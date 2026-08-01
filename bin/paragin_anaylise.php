#!/usr/bin/env php
<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Infrastructure\Spreadsheet\ParaginExamReader;
use App\Service\Calculation\ParaginGradeCalculatorService;
use App\Service\Calculation\PValueCalculatorService;

if ($argc < 2) {
    fwrite(STDERR, "Usage: php {$argv[0]} <excel-file>\n");
    exit(1);
}

$excelFile = $argv[1];

if (!is_file($excelFile)) {
    fwrite(STDERR, "Error: File '{$excelFile}' does not exist.\n");
    exit(1);
}

$reader = new ParaginExamReader();
$exam = $reader->read($excelFile);

$gradeCalculator = new ParaginGradeCalculatorService();
$pValueCalculator = new PValueCalculatorService();

$grades = $gradeCalculator->calculate($exam);