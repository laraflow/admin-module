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
        View::composer('admin::partials.navbar-message', MessageDropDownComposer::class);
        View::composer('admin::partials.navbar-shortcut', NavbarShortcutComposer::class);
        View::composer('admin::partials.navbar-notification', NotificationDropDownComposer::class);
        View::composer(['admin::partials.navbar-user', 'admin::partials.menu-sidebar'], UserDropDownComposer::class);
    }
}
