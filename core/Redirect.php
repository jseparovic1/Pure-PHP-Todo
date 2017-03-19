<?php
namespace Viper;

/**
 * Simple redirection class
 */
class Redirect
{
    public static function to($path)
    {
        header("Location: $path");
    }
}