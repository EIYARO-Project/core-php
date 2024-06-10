<?php
declare(strict_types=1);

namespace EIYARO\Test;

use EIYARO\API;
use EIYARO\APIClientGuzzle;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class BlockCountTest extends TestCase {
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
     * Test the Get Block Count endpoint
     * 
     * @return void
     */
    public function testBlockCountIsInt(): void {
        $client = new APIClientGuzzle(BASEURL, 5);
        $api = new API($client);
        $blockCount = $api->getBlockCount();
        $this->assertIsInt($blockCount);
        $this->assertGreaterThanOrEqual(0, $blockCount, "Block Count >= 0");
    }
}