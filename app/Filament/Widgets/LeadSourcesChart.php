<?php

namespace App\Filament\Widgets;

use App\Models\Lead;
use Filament\Widgets\ChartWidget;

class LeadSourcesChart extends ChartWidget
{
    protected static ?int $sort = 2;

    protected int | string | array $columnSpan = 1;

    protected ?string $heading = 'Lead Sources';

    protected function getData(): array
    {
        $sources = Lead::selectRaw('source, count(*) as count')
            ->groupBy('source')
            ->pluck('count', 'source')
            ->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'Sources',
                    'data' => array_values($sources),
                    'backgroundColor' => ['#3b82f6', '#22c55e', '#f59e0b', '#ef4444', '#a855f7', '#6b7280'],
                ],
            ],
            'labels' => array_keys($sources),
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
}
