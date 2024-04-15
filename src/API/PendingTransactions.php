<?php

declare(strict_types=1);

namespace EIYARO\API;

class PendingTransactions implements \JsonSerializable {
    public int $Total;
    public array $Transactions;

    public function __construct(object $json)
    {
        if (isset($json->total)) {
            $this->Total = $json->total;
        }
        if (isset($json->tx_ids)) {
            $this->Transactions = $json->tx_ids;
        }
    }

    public function jsonSerialize(): object {
        $result = new \stdClass;
        $result->total = $this->Total;
        $result->tx_ids = $this->Transactions;
        return $result;
    }
}