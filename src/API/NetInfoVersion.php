<?php

declare(strict_types=1);

namespace EIYARO\API;

class NetInfoVersion implements \JsonSerializable {
    public string $Version;
    public int $Update;
    public string $NewVersion;

    public function __construct(object $json)
    {
        $this->Version = $json->version;
        $this->Update = intval($json->update);
        $this->NewVersion = $json->new_version;
    }

    public function jsonSerialize(): array {
        return [
            "version"=> $this->Version,
            "update"=> $this->Update,
            "new_version"=> $this->NewVersion,
        ];
    }
}