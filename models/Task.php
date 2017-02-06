<?php

/**
 * Task model
 */
class Task extends Model
{
    private $task_id;
    private $task_name;
    private $task_priority;
    private $list_id;
    private $task_deadline;
    private $task_status;
    private $task_passed;

    public function isLate()
    {
        return (($this->task_status === 'unfinished') && ($this->task_passed === true)) ? true : false;
    }

    public function getTaskId()
    {
        return $this->task_id;
    }

    public function setTaskId($task_id)
    {
        $this->task_id = $task_id;
    }

    public function getTaskName()
    {
        return $this->task_name;
    }

    public function setTaskName($task_name)
    {
        $this->task_name = $task_name;
    }

    public function getTaskPriority()
    {
        return $this->task_priority;
    }

    public function setTaskPriority($task_priority)
    {
        $this->task_priority = $task_priority;
    }

    public function getTaskStatus()
    {
        return $this->task_status;
    }

    public function setTaskStatus($task_status)
    {
        $this->task_status = $task_status;
    }

    public function getTaskDeadline()
    {
        return $this->task_deadline;
    }

    public function setTaskDeadline($task_deadline)
    {
        $this->task_deadline = $task_deadline;
    }

    public function setListId($list_id)
    {
        $this->list_id = $list_id;
    }


    /**
     * Coverts deadline to days,months,years left or ago
     */
    public function deadLineToStr()
    {
        $deadline = new DateTime($this->task_deadline);
        $now = new DateTime('NOW');
        $diff = $deadline->diff($now);

        $str = '';
        if ($diff->d !== 0) {
            $str.= $diff->d;
            $str.= ($diff->d > 1) ? ' days ' : ' day ';
        }
        if ($diff->m !== 0) {
            $str.= $diff->m;
            $str.= ($diff->m > 1) ? ' months ' : ' month ';
        }
        if ($diff->y !== 0) {
            $str.= $diff->y;
            $str.= ($diff->y > 1) ? ' years ' : ' year ';
        }

        if ($deadline < $now) {
            $str .= ' ago';
            $this->task_passed = true;
        }

        $this->task_deadline = $str;
    }
    public function priorityToStr()
    {
        switch ($this->task_priority) {
            case 1:
                $this->task_priority = "LOW";
                break;
            case 2:
                $this->task_priority = "MEDIUM";
                break;
            case 3:
                $this->task_priority = "HIGH";
                break;
            default:
                break;
        }
    }
    public function statusToStr()
    {
        switch ($this->task_status) {
            case 0:
                $this->task_status = "unfinished";
                break;
            case 1:
                $this->task_status = "finished";
                break;
            default:
                break;
        }
    }
    public function covertDeadlinePriorityAndStatusToStr()
    {
        $this->deadLineToStr();
        $this->statusToStr();
        $this->priorityToStr();
    }
    public function save()
    {
        //prepare query for excaping sql injection
        $statment = $this->db->prepare(
            "INSERT INTO task (list_id,task_name,task_deadline,task_priority)  
             VALUES (:listId,:taskName,:deadline,:priority)"
        );
        $statment->bindParam(':listId'	,$this->list_id,PDO::PARAM_INT);
        $statment->bindParam(':taskName',$this->task_name,PDO::PARAM_STR);
        $statment->bindParam(':deadline',$this->task_deadline);
        $statment->bindParam(':priority',$this->task_priority,PDO::PARAM_INT);

        $statment->execute();
    }
}