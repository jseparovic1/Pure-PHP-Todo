<?php
/**
 * Builds query for database
 */
class QueryBuilder
{
    /**
     * Instance of PDO
     * @var PDO
     */
    protected $pdo;
    /**
     * @param PDO $pdo
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * select data from table
     *
     * @param $table
     * @param $parameters
     * @param $className
     * @return array
     */
    public function select($table, $parameters, $className = [])
    {
        //get all columns
        $column = array_keys($parameters);
        //create placeholders for every param
        $placeHolder = array_map(function($param) {
            return ":". $param;
        },$column);
        //create query

        $query = sprintf('SELECT * FROM %s WHERE %s = %s;',
            $table,
            implode(',',$column),
            implode(',',$placeHolder)
        );
        $statment = $this->pdo->prepare($query);

        try {
            $statment->execute($parameters);
        } catch (PDOexception $e) {
            die("Something went wrong!");
        }
        //check if classname is set
        if ($className) {
            return $statment->fetchAll(PDO::FETCH_CLASS,"$className");
        } else {
            return $statment->fetchAll(PDO::FETCH_CLASS);
        }
    }

    /**
     * Select sorted data from table
     * @param $table
     * @param $parameters
     * @param array $className
     * @param $orderColumn
     * @param $orderType
     * @return array
     */
    public function selectSorted($table, $parameters, $className = [], $orderColumn, $orderType)
    {
        //get all columns
        $column = array_keys($parameters);
        //create placeholders for every param
        $placeHolder = array_map(function($param) {
            return ":". $param;
        },$column);
        //create query

        $query = sprintf('SELECT * FROM %s WHERE %s = %s ORDER BY %s %s',
            $table,
            implode(',',$column),
            implode(',',$placeHolder),
            $orderColumn,
            $orderType
        );

        $statment = $this->pdo->prepare($query);

        try {
            $statment->execute($parameters);
        } catch (PDOexception $e) {
            die("Something went wrong!");
        }

        //check if classname is set
        if ($className) {
            return $statment->fetchAll(PDO::FETCH_CLASS,"$className");
        } else {
            return $statment->fetchAll(PDO::FETCH_CLASS);
        }
    }

    /**
     * Insert values into table
     * @param string $table table name
     * @param array $parameters  array ["column" => "value" ...]
     */
    public function insert($table, $parameters)
    {
        //get all columns
        $columns = array_keys($parameters);
        //create placeholders for every param
        $placeHolders = array_map(function($param) {
            return ":". $param;
        },$columns);
        //create query
        $query = sprintf('INSERT INTO %s (%s) values (%s)',
            $table,
            implode(',',$columns),
            implode(',',$placeHolders)
        );
        $statment = $this->pdo->prepare($query);
        try {
            $statment->execute($parameters);
        } catch (PDOexception $e) {
            die("Something went wrong!");
        }
    }
}