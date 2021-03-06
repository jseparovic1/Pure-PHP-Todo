<?php
namespace App\Controllers;

use Viper\{Controller,Request,Redirect};

/**
 * Todos page controller
 */

class TodoListController extends Controller
{
    public function indexAction()
    {
        $lists = $this->db->select('list',['user_id' => (int)$_SESSION['user_id']], 'TodoList');

        return $this->view->render('todos', ['title' => 'Todo lists' , 'lists' => $lists]);
    }

    public function createAction()
    {
        if (empty(Request::post('listName'))) {
            return $this->indexAction();
        }

        $listModel = $this->getModel('TodoList');

        //get post data
        $listModel->setListName(Request::post('listName'));

        //insert list
        $this->db->insert('list',['list_name' => $listModel->getListName() ,'user_id' => $_SESSION['user_id']]);

        //select insterted list to se id , hmm what if there is more lists with same name ?
        $newList = $this->db->select('list',['list_name' => $listModel->getListname()]);

        //create path
        $path = "/tasks?listId=".(int)$newList[0]->list_id;

        Redirect::to($path);
    }

    public function deleteAction()
    {
        //if request is empty
        if (!Request::post('list_id')) {
            return false;
        }

        $list_id = Request::post('list_id');
        $user_id = (int)$_SESSION['user_id'];

        $deleted = $this->db->delete('list',["list_id" => $list_id, "user_id" => $user_id],"AND");

        if ($deleted === '0') {
            return false;
        }

        $lists = $this->db->select('list',['user_id' => (int)$_SESSION['user_id']], 'TodoList');

        //get post data
       return $this->view->renderTemlpate('list' , ['lists' => $lists]);
    }

    public function sortAction()
    {
        //if request is empty
        if ((!Request::post('order')) || (!Request::post('name'))) {
            return $this->indexAction();
        }

        $columnSelected = Request::post('name');

        if ($columnSelected === "name")
            $column = 'list_name';
        else
            $column = 'created';

        switch (Request::post('order'))
        {
            case 'ASC':
                $lists = $this->db->selectSorted('list',['user_id' => (int)$_SESSION['user_id']], 'TodoList',$column,'ASC');
                break;
            case 'DESC':
                $lists = $this->db->selectSorted('list',['user_id' => (int)$_SESSION['user_id']], 'TodoList',$column,'DESC');
                break;
            default:
                return false;
        }

        //get post data
        return $this->view->renderTemlpate('list' , ['lists' => $lists]);
    }
}