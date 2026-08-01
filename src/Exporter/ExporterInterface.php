<?php

declare(strict_types=1);

namespace App\Exporter;

interface ExporterInterface
{
    public function export(
        array $grades,
        array $pValues,
        array $pearsonCorrelations,
    ): void;
}
