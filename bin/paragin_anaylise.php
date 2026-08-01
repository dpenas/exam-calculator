#!/usr/bin/env php
<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Infrastructure\Spreadsheet\ParaginExamReader;
use App\Service\Calculation\ParaginGradeCalculatorService;
use App\Service\Calculation\PValueCalculatorService;
use App\Service\Calculation\PearsonCorrelationCalculatorService;
use App\Exporter\ExamToFileExporter;

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
$pearsonCorrelationCalculator = new PearsonCorrelationCalculatorService();

$paraginGrades = $gradeCalculator->calculate($exam);
$pValue = $pValueCalculator->calculate($exam);
$pearsonCorrelation = $pearsonCorrelationCalculator->calculate($exam);

$examToFileExporter = new ExamToFileExporter();
$examToFileExporter->export($paraginGrades, $pValue, $pearsonCorrelation);