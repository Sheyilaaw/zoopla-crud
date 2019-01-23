<?php

use GuzzleHttp\Client as Client;

class FetchController extends Controller {

    private $area;
    private $api_key;

    public function __construct() {
        $this->area = 'Oxford';
        $this->api_key = getenv('API_KEY');
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

        $listingsUpdated= 0;
        $listingsAdded = 0;

        foreach ($listings as $listing) {
            if(count($existingListingsArr) <= 0) {
                Property::create($listing);
                $listingsAdded++;
            }
            else {
                $listingId = $listing['listing_id'];
                if(in_array($listingId, $existingListingsArr)) {
                    Property::updateOrCreate(['listing_id' => $listingId ], $listing );
                    $listingsUpdated++;
                }else {
                    Property::create($listing);
                    $listingsAdded++;
                }
            }
        }
        $this->render('fetch/index',[
            'listingsAdded' => $listingsAdded,
            'listingsUpdated' => $listingsUpdated
        ]);
    }

}