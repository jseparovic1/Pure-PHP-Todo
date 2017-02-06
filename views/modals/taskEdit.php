<!-- edit modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="New task">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Eddit task</h4>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label>Task name</label>
                        <input type="text" class="form-control" required id="task-name">
                    </div>
                    <div class="form-group">
                        <label >Deadline</label>
                        <input type="date" class="form-control" required id="task-date">
                    </div>
                    <div class="form-group">
                        <label>Priority</label>
                        <select id="priority">
                            <option value="3">HIGH</option>
                            <option value="2">MEDIUM</option>
                            <option value="1">LOW</option>
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary editSubmit">Submit changes</button>
            </div>
            </form>
        </div>
    </div>
</div>