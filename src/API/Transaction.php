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
    public array $Inputs;
    public array $Outputs;
    public bool $StatusFail;
    public int $Size;

    public function __construct(object $json) {
        $this->TxID = $json->tx_id;
        $this->BlockTime = $json->block_time;
        $this->BlockHash = $json->block_hash;
        $this->BlockHeight = $json->block_height;
        $this->BlockIndex = $json->block_index;
        $this->BlockTransactionsCount = $json->block_transactions_count;        
        if (count($json->inputs) > 0) {
            foreach ($json->inputs as $input) {
                $this->Inputs[] = new TransactionInput($input);
            }
        } else {
            $this->Inputs = [];
        }
        if (count($json->outputs) > 0) {
            foreach ($json->outputs as $output) {
                $this->Outputs[] = new TransactionOutput($output);
            }
        } else {
            $this->Outputs = [];
        }
        $this->StatusFail = $json->status_fail;
        $this->Size = $json->size;
    }

    private function FormattedDateTime(int $seconds) {
        return gmdate("Y-m-d H:i:s", $seconds);
    }

    public function __get($name) {
        switch ($name) {
            case 'BlockTimeFormatted':
                return $this->FormattedDateTime($this->BlockTime);
            default:
              return '';
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
            "inputs"=> $this->Inputs,
            "outputs"=> $this->Outputs,
            "status_fail"=> $this->StatusFail,
            "size"=> $this->Size,
        ];
    }
}