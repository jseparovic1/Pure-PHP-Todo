<?php

require '../core/bootstrap.php';

use Viper\{Router,Request};

Router::load('../app/routes.php')->direct(Request::uri(),Request::method());