<?php

namespace App\Services\Spotify;

use GuzzleHttp\Client;
use SpotifyWebAPI\Session;
use SpotifyWebAPI\SpotifyWebAPI;
use SpotifyWebAPI\SpotifyWebAPIException;

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
    $this->credentials = \App\Spotify::first();
    $this->api->setAccessToken($this->credentials->access_token);
  }

  public function currentlyPlaying() : array
  {
    try {
      $result = $this->api->getMyCurrentTrack()->item;
    }catch(SpotifyWebAPIException $e) {
      $this->session->refreshAccessToken($this->credentials->refresh_token);
      $this->api->setAccessToken($this->session->getAccessToken());
      $this->credentials->access_token = $this->session->getAccessToken();
      $this->credentials->save();
      $this->currentlyPlaying();
    }

    return (array) $result;
  }
}
