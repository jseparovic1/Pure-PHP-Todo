<?php

/**
 * Todos page controller
 */

class TodoListController extends Controller
{
    public function indexAction()
    {
        $this->requireModel('TodoList');
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
        var_dump($path);
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

        $listModel = $this->requireModel('TodoList');
        $lists = $this->db->select('list',['user_id' => (int)$_SESSION['user_id']], 'TodoList');

        //get post data
       return $this->view->renderTemlpate('list' , ['lists' => $lists , 'actionMessage' => 'List deleted!']);
    }

    public function sortAction()
    {
        //if request is empty
        if (!Request::post('order')) {
            return $this->indexAction();
        }

        switch (Request::post('order'))
        {
            case 'ASC':
                $this->requireModel('TodoList');
                $lists = $this->db->selectSorted('list',['user_id' => (int)$_SESSION['user_id']], 'TodoList','list_name','ASC');
                break;
            case 'DESC':
                $this->requireModel('TodoList');
                $lists = $this->db->selectSorted('list',['user_id' => (int)$_SESSION['user_id']], 'TodoList','list_name','DESC');
                break;
        }

        //get post data
        return $this->view->renderTemlpate('list' , ['lists' => $lists , 'actionMessage' => 'List sorted !']);
    }
}