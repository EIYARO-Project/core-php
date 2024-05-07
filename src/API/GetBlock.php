<?php

declare(strict_types = 1);

namespace EIYARO\API;


class GetBlock implements \JsonSerializable {
    public int $BlockHeight;
    public string|null $BlockHash;

    public function __construct(int $blockNum = 0, string|null $blockHash = null) {
        $this->BlockHeight = $blockNum;
        $this->BlockHash = $blockHash;
    }

    public function jsonSerialize(): array {
        if ($this->BlockHeight < 0) {
            return [
                "block_height"=> null,
                "block_hash"=> $this->BlockHash,
            ];
        } else {
            return [
                "block_height"=> $this->BlockHeight,
                "block_hash"=> $this->BlockHash,
            ];
        }
    }
}