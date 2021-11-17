<?php


namespace Modules\Admin\Supports;

/**
 * Class Constant
 * @package Modules\Admin\Supports
 */
class Constant
{

    /**
     * System Model Status
     */
    const ENABLED_OPTIONS = ['yes' => 'Yes', 'no' => 'No'];

    /**
     * System User Permission Guards
     */
    const PERMISSION_GUARDS = ['web' => 'WEB'];

    /**
     * System Permission Title Constraint
     */
    const PERMISSION_NAME_ALLOW_CHAR = '([a-zA-Z0-9.-_]+)';

    /**
     * Keyword to purge Soft Deleted Models
     */
    const PURGE_MODEL_QSA = 'purge';

    /**
     *--------------------------------------------------------------------------
     * Timing Constants
     *--------------------------------------------------------------------------
     *
     * Provide simple ways to work with the myriad of PHP functions that
     * require information to be in seconds.
     */

    const SECOND = '1';
    const MINUTE = '60';
    const HOUR = '3600';
    const DAY = '86400';
    const WEEK = '604800';
    const MONTH = '2592000';
    const YEAR = '31536000';
    const DECADE = '315360000';

    /**
     * Toastr Message Levels
     */
    const MSG_TOASTR_ERROR = 'error';
    const MSG_TOASTR_WARNING = 'warning';
    const MSG_TOASTR_SUCCESS = 'success';
    const MSG_TOASTR_INFO = 'info';

    /**
     *--------------------------------------------------------------------------
     * Authentication Login Medium
     *--------------------------------------------------------------------------
     *
     */

    const LOGIN_EMAIL = 'email';
    const LOGIN_USERNAME = 'username';
    const LOGIN_MOBILE = 'mobile';
    const LOGIN_OTP = 'otp';

    /**
     *--------------------------------------------------------------------------
     * OTP Medium Source
     *--------------------------------------------------------------------------
     *
     */
    const OTP_MOBILE = 'mobile';
    const OTP_EMAIL = 'email';
}
