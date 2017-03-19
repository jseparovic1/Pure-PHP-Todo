<?php
/**
 * Created by Jurica Separovic.
 *
 * Including all core elements of the app
 *
 * Date: 2.2.2017.
 */

use Viper\App;
use Viper\Database\Connection;
use Viper\Database\QueryBuilder;

require '../vendor/autoload.php';

$config = require '../config.php';

App::register('config', $config);
App::register('database', Connection::make(App::get('config')['database']));
App::register('qbuilder', new QueryBuilder(Connection::make(App::get('config')['database'])));
