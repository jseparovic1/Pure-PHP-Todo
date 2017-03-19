<?php

namespace Viper;
/**
 * View class
 */
class View
{
    /**
     * Render view with header and footer
     *
     * @param $view view name
     * @param array $arguments
     */
    public function render($view , $arguments = [])
    {
        $viewPath = '../views/'. $view. '.view.php';
        if (file_exists($viewPath)) {

            //extract arguments , ["title" => "Login"] becomes accesible via $title
            extract($arguments);

            require '../views/templates/header.php';
            require $viewPath;
            require '../views/templates/footer.php';


        } else {
            echo "view doesn't exist !!";
        }
    }

    /**
     * Render only view
     *
     * @param $view view name
     * @param array $arguments
     */
    public function renderTemlpate($view , $arguments = [])
    {
        $viewPath = '../views/templates/'. $view. '.php';
        if (file_exists($viewPath)) {

            //extract arguments , ["title" => "Login"] becomes accesible via $title
            extract($arguments);

            require $viewPath;

        } else {
            echo "view doesn't exist !!";
        }
    }
}