<?php

declare(strict_types=1);

namespace App\Service\Calculation;

use App\Domain\Exam;
use App\Domain\GradeResult;

class PearsonCorrelationCalculatorService implements GradeCalculatorInterface
{
    public function calculate(Exam $exam)
    {
        $results = [];

        foreach ($exam->questions as $question) {
            $itemScores = [];
            $totalScores = [];

            foreach ($exam->students as $student) {
                $itemScores[] = $student->scores[$question->number - 1];
                $totalScores[] = array_sum($student->scores);
            }

            $results[$question->number] =
                $this->calculateCorrelation(
                    $itemScores,
                    $totalScores,
                );
        }

        return $results;
    }

    private function calculateCorrelation(array $itemScores, array $totalScores): float
    {
        $count = count($itemScores);

        $meanItemScores = array_sum($itemScores) / $count;
        $meanTotalScores = array_sum($totalScores) / $count;

        $numerator = 0.0;
        $sumItemScores = 0.0;
        $sumTotalScores = 0.0;

        for ($i = 0; $i < $count; $i++) {
            $dItemScores = $itemScores[$i] - $meanItemScores;
            $dTotalScores = $totalScores[$i] - $meanTotalScores;

            $numerator += $dItemScores * $dTotalScores;
            $sumItemScores += $dItemScores ** 2;
            $sumTotalScores += $dTotalScores ** 2;
        }

        $denominator = sqrt($sumItemScores * $sumTotalScores);

        if ($denominator === 0.0) {
            return 0.00;
        }

        return round($numerator / $denominator, 2);
    }
}
