<?php

declare(strict_types=1);

namespace App\DTO;

class EmailContextDTO
{
    public string $signedUrl;
    public string $expiresAtMessageKey;
    public array $expiresAtMessageData;

    public function __construct(string $signedUrl, string $expiresAtMessageKey, array $expiresAtMessageData)
    {
        $this->signedUrl = $signedUrl;
        $this->expiresAtMessageKey = $expiresAtMessageKey;
        $this->expiresAtMessageData = $expiresAtMessageData;
    }

    /**
     * @param mixed $signatureComponents
     * 
     * @return self
     */
    public static function fromSignatureComponents($signatureComponents): self
    {
        return new self(
            $signatureComponents->getSignedUrl(),
            $signatureComponents->getExpirationMessageKey(),
            $signatureComponents->getExpirationMessageData()
        );
    }

    // You can also add getter and setter methods if needed.
}