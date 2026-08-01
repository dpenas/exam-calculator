<?php

declare(strict_types=1);

namespace Tests\Paragin;

use App\Infrastructure\Spreadsheet\ParaginExamReader;
use App\Service\Calculation\ParaginGradeCalculatorService;
use PHPUnit\Framework\TestCase;

final class GradeCalculatorTest extends TestCase
{
    public function testCalculatesGradesForExamOne(): void
    {
        $reader = new ParaginExamReader();
        $exam = $reader->read(__DIR__ . '/Fixtures/test_exam_1.xlsx');

        $calculator = new ParaginGradeCalculatorService();

        $results = $calculator->calculate($exam);

        self::assertCount(3, $results);

        $grades = [];

        foreach ($results as $result) {
            $individualResult = [
                'grade' => $result->grade,
                'passed' => $result->passed,
            ];

            $grades[$result->student->id] = $individualResult;
        }

        self::assertEquals(10.0, $grades['Alice']['grade']);
        self::assertEquals(3.7, $grades['Bob']['grade']);
        self::assertEquals(1.0, $grades['Carol']['grade']);

        self::assertTrue($grades['Alice']['passed']);
        self::assertFalse($grades['Bob']['passed']);
        self::assertFalse($grades['Carol']['passed']);
    }

    public function testCalculatesGradesForExamTwo(): void
    {
        $reader = new ParaginExamReader();

        $exam = $reader->read(__DIR__ . '/Fixtures/test_exam_2.xlsx');

        $calculator = new ParaginGradeCalculatorService();

        $results = $calculator->calculate($exam);

        self::assertCount(3, $results);

        $grades = [];

        foreach ($results as $result) {
            $individualResult = [
                'grade' => $result->grade,
                'passed' => $result->passed,
            ];

            $grades[$result->student->id] = $individualResult;
        }

        self::assertEquals(10.0, $grades['Anna']['grade']);
        self::assertEquals(4.6, $grades['Ben']['grade']);
        self::assertEquals(1.0, $grades['Chris']['grade']);

        self::assertTrue($grades['Anna']['passed']);
        self::assertFalse($grades['Ben']['passed']);
        self::assertFalse($grades['Chris']['passed']);
    }

    public function testCalculatesGradesForExamThree(): void
    {
        $reader = new ParaginExamReader();

        $exam = $reader->read(__DIR__ . '/Fixtures/test_exam_3.xlsx');

        $calculator = new ParaginGradeCalculatorService();

        $results = $calculator->calculate($exam);

        self::assertCount(4, $results);

        $grades = [];

        foreach ($results as $result) {
            $individualResult = [
                'grade' => $result->grade,
                'passed' => $result->passed,
            ];

            $grades[$result->student->id] = $individualResult;
        }

        self::assertEquals(10.0, $grades['S1']['grade']);
        self::assertEquals(4.6, $grades['S2']['grade']);
        self::assertEquals(1.0, $grades['S3']['grade']);
        self::assertEquals(1.0, $grades['S4']['grade']);

        self::assertTrue($grades['S1']['passed']);
        self::assertFalse($grades['S2']['passed']);
        self::assertFalse($grades['S3']['passed']);
        self::assertFalse($grades['S4']['passed']);
    }

    public function testCalculatesBoundaryGradesCorrectly(): void
    {
        $reader = new ParaginExamReader();

        $exam = $reader->read(__DIR__ . '/Fixtures/test_exam_4.xlsx');

        $calculator = new ParaginGradeCalculatorService();

        $results = $calculator->calculate($exam);

        self::assertCount(4, $results);

        $grades = [];

        foreach ($results as $result) {
            $grades[$result->student->id] = [
                'grade' => $result->grade,
                'passed' => $result->passed,
            ];
        }

        self::assertEquals(10.0, $grades['Perfect']['grade']);
        self::assertEquals(5.5, $grades['Pass']['grade']);
        self::assertEquals(5.4, $grades['AlmostPass']['grade']);
        self::assertEquals(1.0, $grades['Fail']['grade']);

        self::assertTrue($grades['Perfect']['passed']);
        self::assertTrue($grades['Pass']['passed']);
        self::assertFalse($grades['AlmostPass']['passed']);
        self::assertFalse($grades['Fail']['passed']);
    }
}