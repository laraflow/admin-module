<?php

namespace Modules\Admin\Supports;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\HtmlString;

/**
 * Class CHTML
 * @package Modules\Admin\Supports
 */
class CHTML
{
    /**
     * @param Model $model
     * @param string $field
     * @param array $options
     * @param null $current_value
     * @param array $states
     * @return HtmlString
     */
    public static function flagChangeButton(Model $model, string $field, array $options = [], $current_value = null, array $states = []): HtmlString
    { //Get Model information
        $model_id_field = $model->getKeyName();
        $model_id = $model->$model_id_field;
        $model_path = get_class($model); //generate switch states
        $options['on'] = $options['on'] ?? array_shift($options);
        $options['off'] = $options['off'] ?? array_shift($options); //generate switch states colors
        $states['on'] = $states['on'] ?? 'success';
        $states['off'] = $states['off'] ?? 'danger';
        $HTML = "<input class='toggle-class' type='checkbox' ";
        $HTML .= "data-onstyle='" . $states['on'] . "' data-offstyle='" . $states['off'] . "' data-toggle='toggle' data-size='small'";
        $HTML .= "data-model='$model_path' data-id='$model_id' data-field='$field' ";
        $HTML .= "data-on='" . $options['on'] . "' data-off='" . $options['off'] . "'";
        if (is_null($current_value)) {
            $HTML .= ($options['on'] == $model->$field) ? " checked" : "";
        } else {
            $HTML .= ($options['on'] == $current_value) ? " checked" : "";
        }
        $HTML .= ">";

        return new HtmlString($HTML);
    }

    /**
     * @param Model $model
     * @param string $field
     * @param array $options
     * @param null $current_value
     * @param array $states
     * @return HtmlString
     */
    public static function statusEnabledToggle(Model $model, string $field, array $options = [], $current_value = null, array $states = []): HtmlString
    { //Get Model information
        $model_id_field = $model->getKeyName();
        $model_id = $model->$model_id_field;
        $model_path = get_class($model); //generate switch states
        $options['on'] = $options['on'] ?? array_shift($options);
        $options['off'] = $options['off'] ?? array_shift($options); //generate switch states colors
        $states['on'] = $states['on'] ?? 'success';
        $states['off'] = $states['off'] ?? 'danger';
        $HTML = "<input class='toggle-class' type='checkbox' ";
        $HTML .= "data-onstyle='" . $states['on'] . "' data-offstyle='" . $states['off'] . "' data-toggle='toggle' data-size='small'";
        $HTML .= "data-model='$model_path' data-id='$model_id' data-field='$field' ";
        $HTML .= "data-on='" . $options['on'] . "' data-off='" . $options['off'] . "'";
        if (is_null($current_value)) {
            $HTML .= ($options['on'] == $model->$field) ? " checked" : "";
        } else {
            $HTML .= ($options['on'] == $current_value) ? " checked" : "";
        }
        $HTML .= ">";

        return new HtmlString($HTML);
    }

    /**
     * @param $collection
     * @param string $type [default, simple]
     * @return mixed
     */
    public static function pagination($collection, string $type = 'default')
    {
        return $collection->onEachSide(2)->appends(request()->query())
            ->links('admin::layouts.' . $type . '-paginate');
    }

}

