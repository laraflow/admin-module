<?php

namespace Modules\Admin\Services\Auth;


use Illuminate\Auth\Events\Lockout;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Modules\Admin\Http\Requests\Auth\LoginRequest;
use Modules\Admin\Supports\Constant;
use Modules\Admin\Supports\DefaultValue;

/**
 * Class AuthenticatedSessionService
 * @package Modules\Admin\Services\Auth
 */
class AuthenticatedSessionService
{
    /**
     * Handle an incoming auth request.
     *
     * @param LoginRequest $request
     * @return array
     */
    public function attemptLogin(LoginRequest $request): array
    {
        $authConfirmation = $this->authenticate($request);

        if ($authConfirmation['status'] == true) {
            $request->session()->regenerate();
        }

        return $authConfirmation;
    }


    /**
     * Attempt to authenticate the request's credentials.
     *
     * @param LoginRequest $request
     * @return array
     *
     */
    private function authenticate(LoginRequest $request): array
    {
        $this->ensureIsNotRateLimited($request);

        $authInfo = $this->formatAuthCredential($request);
        $remember_me = false;

        if (config('auth.allow_remembering')) {
            $remember_me = $request->boolean('remember');
        }

        //authentication is OTP
        if (!isset($authInfo['password'])) {
            //TODO OTP Based Authentication
            return ['status' => false, 'message' => __('auth.failed'), 'level' => Constant::MSG_TOASTR_ERROR, 'title' => 'Alert!'];
        } else {
            //Login using [email, mobile, username] & password
            if (Auth::attempt($authInfo, $remember_me)) {

                //TODO Email Verification
                //dd((Auth::user() instanceof MustVerifyEmail));

                RateLimiter::clear($this->throttleKey($request));
                return ['status' => true, 'message' => __('auth.success'), 'level' => Constant::MSG_TOASTR_SUCCESS, 'title' => 'Authentication'];
            }

            RateLimiter::hit($this->throttleKey($request));
            return ['status' => false, 'message' => __('auth.failed'), 'level' => Constant::MSG_TOASTR_ERROR, 'title' => 'Alert!'];
        }
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @param LoginRequest $request
     * @return void
     *
     */
    private function ensureIsNotRateLimited(LoginRequest $request)
    {
        if (!RateLimiter::tooManyAttempts($this->throttleKey($request), 5)) {
            return;
        }

        event(new Lockout($request));

        $seconds = RateLimiter::availableIn($this->throttleKey($request));

        notify(trans('auth.throttle', [
            'seconds' => $seconds,
            'minutes' => ceil($seconds / 60),
        ]), Constant::MSG_TOASTR_WARNING, 'Warning');
    }

    /**
     * Get the rate limiting throttle key for the request.
     *
     * @param LoginRequest $request
     * @return string
     */
    private function throttleKey(LoginRequest $request): string
    {
        return Str::lower($request->input('email')) . '|' . $request->ip();
    }

    /**
     * Destroy an authenticated session.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function attemptLogout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    /**
     * Verify that current request user is who he claim to be
     *
     * @param Request $request
     * @return bool
     */
    public function verifyUser(Request $request): bool
    {
        if (config('auth.credential_field') != Constant::LOGIN_OTP) {

            $credentials = [];

            if (config('auth.credential_field') == Constant::LOGIN_EMAIL
                || (config('auth.credential_field') == Constant::LOGIN_OTP
                    && config('auth.credential_otp_field') == Constant::OTP_EMAIL)) {
                $credentials['email'] = $request->user()->email;

            } elseif (config('auth.credential_field') == Constant::LOGIN_MOBILE
                || (config('auth.credential_field') == Constant::LOGIN_OTP
                    && config('auth.credential_otp_field') == Constant::OTP_MOBILE)) {
                $credentials['mobile'] = $request->user()->mobile;

            } elseif (config('auth.credential_field') == Constant::LOGIN_USERNAME) {
                $credentials['username'] = $request->user()->username;
            }

            //Password Field
            $credentials['password'] = $request->password;

            return Auth::guard('web')->validate($credentials);
        } else {
            return true;
        }
    }

    /**
     * Collect Credential Info from Request based on Config
     *
     * @param LoginRequest $request
     * @return array
     */
    private function formatAuthCredential(LoginRequest $request): array
    {
        $credentials = [];

        if (config('auth.credential_field') == Constant::LOGIN_EMAIL
            || (config('auth.credential_field') == Constant::LOGIN_OTP
                && config('auth.credential_otp_field') == Constant::OTP_EMAIL)) {
            $credentials['email'] = $request->email;

        } elseif (config('auth.credential_field') == Constant::LOGIN_MOBILE
            || (config('auth.credential_field') == Constant::LOGIN_OTP
                && config('auth.credential_otp_field') == Constant::OTP_MOBILE)) {
            $credentials['mobile'] = $request->mobile;

        } elseif (config('auth.credential_field') == Constant::LOGIN_USERNAME) {
            $credentials['username'] = $request->username;
        }

        //Password Field
        if (config('auth.credential_field') != Constant::LOGIN_OTP) {
            $credentials['password'] = $request->password;
        }

        return $credentials;
    }

    public static function isSuperAdmin() {
        return (\auth()->user()->hasRole(DefaultValue::SUPER_ADMIN_ROLE));
    }
}
