<?php

/**
 * Task model
 */
class Task extends Model
{
    private $task_id;
    private $task_name;
    private $task_priority;
    private $task_priority_str;
    private $list_id;
    private $task_deadline;
    private $task_deadline_str;
    private $task_status = 0;
    private $task_status_str;
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
        $this->priorityToStr();
        return $this->task_priority_str;
    }

    public function setTaskPriority($task_priority)
    {
        $this->task_priority = $task_priority;
    }

    public function getTaskStatus()
    {
        $this->statusToStr();
        return $this->task_status_str;
    }

    public function setTaskStatus($task_status)
    {
        $this->task_status = $task_status;
    }

    public function getTaskDeadline()
    {
        $this->deadLineToStr();
        return $this->task_deadline_str;
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
        $now = new DateTime();
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

        if ($diff->days === 0 && $diff->m === 0 && $diff->y ===0) {
            $str.= 'TODAY';
        } else if ($deadline < $now) {
            $str .= ' ago';
            $this->task_passed = true;
        }

        $this->task_deadline_str = $str;
    }

    public function priorityToStr()
    {
        switch ($this->task_priority) {
            case 1:
                $this->task_priority_str = "LOW";
                break;
            case 2:
                $this->task_priority_str = "MEDIUM";
                break;
            case 3:
                $this->task_priority_str = "HIGH";
                break;
            default:
                break;
        }
    }

    public function statusToStr()
    {
        switch ($this->task_status) {
            case 0:
                $this->task_status_str = "unfinished";
                break;
            case 1:
                $this->task_status_str = "finished";
                break;
            default:
                break;
        }
    }

    public function save()
    {
        //prepare query for excaping sql injection
        $statment = $this->db->prepare(
            "INSERT INTO task (list_id,task_name,task_deadline,task_priority,task_status)  
             VALUES (:listId,:taskName,:deadline,:priority,:status)"
        );
        $statment->bindParam(':listId'	,$this->list_id,PDO::PARAM_INT);
        $statment->bindParam(':taskName',$this->task_name,PDO::PARAM_STR);
        $statment->bindParam(':deadline',$this->task_deadline);
        $statment->bindParam(':priority',$this->task_priority,PDO::PARAM_INT);
        $statment->bindParam(':status',$this->task_status,PDO::PARAM_INT);

        $statment->execute();
    }
}