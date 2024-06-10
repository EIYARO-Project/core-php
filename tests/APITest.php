<?php
declare(strict_types=1);

namespace EIYARO\Test\API;

use EIYARO\API;
use EIYARO\APIClientGuzzle;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

const BASEURL = "http://localhost:9888";

class APITest extends TestCase {
    /**
     * Test the Net Info endpoint
     * 
     * @return void
     */
    public function testNetInfo(): void {
        $client = new APIClientGuzzle(BASEURL, 5);
        $api = new API($client);
        $netInfo = $api->getNetInfo();
        $this->assertIsObject($netInfo);
    }

    /**
     * Test the Get Block Count endpoint
     * 
     * @return void
     */
    public function testBlockCount(): void {
        $client = new APIClientGuzzle(BASEURL, 5);
        $api = new API($client);
        $blockCount = $api->getBlockCount();
        $this->assertIsInt($blockCount);
    }
}