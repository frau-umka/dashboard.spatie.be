<?php

namespace App\Services\Spotify;

use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;
use SpotifyWebAPI\Session;
use SpotifyWebAPI\SpotifyWebAPI;

class SpotifyServiceProvider extends ServiceProvider
{
  public function register()
  {
    $this->app->singleton(Spotify::class, function () {
      $session = new Session(
        config('services.spotify.client_id'),
        config('services.spotify.client_secret'),
        url(config('services.spotify.callback'))
      );
      $api = new SpotifyWebAPI();


      return new Spotify($session, $api);
    });
  }
}
