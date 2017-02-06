<?php if (isset($actionMessage)) : ?>
    <div class="alert alert-success" role="alert"><?= $actionMessage ?></div>
<?php endif ?>
<?php foreach ($lists as $list) : ?>
<div class="col-md-6 col-lg-4">
    <div class="inner">
        <div class="title">
            <div class="h4">
                <a class="list-link" href="/list?id=<?= $list->getListId(); ?>"> <?= $list->getListName(); ?> </a>
                <a class="icon" ">
                <button class="icon-button" id="deleteList" data-listId="<?= $list->getListId(); ?>">
                    <span class="glyphicon glyphicon-remove"></span>
                </button>
                </a>
            </div>
        </div>
        <div class="info">
            <table class="table table-hover table-responsive borderless">
                <tbody>
                <tr>
                    <td>
                        <div class="h5">CREATED : </div>
                    </td>
                    <td>
                        <span class="text-successs h5"><?= $list->getCreated(); ?></span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="h5">FINISHED : </div>
                    </td>
                    <td>
                        <span class="text-success h5"><?= $list->getTasksFinished(); ?></span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="h5">UNFINISHED : </div>
                    </td>
                    <td>
                        <span class="text-danger h5"><?= $list->getTasksUnfinished(); ?></span>
                    </td>
                </tr>
                </tbody>
            </table>
            <div class="bar">
                <div class="h5">Progress</div>
                <div class="progress">
                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40"
                         aria-valuemin="0" aria-valuemax="100" style="width:<?= $list->getProgress(); ?>%">
                        <span > <?= $list->getProgress(); ?>% </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php   endforeach; ?>