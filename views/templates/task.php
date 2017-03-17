<?php  foreach ($tasks as $task) :?>
<tr class="task-row">
    <td id="task-name"><?= $task->getTaskName() ?> </td>
    <td id="task-deadline"><?= $task->getTaskDeadlineStr() ?> </td>
    <td id="task-priority"><?= $task->getTaskPriorityStr() ?> </td>
    <td id="task-status"><?= $task->getTaskStatusStr() ?></td>
    <td id="task-deadline-hidden" class="hidden"><?= $task->getTaskDeadline() ?> </td>
    <td id="task-priority-hidden" class="hidden"><?= $task->getTaskPriority() ?> </td>
    <td id="task-status-hidden" class="hidden"><?= $task->getTaskStatus() ?></td>
    <td>
        <div class="options">
            <button id="task-edit" onclick=taskEdit(<?= $task->getTaskId() ?>,this) style="color:#000bad;">
                <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
            </button>
            <button id="task-finish"  onclick="taskFinish(<?= $task->getTaskId()?>)"  style="color:#00ad2e;">
                <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
            </button>
            <button id="task-delete" onclick="taskDelete(<?= $task->getTaskId()?>)" style="color:#ff0022;">
                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
            </button>
        </div>
    </td>
</tr>
<?php  endforeach;?>

