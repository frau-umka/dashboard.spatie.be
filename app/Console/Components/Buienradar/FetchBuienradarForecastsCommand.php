<?php

namespace App\Console\Components\Buienradar;

use App\Events\Buienradar\ForecastsFetched;
use App\Services\OpenWeather\OpenWeather;
use Illuminate\Console\Command;

class FetchBuienradarForecastsCommand extends Command
{
    protected $signature = 'dashboard:fetch-buienradar-forecasts';

    protected $description = 'Fetch Buienradar forecasts';

    public function handle(OpenWeather $buienradar)
    {
        $this->info('Fetching Buienradar forecasts...');

        $forecasts = $buienradar->getForecasts('Merida,es');

        event(new ForecastsFetched($forecasts));

        $this->info('All done!');
    }
}
