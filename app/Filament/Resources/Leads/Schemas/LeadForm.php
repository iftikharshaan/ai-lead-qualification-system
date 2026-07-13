<?php

namespace App\Filament\Resources\Leads\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class LeadForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('email')
                    ->label('Email address')
                    ->email(),
                TextInput::make('phone')
                    ->tel(),
                TextInput::make('company'),
                TextInput::make('industry'),
                TextInput::make('budget')
                    ->numeric(),
                TextInput::make('source'),
                Select::make('status')
                    ->required()
                    ->default('new')
                    ->options([
                        'new' => 'New',
                        'contacted' => 'Contacted',
                        'proposal_sent' => 'Proposal',
                        'won' => 'Won',
                        'lost' => 'Lost',
                        'qualified' => 'Qualified',
                    ]),
                TextInput::make('score')
                    ->required()
                    ->numeric()
                    ->default(0),
                Textarea::make('requirements')
                    ->columnSpanFull(),
                Textarea::make('ai_summary')
                    ->columnSpanFull(),
            ]);
    }
}
