<?php

namespace App\Services\OpenWeather;

use GuzzleHttp\Client;

class OpenWeather
{
  /** @var \GuzzleHttp\Client */
  protected $client;

  public function __construct(Client $client)
  {
    $this->client = $client;
  }

  public function getForecasts(string $city) : \stdClass
  {
    $response = $this->client->get("weather?q={$city}&units=metric&appid=" . config('services.open_weather.api_key'));
    $payload = json_decode($response->getBody());

    return (Object) [
      'icon' => $payload->weather[0]->icon,
      'current' => $payload->main->temp,
      'max' => $payload->main->temp_max,
      'min' => $payload->main->temp_min,
    ];
  }
}
