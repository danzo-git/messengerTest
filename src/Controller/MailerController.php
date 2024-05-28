<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Mime\Email;
use Symfony\Component\Messenger\MessageBusInterface;
use App\Message\SendEmailMessage;







class MailerController extends AbstractController
{
    private MailerService $mailer;
    private MessageBusInterface $messageBus;
    public function __construct( MessageBusInterface $messageBus)
    {
        
        $this->messageBus = $messageBus;
    }

    #[Route('/mailer/send', name: 'app_mailer_send')]
    public function send(MessageBusInterface $messageBus): Response
    {
      $messageBus->dispatch(new SendEmailMessage('kouamedenzel09@gmail.com', 'test', 'test'));

        return new Response('ok');
    }
    #[Route('/mailer', name: 'app_mailer')]
    public function index(): Response
    {
        return $this->render('mailer/index.html.twig', [
            'controller_name' => 'MailerController',
        ]);
    }
}
