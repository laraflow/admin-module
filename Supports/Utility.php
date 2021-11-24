<?php


namespace Modules\Admin\Supports;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Excel;
use Modules\Admin\Repositories\Eloquent\Rbac\UserRepository;

/***
 * Class Utility
 * @package Modules\Admin\Supports
 */
class Utility
{
    /**
     * Hash any text with laravel default has algo.
     * Currently, only support bcrypt() with cost 10
     *
     * @param string $password
     * @return string
     */
    public static function hashPassword(string $password): string
    {
        return Hash::make($password);
    }

    /**
     * Create a unique random username with given having input
     * As prefix text and a random number
     *
     * @param string $name
     * @param UserRepository|null $userRepository
     * @return string
     * @throws \Exception
     */
    public static function generateUsername(string $name, UserRepository $userRepository = null): string
    {
        if (is_null($userRepository)) {
            $userRepository = new UserRepository;
        }

        //removed white space from name
        $firstPart = preg_replace("([\s]+)", '-', Str::lower($name));

        //add a random number to end
        $username = trim($firstPart) . rand(100, 1000);

        //verify generated username is unique
        return ($userRepository->verifyUniqueUsername($username)) ? $username : self::generateUsername($name, $userRepository);

    }

    /**
     * Admin LTE 3 Supported Random Badge Colors
     *
     * @param bool $rounded
     * @return string
     */
    public static function randomBadgeBackground(bool $rounded = false): string
    {
        $class = "badge ";

        $badges = [
            "bg-primary",
            "bg-secondary",
            "bg-success",
            "bg-danger",
            "bg-warning text-dark",
            "bg-info text-white",
            "bg-light text-dark",
            "bg-dark"
        ];

        if ($rounded) $class .= "rounded-pill ";

        $class .= $badges[array_rand($badges)];

        return $class;
    }

    /**
     * Rename laravel log filename to more human readable format
     *
     * @param string $filename
     * @return array|string|string[]|null
     */
    public static function formatLogFilename(string $filename)
    {
        return preg_replace('/laravel\-([\d]{4})-([\d]{2})-([\d]{2})\.log/', '$3/$2/$1', $filename);
    }


    /**
     * Convert Route Name Human Readable Style
     *
     * @param string $permission
     * @return string
     */
    public static function permissionDisplay(string $permission): string
    {
        return ucwords(str_replace(['.', '-', '_'], [' ', ' ', ' '], $permission));
    }

    /**
     * @param string $format
     * @return string
     */
    public static function getExportExt(string $format = Excel::XLSX): string
    {
        switch ($format) {
            case 'xlsx' :
                return Excel::XLSX;

            case 'csv' :
                return Excel::CSV;

            case 'pdf' :
                return Excel::DOMPDF;

            case 'html' :
                return Excel::HTML;

            case 'ods' :
                return Excel::ODS;

            default :
                return Excel::XLSX;
        }
    }
}
