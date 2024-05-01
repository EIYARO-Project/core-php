<?php

declare(strict_types=1);

namespace EIYARO\API;

class ValidateAddress implements \JsonSerializable {
    public bool $Valid;
    public bool $IsLocal;

    public function __construct(object $json)
    {
        $this->Valid = $json->valid;
        $this->IsLocal = $json->is_local;
    }

    public function jsonSerialize(): object {
        $result = new \stdClass;
        $result->valid = $this->Valid;
        $result->is_local = $this->IsLocal;
        return $result;
    }
}