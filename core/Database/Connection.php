<?php
namespace Viper\Database;

use PDO;
use PDOException;

/**
 * Database class
 */
class Connection
{
    /**
     * Creates connection to database
     * @param  array $config
     * @return PDO instace of pdo class
     */
    public static function make($config)
    {
        try {
            return $pdo = new PDO (
                $config['connection'].';dbname='.$config['name'],
                $config['username'],
                $config['password'],
                $config['options']
            );
        } catch (PDOException $e) {
            $e->getMessage();
            die("Couldn't connect to database");
        }
    }
}