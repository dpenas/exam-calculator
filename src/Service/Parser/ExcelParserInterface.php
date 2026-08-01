<?php
 
declare(strict_types=1);
 
namespace App\Service\Parser;

use App\Domain\Question;
use App\Domain\Student;
use App\Domain\Exam;

class ExcelParserInterface
{
    public function getExam(array $rows): Exam;
}