<?php

namespace App\Console\Components\OpenWeather;

use App\Events\OpenWeather\OpenWeatherDataFetched;
use App\Services\OpenWeather\OpenWeather;
use Illuminate\Console\Command;

class OpenWeatherCommand extends Command
{
    protected $signature = 'dashboard:fetch-openweather';

    protected $description = 'Fetch openweather data';

    public function handle(OpenWeather $openWeather)
    {
        $this->info('Fetching openweather data...');

        $forecasts = $openWeather->getForecasts('Merida,es');

        event(new OpenWeatherDataFetched($forecasts));

        $this->info('All done!');
    }
}
