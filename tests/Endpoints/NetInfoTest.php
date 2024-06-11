<?php
declare(strict_types=1);

namespace EIYARO\Test\Endpoints;

use EIYARO\API;
use EIYARO\APIClientGuzzle;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class NetInfoTest extends TestCase {
    /**
     * API Client
     * 
     * @property API $api
     */
    private API $api;

    /**
     * setUp method
     * 
     * @return void
     */
    protected function setUp(): void {
        parent::setUp();

        $client = new APIClientGuzzle(BASEURL, 5);
        $this->api = new API($client);
    }

    /**
     * tearDown method
     * 
     * @return void
     */
    protected function tearDown(): void {
        unset($this->api);

        parent::tearDown();
    }

    /**
     * Test the Net Info endpoint
     * 
     * @return void
     */
    public function testNetInfoIsObject(): void {
        $netInfo = $this->api->getNetInfo();
        $this->assertIsObject($netInfo);
        //$this->assertGreaterThanOrEqual(0, $netInfo->HighestBlock, "NetInfo Height >= 0");
    }

}