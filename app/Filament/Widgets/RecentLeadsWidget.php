<?php

namespace App\Filament\Widgets;

use App\Models\Lead;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;

class RecentLeadsWidget extends TableWidget
{
    protected int | string | array $columnSpan = 2;
    protected function getTableQuery(): ?\Illuminate\Database\Eloquent\Builder
    {
        return Lead::query()->latest()->limit(10);
    }

    public function table(Table $table): Table
    {
        return $table
            ->heading('Recent Leads')
            ->query($this->getTableQuery())
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('email'),
                TextColumn::make('status')
                    ->badge()
                    ->colors([
                        'gray' => 'new',
                        'info' => 'contacted',
                        'warning' => 'proposal_sent',
                        'success' => 'won',
                        'danger' => 'lost',
                        'primary' => 'qualified',
                    ]),
                TextColumn::make('budget')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime(),
            ]);
    }
}
