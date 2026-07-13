<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationItem;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->brandName('AI Lead Assistant')
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->navigationGroups([
                'CRM',
                'AI',
                'Automation',
            ])
            ->navigationItems([

                // CRM - Placeholders (visible until real Resources are created)

                NavigationItem::make('Companies')
                    ->group('CRM')
                    ->icon('heroicon-o-building-office')
                    ->url('#')
                    ->sort(2)
                    ->visible(fn (): bool => ! class_exists(\App\Filament\Resources\Companies\CompanyResource::class)),

                NavigationItem::make('Contacts')
                    ->group('CRM')
                    ->icon('heroicon-o-users')
                    ->url('#')
                    ->sort(3)
                    ->visible(fn (): bool => ! class_exists(\App\Filament\Resources\Contacts\ContactResource::class)),

                NavigationItem::make('Activities')
                    ->group('CRM')
                    ->icon('heroicon-o-arrow-path')
                    ->url('#')
                    ->sort(4)
                    ->visible(fn (): bool => ! class_exists(\App\Filament\Resources\Activities\ActivityResource::class)),

                // AI - Placeholders

                NavigationItem::make('AI Qualification')
                    ->group('AI')
                    ->icon('heroicon-o-sparkles')
                    ->url('#')
                    ->sort(1)
                    ->visible(fn (): bool => ! class_exists(\App\Filament\Resources\AI\AIQualificationResource::class)),

                NavigationItem::make('AI Conversations')
                    ->group('AI')
                    ->icon('heroicon-o-chat-bubble-left-right')
                    ->url('#')
                    ->sort(2)
                    ->visible(fn (): bool => ! class_exists(\App\Filament\Resources\AI\AIConversationResource::class)),

                // Automation - Placeholders

                NavigationItem::make('Workflows')
                    ->group('Automation')
                    ->icon('heroicon-o-queue-list')
                    ->url('#')
                    ->sort(1)
                    ->visible(fn (): bool => ! class_exists(\App\Filament\Resources\Automation\WorkflowResource::class)),

                NavigationItem::make('WhatsApp')
                    ->group('Automation')
                    ->icon('heroicon-o-chat-bubble-oval-left-ellipsis')
                    ->url('#')
                    ->sort(2)
                    ->visible(fn (): bool => ! class_exists(\App\Filament\Resources\Automation\WhatsAppResource::class)),

                NavigationItem::make('Email')
                    ->group('Automation')
                    ->icon('heroicon-o-envelope')
                    ->url('#')
                    ->sort(3)
                    ->visible(fn (): bool => ! class_exists(\App\Filament\Resources\Automation\EmailResource::class)),

                // Ungrouped placeholders

                NavigationItem::make('Reports')
                    ->icon('heroicon-o-chart-bar')
                    ->url('#')
                    ->sort(1)
                    ->visible(fn (): bool => ! class_exists(\App\Filament\Pages\ReportsPage::class)),

                NavigationItem::make('Settings')
                    ->icon('heroicon-o-cog-6-tooth')
                    ->url('#')
                    ->sort(2)
                    ->visible(fn (): bool => ! class_exists(\App\Filament\Pages\SettingsPage::class)),

            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
