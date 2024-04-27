<?php

declare(strict_types = 1);

namespace EIYARO;

use EIYARO\API\NetInfo;
use EIYARO\API\GetBlock;
use EIYARO\API\Block;
use EIYARO\API\GetTransaction;
use EIYARO\API\PendingTransactions;
use EIYARO\API\Transaction;
use EIYARO\API\BlockTransaction;
use EIYARO\API\Asset;
use EIYARO\API\HashRate;

class API {
    private $api_client;
    private $login;
    private $password;

    function __construct(string $base_uri, string|null $accessToken = null){
        $this->login = null;
        $this->password = null;
        if ($accessToken !== null && str_contains($accessToken, ":")){
            list($this->login, $this->password) = explode(":", $accessToken);
        }
        if ($this->login && $this->password){
            $this->api_client = new APIClient($base_uri, 5, $this->login, $this->password);
        } else {
            $this->api_client = new APIClient($base_uri, 5);
        }
    }

    public function getNetInfo(): NetInfo|null {
        try{
            $response = $this->api_client->get('net-info');
            $json = json_decode((string)$response->getBody());
            if ($response->getStatusCode() == 200 && $json->status == 'success') {
                $net_info = new NetInfo($json->data);
                return $net_info;
            } else {
                if (isset($json->detail)) {
                    throw new \Exception("Error({$json->code}): {$json->msg}({$json->detail})");
                } else {
                    throw new \Exception("Error({$json->code}): {$json->msg}({$json->error_detail})");
                }
            }
        } catch (\Exception $e){
            //echo $e->getMessage() . "\n";
            return null;
        }
    }

    public function getBlockCount(): int|null {
        try{
            $response = $this->api_client->get('get-block-count');
            $json = json_decode((string)$response->getBody());
            if ($response->getStatusCode() == 200 && $json->status == 'success') {
                $blockCount = intval($json->data->block_count);
                return $blockCount;
            } else {
                if (isset($json->detail)) {
                    throw new \Exception("Error({$json->code}): {$json->msg}({$json->detail})");
                } else {
                    throw new \Exception("Error({$json->code}): {$json->msg}({$json->error_detail})");
                }
            }
        } catch (\Exception $e){
            //echo $e->getMessage() . "\n";
            return null;
        }
    }
    public function getBlock(int $blockNum, string|null $blockHash = null): Block|null {
        try{
            $getBlock = new GetBlock($blockNum, $blockHash);
            $response = $this->api_client->post('get-block', json_encode($getBlock));
            $json = json_decode((string)$response->getBody());
            if ($response->getStatusCode() == 200 && $json->status == 'success') {
                $block = new Block($json->data);
                return $block;
            } else {
                if (isset($json->detail)) {
                    throw new \Exception("Error({$json->code}): {$json->msg}({$json->detail})");
                } else {
                    throw new \Exception("Error({$json->code}): {$json->msg}({$json->error_detail})");
                }
            }
        } catch (\Exception $e){
            //echo $e->getMessage() . "\n";
            return null;
        }
    }

    public function getTransaction(string $hash): Transaction|null {
        try{
            $getTransaction = new GetTransaction($hash);
            $response = $this->api_client->post('get-transaction', json_encode($getTransaction));
            $json = json_decode((string)$response->getBody());
            if ($response->getStatusCode() == 200 && $json->status == 'success') {
                $transaction = new Transaction($json->data);
                return $transaction;

            } else {
                if (isset($json->detail)) {
                    throw new \Exception("Error({$json->code}): {$json->msg}({$json->detail})");
                } else {
                    throw new \Exception("Error({$json->code}): {$json->msg}({$json->error_detail})");
                }
            }
        } catch (\Exception $e){
            //echo $e->getMessage() . "\n";
            return null;
        }
    }

    public function getPendingTransactions(): PendingTransactions|null {
        try{
            $response = $this->api_client->post('list-unconfirmed-transactions');
            $json = json_decode((string)$response->getBody());
            if ($response->getStatusCode() == 200 && $json->status == 'success') {
                $transactions = new PendingTransactions($json->data);
                return $transactions;

            } else {
                if (isset($json->detail)) {
                    throw new \Exception("Error({$json->code}): {$json->msg}({$json->detail})");
                } else {
                    throw new \Exception("Error({$json->code}): {$json->msg}({$json->error_detail})");
                }
            }
        } catch (\Exception $e){
            //echo $e->getMessage() . "\n";
            return null;
        }
    }
    public function getPendingTransaction(string $hash): BlockTransaction|null {
        try{
            $getTransaction = new GetTransaction($hash);
            $response = $this->api_client->post('get-unconfirmed-transaction', json_encode($getTransaction));
            $json = json_decode((string)$response->getBody());
            if ($response->getStatusCode() == 200 && $json->status == 'success') {
                $transaction = new BlockTransaction($json->data);
                return $transaction;
            } else {
                if (isset($json->detail)) {
                    throw new \Exception("Error({$json->code}): {$json->msg}({$json->detail})");
                } else {
                    throw new \Exception("Error({$json->code}): {$json->msg}({$json->error_detail})");
                }
            }
        } catch (\Exception $e){
            //echo $e->getMessage() . "\n";
            return null;
        }
    }

    public function getAssets(): array|null {
        try{
            $response = $this->api_client->post('list-assets', '{}');
            $json = json_decode((string)$response->getBody());
            if ($response->getStatusCode() == 200 && $json->status == 'success') {
                $assets = [];
                foreach ($json->data as $asset) {
                    $assets[] = new Asset($asset);
                }
                return $assets;
            } else {
                if (isset($json->detail)) {
                    throw new \Exception("Error({$json->code}): {$json->msg}({$json->detail})");
                } else {
                    throw new \Exception("Error({$json->code}): {$json->msg}({$json->error_detail})");
                }
            }
        } catch (\Exception $e){
            //echo $e->getMessage() . "\n";
            return null;
        }
    }

    public function getAsset(string $assetID): Asset|null {
        try{
            $response = $this->api_client->post('get-asset', "{\"id\": \"{$assetID}\"}");
            $json = json_decode((string)$response->getBody());
            if ($response->getStatusCode() == 200 && $json->status == 'success') {
                $asset = new Asset($json->data);
                return $asset;
            } else {
                if (isset($json->detail)) {
                    throw new \Exception("Error({$json->code}): {$json->msg}({$json->detail})");
                } else {
                    throw new \Exception("Error({$json->code}): {$json->msg}({$json->error_detail})");
                }
            }
        } catch (\Exception $e){
            //echo $e->getMessage() . "\n";
            return null;
        }
    }

    public function getHashRate(int $blockNum): HashRate|null {
        try{
            $getBlock = new GetBlock($blockNum);
            $response = $this->api_client->post('get-hash-rate', json_encode($getBlock));
            $json = json_decode((string)$response->getBody());
            if ($response->getStatusCode() == 200 && $json->status == 'success') {
                $hashRate = new HashRate($json->data);
                return $hashRate;
            } else {
                if (isset($json->detail)) {
                    throw new \Exception("Error({$json->code}): {$json->msg}({$json->detail})");
                } else {
                    throw new \Exception("Error({$json->code}): {$json->msg}({$json->error_detail})");
                }
            }
        } catch (\Exception $e){
            //echo $e->getMessage() . "\n";
            return null;
        }
    }}

