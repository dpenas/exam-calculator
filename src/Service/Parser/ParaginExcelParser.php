<?php

declare(strict_types=1);

namespace App\Service\Parser;

use App\Domain\Exam;
use App\Domain\Question;
use App\Domain\Student;

class ParaginExcelParser
{
    public function getExam(array $rows): Exam
    {
        $students = [];
        $questions = [];

        foreach (array_slice($rows, 2) as $row) {
            $students[] = new Student(
                id: $row[0], // Student name
                scores: array_map('intval', array_slice($row, 1)),
            );
        }

        foreach (array_slice($rows[1], 1) as $index => $maxScore) {
            $questions[] = new Question(
                number: $index + 1,
                maxScore: (int) $maxScore,
            );
        }

        return new Exam(
            questions: $questions,
            students: $students,
        );
    }
}
