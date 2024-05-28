<?php

namespace App\MessageHandler;

use App\Message\SendEmailMessage;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use  Symfony\Component\Messenger\MessageBusInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Service\MailerService;



#[AsMessageHandler]
final class SendEmailMessageHandler
{
    private EntityManagerInterface $entityManager;
    private MailerService $mailer;
    public function __construct(EntityManagerInterface $entityManager, MailerService $mailer)
    {
        $this->entityManager = $entityManager;
        $this->mailer = $mailer;
        
    }
    public function __invoke(SendEmailMessage $message)
    {
        $this->mailer->sendEmail('kouamedenzel09@gmail.com', 'test', 'test');
    }
}
