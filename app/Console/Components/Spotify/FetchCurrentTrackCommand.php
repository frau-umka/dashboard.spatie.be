<?php

namespace App\Console\Components\Spotify;

use Illuminate\Console\Command;
use App\Services\Spotify\Spotify;
use App\Events\Spotify\CurrentTrackFetched;

class FetchCurrentTrackCommand extends Command
{
  protected $signature = 'dashboard:fetch-current-track';

  protected $description = 'Fetch spotify current track';

  public function handle(Spotify $spotify)
  {
    $this->info('Fetching spotify current track...');

    $track = $spotify->currentlyPlaying();

    event(new CurrentTrackFetched($track));

    $this->info('All done!');
  }
}
