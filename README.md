# 📊 Filanitics

**Filanitics** is a custom Filament plugin that integrates Google Analytics (GA4) data directly into your Filament admin panel, so your users (or clients) can view traffic stats without needing to access the actual Google Analytics dashboard.

> ⚡ Built for Filament v3 and Laravel 10/12  
> 🔒 Uses Google Analytics Data API (GA4) with Service Account authentication

---
> ⚠️ **Disclaimer**
>
> This package is a **personal fork** of [`bezhanSalleh/filament-google-analytics`](https://github.com/bezhanSalleh/filament-google-analytics), adapted for use in a **very specific Filament v3 setup**.
>
> I make **no guarantees** that this package will work outside of my environment. It is not actively maintained for public use, and may not be compatible with your setup.
>
> If you're looking for a stable and community-supported solution, please use the original package by [@bezhanSalleh](https://github.com/bezhanSalleh).
>
> **Use at your own risk.** I take **no responsibility** for any issues, bugs, or system breaks caused by using this code.
>
> **TBH:** I built this for myself. You can use it if you want, but don’t blame me if it breaks things. 😅
---
## 🚀 Features

- See visitors and page views directly in Filament
- View traffic trends over the past 7/30 days
- Optional charts and breakdowns (top pages, countries, etc.)
- Uses official Google Analytics SDK (no third-party wrappers)

---

## 🧱 Installation

```bash
composer require sepremex/filanitics
```
For now, follow the directions on [Spatie's Laravel Google Analytics package](https://github.com/spatie/laravel-analytics) for getting your credentials, then put them here:

```
yourapp/storage/app/analytics/service-account-credentials.json
```

Also add this to the `.env` for your Filament PHP app:

```ini
ANALYTICS_PROPERTY_ID=
```


> [!NOTE]  
> The plugin is developed to work in any Livewire project that uses the standalone `filament/widgets` package. But it also comes with a dedicated dashboard, which is a normal filament page. You can enable it by registering the plugin for the panels you want to use it in. If you are not using filament panels then you can skip this step.
>

```php
public function panel(Panel $panel): Panel
{
    return $panel
        ->plugins([
            ...
            \Sepremex\Filanitics\FilaniticsPlugin::make()
        ]);
}
```

# Usage

All the widgets are enabled by default for you to use them in your filament pages/resources. In order to enable the widgets for the default filament dashboard, you need to set the `filament_dashboard` option to `true` in the config file `filanitics.php` for each widget you want to enable.

Publish the config files and set your settings:
```bash
php artisan vendor:publish --tag=filanitics-config
```

#### Available Widgets
```php
\Sepremex\Filanitics\Widgets\PageViewsWidget::class,
\Sepremex\Filanitics\Widgets\VisitorsWidget::class,
\Sepremex\Filanitics\Widgets\ActiveUsersOneDayWidget::class,
\Sepremex\Filanitics\Widgets\ActiveUsersSevenDayWidget::class,
\Sepremex\Filanitics\Widgets\ActiveUsersTwentyEightDayWidget::class,
\Sepremex\Filanitics\Widgets\SessionsWidget::class,
\Sepremex\Filanitics\Widgets\SessionsDurationWidget::class,
\Sepremex\Filanitics\Widgets\SessionsByCountryWidget::class,
\Sepremex\Filanitics\Widgets\SessionsByDeviceWidget::class,
\Sepremex\Filanitics\Widgets\MostVisitedPagesWidget::class,
\Sepremex\Filanitics\Widgets\TopReferrersListWidget::class,
```

#### Custom Dashboard
Though this plugin comes with a default dashboard, but sometimes you might want to change `navigationLabel` or `navigationGroup` or disable some `widgets` or any other options and given that the dashboard is a simple filament `page`; The easiest solution would be to disable the default dashboard and create a new `page`:

```bash
php artisan filament:page MyCustomDashboardPage
```
then register the widgets you want from the **Available Widgets** list either in the `getHeaderWidgets()` or `getFooterWidgets()`:
```php
<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Sepremex\Filanitics\Widgets;

class MyCustomDashboardPage extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.my-custom-dashboard-page';

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
```
> [!NOTE]  
> In order to enable the widgets for the default filament dashboard, you need to set the `filament_dashboard` option to `true` in the config file `filanitics.php` for each widget you want to enable.
---
### **2025-04-05**
I had to remove the original package since many of you started to use it, and I was getting way too many messages, however, as I said, please use the one from [@bezhanSalleh](https://github.com/bezhanSalleh), and support that one, this is for personal use.