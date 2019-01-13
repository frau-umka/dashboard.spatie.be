<?php

namespace App\Http\Middleware;

use Closure;
use App\Services\Spotify\Spotify as SpotifyService;
use SpotifyWebAPI\SpotifyWebAPIException;

class Spotify
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $this->handleSpotifyCallback();
        $spotifyData = \App\Spotify::first();
        $spotifyService = app(SpotifyService::class);

        if ($spotifyData) {
            try {
                $spotifyService->api->setAccessToken($spotifyData->access_token);
            } catch(SpotifyWebAPIException $e) {
                $spotifyService->session->refreshAccessToken($spotifyService->credentials->refresh_token);
                $spotifyService->api->setAccessToken($spotifyService->session->getAccessToken());
                $spotifyData->access_token = $spotifyService->session->getAccessToken();
                $spotifyData->save();
            }
        } else {

        }

        return $next($request);
    }

    public function handleSpotifyCallback()
    {
        if (request()->has('code')) {
            $spotify = app(SpotifyService::class);

            $spotify->session->requestAccessToken(request()->get('code'));
            $spotify->api->setAccessToken($spotify->session->getAccessToken());
            $user = $spotify->api->me();

            \App\Spotify::updateOrCreate([
                'email' => $user->email,
            ],[
                'email' => $user->email,
                'access_token' => $spotify->session->getAccessToken(),
                'refresh_token' => $spotify->session->getRefreshToken(),
            ]);
        }
    }
}
