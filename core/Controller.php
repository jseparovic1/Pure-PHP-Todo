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

        //if user is not on register or activation page and isn't logged in return to home
        if (Request::uri()!== '' && Request::uri()!=='register' && Request::uri()!=='activate') {
            if (!isset($_SESSION['logged_in'])) {
                Redirect::to('/');
            }
        }

        $config = require '../config.php';
        $this->db = new QueryBuilder(Connection::make($config['database']));
        $this->view = new View();
    }

    /**
     * Creates an instance of model
     * @param $modelName
     * @return model instance of model class
     */
    public function getModel(string $modelName)
    {
        $model = "App\\Models\\{$modelName}";
        return $model = new $model();
    }
}