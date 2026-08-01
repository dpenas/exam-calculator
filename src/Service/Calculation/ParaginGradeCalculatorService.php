<?php
 
declare(strict_types=1);
 
namespace App\Service\Calculation;

use App\Domain\Exam;
use App\Domain\GradeResult;

class ParaginGradeCalculatorService implements GradeCalculatorInterface
{
    const MIN_PASSING_GRADE = 5.5;

    public function calculate(Exam $exam): array
    {
        $results = [];
        $maxScore = 0;

        foreach ($exam->questions as $question) {
            $maxScore += $question->maxScore;
        }

        foreach ($exam->students as $student) {
            $studentScore = array_sum($student->scores);
            $percentage = $studentScore / $maxScore;
            $grade = $this->calculateGrade($percentage);
            $passed = $this->hasPassed($grade);

            $results[] = new GradeResult($student, $grade, $passed);
        }

        return $results;    
    }

    public function calculateGrade(float $percentage): float
    {
        if ($percentage <= 0.20) {
            return 1.0;
        }

        if ($percentage <= 0.70) {
            $grade = 1.0 + (
                ($percentage - 0.20)
                / (0.70 - 0.20)
            ) * (5.5 - 1.0);

            return round($grade, 1);
        }

        $grade = 5.5 + (
            ($percentage - 0.70)
            / (1.00 - 0.70)
        ) * (10.0 - 5.5);

        return round($grade, 1);
    }

    public function hasPassed(float $percentage): bool
    {
        if ($percentage >= self::MIN_PASSING_GRADE) {
            return true;
        }

        return false;
    }
}