<?php

declare(strict_types = 1);

namespace EIYARO\API;


class GetTransaction implements \JsonSerializable {
    public string $Hash;

    public function __construct(string $hash = null) {
        $this->Hash = $hash;
    }

    public function jsonSerialize(): array {
        return [
            "tx_id"=> $this->Hash,
        ];
    }
}