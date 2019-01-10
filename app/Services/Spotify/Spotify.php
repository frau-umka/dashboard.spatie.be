<?php

namespace App\Services\Spotify;

use GuzzleHttp\Client;
use SpotifyWebAPI\Session;
use SpotifyWebAPI\SpotifyWebAPI;

class Spotify
{
  /** @var \SpotifyWebAPI\Session */
  public $session;

  /** @var \SpotifyWebAPI\SpotifyWebAPI*/
  public $api;

  public function __construct(Session $session, SpotifyWebAPI $api)
  {
    $this->session = $session;
    $this->api = $api;

    $data = \App\Spotify::first();
    $this->api->setAccessToken($data->access_token);
  }

  public function currentlyPlaying() : array
  {
    return (array) $this->api->getMyCurrentTrack()->item;
  }
}
