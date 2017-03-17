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
     * @param $join AND OR ...
     * @return array
     */
    public function select($table, $parameters, $className = [], $join = '')
    {
        //get all columns
        $columns = array_keys($parameters);
        //create placeholders for every param
        $placeHolders = array_map(function($param) {
            return ":". $param;
        },$columns);

        //create query condition
        $condition = $this->makeCondition($columns, $placeHolders, $join);

        $query = sprintf('SELECT * FROM %s WHERE %s;',
            $table,
            $condition
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

    /**
     * delete data from table
     *
     * @param $table
     * @param $parameters
     * @param string $join
     * @throws Exception
     */
    public function delete($table, $parameters, $join = '')
    {
        if ($join === '' and count($parameters) > 1 ) {
            throw new Exception('Join parameter not specified !');
        }
        //get all columns
        $columns = array_keys($parameters);

        //create placeholders for every param
        $placeHolder = array_map(function($param) {
            return ":". $param;
        },$columns);

        //create query condition
        $condition = $this->makeCondition($columns, $placeHolder, $join);

        $query = sprintf('DELETE FROM %s WHERE %s;',
            $table,
            $condition
        );

        $statment = $this->pdo->prepare($query);

        try {
            $statment->execute($parameters);
        } catch (PDOexception $e) {
            die("Something went wrong!");
        }
    }

    /**
     * delete data from table
     *
     * @param $table
     * @param $parameters
     * @param string $join
     * @throws Exception
     */
    public function update($table, $setParams, $whereParams, $join = '')
    {
        $setRules = '';

        //get all column names to be updated
        $setColumns = array_keys($setParams);

        //create placeholders for every param
        $setPlaceholder = array_map(function($param) {
            return ":". $param;
        },$setColumns);

        for ($i = 0; $i < count($setColumns); $i++) {
            $setRules .= sprintf('%s = %s,',
                $setColumns[$i],
                $setPlaceholder[$i]
            );
        }
        $setRules = trim($setRules,",");

        //get all columns for condition
        $columnsParams = array_keys($whereParams);

        //create placeholders for every param
        $conditionPlaceholder = array_map(function($param) {
            return ":". $param;
        },$columnsParams);

        //create query condition
        $condition = $this->makeCondition($columnsParams, $conditionPlaceholder, $join);

        $query = sprintf('UPDATE %s SET %s WHERE %s;',
            $table,
            $setRules,
            $condition
        );

        $statment = $this->pdo->prepare($query);
        try {
            $statment->execute(array_merge($setParams,$whereParams));
        } catch (PDOexception $e) {
            die("Something went wrong!");
        }
    }


    private function makeCondition($columns, $placeholders, $join)
    {
        //create query condition
        $condition = '';
        $length = count($columns);
        if ($length === 1) {
            return $condition .= $columns[0] ." = ". $placeholders[0];
        }

        for ($i = 0; $i < $length ; $i++) {
            if ($i === $length-1) {
                $condition .=  sprintf('%s = %s ',
                    $columns[$i],
                    $placeholders[$i]
                );
            } else {
                $condition .=  sprintf('%s = %s %s ',
                    $columns[$i],
                    $placeholders[$i],
                    $join
                );
            }
        }
        return $condition;
    }
}