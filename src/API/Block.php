<?php

declare(strict_types = 1);

namespace EIYARO\API;

class Block implements \JsonSerializable {
    public string $Hash;
    public int $Size;
    public int $Version;
    public int $Height;
    public string $PreviousBlockHash;
    public int $TimeStamp;
    public int $Nonce;
    public int $Bits;
    public string $Difficulty;
    public string $TransactionMerkleRoot;
    public string $TransactionStatusHash;

    public array $Transactions;

    public function __construct(object $json) {
        $this->Hash = $json->hash;
        $this->Size = $json->size;
        $this->Version = $json->version;
        $this->Height = $json->height;
        $this->PreviousBlockHash = $json->previous_block_hash;
        $this->TimeStamp = $json->timestamp;
        $this->Nonce = $json->nonce;
        $this->Bits = $json->bits;
        $this->Difficulty = $json->difficulty;
        $this->TransactionMerkleRoot = $json->transaction_merkle_root;
        $this->TransactionStatusHash = $json->transaction_status_hash;
        if (count($json->transactions) > 0) {
            foreach ($json->transactions as $transaction) {
                $this->Transactions[] =  new BlockTransaction($transaction);
            }
        } else {
            $this->Transactions = [];
        }
    }

    private function FormattedDateTime(int $seconds) {
        return gmdate("Y-m-d H:i:s", $seconds);
    }

    public function __get($name) {
        switch ($name) {
            case 'TimestampFormatted':
                return $this->FormattedDateTime($this->TimeStamp);
            default:
                return '';
          }
    }

    public function jsonSerialize(): array {
        return [
            "hash"=> $this->Hash,
            "size"=> $this->Size,
            "version"=> $this->Version,
            "height"=> $this->Height,
            "previous_block_hash"=> $this->PreviousBlockHash,
            "timestamp"=> $this->TimeStamp,
            "nonce"=> $this->Nonce,
            "bits"=> $this->Bits,
            "difficulty"=> $this->Difficulty,
            "transaction_merkle_rrot"=> $this->TransactionMerkleRoot,
            "transaction_status_hash"=> $this->TransactionStatusHash,
            "transactions"=> $this->Transactions,
        ];
    }
}