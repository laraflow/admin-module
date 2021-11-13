<?php


namespace Modules\Admin\Supports;

/**
 * Class Helper
 * @package Modules\Admin\Supports
 */
class Helper
{

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

    public static function randomBadge(int $limit = 1, bool $rounded = false): string
    {
        $CLASS = "badge ";

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

        if ($rounded) $CLASS .= "rounded-pill ";

        $CLASS .= $badges[array_rand($badges, $limit)];

        return $CLASS;
    }

    public static function formatLogFilename(string $filename)
    {
        return preg_replace('/laravel\-([\d]{4})-([\d]{2})-([\d]{2})\.log/', '$3/$2/$1', $filename);
    }
}
