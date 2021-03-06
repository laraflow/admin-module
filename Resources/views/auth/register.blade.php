@extends('admin::layouts.auth')

@section('title', 'Register')

@push('meta')

@endpush

@push('webfont')

@endpush

@push('icon')

@endpush

@push('plugin-style')
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('modules/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@endpush

@push('inline-style')

@endpush

@push('head-script')

@endpush

@section('body-class', 'register-page')

@section('content')
    <div class="register-box">
        <div class="register-logo">
            <a href="{{ url('/') }}">{{ config('app.name', 'Laravel') }}</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body register-card-body">
                <p class="login-box-msg">Register a new membership</p>
                {!! \Form::open(['route' => 'admin.register', 'id' => 'register-form', 'method' => 'post']) !!}

                {!! \Form::iText('name', __('Name'), null, true, "fas fa-font", "after",
                [ 'minlength' => '2', 'maxlength' => '255',
                                'size' => '255', 'placeholder' => 'Enter Full Name']) !!}

                @if(config('auth.credential_field') == \Modules\Admin\Supports\Constant::LOGIN_EMAIL
                || (config('auth.credential_field') == \Modules\Admin\Supports\Constant::LOGIN_OTP
                    && config('auth.credential_otp_field') == \Modules\Admin\Supports\Constant::OTP_EMAIL))
                    {!! \Form::iEmail('email', __('Email'), null, true, "fas fa-envelope", "after",
                                        [ 'minlength' => '5', 'maxlength' => '250',
                                            'size' => '250', 'placeholder' => 'Enter Email Address']) !!}
                @endif

                @if(config('auth.credential_field') == \Modules\Admin\Supports\Constant::LOGIN_MOBILE
                || (config('auth.credential_field') == \Modules\Admin\Supports\Constant::LOGIN_OTP
                    && config('auth.credential_otp_field') == \Modules\Admin\Supports\Constant::OTP_MOBILE))
                    {!! \Form::iTel('mobile', __('Mobile'), null, true, "fas fa-mobile", "after",
                                        [ 'minlength' => '11', 'maxlength' => '11',
                                            'size' => '11', 'placeholder' => 'Enter Mobile Number']) !!}
                @endif

                @if(config('auth.credential_field') == \Modules\Admin\Supports\Constant::LOGIN_USERNAME)
                    {!! \Form::iText('username', __('Username'), null, true, "fas fa-user-shield", "after",
                                        [ 'minlength' => '5', 'maxlength' => '255',
                                            'size' => '255', 'placeholder' => 'Enter Username']) !!}
                @endif

                @if(config('auth.credential_field') != \Modules\Admin\Supports\Constant::LOGIN_OTP)
                    {!! \Form::iPassword('password', __('Password'), true, "fas fa-lock", "after",
                                        ["placeholder" => 'Enter Password', 'minlength' => '5',
                                         'maxlength' => '255', 'size' => '255']) !!}

                    {!! \Form::iPassword('password_confirmation', __('Retype Password'), true, "fas fa-lock", "after",
                                        ["placeholder" => 'Retype Password', 'minlength' => '5',
                                         'maxlength' => '255', 'size' => '255']) !!}

                @endif
                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            {!! \Form::checkbox('agree_terms', 'agree', null, ['id' => 'agree_terms']) !!}
                            <label for="agree_terms">
                                I agree to the <a href="{{ route('admin.terms') }}" target="_blank">terms</a>
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-success btn-block">{{ __('Register') }}</button>
                    </div>
                    <!-- /.col -->
                </div>
                {!! \Form::close() !!}

                {{--
                <div class="social-auth-links text-center mb-3">
                    <p>- OR -</p>
                    <a href="#" class="btn btn-block btn-primary">
                        <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
                    </a>
                    <a href="#" class="btn btn-block btn-danger">
                        <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
                    </a>
                </div>
                --}}
            <!-- /.social-auth-links -->

                @if(Route::has('admin.login'))
                    <p class="mb-0">
                        <a href="{{ route('admin.login') }}" class="text-center">I already have a membership</a>
                    </p>
                @endif

                @if (Route::has('admin.password.request') && config('auth.allow_password_reset'))
                    <p class="mb-1">
                        <a href="{{ route('admin.password.request') }}">I forgot my password</a>
                    </p>
                @endif
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->
@endsection


@push('plugin-script')
    <script src="{{ asset('modules/admin/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
@endpush

@push('page-script')
    <script type="text/javascript">
        $(function () {
            $("#register-form").validate({
                rules: {
                    @if(config('auth.credential_field') == \Modules\Admin\Supports\Constant::LOGIN_EMAIL
                    || (config('auth.credential_field') == \Modules\Admin\Supports\Constant::LOGIN_OTP
                    && config('auth.credential_otp_field') == \Modules\Admin\Supports\Constant::OTP_EMAIL))
                    email: {
                        required: true,
                        minlength: 3,
                        maxlength: 255,
                        email: true
                    },
                    @endif

                        @if(config('auth.credential_field') == \Modules\Admin\Supports\Constant::LOGIN_MOBILE
                        || (config('auth.credential_field') == \Modules\Admin\Supports\Constant::LOGIN_OTP
                        && config('auth.credential_otp_field') == \Modules\Admin\Supports\Constant::OTP_MOBILE))
                    mobile: {
                        required: true,
                        minlength: 11,
                        maxlength: 11,
                        digits: true
                    },
                    @endif

                        @if(config('auth.credential_field') == \Modules\Admin\Supports\Constant::LOGIN_USERNAME)
                    username: {
                        required: true,
                        minlength: 5,
                        maxlength: 250
                    },
                    @endif

                        @if(config('auth.credential_field') != \Modules\Admin\Supports\Constant::LOGIN_OTP)
                    password: {
                        required: true,
                        minlength: {{ config('auth.minimum_password_length') }},
                        maxlength: 250
                    }
                    @endif
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-valid').addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid').addClass('is-valid');
                }
            });
        });
    </script>
@endpush




@section('content')
    <form action="../../index.html" method="post">
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Full name">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-user"></span>
                </div>
            </div>
        </div>
        <div class="input-group mb-3">
            <input type="email" class="form-control" placeholder="Email">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
            </div>
        </div>
        <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Password">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
        </div>
        <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Retype password">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-8">
                <div class="icheck-primary">
                    <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                    <label for="agreeTerms">
                        I agree to the <a href="#">terms</a>
                    </label>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
                <button type="submit" class="btn btn-primary btn-block">Register</button>
            </div>
            <!-- /.col -->
        </div>
    </form>

    <div class="social-auth-links text-center">
        <p>- OR -</p>
        <a href="#" class="btn btn-block btn-primary">
            <i class="fab fa-facebook mr-2"></i>
            Sign up using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
            <i class="fab fa-google-plus mr-2"></i>
            Sign up using Google+
        </a>
    </div>

    <a href="login.html" class="text-center"></a>
    </div>
    <!-- /.form-box -->
    </div>
    <!-- /.card -->
    </div>
    <!-- /.register-box -->
@endsection


@push('plugin-script')

@endpush

@push('page-script')

@endpush

{{--
<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
--}}
