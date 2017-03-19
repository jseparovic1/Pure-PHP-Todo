<?php
namespace Viper;

/**
 * Hasing class
 */
class Hash
{
    /**
     * Hash password using php password_hash and default algorithm
     *
     * @param $password
     * @return bool|string
     */
    public static function password($password)
    {
        return password_hash($password,PASSWORD_DEFAULT);
    }

    /**
     * Verify pasword and hash
     * @param $password
     * @param $hash
     * @return bool
     */
    public static function verifyPassword($password,$hash)
    {
        return password_verify($password,$hash);
    }

    /**
     * Creates random activation code
     * @return string
     */
    public static function getActivationCode()
    {
        return bin2hex(random_bytes(16));
    }
}