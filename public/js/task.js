/**
 * Controls for task like delete edit and finish
 */

var listId 		= document.getElementById("list-modal-id").value;

var finishButton = document.getElementById("submit-finish");
var editButton = document.getElementById('submit-edit');
var deleteButton = document.getElementById("submit-delete");

function addTask() {
    var response = '';

    //modal values
    var taskName 	= document.getElementById("task-modal-name").value;
    var deadline 	= document.getElementById("task-modal-date").value;
    var priority 	= document.getElementById("task-modal-priority");
    var prioritySelected = priority.options[priority.selectedIndex].value;

    //chek if all fields are entered
    if (taskName === "" || deadline === "") {
        alert("Enter all fileds !");
    }

    var data = {
        taskName : taskName,
        deadline : deadline,
        priority : prioritySelected,
        listId : listId
    };

    makeRequest('POST', 'tasks', createParametars(data));

    $('#taskModal').modal('hide');

    //reset modal values
    taskName.value = '';
    deadline.value = '';
}

function taskFinish(taskId) {
    $('#finishModal').modal('show');

    //see if user clicks YES on finish modal then make ajax request
    finishButton.onclick = function () {
        makeRequest('POST','task/finish', taskId);
        $('#finishModal').modal('hide');
    };
}

function taskDelete(taskId) {
    $('#deleteModal').modal('show');

    //see if user clicks YES on delete modal then make ajax request
    var data = {
        taskId : taskId,
        listId : listId
    };

    deleteButton.onclick = function () {
        makeRequest('POST','task/delete', createParametars(data));

        //update task count in list details
        taskCount("delete");
        $('#deleteModal').modal('hide');
    };

}

/**
 * Make ajax request and add data to task container
 * @param type http request type like , POST,GET,PUT,DELTE ...
 * @param url  send request to this url
 * @param data
 */
function makeRequest(type, url, data)
{
    var request = new XMLHttpRequest();
    request.open(type, url, true);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    request.onload = function () {
        if (request.readyState === XMLHttpRequest.DONE) {
            if (request.status === 200) {
                //append data to container
                var container   = document.getElementById("task-container");
                container.innerHTML = '';
                container.innerHTML = request.responseText;
            } else {
                alert('There was a problem with the request.');
            }
        }
    };

    request.onerror = function() {
        // There was a connection error of some sort
        alert('Error connecting to server !');
    };

    request.send(data);
}

/**
 * Create string with parametars for ajax request
 * @param data
 */
function createParametars(data) {
    var ajaxString = '';
    for (var property in data) {
        if (ajaxString.length > 0) {
            ajaxString += "&";
        }
        ajaxString += encodeURI(property + "=" + data[property]);
    }
    return ajaxString;
}

function taskCount(operation) {

    var task = document.getElementById("table-tasks");
    var taskCount = parseInt(task.textContent);

    if (operation === 'add') {
        taskCount++;
    } else {
        taskCount--;
    }
    console.log("task count =" + taskCount);

    task.textContent = taskCount.toString();
}