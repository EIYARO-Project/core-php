<?php

declare(strict_types=1);

namespace EIYARO\API;

class AssetDefinition implements \JsonSerializable {
    public int $Decimals;
    public string|object $Description;
    public string $Name;
    public string $Symbol;

    public function __construct(object $json)
    {
        if (isset($json->decimals)) {
            $this->Decimals = $json->decimals;
        }
        if (isset($json->description)) {
            $this->Description = $json->description;
        }
        if (isset($json->name)) {
            $this->Name = $json->name;
        }
        if (isset($json->symbol)) {
            $this->Symbol = $json->symbol;
        }
    }

    public function jsonSerialize(): object {
        $result = new \stdClass;
        if (isset($this->Decimals)) {
            $result->decimals = $this->Decimals;
        }
        if (isset($this->Description)) {
            $result->description = $this->Description;
        }
        if (isset($this->Name)) {
            $result->name = $this->Name;
        }
        if (isset($this->Symbol)) {
            $result->symbol = $this->Symbol;
        }
        return $result;
    }
}