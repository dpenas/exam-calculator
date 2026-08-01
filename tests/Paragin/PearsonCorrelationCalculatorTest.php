<?php

declare(strict_types=1);

namespace Tests\Paragin;

use App\Infrastructure\Spreadsheet\ParaginExamReader;
use App\Service\Calculation\PearsonCorrelationCalculatorService;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 *
 * @coversNothing
 */
final class PearsonCorrelationCalculatorTest extends TestCase
{
    public function testCalculatesGradesForExamOne(): void
    {
        $reader = new ParaginExamReader();
        $exam = $reader->read(__DIR__.'/Fixtures/test_exam_1.xlsx');

        $calculator = new PearsonCorrelationCalculatorService();

        $results = $calculator->calculate($exam);

        self::assertEquals(0.87, $results[1]);
        self::assertEquals(0.87, $results[2]);
        self::assertEquals(1.00, $results[3]);
    }

    public function testCalculatesGradesForExamTwo(): void
    {
        $reader = new ParaginExamReader();
        $exam = $reader->read(__DIR__.'/Fixtures/test_exam_2.xlsx');

        $calculator = new PearsonCorrelationCalculatorService();

        $results = $calculator->calculate($exam);

        self::assertEquals(1.00, $results[1]);
        self::assertEquals(1.00, $results[2]);
    }

    public function testCalculatesGradesForExamThree(): void
    {
        $reader = new ParaginExamReader();
        $exam = $reader->read(__DIR__.'/Fixtures/test_exam_3.xlsx');

        $calculator = new PearsonCorrelationCalculatorService();

        $results = $calculator->calculate($exam);

        self::assertEquals(0.91, $results[1]);
        self::assertEquals(0.92, $results[2]);
        self::assertEquals(0.91, $results[3]);
        self::assertEquals(0.83, $results[4]);
    }

    public function testCalculatesGradesForExamFour(): void
    {
        $reader = new ParaginExamReader();
        $exam = $reader->read(__DIR__.'/Fixtures/test_exam_4.xlsx');

        $calculator = new PearsonCorrelationCalculatorService();

        $results = $calculator->calculate($exam);

        self::assertEquals(0.00, $results[1]);
        self::assertEquals(0.00, $results[2]);
        self::assertEquals(0.90, $results[3]);
        self::assertEquals(0.90, $results[4]);
        self::assertEquals(0.90, $results[5]);
        self::assertEquals(0.90, $results[6]);
        self::assertEquals(0.92, $results[7]);
        self::assertEquals(0.71, $results[8]);
        self::assertEquals(0.71, $results[9]);
        self::assertEquals(0.71, $results[10]);
    }
}
