@if($model instanceof \Illuminate\Database\Eloquent\Model)
    <style>
        .toggle.ios, .toggle-on.ios, .toggle-off.ios { border-radius: 20rem; }
        .toggle.ios .toggle-handle { border-radius: 20rem; }
    </style>

    <input type="checkbox" class="toggle-class" data-toggle="toggle" data-size="sm"
           data-onstyle="outline-success" data-offstyle="outline-danger" data-model="{{ get_class($model) }}"
           data-id="{{ $model->id }}" data-width="65" data-style="ios"
           data-on="<i class='fas fa-check'></i> {{ \Modules\Core\Supports\Constant::ENABLED_OPTIONS[\Modules\Core\Supports\Constant::ENABLED_OPTION] }}"
           data-off="<i class='fas fa-times'></i> {{ \Modules\Core\Supports\Constant::ENABLED_OPTIONS[\Modules\Core\Supports\Constant::DISABLED_OPTION] }}"
           data-onvalue="{{ \Modules\Core\Supports\Constant::ENABLED_OPTION }}"
           data-offvalue="{{ \Modules\Core\Supports\Constant::DISABLED_OPTION }}"
           @if($model->enabled == \Modules\Core\Supports\Constant::ENABLED_OPTION) checked @endif>
@else
    @php throw new \Exception('Input must be instance of Eloquent Model'); @endphp
@endif
