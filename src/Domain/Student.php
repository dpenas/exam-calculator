<?php

declare(strict_types=1);

namespace App\Domain;

final readonly class Student
{
    public function __construct(
        public string $id,
        public array $scores,
    ) {
    }
}
