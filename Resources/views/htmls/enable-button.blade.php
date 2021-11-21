@if($model instanceof \Illuminate\Database\Eloquent\Model)
    <input type="checkbox" data-toggle="toggle" data-size="small" data-onstyle="{{ $options['onstyle'] ?? 'success' }}"
           data-offstyle="{{ $options['offstyle'] ?? 'danger' }}" data-model="{{ get_class($model) }}"
           data-field="{{ $options['field'] ?? 'enabled' }}" data-id="{{ $model->id }}"
           data-on="<i class='fas fa-check'></i> Yes"
           data-off="<i class='fas fa-times'></i> No"
           data-width="65"
           data-onvalue="{{ $options['onvalue'] ?? \Modules\Admin\Supports\DefaultValue::ENABLED_OPTION }}"
           data-offvalue="{{ $options['offvalue'] ?? \Modules\Admin\Supports\DefaultValue::DISABLED_OPTION }}"
           @if($model->enabled == \Modules\Admin\Supports\DefaultValue::ENABLED_OPTION) checked @endif>
@else
    @php throw new \Exception('Input must be instance of Eloquent Model'); @endphp
@endif
