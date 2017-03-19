<?php
namespace Viper;

class App
{
    /**
     * All registered dependecies
     * @var array
     */
    protected static $registry = [];

    /**
     * Register key to acces dependency
     * @param $key
     * @param $value
     */
    public static function register(string $key, $value)
    {
        static::$registry[$key] = $value;
    }

    /**
     * Get dependecy via key
     *
     * @param string $key
     * @return mixed
     * @throws \Exception
     */
    public static function get(string $key)
    {
        if (array_key_exists($key, static::$registry)) {
            return static::$registry[$key];
        }
        throw new \Exception("Key {$key} not found !");
    }
}