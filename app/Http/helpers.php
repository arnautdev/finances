<?php

/**
 * Get current logged guard
 */
if (!function_exists('getGuardName')) {
    function getGuardName()
    {
        $guards = config('auth.guards');
        foreach ($guards as $guard => $settings) {
            if (auth()->guard($guard)->check()) {
                return $guard;
            }
        }
    }
}

/**
 * Check user instance
 */
if (!function_exists('userIs')) {
    function userIs($guard)
    {
        return \auth()->guard($guard)->check();
    }
}

/**
 * Get auth client instance
 */
if (!function_exists('client')) {
    function client()
    {
        $auth = \auth('client');
        if ($auth->check()) {
            return $auth;
        }
        return false;
    }
}

/**
 * Get employee auth instance
 */
if (!function_exists('employee')) {
    function employee()
    {
        $auth = \auth('employee');
        if ($auth->check()) {
            return $auth;
        }
        return false;
    }
}

/**
 * Get auth business instance
 */
if (!function_exists('business')) {
    function business()
    {
        return \auth('business');
    }
}

/**
 * Get youtube id
 */
if (!function_exists('getYoutubeVideoId')) {
    function getYoutubeVideoId($youtubeVideoUrl)
    {
        parse_str(parse_url($youtubeVideoUrl, PHP_URL_QUERY), $args);
        return $args['v'];
    }
}

if (!function_exists('loadIpData')) {
    /**
     * Load ip-data
     */
    function loadIpData()
    {
        $ip = request()->ip();

        // for test
//        $ip = '78.128.7.251';

        return file_get_contents('http://api.ipstack.com/' . $ip . '?access_key=013b051b58993d99e21025474142a196');
    }
}

if (!function_exists('isJson')) {

    /**
     * Check string if json
     * @param $str
     * @return bool
     */
    function isJson($str)
    {
        json_decode($str);
        if (json_last_error() === 0) {
            return true;
        }
        return false;
    }
}

if (!function_exists('__')) {
    /**
     * Translate the given message.
     *
     * @param string $key
     * @param array $replace
     * @param string $locale
     * @return string|array|null
     */
    function __($key, $replace = [], $locale = null)
    {
        $jsonString = openJSONFile();
        if (!isset($jsonString[$key])) {
            addKeyToLangFiles($key);
        }

        return app('translator')->getFromJson($key, $replace, $locale);
    }

    /**
     * @param $key
     */
    function addKeyToLangFiles($key)
    {
        $languages = collect(config('app.localesI18n'));

        // add key to all lng files
        $languages->map(function ($lang) use ($key) {
            $data = openJSONFile($lang);
            $data[$key] = $key;
            saveJSONFile($lang, $data);
        });
    }

    /**
     * @param $code
     * @param $data
     */
    function saveJSONFile($code, $data)
    {
        ksort($data);
        $jsonData = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        file_put_contents(base_path('resources/lang/' . $code . '.json'), stripslashes($jsonData));
    }

    /**
     * @param string $code
     * @return array|bool|mixed|string
     */
    function openJSONFile($code = 'bg')
    {
        $jsonString = [];
        $lngFile = base_path('resources/lang/' . $code . '.json');
        if (is_file($lngFile)) {
            $jsonString = file_get_contents(base_path('resources/lang/' . $code . '.json'));
            $jsonString = json_decode($jsonString, true);
        } else {
            file_put_contents($lngFile, '{}');
            $jsonString = json_decode($jsonString, true);
        }
        return $jsonString;
    }
}
