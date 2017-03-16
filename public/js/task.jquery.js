
//inserting task name into database
function addTask(){
    //get user input
    var taskName 	= $('#task-modal-name').val();
    var deadline 	= $('#task-modal-date').val();
    var priority 	= $('#task-modal-priority').find(":selected").attr("value");
    var listId 		= $('#list-modal-id').val();

    //insert only if name is not empty
    if ($.trim(taskName) != '' && $.trim(deadline)){
        //hide modal
        $('#taskModal').modal('hide');

        //send data with ajax post
        $.ajax({
            type: 'POST',
            url: 'task/new',
            data: {taskName: taskName, deadline: deadline, priority: priority, listId: listId}
        })
            .done(function(data) {
                console.log("task insert done");

                //append task data to table
                $('#task-container').empty();
                $('#task-container').append(data);

                //empty entered values in modal
                $('#task-name').val("");
                $('#task-date').val("");
            });
    };
}

//delet task with taskId
function taskDelete(taskId){
    //show confirmation modal
    $('#deleteModal').modal('show');

    //if user clicked confirm button delete task using ajax
    $('.confirmDelete').click(function(event) {

        $('#deleteModal').modal('hide');
        //do ajax request
        $.ajax({
            type: 'POST',
            url: 'task/delete',
            data: {taskId: taskId},
        })
            .done(function(data) {
                //task deleted so update task lsit
                console.log(data);
            });
    });
}

//set status = finished in database for taskId
function taskFinish(taskId){
    //show modal
    $('#finishModal').modal('show');

    //if confirm button is clicked hide and call finish script
    $('.confirmFinish').click(function(event) {
        $('#finishModal').modal('hide');

        //do ajax request
        $.ajax({
            type: 'POST',
            url: 'task/finish',
            data: {taskId: taskId},
        })
            .done(function(data) {
                //load task again
                console.log(data);
            });
    });
}

//set status = finished in database for taskId
function taskEdit(){
    //show modal
    $('#editModal').modal('show');

    //do stuff
}
