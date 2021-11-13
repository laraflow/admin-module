<?php

namespace Modules\Admin\Providers\Components;

use Illuminate\Support\ServiceProvider;
use Collective\Html\FormFacade as Form;

/**
 * Class HorizontalFieldServiceProvider
 * @package Modules\Admin\Providers\Components
 */
class HorizontalFieldServiceProvider extends ServiceProvider
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

    public function boot()
    {
        //       Horizontal Form   start

        /**
         * @parem string $name
         * @parem string $label
         * @parem mixed $default
         * @parem bool $required
         * @parem array $attributes
         */
        Form::component('hText', 'admin::forms.horizon.text', ['name', 'label', 'default' => null, 'required' => false, 'col_size' => 2, 'attributes' => []]);
        /**
         * @parem string $name
         * @parem string $label
         * @parem mixed $default
         * @parem bool $required
         * @parem array $attributes
         */
        Form::component('hEmail', 'admin::forms.horizon.email', ['name', 'label', 'default' => null, 'required' => false, 'col_size' => 2, 'attributes' => []]);



        /**
         * @parem string $name
         * @parem string $label
         * @parem bool $required
         * @parem array $attributes
         */
        Form::component('hSearch', 'admin::forms.horizon.search', ['name', 'label', 'default' => null, 'required' => false, 'col_size' => 2, 'attributes' => []]);

        /**
         * @parem string $name
         * @parem string $label
         * @parem bool $required
         * @parem array $attributes
         */
        Form::component('hTel', 'admin::forms.horizon.tel', ['name', 'label', 'default' => null, 'required' => false, 'col_size' => 2, 'attributes' => []]);

        /**
         * @parem string $name
         * @parem string $label
         * @parem bool $required
         * @parem array $attributes
         */
        Form::component('hNumber', 'admin::forms.horizon.number', ['name', 'label', 'default' => null, 'required' => false, 'col_size' => 2, 'attributes' => []]);


        /**
         * @parem string $name
         * @parem string $label
         * @parem bool $required
         * @parem array $attributes
         */
        Form::component('hDate', 'admin::forms.horizon.date', ['name', 'label', 'default' => null, 'required' => false, 'col_size' => 2, 'attributes' => []]);

        /**
         * @parem string $name
         * @parem string $label
         * @parem bool $required
         * @parem array $attributes
         */
        Form::component('hUrl', 'admin::forms.horizon.url', ['name', 'label', 'default' => null, 'required' => false, 'col_size' => 2, 'attributes' => []]);

        /**
         * @parem string $name
         * @parem string $label
         * @parem bool $required
         * @parem array $attributes
         */
        Form::component('hFile', 'admin::forms.horizon.file', ['name', 'label', 'default' => null, 'required' => false, 'col_size' => 2, 'attributes' => []]);


        /**
         * @parem string $name
         * @parem string $label
         * @parem bool $required
         * @parem array $attributes
         */
        Form::component('hTextarea', 'admin::forms.horizon.textarea', ['name', 'label', 'default' => null, 'required' => false, 'col_size' => 2, 'attributes' => []]);



        /**
         * Create a select box field.
         *
         * @param  string $name
         * @param  array  $list
         * @param  string|bool $selected
         * @param  array  $selectAttributes
         * @param  array  $optionsAttributes
         * @param  array  $optgroupsAttributes
         */
        Form::component('hSelect', 'admin::forms.horizon.select', ['name', 'label', 'data', 'selected' => null, 'required' => false, 'col_size' => 2, 'attributes' => []]);

        /**
         * Create a select range field.
         *
         * @param  string $name
         * @param  string $begin
         * @param  string $end
         * @param  string $selected
         * @param  array  $options
         *
         * @return \Illuminate\Support\HtmlString
         */
        Form::component('hSelectRange', 'admin::forms.horizon.selectrange', ['name', 'label', 'begin', 'end', 'selected' => null, 'required' => false, 'col_size' => 2, 'attributes' => []]);


        /**
         * Create a select year field.
         *
         * @param  string $name
         * @param  string $begin
         * @param  string $end
         * @param  string $selected
         * @param  array  $options
         *
         * @return mixed
         */
        Form::component('hSelectYear', 'admin::forms.horizon.selectyear', ['name', 'label', 'begin', 'end', 'selected' => null, 'required' => false, 'col_size' => 2, 'attributes' => []]);


        /**
         * Create a select month field.
         *
         * @param  string $name
         * @param  string $selected
         * @param  array  $options
         * @param  string $format
         *
         * @return \Illuminate\Support\HtmlString
         */
        Form::component('hSelectMonth', 'admin::forms.horizon.selectmonth', ['name', 'label', 'selected' => null, 'required' => false, 'col_size' => 2, 'attributes' => []]);


        /**
         * Create a checkbox input field.
         *
         * @param  string $name
         * @param  mixed  $value
         * @param  bool   $checked
         * @param  array  $options
         *
         * @return \Illuminate\Support\HtmlString
         */
        Form::component('hCheckbox', 'admin::forms.horizon.checkbox', ['name', 'label', 'checked', 'required' => false,  'col_size' => 2, 'attributes' => []]);



        /**
         * Create a radio button input field.
         *
         * @param  string $name
         * @param  mixed  $value
         * @param  bool   $checked
         * @param  array  $options
         *
         * @return \Illuminate\Support\HtmlString
         */
        Form::component('hRadio', 'admin::forms.horizon.radio', ['name', 'label', 'checked' => null, 'required' => false,  'col_size' => 2, 'attributes' => []]);
    }
}
