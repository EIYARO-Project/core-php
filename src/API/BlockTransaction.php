<?php

declare(strict_types = 1);

namespace EIYARO\API;

class BlockTransaction implements \JsonSerializable {
    public string $ID;
    public int $Version;
    public int $Size;
    public int $TimeRange;
    public array $Inputs;
    public array $Outputs;
    public bool $StatusFail;
    public string $MuxID;

    public function __construct(object $json) {
        $this->ID = $json->id;
        $this->Version = $json->version;
        $this->Size = $json->size;
        $this->TimeRange = $json->time_range;
        if (count($json->inputs) > 0) {
            foreach ($json->inputs as $input) {
                $this->Inputs[] = new TransactionInput($input);
            }
        } else {
            $this->Inputs = [];
        }
        if (count($json->outputs) > 0) {
            foreach ($json->outputs as $output) {
                $this->Outputs[] = new TransactionOutput($output);
            }
        } else {
            $this->Outputs = [];
        }
        $this->StatusFail = $json->status_fail;
        $this->MuxID = $json->mux_id;
    }

    public function jsonSerialize(): array {
        return [
            "id"=> $this->ID,
            "version"=> $this->Version,
            "size"=> $this->Size,
            "time_range"=> $this->TimeRange,
            "inputs"=> $this->Inputs,
            "outputs"=> $this->Outputs,
            "status_fail"=> $this->StatusFail,
            "mux_id"=> $this->MuxID,
        ];
    }
}