<?php

namespace App\Filament\Widgets;

use App\Models\Lead;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class LeadStats extends StatsOverviewWidget
{
    protected int | string | array $columnSpan = 2;
    protected function getStats(): array
    {
        $total = Lead::count();
        $newCount = Lead::where('status', 'new')->count();
        $qualified = Lead::where('status', 'qualified')->count();
        $won = Lead::where('status', 'won')->count();
        $lost = Lead::where('status', 'lost')->count();
        $totalBudget = Lead::sum('budget');

        $leadsThisWeek = Lead::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count();
        $leadsThisMonth = Lead::whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->count();

        $conversionRate = $total > 0 ? round(($won / $total) * 100, 1) : 0;

        return [
            Stat::make('Total Leads', $total)
                ->description("{$leadsThisWeek} this week, {$leadsThisMonth} this month")
                ->descriptionIcon('heroicon-m-users')
                ->color('info'),

            Stat::make('New Leads', $newCount)
                ->description('Waiting for review')
                ->descriptionIcon('heroicon-m-sparkles')
                ->color('gray'),

            Stat::make('Qualified', $qualified)
                ->description('Qualified by AI')
                ->descriptionIcon('heroicon-m-check-badge')
                ->color('success'),

            Stat::make('Won', $won)
                ->description('Successfully closed')
                ->descriptionIcon('heroicon-m-trophy')
                ->color('success'),

            Stat::make('Lost', $lost)
                ->description('Lost opportunities')
                ->descriptionIcon('heroicon-m-x-circle')
                ->color('danger'),

            Stat::make('Conversion Rate', "{$conversionRate}%")
                ->description("{$won} won out of {$total} leads")
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color($conversionRate > 50 ? 'success' : ($conversionRate > 20 ? 'warning' : 'gray')),

            Stat::make('Revenue Potential', 'Rs ' . number_format($totalBudget))
                ->description('Total budget from all leads')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('success'),
        ];
    }
}
