<?php

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