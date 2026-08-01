<?php

declare(strict_types=1);

namespace App\Service\Calculation;

use App\Domain\Exam;

interface GradeCalculatorInterface
{
    public function calculate(Exam $exam);
}
