<?php

namespace App\Controller;

use Symfony\Component\Mailer\MailerInterface;

class EmailController
{
    /**
     * @var MailerIntarface
     */
    private $mailer;

    /**
     * @param MailerInterface $mailer
     */
    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }
}