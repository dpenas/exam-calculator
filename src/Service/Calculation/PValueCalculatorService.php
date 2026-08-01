<?php

declare(strict_types=1);

namespace App\Service\Calculation;

use App\Domain\Exam;

final class PValueCalculatorService implements GradeCalculatorInterface
{
    public function calculate(Exam $exam): array
    {
        $results = [];

        foreach ($exam->questions as $question) {
            $totalScore = 0;

            foreach ($exam->students as $student) {
                $totalScore += $student->scores[$question->number - 1];
            }

            $averageScore = $totalScore/count($exam->students);

            $results[$question->number] = round(
                $averageScore / $question->maxScore,
                2,
            );
        }

        return $results;
    }
}