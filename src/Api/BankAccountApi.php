<?php

namespace MagdKudama\Loqate\Api;

use MagdKudama\Loqate\Api\Model\BankAccountValidationResult;

class BankAccountApi extends BaseApiClient
{
    public function validate(string $sortCode, string $accountNumber): BankAccountValidationResult
    {
        $qs = [
            'Key' => $this->apiKey,
            'AccountNumber' => $accountNumber,
            'SortCode' => $sortCode,
        ];

        $response = $this->executeGet('BankAccountValidation/Interactive/Validate/v2/json3.ws?' . http_build_query($qs));

        if (!isset($response['Items']) || !is_array($response['Items']) || count($response['Items']) !== 1) {
            throw new ClientException('Invalid response from API');
        }

        $data = $response['Items'][0];

        if (isset($data['Error'])) {
            throw new ClientException('Response error: ' . $data['Cause']);
        }

        return new BankAccountValidationResult($data['IsCorrect']);
    }
}
