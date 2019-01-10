<?php

namespace App\Services\OpenWeather;

use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

class OpenWeatherServiceProvider extends ServiceProvider
{
  public function register()
  {
    $this->app->singleton(OpenWeather::class, function () {
      $client = new Client([
        'base_uri' => 'http://api.openweathermap.org/data/2.5/',
      ]);

      return new OpenWeather($client);
    });
  }
}
