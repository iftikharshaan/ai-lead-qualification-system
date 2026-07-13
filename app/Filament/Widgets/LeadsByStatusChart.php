<?php

namespace App\Filament\Widgets;

use App\Models\Lead;
use Filament\Widgets\ChartWidget;

class LeadsByStatusChart extends ChartWidget
{
    protected static ?int $sort = 3;

    protected int | string | array $columnSpan = 1;

    protected ?string $heading = 'Leads by Status';

    protected function getData(): array
    {
        $statuses = ['new', 'contacted', 'proposal_sent', 'qualified', 'won', 'lost'];
        $counts = [];

        foreach ($statuses as $status) {
            $counts[] = Lead::where('status', $status)->count();
        }

        return [
            'datasets' => [
                [
                    'label' => 'Leads',
                    'data' => $counts,
                    'backgroundColor' => ['#6b7280', '#3b82f6', '#f59e0b', '#a855f7', '#22c55e', '#ef4444'],
                ],
            ],
            'labels' => ['New', 'Contacted', 'Proposal', 'Qualified', 'Won', 'Lost'],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
