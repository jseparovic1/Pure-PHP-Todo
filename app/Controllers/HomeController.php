<?php
namespace App\Controllers;

use Viper\{Controller,Request,Redirect};


/**
 * Home page controller
 */

class HomeController extends Controller
{
    public function indexAction()
    {
        if (isset($_SESSION['logged_in'])) {
            return Redirect::to('todos');
        }
        return $this->view->render('auth/login', ['title' => 'Login']);
    }

    public function signAction()
    {
        //get post values , if values are not set Request returns null
        $email = Request::post('email');
        $password = Request::post('password');

        $loginModel = $this->getModel('LoginModel');
        if(!($loginModel->logIn($email, $password))) {
           return $this->view->render('auth/login',['title' => 'Login' ,'errorMessage' => $loginModel->getError() ,'email' => $email]);
        }

        Redirect::to('todos');
    }
}