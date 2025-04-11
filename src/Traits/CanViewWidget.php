<?php

namespace Sepremex\Filanitics\Traits;

use Illuminate\Support\Str;

trait CanViewWidget
{
    public static function canView(): bool
    {
        $filamentPagesRoutePrefix = 'filament.' . filament()->getCurrentPanel()->getId() . '.pages.';
        $filamentDashboardStatus = config('filanitics.' . Str::of(static::class)->after('Widgets\\')->before('Widget')->snake() . '.filament_dashboard');

        $globalStatus = config('filanitics.' . Str::of(static::class)->after('Widgets\\')->before('Widget')->snake() . '.global');

        if ($filamentDashboardStatus && request()->routeIs($filamentPagesRoutePrefix . 'dashboard')) {
            return true;
        }

        if ($globalStatus && config('filanitics.dedicated_dashboard') && request()->routeIs($filamentPagesRoutePrefix . 'filanitics-dashboard')) {
            return true;
        }

        if ($globalStatus && ! request()->routeIs($filamentPagesRoutePrefix . 'dashboard') && ! request()->routeIs($filamentPagesRoutePrefix . 'filanitics-dashboard')) {
            return true;
        }

        return false;
    }
}
