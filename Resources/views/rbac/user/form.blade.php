@push('plugin-style')
    <link rel="stylesheet" href="{{ asset('modules/admin/plugins/select2/css/select2.min.css') }}" type="text/css">
    <link rel="stylesheet"
          href="{{ asset('modules/admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}"
          type="text/css">
@endpush

<div class="card-body">
    <div class="row">
        <div class="col-md-6">
            {!! \Form::nText('name', 'Name', old('name', $user->name ?? null), true) !!}
        </div>
        <div class="col-md-6">
            {!! \Form::nText('username', 'Username', old('username', $user->username ?? null)) !!}
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            {!! \Form::nEmail('email', 'Email Address', old('email', $user->email ?? null), true) !!}
        </div>
        <div class="col-md-6">
            {!! \Form::nTel('mobile', 'Mobile', old('mobile', $user->mobile ?? null), true) !!}
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            {!! \Form::nPassword('password', 'Password', null, empty($user->password)) !!}
        </div>
        <div class="col-md-6">
            {!! \Form::nPassword('password_confirmation', 'Retype Password', null, empty($user->password)) !!}
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            {!! \Form::nSelect('role_id[]', 'Role', $roles,
    old('role_id', ($user_roles ?? \Modules\Admin\Supports\DefaultValue::GUEST_ROLE_ID)), true,
    ['multiple' => true, 'class' => 'form-control form-select select2']) !!}
        </div>
        <div class="col-md-6">
            {!! \Form::nFile('photo', 'Photo', null, false) !!}
        </div>
    </div>
    @if(isset($user->enabled))
        <div class="row">
            <div class="col-md-6">
                {!! \Form::nSelect('enabled', 'Enabled', \Modules\Admin\Supports\Constant::ENABLED_OPTIONS,
        old('enabled', ($user->enabled ?? \Modules\Admin\Supports\DefaultValue::ENABLED_OPTION))) !!}
            </div>
        </div>
    @endif
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



@push('page-script')
    <script type="text/javascript" src="{{ asset('modules/admin/plugins/select2/js/select2.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            //trigger select2
            $("select.select2").select2({
                width: "100%",
                minimumResultsForSearch: Infinity,
                maximumSelectionLength: 3,
            });

            $("#user-form").validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 3,
                        maxlength: 255
                    },
                    username: {},
                    email: {
                        required: true,
                        email: true,
                        minlength: 2,
                        maxlength: 255
                    },
                    mobile: {
                        required: true,
                        digits: true,
                        minlength: 11,
                        maxlength: 11
                    },
                    password: {
                        required: {{ isset($user) ? 'false' : 'true' }},
                        minlength: '{{ config('auth.minimum_password_length') }}',
                        maxlength: 255,
                        equalTo: "#password_confirmation"
                    },
                    password_confirmation: {
                        required: {{ isset($user) ? 'false' : 'true' }},
                        minlength: '{{ config('auth.minimum_password_length') }}',
                        maxlength: 255,
                        equalTo: "#password"
                    }

                }
            });

        });
    </script>
@endpush
