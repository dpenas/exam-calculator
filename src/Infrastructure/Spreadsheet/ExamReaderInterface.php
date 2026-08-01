<?php

declare(strict_types=1);

namespace App\Infrastructure\Spreadsheet;

use App\Domain\Exam;

interface ExamReaderInterface
{
    public function read(string $filename): Exam;
}
