<div class="card-body">
    <div class="row">
        <div class="col-md-4">
            {!! \Form::nText('name', 'Name', old('name', $role->name ?? null), true) !!}
        </div>
        <div class="col-md-4">
            {!! \Form::nText('guard_name', 'Guard(s)', old('guard_name', $role->guard_name ?? \DefaultValue::PERMISSION_GUARD)) !!}
        </div>
        <div class="col-md-4">
            {!! \Form::nSelect('enabled', 'Enabled', \Constant::ENABLED_OPTIONS,
                old('enabled', ($role->enabled ?? \DefaultValue::ENABLED_OPTION))) !!}
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-12">
            {!! \Form::nTextarea('remarks', 'Remarks', old('remarks', $role->remarks ?? null)) !!}
        </div>
    </div>
    <div class="row">
        <div class="border-bottom my-3">
            <div class="card-title d-flex justify-content-between">
                <h4 class="mb-0">
                    <i class="mdi mdi-account-details-outline"></i>
                    Permissions
                </h4>
                @include('partials.app.preference.selection')
            </div>
            <p class="card-title-desc mb-3">
                Permission /Privilege assigned to this Role.
            </p>
        </div>
        @forelse($permissions as $permission)
            <div class="col-md-3">
                <div class="form-check m-2" title="{{ $permission->name }}">
                    <input class="form-check-input mark-checkbox" type="checkbox" name="permissions[]"
                           value="{{ $permission->id }}" id="permission_{{ $permission->id }}"
                           @if(in_array($permission->id, old('permissions.*', isset($role_permissions) ? (array)$role_permissions : [])) == true)
                           checked="checked"
                        @endif
                    >

                    <label class="form-check-label" for="permission_{{ $permission->id }}">
                        {{ $permission->display_name }}
                    </label>
                </div>
            </div>
        @empty
            <div class="col-12 text-center fw-bolder">No Permission/ Privilege available</div>
        @endforelse
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
