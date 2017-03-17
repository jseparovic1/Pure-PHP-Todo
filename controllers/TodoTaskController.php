<?php

/**
 * Manage tasks
 */
class TodoTaskController extends Controller
{
    public function indexAction()
    {
        //user submitted list id
        $listId = Request::get('id');
        if (empty($listId)) {
            return Redirect::to('todos');
        }

        $listModel = $this->getModel('TodoList');
        $list = $listModel->selectById($listId,(int)$_SESSION['user_id']);
        if (empty($list)) {
            return Redirect::to('todos');
        }

        $list->countTask();

        $this->requireModel('Task');
        $tasks = $this->db->select('task',['list_id' => $list->getListId()],'Task');
        foreach ($tasks as $task) {
            $task->covertDeadlinePriorityAndStatusToStr();
        }

        return $this->view->render('tasks', ['title' => 'Tasks', 'list' => $list, 'tasks' => $tasks]);
    }
    public function insertAction()
    {
        $task = $this->getModel('Task');

        $task->setTaskName(Request::post('taskName'));
        $task->setTaskDeadline(Request::post('deadline'));
        $task->setTaskPriority(Request::post('priority'));
        $task->setListId(Request::post('listId'));

        $task->save();

        $tasks = $this->db->select('task',['list_id' => Request::post('listId')],'Task');

        foreach ($tasks as $task) {
            $task->covertDeadlinePriorityAndStatusToStr();
        }
        return $this->view->renderTemlpate('task' , ['tasks' => $tasks]);
    }

    public function deleteAction ()
    {
        $this->db->delete(
            'task',
            [
                "task_id" => Request::post('taskId') ,
                "list_id" =>  Request::post('listId')
            ],
            'AND'
        );
    }
    public function finishAction ()
    {
        var_dump($_POST);
    }
    public function editAction ()
    {
        var_dump($_POST);
    }
}