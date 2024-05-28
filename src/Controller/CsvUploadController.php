<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use App\Service\CsvProcessor;
use App\Form\ImportType;
use Symfony\Component\Messenger\MessageBusInterface;
use App\Message\ImportMessage;

class CsvUploadController extends AbstractController
{
    private MessageBusInterface $messageBus;

    public function __construct(MessageBusInterface $messageBus)
    {
        $this->messageBus = $messageBus;
    }

    #[Route('/csv/upload', name: 'app_csv_upload')]
    public function upload(Request $request, CsvProcessor $csvProcessor): Response
    {
        $form = $this->createForm(ImportType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $file */
            $file = $form->get('file')->getData();
            if ($file instanceof UploadedFile) {
                $this->messageBus->dispatch(new ImportMessage($file->getPathname()));

                $this->addFlash('success', 'CSV file has been uploaded and is being processed.');
                return $this->redirectToRoute('app_csv_upload');
            }
        }

        return $this->render('csv_upload/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
