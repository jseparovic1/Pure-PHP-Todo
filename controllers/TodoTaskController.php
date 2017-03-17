<?php

/**
 * Manage tasks
 */
class TodoTaskController extends Controller
{
    public function index()
    {
        //user submitted list id
        $listId = Request::get('listId');
        if (empty($listId)) {
            return Redirect::to('todos');
        }

        $listModel = $this->requireModel('TodoList');
        $list = $this->db->select('list',['list_id' => $listId, "user_id" => (int)$_SESSION['user_id']],'TodoList','AND');

        if (empty($list)) {
            return Redirect::to('todos');
        }

        $list[0]->countTask();

        $this->requireModel('Task');
        $tasks = $this->db->select('task',['list_id' => $list[0]->getListId()],'Task');

        return $this->view->render('tasks', ['title' => 'Tasks', 'list' => $list[0], 'tasks' => $tasks]);
    }

    public function store()
    {
        $task = $this->getModel('Task');

        $task->setTaskName(Request::post('taskName'));
        $task->setTaskDeadline(Request::post('deadline'));
        $task->setTaskPriority(Request::post('priority'));
        $task->setListId(Request::post('listId'));

        $task->save();

        $tasks = $this->db->select('task',['list_id' => Request::post('listId')],'Task');

        return $this->view->renderTemlpate('task' , ['tasks' => $tasks]);
    }

    public function delete ()
    {
        $this->db->delete(
            'task',
            [
                "task_id" => Request::post('taskId') ,
                "list_id" =>  Request::post('listId')
            ],
            'AND'
        );

        $this->showTasks(Request::post('listId'));
    }

    public function finish ()
    {
        $setParams = [
          "task_status" => 1
        ];
        $whereParams = [
            "task_id" => Request::post('taskId')
        ];
        $this->db->update('task', $setParams, $whereParams);

        $this->showTasks(Request::post('listId'));
    }

    public function edit ()
    {
        $setParams = [
            "task_name" => Request::post('taskName'),
            "task_deadline" => Request::post('deadline'),
            "task_priority" => Request::post('priority')
        ];
        $whereParams = [
            "task_id" => Request::post('taskId')
        ];

        $this->db->update('task', $setParams, $whereParams);

        $this->showTasks(Request::post('listId'));
    }

    protected function showTasks(int $listId,string $orderColumn = 'task_deadline',string $order = 'ASC')
    {
        $task = $this->requireModel('Task');
        $tasks = $this->db->selectSorted('task',['list_id' =>$listId],'Task', $orderColumn, $order);

        return $this->view->renderTemlpate('task' , ['tasks' => $tasks]);
    }
}