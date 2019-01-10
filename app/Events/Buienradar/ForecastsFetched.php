<?php

namespace App\Events\Buienradar;

use App\Events\DashboardEvent;

class ForecastsFetched extends DashboardEvent
{
    /** @var \stdClass */
    public $weather;

    public function __construct(\stdClass $weather)
    {
        $this->weather = $weather;
    }
}
