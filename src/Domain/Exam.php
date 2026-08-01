<?php

declare(strict_types=1);

namespace App\Domain;

final readonly class Exam
{
    public function __construct(
        public array $questions,
        public array $students,
    ) {
    }
}
