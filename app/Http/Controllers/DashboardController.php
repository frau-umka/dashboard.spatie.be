<?php

namespace App\Http\Controllers;

use App\Services\TweetHistory\TweetHistory;
use Illuminate\Http\Request;
use App\Services\Spotify\Spotify;
use App\Spotify as SpotifyModel;
use App\Events\Spotify\CurrentTrackFetched;

class DashboardController
{
    public function __invoke(Request $request)
    {
        if ($request->has('code')) {
            $spotify = app(Spotify::class);

            $spotify->session->requestAccessToken($request->get('code'));
            $spotify->api->setAccessToken($spotify->session->getAccessToken());
            $user = $spotify->api->me();

            SpotifyModel::create([
                'email' => $user->email,
                'access_token' => $spotify->session->getAccessToken(),
                'refresh_token' => $spotify->session->getRefreshToken(),
            ]);
        }

        return view('dashboard')->with([
            'pusherKey' => config('broadcasting.connections.pusher.key'),
            'clientConnectionPath' => config('websockets.client_connection_path'),
            'environment' => app()->environment(),
            'initialTweets' => TweetHistory::all(),
            'authorizeUrl' => app(Spotify::class)->session->getAuthorizeUrl(['scope' => ['user-read-email', 'user-read-playback-state']]),
        ]);
    }
}
