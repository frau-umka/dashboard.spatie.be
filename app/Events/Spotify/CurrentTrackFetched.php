<?php

namespace App\Events\Spotify;

use App\Events\DashboardEvent;

class CurrentTrackFetched extends DashboardEvent
{
  public $track;

  public function __construct($track)
  {
    $this->track = $track;
  }
}
