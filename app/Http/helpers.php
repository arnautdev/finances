<?php

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

        return trans($key, $replace, $locale);
    }

    /**
     * @param $key
     */
    function addKeyToLangFiles($key)
    {
        $languages = collect(config('app.locales'));

        // add key to all lng files
        $languages->map(function ($lang, $langKey) use ($key) {
            $data = openJSONFile($langKey);
            $data[$key] = $key;
            saveJSONFile($langKey, $data);
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
    function openJSONFile($code = 'en')
    {
        $jsonString = [];
        $filePath = base_path('resources/lang/' . $code . '.json');

        /// create file if not exists
        if (!is_file($filePath)) {
            touch($filePath);
            file_put_contents($filePath, '{}');
        }

        if (is_file(base_path('resources/lang/' . $code . '.json'))) {
            $jsonString = file_get_contents(base_path('resources/lang/' . $code . '.json'));
            $jsonString = json_decode($jsonString, true);
        }
        return $jsonString;
    }
}
