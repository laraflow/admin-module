<?php

namespace Modules\Core\Providers;

use Modules\Core\Providers\Components\GroupFieldServiceProvider;
use Modules\Core\Providers\Components\HorizontalFieldServiceProvider;
use Modules\Core\Providers\Components\InlineFieldServiceProvider;
use Modules\Core\Providers\Components\LabelServiceProvider;
use Modules\Core\Providers\Components\NormalFieldServiceProvider;
use Illuminate\Support\ServiceProvider;

/**
 * Class FormServiceProvider
 * @package Modules\Core\Providers
 */
class FormServiceProvider extends ServiceProvider
{
    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(LabelServiceProvider::class);
        $this->app->register(HorizontalFieldServiceProvider::class);
        $this->app->register(GroupFieldServiceProvider::class);
        $this->app->register(InlineFieldServiceProvider::class);
        $this->app->register(NormalFieldServiceProvider::class);

    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides(): array
    {
        return [];
    }
}
