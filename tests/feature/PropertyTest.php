<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class PropertyTest extends TestCase {

    private $http;

    public function setUp() {
        $this->http = new GuzzleHttp\Client([
            'base_uri' => 'http://api.zoopla.co.uk/api/v1/'
        ]);
    }

    public function testPropertyListingsCanBeFetched(): void {
        $response = $this->http->request('GET', 'property_listings.json', [
            'query' => [
                'area' => 'Oxford',
                'api_key' => 'raqjr53tyfbdytqt8bc7r3h8',
            ]
        ]);

        $this->assertEquals(200, $response->getStatusCode());
    }

    public function tearDown(): void {
        $this->http = null;
    }

}