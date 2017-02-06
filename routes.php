<?php

/**
 * Register application routes
 */

//Home page
$router->get('','HomeController@indexAction');
$router->post('','HomeController@signAction');

//register page
$router->get('register','RegistrationController@indexAction');
$router->post('register','RegistrationController@registerAction');

//activation
$router->get('activate','RegistrationController@activateAction');

//toodo lists page
$router->get('todos','TodoListController@indexAction');
$router->post('todos','TodoListController@createAction');
$router->post('sort','TodoListController@sortAction');
$router->post('delete','TodoListController@deleteAction');

//logout
$router->get('logout','LogOutController@indexAction');

//list tasks page
$router->get('list','TodoTaskController@indexAction');

//task controls
$router->post('task/insert','TodoTaskController@insertAction');
$router->post('task/delete','TodoTaskController@deleteAction');
$router->post('task/finish','TodoTaskController@finishAction');
$router->post('task/edit','TodoTaskController@editAction');

