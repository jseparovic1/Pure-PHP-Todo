/**
 * Controls for task like delete edit and finish
 */

function addTask() {
    var listId 		= document.getElementById("list-modal-id").value;
    var response = '';

    //modal values
    var taskName 	= document.getElementById("task-modal-name").value;
    var deadline 	= document.getElementById("task-modal-date").value;
    var priority 	= document.getElementById("task-modal-priority");
    var prioritySelected = priority.options[priority.selectedIndex].value;

    //chek if all fields are entered
    if (taskName === "" || deadline === "") {
        return alert("Enter all fileds !");
    }

    var data = {
        taskName : taskName,
        deadline : deadline,
        priority : prioritySelected,
        listId : listId
    };

    makeRequest('POST', 'tasks', createParametars(data),"task-container");
    $('#taskModal').modal('hide');
    taskCount("add");
    flashMessage("Task added", "alert-success");
}

function taskEdit(taskId, task) {
    var task = task.parentNode.parentNode.parentNode;
    var editButton = document.getElementById("submit-edit");

    //fetch clicked task data
    var name = task.querySelector("#task-name").innerText;

    //get modal input
    var nameModal = document.getElementById("task-name");

    //populate modal
    nameModal.value = name;

    $('#editModal').modal('show');

    //see if user clicks YES on finish modal then make ajax request
    editButton.onclick = function () {
        var taskName 	= document.getElementById("task-name").value;
        var deadline 	= document.getElementById("task-date").value;
        var priority 	= document.getElementById("priority");
        var listId 		= document.getElementById("list-modal-id").value;

        var prioritySelected = priority.options[priority.selectedIndex].value;

        var data = {
            taskName : taskName,
            deadline : deadline,
            priority : prioritySelected,
            listId   : listId,
            taskId : taskId
        };

        makeRequest('POST','task/edit', createParametars(data), "task-container");
        $('#editModal').modal('hide');
        flashMessage("Task "+ taskName +" edited", "alert-success");
    };
}

function taskFinish(taskId) {
    var listId 		= document.getElementById("list-modal-id").value;
    var finishButton = document.getElementById("submit-finish");

    $('#finishModal').modal('show');

    //data to send
    var data = {
        taskId : taskId,
        listId : listId
    };

    //see if user clicks YES on finish modal then make ajax request
    finishButton.onclick = function () {
        makeRequest('POST','task/finish', createParametars(data), "task-container");
        $('#finishModal').modal('hide');
        flashMessage("Nice man, task finished. Rock on!", "alert-success");
    };
}

function taskDelete(taskId) {

    var deleteButton = document.getElementById("submit-delete");
    var listId 		= document.getElementById("list-modal-id").value;
    $('#deleteModal').modal('show');

    //see if user clicks YES on delete modal then make ajax request
    var data = {
        taskId : taskId,
        listId : listId
    };

    deleteButton.onclick = function () {
        makeRequest('POST','task/delete', createParametars(data), "task-container");

        //update task count in list details
        taskCount("delete");
        $('#deleteModal').modal('hide');
        flashMessage("Task deleted", "alert-success");
    };
}

function taskSort() {
    var selectDiv = document.getElementById("table-sort");
    var listId 		= document.getElementById("list-modal-id").value;
    var sortParam = selectDiv.options[selectDiv.selectedIndex].value;

    var data = {
        listId : listId,
        sortParam : sortParam
    }

    makeRequest('POST','task/sort',createParametars(data), "task-container");
}

function taskCount(operation) {

    var task = document.getElementById("table-tasks");
    var taskCount = parseInt(task.textContent);

    if (operation === 'add') {
        taskCount++;
    } else {
        taskCount--;
    }

    task.textContent = taskCount.toString();
}


