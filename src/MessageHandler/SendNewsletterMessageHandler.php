<?php

namespace App\MessageHandler;

use App\Entity\Newsletters\Newsletters;
use App\Entity\Newsletters\Users;
use App\Message\SendNewsletterMessage;
use App\Service\SendNewsletterService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class SendNewsletterMessageHandler implements MessageHandlerInterface
{
    private EntityManagerInterface $em;
    private SendNewsletterService $newsService;

    public function __construct(EntityManagerInterface $em, SendNewsletterService $newsService)
    {
        $this->em = $em;   
        $this->newsService = $newsService;   
    }

    public function __invoke(SendNewsletterMessage $message)
    {
        // do something with your message
        $user = $this->em->find(Users::class, $message->getUserId());
        $newsletter = $this->em->find(Newsletters::class, $message->getNewsId());

        // On vérifie qu'on a toutes les informations nécessaires
        if($newsletter !== null && $user !== null){
            $this->newsService->send($user, $newsletter);
        }
    }
}
