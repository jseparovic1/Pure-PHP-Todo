<?php
namespace Viper;

/*
 * Data validation
 */

class Validate
{
    public function email(string $email) : bool
    {
        if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
            return false;
        } else {
            return true;
        }
    }

    public function password(string $password)
    {
        if(strlen(utf8_decode($password)) < 5) {
           return false;
        } else {
            return true;
        }
    }
}