<?php
    require 'modals/taskEdit.php';
    require 'modals/taskAdd.php';
    require 'modals/taskDelete.php';
    require 'modals/taskFinish.php';
?>
<div class="container">
    <!-- todoo list data -->
    <div class="row">
        <table class="table table-responsive">
            <tbody>
            <tr>
                <th class="col-lg-5 table-field">LIST NAME</th>
                <td id="table-name"><?= $list->getListName(); ?></td>
            </tr>
            <tr>
                <th class="col-lg-5 table-field">CREATED</th>
                <td id="table-created"><?= $list->getCreated(); ?></td>
            </tr>
            <tr>
                <th class="col-lg-5 table-field">TASKS</th>
                <td id="table-tasks"><?= $list->getTasksCount(); ?></td>
            </tr>
        </table>
    </div>
    <button class="btn btn-primary" data-toggle="modal" data-target="#taskModal">New task</button>
</div>
<div class="container">
    <div class="row">
        <div class="table-responsive table-condensed tasks">
            <table class="table col-xs-12">
                <thead>
                <tr>
                    <td width="20%">
                        <h5>Name</h5>
                    </td>
                    <td width="10%">
                        <h5>Deadline in</h5>
                    </td>
                    <td width="10%">
                        <h5>Priority</h5>
                    </td>
                    <td width="10%">
                        <h5>Status</h5>
                    </td>
                    <td width="10%">
                        <h5>Options</h5>
                    </td>
                </tr>
                </thead>
                <tbody id="task-container">
                <?php if ($list->getTasksCount() > 0): ?>
                    <?php require 'templates/task.php' ?>
                <?php else: ?>
                    <tr><td>No task's yet !</td></tr>
                <?php endif ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

