<?php

namespace MagdKudama\Loqate;

use MagdKudama\Loqate\Api\BankAccountApi;

class Client
{
    private $bankAccountApi;

    public function __construct(string $apiKey)
    {
        $this->bankAccountApi = new BankAccountApi($apiKey);
    }

    public function bankAccount(): BankAccountApi
    {
        return $this->bankAccountApi;
    }
}
