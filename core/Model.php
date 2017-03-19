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
        $this->db = App::get('database');
    }
}