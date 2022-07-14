<?php

namespace NotificationChannels\AfroMessage;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;

class AfroMessageServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app->when(AfroMessageChannel::class)
            ->needs(PendingRequest::class)
            ->give(function () {
                $baseUrl = config('services.afromessage.base_url');
                $key = config('services.afromessage.api_key');

                return Http::baseUrl($baseUrl)
                    ->acceptJson()
                    ->withToken($key);
            });
    }
}
