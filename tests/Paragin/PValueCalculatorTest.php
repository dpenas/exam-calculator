<?php

declare(strict_types=1);

namespace Tests\Paragin;

use App\Infrastructure\Spreadsheet\ParaginExamReader;
use App\Service\Calculation\PValueCalculatorService;
use PHPUnit\Framework\TestCase;

final class PValueCalculatorTest extends TestCase
{
    public function testCalculatesPValuesForExamOne(): void
    {
        $reader = new ParaginExamReader();

        $exam = $reader->read(__DIR__ . '/Fixtures/test_exam_1.xlsx');

        $calculator = new PValueCalculatorService();

        $results = $calculator->calculate($exam);

        self::assertCount(3, $results);

        self::assertEquals(0.67, $results[1]);
        self::assertEquals(0.33, $results[2]);
        self::assertEquals(0.50, $results[3]);
    }

    public function testCalculatesPValuesForExamTwo(): void
    {
        $reader = new ParaginExamReader();

        $exam = $reader->read(__DIR__ . '/Fixtures/test_exam_2.xlsx');

        $calculator = new PValueCalculatorService();

        $results = $calculator->calculate($exam);

        self::assertCount(2, $results);

        self::assertEquals(0.50, $results[1]);
        self::assertEquals(0.67, $results[2]);
    }

    public function testCalculatesPValuesForExamThree(): void
    {
        $reader = new ParaginExamReader();

        $exam = $reader->read(__DIR__ . '/Fixtures/test_exam_3.xlsx');

        $calculator = new PValueCalculatorService();

        $results = $calculator->calculate($exam);

        self::assertCount(4, $results);

        self::assertEquals(0.50, $results[1]);
        self::assertEquals(0.50, $results[2]);
        self::assertEquals(0.50, $results[3]);
        self::assertEquals(0.25, $results[4]);
    }

    public function testCalculatesPValuesForExamFour(): void
    {
        $reader = new ParaginExamReader();

        $exam = $reader->read(__DIR__ . '/Fixtures/test_exam_4.xlsx');

        $calculator = new PValueCalculatorService();

        $results = $calculator->calculate($exam);

        self::assertCount(10, $results);

        self::assertEquals(1.00, $results[1]);
        self::assertEquals(1.00, $results[2]);
        self::assertEquals(0.75, $results[3]);
        self::assertEquals(0.75, $results[4]);
        self::assertEquals(0.75, $results[5]);
        self::assertEquals(0.75, $results[6]);
        self::assertEquals(0.73, $results[7]);
        self::assertEquals(0.25, $results[8]);
        self::assertEquals(0.25, $results[9]);
        self::assertEquals(0.25, $results[10]);
    }
}