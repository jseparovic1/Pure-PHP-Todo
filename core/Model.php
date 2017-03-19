<?php
namespace Viper;

use Viper\Database\Connection;

/**
 * Base model class
 */
abstract class Model
{
    protected $db;

    public function __construct()
    {
        $config = require '../config.php';
        $this->db = Connection::make($config['database']);
    }
}