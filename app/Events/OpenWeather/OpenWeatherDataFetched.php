<?php

namespace App\Events\OpenWeather;

use App\Events\DashboardEvent;

class OpenWeatherDataFetched extends DashboardEvent
{
    /** @var \stdClass */
    public $weather;

    public function __construct(\stdClass $weather)
    {
        $this->weather = $weather;
    }
}
