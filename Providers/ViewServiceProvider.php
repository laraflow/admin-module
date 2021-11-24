<?php

namespace Modules\Admin\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Modules\Admin\View\Composers\MessageDropDownComposer;
use Modules\Admin\View\Composers\NavbarShortcutComposer;
use Modules\Admin\View\Composers\NotificationDropDownComposer;
use Modules\Admin\View\Composers\UserDropDownComposer;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('admin::layouts.partials.navbar-message', MessageDropDownComposer::class);
        View::composer('admin::layouts.partials.navbar-shortcut', NavbarShortcutComposer::class);
        View::composer('admin::layouts.partials.navbar-notification', NotificationDropDownComposer::class);
        View::composer(['admin::layouts.partials.navbar-user', 'admin::layouts.partials.menu-sidebar'], UserDropDownComposer::class);
    }
}
