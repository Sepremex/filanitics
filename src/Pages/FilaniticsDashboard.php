<?php

namespace Sepremex\Filanitics\Pages;

use Sepremex\Filanitics\Widgets;
use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;

class FilaniticsDashboard extends Page
{
    protected static string $view = 'filanitics::pages.google-analytics-dashboard';

    public static function getNavigationIcon(): ?string
    {
        return (string) config('filanitics.dashboard_icon') ?? 'heroicon-m-chart-bar';
    }

    public static function getNavigationLabel(): string
    {
        return __('filanitics::widgets.navigation_label');
    }

    public function getTitle(): string | Htmlable
    {
        return (string) __('filanitics::widgets.title');
    }

    public static function canView(): bool
    {
        return config('filanitics.dedicated_dashboard');
    }

    public static function shouldRegisterNavigation(): bool
    {
        return static::canView() && static::$shouldRegisterNavigation;
    }

    /**
     * @return array<class-string<Widget> | WidgetConfiguration>
     */
    protected function getHeaderWidgets(): array
    {
        return [
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
        ];
    }
}
