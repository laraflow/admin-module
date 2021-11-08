<div class="card-body">
    <div class="row">
        <div class="col-md-4">
            {!! \Form::nText('name', 'Name', old('name', $role->name ?? null), true) !!}
        </div>
        <div class="col-md-4">
            {!! \Form::nText('guard_name', 'Guard(s)', old('guard_name', $role->guard_name ?? \Modules\Core\Supports\DefaultValue::PERMISSION_GUARD)) !!}
        </div>
        <div class="col-md-4">
            {!! \Form::nSelect('enabled', 'Enabled', \Modules\Core\Supports\Constant::ENABLED_OPTIONS,
                old('enabled', ($role->enabled ?? \Modules\Core\Supports\DefaultValue::ENABLED_OPTION))) !!}
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            {!! \Form::nTextarea('remarks', 'Remarks', old('remarks', $role->remarks ?? null)) !!}
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-12 justify-content-between d-flex">
            {!! \Form::nCancel('Cancel') !!}
            {!! \Form::nSubmit('submit', 'Save') !!}
        </div>
    </div>
</div>


@push('page-scripts')
    <script>
        $(document).ready(function () {
            $("#role-form").validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 3,
                        maxlength: 255
                    },
                    enabled: {
                        required: true
                    },
                    remarks: {
                        minlength: 3,
                        maxlength: 255
                    },
                }
            });
        });
    </script>
@endpush
