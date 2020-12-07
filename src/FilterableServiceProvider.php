<?php

namespace Zarate\Filterable;

use Illuminate\Support\ServiceProvider;
use Zarate\Filterable\Console\FilterCommand;

class FilterableServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                FilterCommand::class,
            ]);
        }
    }
}
