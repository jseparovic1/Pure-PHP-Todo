<?php

/**
 * Todoo list
 */
class TodoList extends Model
{
    private $list_name;
    private $list_id;
    private $created;
    private $tasksCount;
    private $tasksFinished;
    private $tasksUnfinished;
    private $progress;

    public function countAll()
    {
        $this->countTask();
        $this->countUnfinishedTasks();
        $this->countFinishedTasks();
        $this->countProgress();
    }

    public function setListName($list_name)
    {
        $this->list_name = $list_name;
    }

    public function getProgress()
    {
        return $this->progress;
    }

    public function getListName()
    {
        return $this->list_name;
    }

    public function getListId()
    {
        return $this->list_id;
    }

    public function getCreated()
    {
        return $this->created;
    }

    public function getTasksCount()
    {
        return $this->tasksCount;
    }

    public function getTasksFinished()
    {
        return $this->tasksFinished;
    }

    public function getTasksUnfinished()
    {
        return $this->tasksUnfinished;
    }

    public function countTask()
    {
        $sql = "SELECT * FROM task WHERE list_id = :list_id";
        $statment = $this->db->prepare($sql);
        $statment->bindParam(':list_id', $this->list_id);
        $statment->execute();
        $this->tasksCount = $statment->rowCount();
    }

    public function countFinishedTasks()
    {
        $sql = "SELECT * FROM task WHERE list_id = :list_id AND task_status = 1";
        $statment = $this->db->prepare($sql);
        $statment->bindParam(':list_id', $this->list_id, PDO::PARAM_INT);
        $statment->execute();
        $this->tasksFinished = $statment->rowCount();
    }

    public function countUnfinishedTasks()
    {
        $sql = "SELECT * FROM task WHERE list_id = :list_id AND task_status = 0";
        $statment = $this->db->prepare($sql);
        $statment->bindParam(':list_id', $this->list_id, PDO::PARAM_INT);
        $statment->execute();
        $this->tasksUnfinished = $statment->rowCount();
    }

    public function countProgress()
    {
        if ($this->tasksCount === 0)
            return $this->progress = 0;
        $this->progress = round(($this->tasksFinished / $this->tasksCount) * 100);
    }

    public function delete($list_id, $user_id)
    {
        $statment = $this->db->prepare("DELETE FROM list WHERE list_id=:list_id AND user_id=:user_id");
        $statment->bindParam(':list_id',$list_id,PDO::PARAM_INT);
        $statment->bindParam(':user_id',$user_id,PDO::PARAM_INT);
        $statment->execute();

        return $statment->rowCount();
    }
}