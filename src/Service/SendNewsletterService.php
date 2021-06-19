<?php
namespace App\Service;

use App\Entity\Newsletters\Newsletters;
use App\Entity\Newsletters\Users;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;

class SendNewsletterService
{
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function send(Users $user, Newsletters $newsletter):void
    {
        sleep(3);
        // throw new \Exception('Message non envoyé');
        $email = (new TemplatedEmail())
            ->from('newsletter@site.fr')
            ->to($user->getEmail())
            ->subject($newsletter->getName())
            ->htmlTemplate('emails/newsletter.html.twig')
            ->context(compact('newsletter', 'user'))
        ;
        $this->mailer->send($email);
    }
}