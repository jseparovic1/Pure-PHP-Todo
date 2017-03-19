<?php
namespace Viper;

use Viper\Database\Connection;

/**
 * Base model class
 */
abstract class Model
{
    /**
     * Instance of db connection
     * @var \PDO
     */
    protected $db;

    public function __construct()
    {
        $config = require '../config.php';
        $this->db = Connection::make($config['database']);
    }
}