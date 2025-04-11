<?php

namespace Sepremex\Filanitics\Widgets;

use Sepremex\Filanitics\Filanitics;
use Sepremex\Filanitics\Traits;
use Filament\Support\RawJs;
use Filament\Widgets\ChartWidget;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Arr;

class ActiveUsersOneDayWidget extends ChartWidget
{
    use Traits\ActiveUsers;
    use Traits\CanViewWidget;

    protected static string $view = 'filanitics::widgets.active-users';

    protected static ?string $pollingInterval = null;

    protected static ?int $sort = 3;

    public ?string $filter = '5';

    protected function getType(): string
    {
        return 'line';
    }

    protected function getFilters(): array
    {
        return [
            '5' => __('filanitics::widgets.FD'),
            '10' => __('filanitics::widgets.TD'),
            '15' => __('filanitics::widgets.FFD'),
        ];
    }

    public function getHeading(): string | Htmlable | null
    {
        return Filanitics::for(last($this->initializeData()['results']))->trajectoryValue();
    }

    public function getDescription(): string | Htmlable | null
    {
        return __('filanitics::widgets.one_day_active_users');
    }

    protected function initializeData()
    {
        $lookups = [
            '5' => $this->performActiveUsersQuery('active1DayUsers', 5),
            '10' => $this->performActiveUsersQuery('active1DayUsers', 10),
            '15' => $this->performActiveUsersQuery('active1DayUsers', 15),
        ];

        $data = Arr::get(
            $lookups,
            $this->filter,
            [
                'results' => [0],
            ],
        );

        return $data;
    }

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'data' => array_values($this->initializeData()['results']),
                    'borderWidth' => 2,
                    'fill' => 'start',
                    'tension' => 0.5,
                    'pointRadius' => 0,
                    'pointHitRadius' => 0,
                    'backgroundColor' => ['rgba(251, 191, 36, 0.1)'],
                    'borderColor' => ['rgba(245, 158, 11, 1)'],
                ],
            ],
            'labels' => array_values($this->initializeData()['results']),
        ];
    }

    protected function getOptions(): array | RawJs | null
    {
        return RawJs::make(<<<'JS'
            {
                animation: {
                    duration: 0,
                },
                elements: {
                    point: {
                        radius: 0,
                    },
                    hit: {
                        radius: 0,
                    },

                },
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                        labels: {
                            usePointStyle: false,
                        }
                    },
                },
                scales: {
                    x: {
                        display: false,
                    },
                    y: {
                        display: false,
                    },
                },
                tooltips: {
                    enabled: false,
                },
            }
        JS);
    }
}
