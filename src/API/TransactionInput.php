<?php

declare(strict_types = 1);

namespace EIYARO\API;

class TransactionInput implements \JsonSerializable {
    public string $Type;
    public string $AssetID;
    public string $AssetAlias;
    public object|null $AssetDefinition;
    public int $Amount;
    public string $IssuanceProgram;
    public string $ControlProgram;
    public string $Address;
    public string $SpentOutputID;
    public string $AccountID;
    public string $AccountAlias;
    public string $Arbitrary;
    public string $InputID;
    public array $WitnessArguments;
    public string $SignData;

    public function __construct(object $json) {
        $this->Type = $json->type;
        $this->AssetID = $json->asset_id;
        if (isset($json->asset_alias)) {
            $this->AssetAlias = $json->asset_alias;
        } else {
            $this->AssetAlias = '';
        }
        $this->AssetDefinition = $json->asset_definition;
        $this->Amount = $json->amount;
        if (isset($json->issuance_program)) {
            $this->IssuanceProgram = $json->issuance_program;
        } else {
            $this->IssuanceProgram = '';
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
        if (isset($json->spent_output_id)) {
            $this->SpentOutputID = $json->spent_output_id;
        } else {
            $this->SpentOutputID = '';
        }
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
        if (isset($json->arbitrary)) {
            $this->Arbitrary = $json->arbitrary;
        } else {
            $this->Arbitrary = '';
        }
        $this->InputID = $json->input_id;
        if (isset($json->witness_arguments)) {
            $this->WitnessArguments = $json->witness_arguments;
        } else {
            $this->WitnessArguments = [];
        }
        $this->SignData = $json->sign_data;
    }

    public function jsonSerialize(): array {
        return [
            "type"=> $this->Type,
            "asset_id"=> $this->AssetID,
            "asset_alias"=> $this->AssetAlias,
            "asset_definition"=> $this->AssetDefinition,
            "amount"=> $this->Amount,
            "issuance_program"=> $this->IssuanceProgram,
            "control_program"=> $this->ControlProgram,
            "address"=> $this->Address,
            "spent_output_id"=> $this->SpentOutputID,
            "account_id"=> $this->AccountID,
            "account_alias"=> $this->AccountAlias,            
            "arbitrary"=> $this->Arbitrary,
            "input_id"=> $this->InputID,
            "witness_arguments"=> $this->WitnessArguments,
            "sign_data"=> $this->SignData,
        ];
    }
}