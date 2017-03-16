<?php  foreach ($tasks as $task) :?>
<tr <?php if ($task->isLate()) echo 'class="bg-danger"'; ?> >
    <td id="task-name"><?= $task->getTaskName() ?> </td>
    <td id="task-deadline"><?= $task->getTaskDeadline() ?> </td>
    <td id="task-priority"><?= $task->getTaskPriority() ?> </td>
    <td id="task-status"><?= $task->getTaskStatus() ?></td>
    <td>
        <div class="options">
            <button id="task-edit" onclick="taskEdit(<?= $task->getTaskId()?>)" style="color:#000bad;">
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

