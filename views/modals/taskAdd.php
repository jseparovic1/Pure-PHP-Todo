<!--Add new task  Modal  -->
<div class="modal fade" id="taskModal" tabindex="-1" role="dialog" aria-labelledby="New task">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Create new task</h4>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label >Task name</label>
                        <input type="text" class="form-control" required id="task-modal-name" placeholder="Enter task name">
                    </div>
                    <div class="form-group">
                        <label >Deadline</label>
                        <input type="date" class="form-control" required id="task-modal-date">
                        <input type="text" id="list-modal-id" hidden value="<?= $list->getListId() ?>">
                    </div>
                    <div class="form-group">
                        <label>Priority</label>
                        <select id="task-modal-priority">
                            <option value="3">HIGH</option>
                            <option value="2">MEDIUM</option>
                            <option value="1">LOW</option>
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="addTask()">Add</button>
            </div>
            </form>
        </div>
    </div>
</div>