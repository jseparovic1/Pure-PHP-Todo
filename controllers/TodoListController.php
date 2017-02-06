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

        foreach ($lists as $list) {
            $list->countTask();
            $list->countUnfinishedTasks();
            $list->countFinishedTasks();
            $list->countProgress();
        }
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
        $path = "/list?id=".(int)$newList[0]->list_id;
        Redirect::to($path);
    }

    public function deleteAction()
    {
        //if request is empty
        if (!Request::post('list_id')) {
            return false;
        }
        $listModel = $this->getModel('TodoList');

        $deleted = $listModel->delete(Request::post('list_id') , (int)$_SESSION['user_id']);
        if ($deleted === '0') {
            return false;
        }

        $lists = $this->db->select('list',['user_id' => (int)$_SESSION['user_id']], 'TodoList');

        foreach ($lists as $list) {
            $list->countTask();
            $list->countUnfinishedTasks();
            $list->countFinishedTasks();
            $list->countProgress();
        }

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

        foreach ($lists as $list) {
            $list->countTask();
            $list->countUnfinishedTasks();
            $list->countFinishedTasks();
            $list->countProgress();
        }

        //get post data
        return $this->view->renderTemlpate('list' , ['lists' => $lists , 'actionMessage' => 'List sorted !']);
    }
}