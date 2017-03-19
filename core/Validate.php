<?php
namespace Viper;

/*
 * Data validation
 */

class Validate
{
    /**
     * Validate email
     *
     * @param string $email
     * @return bool
     */
    public function email(string $email)
    {
        return (filter_var($email,FILTER_VALIDATE_EMAIL)) ? true : false;
    }

    /**
     * Validate password length
     *
     * @param string $password
     * @param int $length
     * @return bool
     */
    public function passwordLength(string $password, int $length)
    {
        return (strlen(utf8_decode($password)) > $length) ? true : false;
    }
}