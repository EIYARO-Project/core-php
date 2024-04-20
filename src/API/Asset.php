<?php

declare(strict_types=1);

namespace EIYARO\API;

class Asset implements \JsonSerializable {
    public string $Type;
    public array|null $XPubs;
    public int $Quorum;
    public int $KeyIndex;
    public int $DeriveRule;
    public string $ID;
    public string $Alias;
    public int $VmVersion;
    public string $IssueProgram;
    public string $RawDefinitionByte;
    public AssetDefinition $Definition;
    public int $LimitHeight;

    public function __construct(object $json)
    {
        if (isset($json->type)) {
            $this->Type = $json->type;
        }
        if (isset($json->xpubs)) {
            $this->XPubs = $json->xpubs;
        }
        if (isset($json->quorum)) {
            $this->Quorum = $json->quorum;
        }
        if (isset($json->key_index)) {
            $this->KeyIndex = $json->key_index;
        }
        if (isset($json->derive_rule)) {
            $this->DeriveRule = $json->derive_rule;
        }
        if (isset($json->id)) {
            $this->ID = $json->id;
        }
        if (isset($json->alias)) {
            $this->Alias = $json->alias;
        }
        if (isset($json->vm_version)) {
            $this->VmVersion = $json->vm_version;
        }
        if (isset($json->issue_program)) {
            $this->IssueProgram = $json->issue_program;
        }
        if (isset($json->raw_definition_byte)) {
            $this->RawDefinitionByte = $json->raw_definition_byte;
        }
        if (isset($json->definition)) {
            $this->Definition = new AssetDefinition($json->definition);
        }
        if (isset($json->limit_height)) {
            $this->LimitHeight = $json->limit_height;
        }
    }

    public function jsonSerialize(): object {
        $result = new \stdClass;
        if (isset($this->Type)) {
            $result->type = $this->Type;
        }
        if (isset($this->XPubs)) {
            $result->xpubs = $this->XPubs;
        } else {
            $result->xpubs = null;
        }
        if (isset($this->Quorum)) {
            $result->quorum = $this->Quorum;
        }
        if (isset($this->KeyIndex)) {
            $result->key_index = $this->KeyIndex;
        }
        if (isset($this->DeriveRule)) {
            $result->derive_rule = $this->DeriveRule;
        }
        if (isset($this->ID)) {
            $result->id = $this->ID;
        }
        if (isset($this->Alias)) {
            $result->alias = $this->Alias;
        }
        if (isset($this->VmVersion)) {
            $result->vm_version = $this->VmVersion;
        }
        if (isset($this->IssueProgram)) {
            $result->issue_program = $this->IssueProgram;
        }
        if (isset($this->RawDefinitionByte)) {
            $result->raw_definition_byte = $this->RawDefinitionByte;
        }
        if (isset($this->Definition)) {
            $result->definition = $this->Definition;
        }
        if (isset($this->LimitHeight)) {
            $result->limit_height = $this->LimitHeight;
        }
        return $result;
    }
}