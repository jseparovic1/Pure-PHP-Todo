<?php
namespace Viper;

/**
 * Simple redirection class
 */
class Redirect
{
    /**
     * Redirect to path
     * @param $path
     */
    public static function to($path)
    {
        header("Location: $path");
    }
}