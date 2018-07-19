<?php
//namespace App\Helpers;

/*
|--------------------------------------------------------------------------
| Common global functions related to internationalization and localization
|--------------------------------------------------------------------------
|
| This file contains common global functions related to i18n or translation
| (internationalization and localization) for application wide.
|
 */

if (!function_exists('current_locale')) {
    /**
     * Returns current locale
     *
     * @author  Tan Mai
     * @since   2015/08/11
     * @see     LaravelLocalization::getCurrentLocale
     *
     * @return  string current locale name
     */
    function current_locale() {
        return LaravelLocalization::getCurrentLocale();
    }
}

if (!function_exists('__')) {
    /**
     * Get the translation text
     *
     * @author  Tan Mai
     * @since   2015/08/09
     * @param   string  $id
     * @param   array   $parameters
     * @param   string  $domain
     * @param   string  $locale
     * @return  string
     */
    function __($id, $default = null, $parameters = array(), $domain = 'messages', $locale = null) {
        if(Lang::trans($id, $parameters, $domain, $locale) == $id){
            if($default <> null){
                return $default; // IF no lang key found, just return default value
            }
        }
        return Lang::trans($id, $parameters, $domain, $locale);
    }
}

if (!function_exists('_p')) {
    /**
     * Get the singular or plural forms of a translation
     *
     * @author  Tan Mai
     * @since   2015/08/09
     * @param   string  $id
     * @param   int     $number
     * @param   array   $parameters
     * @param   string  $domain
     * @param   string  $locale
     * @return  string
     */
    function _p($id, $number, array $parameters = array(), $domain = 'messages', $locale = null) {
        // if array provided, use it's count value
        if (is_array($number) || (is_object($number) && method_exists($number, 'count'))) {
            $number = count($number);
        }

        // fix laravel plural behavior
        if (1 == $number) {
            $number = 0;
        }

        return Lang::transChoice($id, $number, $parameters, $domain, $locale);
    }
}

if (!function_exists('from_client_time')) {
    /**
     * Get local time object
     *
     * @author  Tan Mai
     * @since   2015/08/17
     * @param   mixed   $time
     * @return  Carbon\Carbon
     */
    function from_client_time($time = null) {
        // get client timezone if provided
        $tz = Cookie::get('timezone');

        // return Carbon instance in client timezone
        $time = new \Date($time, $tz);
        return $time;
    }
}

if (!function_exists('client_time')) {
    /**
     * Get server time object to local time
     *
     * @author  Tan Mai
     * @since   2015/08/17
     * @param   mixed   $time
     * @param   string  $tz
     * @return  Carbon\Carbon
     */
    function client_time($time = null, $tz = null) {
        // get client timezone if provided
        if (is_null($tz)) {
            $tz = Cookie::get('timezone');
        }

        // return Carbon instance in client timezone
        $time = new \Date($time, config('app.timezone'));
        $time->timezone($tz);
        return $time;
    }
}

if (!function_exists('server_time')) {
    /**
     * Get server time object
     *
     * @author  Tan Mai
     * @since   2015/08/17
     * @param   mixed   $time
     * @param   string  $tz
     * @return  Carbon\Carbon
     */
    function server_time($time = null, $tz = null) {
        $instance = new \Date($time, $tz);
        $instance->timezone(config('app.timezone'));

        return $instance;
    }
}
