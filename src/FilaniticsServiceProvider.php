<?php

namespace Sepremex\Filanitics;

use Filament\Support\Assets\Css;
use Filament\Support\Facades\FilamentAsset;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class FilaniticsServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('filanitics')
            ->hasConfigFile()
            ->hasViews()
            ->hasTranslations();
    }

    public function packageBooted(): void
    {
        WidgetManager::make()->boot();

        FilamentAsset::register([
            Css::make('filanitics', __DIR__ . '/../resources/dist/filanitics.css'),
        ], 'sepremex/filanitics');
    }
}
