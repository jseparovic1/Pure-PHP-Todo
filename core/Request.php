<?php
namespace Viper;

/**
 * Geting HTTP request details
 *
 * Created by Jurica Separovic.
 * Date: 2.2.2017.
 */

class Request
{
    /**
     * Find request URI
     * @return string uri
     */
    public static function uri()
    {
        //parse uri and trim leading slashes
        return trim(parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH),"/");
    }

    /**
     * Return request method GET,POST,DELTE...
     */
    public static function method()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    /**
     * Find user submitted get value by key
     *
     * @param $key
     * @return value of get key
     */
    public static function get($key)
    {
        $value = $_GET[$key] ?? null;
        return htmlspecialchars($value,ENT_QUOTES);
    }

    /**
     * Find user submitted post value by key
     * @param $key
     * @return post value
     */
    public static function post($key)
    {
        $value = $_POST[$key] ?? null;
        return htmlspecialchars($value,ENT_QUOTES);
    }
}