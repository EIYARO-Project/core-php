<?php

declare(strict_types=1);

namespace EIYARO\API;

class HashRate implements \JsonSerializable {
    public string $Hash;
    public int $HashRate;
    public int $Height;

    public function __construct(object $json)
    {
        $this->Hash = $json->hash;
        $this->HashRate = $json->hash_rate;
        $this->Height = $json->height;
    }

    public function jsonSerialize(): object {
        $result = new \stdClass;
        $result->hash = $this->Hash;
        $result->hash_rate = $this->HashRate;
        $result->height = $this->Height;
        return $result;
    }
}