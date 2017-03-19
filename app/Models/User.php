<?php
namespace App\Models;

use Viper\Model;
use \PDO;

class User extends Model
{
    /**
     * @var user id
     */
    private $user_id;

    /**
     * @var password hash
     */
    private $user_password;

    /**
     * @var user email
     */
    private $user_email;

    /**
     * @var users first name
     */
    private $first_name;

    /**
     * @var users last name
     */
    private $last_name;

    /**
     * @var account activation status , 1 if activated
     */
    private $status;

    /**
     * @var account activation code
     */
    private $activation_code;

    /**
     * @return password
     */
    public function getPasswordHash()
    {
        return $this->user_password;
    }

    /**
     * @param password $user_password
     */
    public function setUserPassword($user_password)
    {
        $this->user_password = $user_password;
    }


    /**
     * @return User
     */
    public function getUserId()
    {
        return $this->user_id;
    }


    /**
     * @return User email
     */
    public function getUserEmail()
    {
        return $this->user_email;
    }

    /**
     * @param $email user_email
     */
    public function setUserEmail($email)
    {
        $this->user_email = $email;
    }

    /**
     * @return users
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * @param users $first_name
     */
    public function setFirstName($first_name)
    {
        $this->first_name = $first_name;
    }

    /**
     * @return users
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    /**
     * @param users $last_name
     */
    public function setLastName($last_name)
    {
        $this->last_name = $last_name;
    }

    /**
     * @return account
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param account $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return account
     */
    public function getActivationCode()
    {
        return $this->activation_code;
    }

    /**
     * @param account $activation_code
     */
    public function setActivationCode($activation_code)
    {
        $this->activation_code = $activation_code;
    }

    /**
     * Insert all user data into database
     */
    public function save()
    {
        //prepare query for excaping sql injection
        $statment = $this->db->prepare(
            "INSERT INTO user (user_email,user_password,first_name,last_name,activation_code)  
             VALUES (:user_email,:user_password,:first_name,:last_name,:activation_code)"
        );
        $statment->bindParam(':user_email'	,$this->user_email,PDO::PARAM_STR);
        $statment->bindParam(':user_password',$this->user_password,PDO::PARAM_STR);
        $statment->bindParam(':first_name',$this->first_name,PDO::PARAM_STR);
        $statment->bindParam(':last_name',$this->last_name,PDO::PARAM_STR);
        $statment->bindParam(':activation_code',$this->activation_code,PDO::PARAM_STR);

        $statment->execute();
    }
    public function updateStatus()
    {
        //prepare query for excaping sql injection
        $statment = $this->db->prepare("UPDATE user SET status =:status WHERE user_email =:user_email");
        $statment->bindParam(':user_email'	,$this->user_email,PDO::PARAM_STR);
        $statment->bindParam(':status',$this->status,PDO::PARAM_STR);

        $statment->execute();
    }
}