<?php

declare(strict_types=1);

namespace Sepremex\Filanitics;

use Filament\Contracts\Plugin;
use Filament\Panel;

class FilaniticsPlugin implements Plugin
{
    public static function make(): static
    {
        return app(static::class);
    }

    public function getId(): string
    {
        return 'filanitics';
    }

    public function register(Panel $panel): void
    {
        $panel
            ->pages([
                Pages\FilaniticsDashboard::class,
            ])
            ->widgets([
                Widgets\PageViewsWidget::class,
                Widgets\VisitorsWidget::class,
                Widgets\ActiveUsersOneDayWidget::class,
                Widgets\ActiveUsersSevenDayWidget::class,
                Widgets\ActiveUsersTwentyEightDayWidget::class,
                Widgets\SessionsWidget::class,
                Widgets\SessionsDurationWidget::class,
                Widgets\SessionsByCountryWidget::class,
                Widgets\SessionsByDeviceWidget::class,
                Widgets\MostVisitedPagesWidget::class,
                Widgets\TopReferrersListWidget::class,
            ]);
    }

    public function boot(Panel $panel): void
    {
        //
    }
}
