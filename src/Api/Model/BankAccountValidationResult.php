<?php

namespace MagdKudama\Loqate\Api\Model;

class BankAccountValidationResult
{
    private $ok;

    public function __construct(bool $ok)
    {
        $this->ok = $ok;
    }

    public function isOk(): bool
    {
        return $this->ok;
    }
}
