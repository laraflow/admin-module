<?php

namespace Modules\Admin\Providers;

use Collective\Html\HtmlFacade as Html;
use Illuminate\Support\ServiceProvider;

class HtmlServiceProvider extends ServiceProvider
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
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //Buttons
        Html::component('linkButton', 'admin::htmls.link-button', ['title', 'route', 'param' => [], 'icon', 'color' => 'success']);
        Html::component('actionButton', 'admin::htmls.action-buttons', ['resourceRouteName', 'id', 'options' => []]);
        Html::component('backButton', 'admin::htmls.back-button', ['route', 'param' => []]);
        Html::component('editButton', 'admin::htmls.edit-button', ['route', 'param' => []]);
        Html::component('showButton', 'admin::htmls.show-button', ['route', 'param' => []]);
        Html::component('deleteButton', 'admin::htmls.delete-button', ['route', 'param' => []]);
        Html::component('restoreButton', 'admin::htmls.restore-button', ['route', 'param' => []]);
        Html::component('toggleButton', 'admin::htmls.toggle-button', ['route', 'param' => []]);

        //Card
        Html::component('cardHeader', 'admin::htmls.card-header', ['title', 'icon', 'short' => null]);
        Html::component('cardSearch', 'admin::htmls.search-form', ['field', 'route', 'placeholder' => null]);

        //Dropdown
        Html::component('actionDropdown', 'admin::htmls.action-dropdowns', ['resourceRouteName', 'id', 'options' => []]);
        Html::component('modelDropdown', 'admin::htmls.model-dropdowns', ['resourceRouteName', 'id' => 0, 'options' => []]);


        //Selection
        Html::component('selection', 'admin::htmls.selection', ['target']);

        //Bootstrap4 Toggle
        Html::component('enableToggle', 'admin::htmls.enable-button', ['model' => null, 'options' => []]);
    }
}
