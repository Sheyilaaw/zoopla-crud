<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

final class PagesTest extends TestCase  {

    private $http;

    public function setUp() {
        $this->http = new GuzzleHttp\Client();
    }

    public function testCanLoadHomePage(): void {
        $response = $this->http->request('GET','http://localhost/zoopla-crud');
        $this->assertEquals(200, $response->getStatusCode());
        $pageResponse = ((string) $response->getBody());
        $this->assertRegExp('/All Property Listings/',$pageResponse);
    }

    public function testCanLoadAdminCreatePage(): void {
        $response = $this->http->request('GET','http://localhost/zoopla-crud/admin/create');
        $this->assertEquals(200, $response->getStatusCode());
        $pageResponse = ((string) $response->getBody());
        $this->assertRegExp('/Admin Create Listing/',$pageResponse);
    }

    public function tearDown(): void {
        $this->http = null;
    }

}