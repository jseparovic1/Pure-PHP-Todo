<?php
namespace App\Controllers;

use Viper\{Controller,Redirect};

/**
 * Logs user out
 */
class LogOutController extends Controller
{
    public function indexAction()
    {
        session_destroy();
        Redirect::to('/');
    }
}