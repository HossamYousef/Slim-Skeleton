<?php

if (!function_exists('dd')) {
    /**
     * Dump the passed variables and end the script.
     *
     * @param  mixed
     * @return void
     */
    function dd()
    {
        array_map(
            function ($x) {
                (new \App\Common\Debug\Dumper)->dump($x);
            },
            func_get_args()
        );

        die(1);
    }
}

if (!function_exists('env')) {
    /**
     * Gets the value of an environment variable
     *
     * @param  string $key
     * @param  mixed  $default
     * @return mixed
     */
    function env($key, $default = null)
    {
        $value = getenv($key);
        if ($value === false) {
            return $default;
        }
        switch (strtolower($value)) {
            case 'true':
            case '(true)':
                return true;
            case 'false':
            case '(false)':
                return false;
            case 'empty':
            case '(empty)':
                return '';
            case 'null':
            case '(null)':
                return null;
        }
        $strLen = strlen($value);
        if ($strLen > 1 && $value[0] === '"' && $value[$strLen - 1] === '"') {
            return substr($value, 1, -1);
        }
        return $value;
    }
}
