<?php

declare(strict_types=1);

namespace App\Exporter;

final class ExamToFileExporter implements ExporterInterface
{
    public const OUTPUT_FILE = 'output/report.txt';

    public function export(
        array $grades,
        array $pValues,
        array $pearsonCorrelations,
    ): void {
        $directory = dirname(self::OUTPUT_FILE);

        if (!is_dir($directory)) {
            mkdir($directory, 0o777, true);
        }

        $report = '';

        $report .= "==============================\n";
        $report .= "      PARAGIN REPORT\n";
        $report .= "==============================\n\n";

        $report .= "STUDENT GRADES\n";
        $report .= str_repeat('-', 45).PHP_EOL;
        $report .= sprintf(
            "%-20s %-8s %-8s\n",
            'Student',
            'Grade',
            'Passed',
        );
        $report .= str_repeat('-', 45).PHP_EOL;

        foreach ($grades as $grade) {
            $report .= sprintf(
                "%-20s %-8.1f %-8s\n",
                $grade->student->id,
                $grade->grade,
                $grade->passed ? 'Yes' : 'No',
            );
        }

        $report .= PHP_EOL;
        $report .= "QUESTION STATISTICS\n";
        $report .= str_repeat('-', 45).PHP_EOL;
        $report .= sprintf(
            "%-10s %-10s %-10s\n",
            'Question',
            "P'",
            'r_it',
        );
        $report .= str_repeat('-', 45).PHP_EOL;

        foreach ($pValues as $question => $pValue) {
            $report .= sprintf(
                "%-10d %-10.2f %-10.2f\n",
                $question,
                $pValue,
                $pearsonCorrelations[$question],
            );
        }

        file_put_contents(self::OUTPUT_FILE, $report);
    }
}
