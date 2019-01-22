<?php

use GuzzleHttp\Client as Client;

class FetchController extends Controller {

    private $area;
    private $api_key;

    public function __construct() {
        $this->area = 'Oxford';
        $this->api_key = 'raqjr53tyfbdytqt8bc7r3h8';
    }

    public function index() {
        $client = new Client;
        $response = $client->request('GET', 'http://api.zoopla.co.uk/api/v1/property_listings.json', [
            'headers' => [
                'Accept' => 'application/json',
                'Content-type' => 'application/json'
            ],
            'query' => [
                'area' => $this->area,
                'api_key' => $this->api_key
            ]
        ]);
        $result = json_decode($response->getBody()->getContents(),true);
        $listings = $result['listing'];

        //Fetch Previous Listings
        $existingListings = Property::select('listing_id')->get()->toArray();
        $existingListingsArr = [];
        foreach ($existingListings as $existingListing){
            array_push($existingListingsArr,array_shift($existingListing));
        }

        foreach ($listings as $listing) {
            if(count($existingListingsArr) <= 0) {
                Property::create($listing);
            }
            else {
                $listingId = $listing['listing_id'];
                if(in_array($listingId, $existingListingsArr)) {
                    Property::updateOrCreate(['listing_id' => $listingId ], $listing );
                }else {
                    Property::create($listing);
                }
            }
        }
        $this->render('fetch/index');
    }

}