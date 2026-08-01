<?php

declare(strict_types=1);

namespace App\Domain;

final readonly class Question
{
    public function __construct(
        public int $number,
        public int $maxScore,
    ) {}
}
