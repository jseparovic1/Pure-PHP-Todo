<?php
namespace App\Models;

use Viper\{Model,Validate,Hash};
use \PDO;

class RegistrationModel extends Model
{
    private $errors = [];

    public  function getErrors()
    {
        return $this->errors;
    }

    public function register($email,$password,$firstName,$lasName,$code)
    {
        $v = new Validate();
        //validate email
        if (!$v->email($email)) {
            $this->errors[] = 'Invalid email!';
            return false;
        }

        //validate password
        if (!$v->passwordLength($password,3)) {
            $this->errors[] = 'Password must be at least 3 characters';
            return false;
        }

        //find user with matching email
        $isUserFound = $this->findUserByEmail($email);

        //check if user found
        if ($isUserFound) {
            $this->errors[] = 'Email already in use !';
            return false;
        }

        $user = new User();
        $user->setFirstName($firstName);
        $user->setLastName($lasName);
        $user->setUserEmail($email);
        $user->setActivationCode($code);
        $user->setUserPassword(Hash::password($password));
        $user->save();

        return true;
    }
    private function findUserByEmail($email)
    {
        $statment = $this->db->prepare("SELECT * FROM user WHERE user_email=:email");
        $statment->bindParam(':email' , $email, PDO::PARAM_STR);
        $statment->setFetchMode(PDO::FETCH_CLASS, 'User');
        $statment->execute();

        return $statment->fetch();
    }
}