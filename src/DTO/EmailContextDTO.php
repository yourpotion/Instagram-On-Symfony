<?php

declare(strict_types=1);

namespace App\DTO;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;

class EmailContextDTO
{
    /**
     * @var string
     */
    public string $signedUrl;
    /**
     * @var string
     */
    public string $expiresAtMessageKey;
    /**
     * @var array
     */
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


    /**
     * @param EmailContextDTO $emailContextDTO
     * @param TemplatedEmail $email
     * 
     * @return mixed
     */
    public static function prepareEmail(EmailContextDTO $emailContextDTO,TemplatedEmail $email): mixed
    {
        $context = $email->getContext();
        $context['signedUrl'] = $emailContextDTO->signedUrl;
        $context['expiresAtMessageKey'] = $emailContextDTO->expiresAtMessageKey;
        $context['expiresAtMessageData'] = $emailContextDTO->expiresAtMessageData;

        $email->context($context);

        return $email;
    }

    // You can also add getter and setter methods if needed.
}
