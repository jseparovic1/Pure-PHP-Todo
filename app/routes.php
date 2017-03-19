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
$router->post('todos/sort','TodoListController@sortAction');
$router->post('todos/delete','TodoListController@deleteAction');

//logout
$router->get('logout','LogOutController@indexAction');

//get tasks
$router->get('tasks','TodoTaskController@index');
//new task
$router->post('tasks','TodoTaskController@store');

//task controls
$router->post('task/delete','TodoTaskController@delete');
$router->post('task/finish','TodoTaskController@finish');
$router->post('task/edit','TodoTaskController@edit');
$router->post('task/sort','TodoTaskController@sort');


