<?php

declare(strict_types=1);

namespace App\Infrastructure\Spreadsheet;

use App\Domain\Exam;
use App\Service\Parser\ParaginExcelParser;
use PhpOffice\PhpSpreadsheet\IOFactory;

final class ParaginExamReader implements ExamReaderInterface
{
    public function read(string $filename): Exam
    {
        $spreadsheet = IOFactory::load($filename);
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray();

        $paraginExcelParser = new ParaginExcelParser();

        return $paraginExcelParser->getExam($rows);
    }
}
