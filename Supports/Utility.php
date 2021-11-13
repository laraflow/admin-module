<?php


namespace Modules\Admin\Supports;

use Illuminate\Support\Facades\Hash;
use Modules\Admin\Repositories\Eloquent\Auth\UserRepository;

/***
 * Class Utility
 * @package Modules\Admin\Supports
 */
class Utility
{
    /**
     * @param string $password
     * @return string
     */
    public static function hashPassword(string $password): string
    {
        return Hash::make($password);
    }

    /**
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

        $pattern = " ";
        $firstPart = strstr(strtolower($name), $pattern, true);
        $secondPart = substr(strstr(strtolower($name), $pattern, false), 0, 3);
        $nrRand = rand(0, 100);
        $username = trim($firstPart) . trim($secondPart) . trim($nrRand);

        //verify generated username is unique
        return ($userRepository->verifyUniqueUsername($username)) ? $username : self::generateUsername($name, $userRepository);

    }
}
