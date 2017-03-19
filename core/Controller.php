<?php
namespace Viper;

use Viper\Database\{QueryBuilder,Connection};

/**
 * Base controler
 */
abstract class Controller
{
    protected $view;
    protected $db;

    /**
     * Controller constructor.
     */
    public function __construct()
    {
        //initialize session
        if (session_id() !== null) {
            session_start();
        }

        if (Request::uri()!== '' && Request::uri()!=='register' && Request::uri()!=='activate') {
            if (!isset($_SESSION['logged_in'])) {
                Redirect::to('/');
            }
        }

        $config = require '../config.php';
        //query builder
        $this->db = new QueryBuilder(Connection::make($config['database']));
        //views
        $this->view = new View();
    }

    /**
     * Creates an instance of model
     * @param $name
     * @return mixed
     */
    public function getModel($name)
    {
        $model = "App\\Models\\{$name}";
        return $model = new $model();
    }

//    /**
//     * Requires model
//     *
//     * @param $name
//     * @return mixed
//     */
//    public function requireModel($name)
//    {
//        return require '../Models/' . $name . '.php';
//    }
}