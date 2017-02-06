<?php

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

        //$mail = new PHPmailer();
        //$mail->send();

        return $this->view->render('auth/registerMessage',
            [
                'title' => 'Registration finished',
                'message' => "Registration succesful.</br>
                 Please click on the confirmation link in the email to activate your account."
            ]);
    }


    public function activateAction()
    {
        //see $_GET['email'] , $_GET['code']

        //check if given code is valid for specified user

        //if it is god set user status to activ
        echo "activate account";
    }
}