<?php

declare(strict_types=1);

namespace OrkhanShukurlu\GitArtisan;

use Illuminate\Support\ServiceProvider;

final class GitArtisanServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if (! $this->app->runningInConsole()) {
            return;
        }

        $this->commands([
            GitCommand::class,
        ]);
    }
}
