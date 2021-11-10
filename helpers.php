<?php

if (!function_exists('cd')) {
    /**
     * Display Variable like DD() in custom
     * @param $param
     */
    function cd($param)
    {
        if (config('app.env') == 'local'):
            \Kint\Kint::dump($param);
        endif;
    }
}


if (!function_exists('cdd')) {
    /**
     * Display Variable like DD() in custom
     * @param $param
     */
    function cdd(...$param)
    {
        if (config('app.env') == 'local'):
            \Kint\Kint::dump(...$param);
            exit;
        endif;
    }
}


