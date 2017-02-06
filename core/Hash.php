<?php

/**
 * Hasing class
 */
class Hash
{
    public static function password($password)
    {
        return password_hash($password,PASSWORD_DEFAULT);
    }
    public static function verifyPassword($password,$hash)
    {
        return password_verify($password,$hash);
    }
    public static function getActivationCode()
    {
        return bin2hex(random_bytes(16));
    }
}