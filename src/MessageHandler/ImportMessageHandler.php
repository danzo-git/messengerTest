<?php

namespace App\MessageHandler;

use App\Message\ImportMessage;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use App\Service\CsvProcessor;

#[AsMessageHandler]
final class ImportMessageHandler
{
    private CsvProcessor $csvProcessor;

    public function __construct(CsvProcessor $csvProcessor)
    {
        $this->csvProcessor = $csvProcessor;
    }

    public function __invoke(ImportMessage $message)
    {
        $filePath = $message->getFilePath();
        $lines = $this->csvProcessor->readCsvFile($filePath);

     
    }
}
