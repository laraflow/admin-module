<?php


namespace Modules\Admin\Supports;

/**
 * Class DefaultValue
 * @package Modules\Admin\Supports
 */
class DefaultValue
{


    /**
     * Default Role ID for frontend registered user
     */
    const GUEST_ROLE_ID = 7;
    /**
     * Default Role Name for system administrator
     */
    const SUPER_ADMIN_ROLE = 'Super Administrator';

    /**
     * Default Mobile Number for backend admin panel
     */
    const MOBILE = '01710534092';

    /**
     * Default Backend Preference ID for backend admin panel
     */
    const USER_ID = 1;

    /**
     * Default Email Address for backend admin panel
     */
    const EMAIL = 'hafijul233@gmail.com';

    /**
     * Default model enabled status
     */
    const ENABLED_OPTION = 'yes';

    /**
     * Default model disabled status
     */
    const DISABLED_OPTION = 'no';

    /**
     * Default Guard for all users if any special is not provided
     */
    const PERMISSION_GUARD = 'web';
    /**
     * Default Password
     */
    const PASSWORD = '123456789';

    /**
     * Default profile display image is user image is missing
     */
    const USER_PROFILE_IMAGE = '/modules/admin/assets/img/AdminLTELogo.png';

    /**
     * Default Export Option
     */
    const EXPORT_DEFAULT = 'xlsx';

}
