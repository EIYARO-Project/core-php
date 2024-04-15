<?php

declare(strict_types = 1);

namespace EIYARO\API;

class Transaction implements \JsonSerializable {
    public string $TxID;
    public int $BlockTime;
    public string $BlockHash;
    public int $BlockHeight;
    public int $BlockIndex;
    public int $BlockTransactionsCount;
    public array $inputs;
    public array $outputs;
    public bool $statusFail;
    public int $size;

    public function __construct(object $json) {
        $this->TxID = $json->tx_id;
        $this->BlockTime = $json->block_time;
        $this->BlockHash = $json->block_hash;
        $this->BlockHeight = $json->block_height;
        $this->BlockIndex = $json->block_index;
        $this->BlockTransactionsCount = $json->block_transactions_count;        
        if (count($json->inputs) > 0) {
            foreach ($json->inputs as $input) {
                $this->inputs[] = new TransactionInput($input);
            }
        } else {
            $this->inputs = [];
        }
        if (count($json->outputs) > 0) {
            foreach ($json->outputs as $output) {
                $this->outputs[] = new TransactionOutput($output);
            }
        } else {
            $this->outputs = [];
        }
        $this->statusFail = $json->status_fail;
        $this->size = $json->size;
    }

    private function FormattedDateTime(int $seconds) {
        return gmdate("Y-m-d H:i:s", $seconds);
    }

    public function __get($name) {
        switch ($name) {
            case 'BlockTimeFormatted':
                return $this->FormattedDateTime($this->BlockTime);
                break;
        }
    }

    public function jsonSerialize(): array {
        return [
            "tx_id"=> $this->TxID,
            "block_time"=> $this->BlockTime,
            "block_hash"=> $this->BlockHash,
            "block_height"=> $this->BlockHeight,
            "block_index"=> $this->BlockIndex,
            "block_transactions_count"=> $this->BlockTransactionsCount, 
            "inputs"=> $this->inputs,
            "outputs"=> $this->outputs,
            "status_fail"=> $this->statusFail,
            "size"=> $this->size,
        ];
    }
}