<?php

declare(strict_types=1);

namespace App\Service;

use App\Security\EmailConfirmationDTO;
use App\Security\EmailVerifier;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mime\Address;

class RegistrationService {
    private EmailVerifier $emailVerifier;

    public function __construct(EmailVerifier $emailVerifier)
    {
        $this->emailVerifier = $emailVerifier;
    }
    /**
     * @param mixed $user
     * 
     * @return void
     */
    public function emailConfirmation($user): void
    {
        $this->emailVerifier->sendEmailConfirmation(
                'app_verify_email',
                $user,
                (new TemplatedEmail())
                    ->from(new Address('tikhonvasilevich@gmail.com', 'Ti'))
                    ->to($user->getEmail())
                    ->subject('Please Confirm your Email')
                    ->htmlTemplate('registration/confirmation_email.html.twig'),
            );

        }
}