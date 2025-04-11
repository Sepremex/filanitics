<?php

namespace Sepremex\Filanitics\Widgets;

use Sepremex\Filanitics\Filanitics;
use Sepremex\Filanitics\Traits;
use Filament\Widgets\ChartWidget;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Arr;

class VisitorsWidget extends ChartWidget
{
    use Traits\CanViewWidget;
    use Traits\Visitors;

    protected static ?string $pollingInterval = null;

    protected static string $view = 'filanitics::widgets.stats-overview';

    protected static ?int $sort = 3;

    public ?string $filter = 'T';

    public function getHeading(): string | Htmlable | null
    {
        return __('filanitics::widgets.visitors');
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
            'T' => $this->visitorsToday(),
            'Y' => $this->visitorsYesterday(),
            'LW' => $this->visitorsLastWeek(),
            'LM' => $this->visitorsLastMonth(),
            'LSD' => $this->visitorsLastSevenDays(),
            'LTD' => $this->visitorsLastThirtyDays(),
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
