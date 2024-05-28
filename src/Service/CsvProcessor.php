<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class CsvProcessor
{
    public function readCsvFile(string $filePath): array
    {
        $lines = [];
        if (($handle = fopen($filePath, 'r')) !== false) {
            while (($data = fgetcsv($handle, 1000, ',')) !== false) {
                $lines[] = $data;
            }
            fclose($handle);
        }

        return $lines;
    }
}
