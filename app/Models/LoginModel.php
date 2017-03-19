<?php
namespace App\Models;

use Viper\{Model,Hash};
use \PDO;
use \DateTime;

/**
 * Authentificaton class
 */
class LoginModel extends Model
{
    private $error;

    public  function getError()
    {
        return $this->error;
    }
    public function logIn(string $email, string $password)
    {
        //check if all fields are set
        if (empty($email) || empty($password)) {
            $this->error = 'Please enter all fields !';
            return false;
        }

        //find user with matching email and password
        $user = $this->findUserByEmail($email);

        //check if email not found
        if (!$user) {
            //email is not registered but we wouldn't tell that user
            $this->error = 'Wrong email or password !';
            return false;
        }

        if (!Hash::verifyPassword($password,$user->getPasswordHash())) {
            //password is wrong
            $this->error = 'Wrong email or password !';
            return false;
        }

        if ($user->getStatus() === '0') {
            //user not activated
             $this->error = 'Account not activated yet ! , please check your email!';
             return false;
        }

        //create new DateTime object with current time
        $time = new DateTime('NOW');
        //format it as string
        $now = $time->format('Y-m-d H::i::s');

        //set session variables
        $this->setSessionForLoggedUser($user);

        //update last login status
        $this->updateLastLoginInfo($user->getUserId(),$now);

        return true;
    }

    private function findUserByEmail(string $email)
    {
        $statment = $this->db->prepare("SELECT * FROM user WHERE user_email=:email");
        $statment->bindParam(':email' , $email, PDO::PARAM_STR);
        $statment->setFetchMode(PDO::FETCH_CLASS, 'App\Models\User');
        $statment->execute();

        return $statment->fetch();
    }

    private function updateLastLoginInfo($user_id, $last_login)
    {
        $sql = "UPDATE user SET last_login = ? WHERE user_id = ? ";
        $this->db->prepare($sql)->execute([$last_login , $user_id]);
    }
    private function setSessionForLoggedUser($user)
    {
        $_SESSION['logged_in'] = true;
        $_SESSION['user_id'] = $user->getUserId();
        $_SESSION['name'] = $user->getFirstName() . " " . $user->getLastName();
    }
}