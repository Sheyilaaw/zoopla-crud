<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class PropertyTest extends TestCase {

    private $http;
    private $area;
    private $api_key;

    public function setUp() {
        //Load Env
        $path = realpath(dirname(__FILE__))."\..\\..\\boot.php" ;
        require_once $path;
        $this->area = 'Oxford';
        $this->api_key = getenv('API_KEY');
        $this->http = new GuzzleHttp\Client();
    }

    public function testPropertyListingsCanBeFetched(): void {
        $response = $this->http->request('GET', 'http://api.zoopla.co.uk/api/v1/property_listings.json', [
            'query' => [
                'area' => $this->area,
                'api_key' => $this->api_key
            ]
        ]);
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function testPropertyListingsFetchedSuccessfully(): void {
        $response = $this->http->request('GET', 'http://localhost/zoopla-crud/fetch');
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertRegExp("/Database Populated Successfully from Zoopla Api/",(string) $response->getBody());
    }

    public function tearDown(): void {
        $this->http = null;
    }

}