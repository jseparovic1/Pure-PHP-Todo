<?php
namespace App\Controllers;

use App\Email;
use Viper\{Controller,Request,Hash};

/**
 * Registration controller
 */
class RegistrationController extends Controller
{
    public function indexAction()
    {
        return $this->view->render('auth/register', ['title' => 'Registration']);
    }

    public function registerAction()
    {
        //validate user input
        $registrationModel = $this->getModel('RegistrationModel');

        $activationCode = Hash::getActivationCode();

        $registration = $registrationModel->register(
            Request::post('email'),
            Request::post('password'),
            Request::post('firstName'),
            Request::post('lastName'),
            $activationCode
        );

        if (!$registration){
            return $this->view->render('auth/register',
                [
                    'title' => 'Registration',
                    'errorMessage' => $registrationModel->getErrors()
                ]);
        }

        //send email to user
        $config = require '../config.php';
        $mail = new Email($config["email"]);
        $status = $mail->sendActivationCode(Request::post('email'),$activationCode);

        //check if email is send
        if($status) {
            return $this->view->render('auth/message',
                [
                    'title' => 'Registration finished',
                    'message' => "Registration succesful.</br>
                 Please click on the confirmation link in the email to activate your account."
                ]);
        }
        return $this->view->render('auth/message',
            [
                'title' => 'Registration failed',
                'messageError' => "Registration failed , ABORT</br>"
            ]);
    }

    public function activateAction()
    {
        $code = Request::get('c');
        $email = Request::get('e');

        $user = $this->db->select('user', ['user_email' => $email], 'User')[0];

        //user is already activated
        if ($user->getStatus() === '1')
            return $this->view->render('auth/message', ['messageError' => 'Account already activated !']);

        //activate user
        if (!empty($user) && ($user->getActivationCode() === $code)) {
            $user->setStatus(1);
            $user->updateStatus();
            return $this->view->render('auth/message', ['message' => 'Activation succesful !']);
        }

        return $this->view->render('auth/message', ['messageError' => 'Activation unsuccessful !']);
    }
}