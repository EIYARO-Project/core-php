<?php

declare(strict_types = 1);

namespace EIYARO\API;

class NetInfo implements \JsonSerializable {
    public bool $Listening;
    public bool $Syncing;
    public bool $Mining;
    public int $PeerCount;
    public int $CurrentBlock;
    public int $HighestBlock;
    public string $NetworkID;
    public  NetInfoVersion $VersionInfo;

    public function __construct(object $json) {
        $this->Listening = $json->listening;
        $this->Syncing = $json->syncing;
        $this->Mining = $json->mining;
        $this->PeerCount = intval($json->peer_count);
        $this->CurrentBlock = intval($json->current_block);
        $this->HighestBlock = intval($json->highest_block);
        $this->NetworkID = $json->network_id;
        $this->VersionInfo = new NetInfoVersion($json->version_info);
    }

    public function jsonSerialize(): array {
        return [
            'listening'=> $this->Listening,
            'syncing'=> $this->Syncing,
            'mining'=> $this->Mining,
            'peer_count'=> $this->PeerCount,
            'current_block'=> $this->CurrentBlock,
            'highest_block'=> $this->HighestBlock,
            'network_id'=> $this->NetworkID,
            'version_info'=> $this->VersionInfo,
        ];
    }
}