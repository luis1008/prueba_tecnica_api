<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Jenssegers\Mongodb\Schema\Blueprint;
use Jenssegers\Mongodb\Schema\Builder;
use Illuminate\Database\Schema\Blueprint as OriginalBlueprint;
use Illuminate\Database\Schema\Builder as OriginalBuilder;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        $this->app->bind(OriginalBlueprint::class, Blueprint::class);
        $this->app->bind(OriginalBuilder::class, Builder::class);
    }
}
