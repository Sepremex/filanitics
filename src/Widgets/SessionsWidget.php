<?php

namespace Sepremex\Filanitics\Widgets;

use Sepremex\Filanitics\Filanitics;
use Sepremex\Filanitics\Traits;
use Filament\Widgets\ChartWidget;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Arr;

class SessionsWidget extends ChartWidget
{
    use Traits\CanViewWidget;
    use Traits\Sessions;

    protected static ?string $pollingInterval = null;

    protected static string $view = 'filanitics::widgets.stats-overview';

    protected static ?int $sort = 3;

    public ?string $filter = 'T';

    public function getHeading(): string | Htmlable | null
    {
        return __('filanitics::widgets.sessions');
    }

    protected function getFilters(): array
    {
        return [
            'T' => __('filanitics::widgets.T'),
            'Y' => __('filanitics::widgets.Y'),
            'LW' => __('filanitics::widgets.LW'),
            'LM' => __('filanitics::widgets.LM'),
            'LSD' => __('filanitics::widgets.LSD'),
            'LTD' => __('filanitics::widgets.LTD'),
        ];
    }

    protected function initializeData()
    {
        $lookups = [
            'T' => $this->sessionsToday(),
            'Y' => $this->sessionsYesterday(),
            'LW' => $this->sessionsLastWeek(),
            'LM' => $this->sessionsLastMonth(),
            'LSD' => $this->sessionsLastSevenDays(),
            'LTD' => $this->sessionsLastThirtyDays(),
        ];

        $data = Arr::get(
            $lookups,
            $this->filter,
            [
                'result' => 0,
                'previous' => 0,
            ],
        );

        return Filanitics::for($data['result'])
            ->previous($data['previous'])
            ->format('%');
    }

    protected function getData(): array
    {
        return [
            'value' => $this->initializeData()->trajectoryValue(),
            'icon' => $this->initializeData()->trajectoryIcon(),
            'color' => $this->initializeData()->trajectoryColor(),
            'description' => $this->initializeData()->trajectoryDescription(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
