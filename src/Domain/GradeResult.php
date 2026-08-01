<?php

declare(strict_types=1);

namespace App\Domain;

final readonly class GradeResult
{
    public function __construct(
        public Student $student,
        public float $grade,
        public bool $passed,
    ) {}
}
