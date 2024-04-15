<?php

declare(strict_types = 1);

namespace EIYARO\API;

class TransactionOutput implements \JsonSerializable {
    public string $Type;
    public string $ID;
    public int $Position;
    public string $AssetID;
    public string $AssetAlias;
    public object|null $AssetDefinition;
    public int $Amount;
    public string $AccountID;
    public string $AccountAlias;
    public string $ControlProgram;
    public string $Address;

    public function __construct(object $json) {
        $this->Type = $json->type;
        $this->ID = $json->id;
        $this->Position = $json->position;
        $this->AssetID = $json->asset_id;
        if (isset($json->asset_alias)) {
            $this->AssetAlias = $json->asset_alias;
        } else {
            $this->AssetAlias = '';
        }
        $this->AssetDefinition = $json->asset_definition;
        $this->Amount = $json->amount;
        if (isset($json->account_id)) {
            $this->AccountID = $json->account_id;
        } else {
            $this->AccountID = '';
        }
        if (isset($json->account_alias)) {
            $this->AccountAlias = $json->account_alias;
        } else {
            $this->AccountAlias = '';
        }
        if (isset($json->control_program)) {
            $this->ControlProgram = $json->control_program;
        } else {
            $this->ControlProgram = '';
        }
        if (isset($json->address)) {
            $this->Address = $json->address;
        } else {
            $this->Address = '';
        }
    }

    public function jsonSerialize(): array {
        return [
            "type"=> $this->Type,
            "id"=> $this->ID,
            "position"=> $this->Position,
            "asset_id"=> $this->AssetID,
            "asset_alias"=> $this->AssetAlias,
            "asset_definition"=> $this->AssetDefinition,
            "amount"=> $this->Amount,
            "account_id"=> $this->AccountID,
            "account_alias"=> $this->AccountAlias,            
            "control_program"=> $this->ControlProgram,
            "address"=> $this->Address,
        ];
    }
}