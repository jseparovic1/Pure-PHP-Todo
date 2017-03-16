/**
 * Controls for task like delete edit and finish
 */


var request = new XMLHttpRequest();
var finishButton = document.getElementById("submit-finish");
var editButton = document.getElementById('submit-edit');
var deleteButton = document.getElementById("submit-delete");


function addTask() {
    var response = '';

    var container   = document.getElementById("task-container");
    var listId 		= document.getElementById("list-modal-id").value;

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

    response = makeRequest('POST', 'task/new', createParametars(data));
    alert(response);
    container.innerHTML = '';
    container.appendChild = response;
    $('#taskModal').modal('hide');

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
    console.log(deleteButton);
    //see if user clicks YES on delete modal then make ajax request
    deleteButton.onclick = function () {
        makeRequest('POST','task/finish', taskId);
        $('#deleteModal').modal('hide');
    };
}

/**
 * Make ajax request
 * @param type http request type like , POST,GET,PUT,DELTE ...
 * @param url  send request to this url
 * @param data
 */
function makeRequest(type, url, data)
{
    var response = '';
    request.open(type, url, true);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    request.onload = function () {
        if (request.readyState === XMLHttpRequest.DONE) {
            if (request.status === 200) {
                response = request.responseText;
            } else {
                response = 'There was a problem with the request.';
            }
        }
    };

    request.onerror = function() {
        // There was a connection error of some sort
        response += ('Error connecting to server !');
    };

    request.send(data);

    return response;
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