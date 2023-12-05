<?php

namespace App\Services;

use Symfony\Component\Mailer\MailerInterface;
Use Symfony\Component\Mime\Email;

class MailerService
{
    public function __construct (private MailerInterface $mailer) {

    }

    public function sendEmail(
        $to = 'ipmsanteplus@gmail.com',
        $from='',
        $subject = 'This is the Mail subject !',
        $content = '',
        $text = ''
    ): void{
        $email = (new Email())
            ->from($from)
            ->to($to)
            ->subject($subject)
            ->text($text)
            ->html($content);
        $this->mailer->send($email);
    }
}