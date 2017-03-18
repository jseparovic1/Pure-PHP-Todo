/**
 * Make ajax request and add data to task container
 * @param type http request type like , POST,GET,PUT,DELTE ...
 * @param url  send request to this url
 * @param element html element in wich data would be pasted
 * @param data
 */
function makeRequest(type, url, data, elementId)
{
    var request = new XMLHttpRequest();
    var container   = document.getElementById(elementId);

    request.open(type, url, true);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    request.onload = function () {
        if (request.readyState === XMLHttpRequest.DONE) {
            if (request.status === 200) {
                //append data to container
                container.innerHTML = '';
                container.innerHTML = request.responseText;
            } else {
                flashMessage("We have some problems, try again later", "alert-danger");
            }
        }
    };

    request.onerror = function() {
        // There was a connection error of some sort
        flashMessage("Error conecting to server :( ", "alert-danger");
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

/**
 * Flash message to message div for 2 seconds
 * @param message message to be flased
 * @param elementClass class that will be added to message element (like alert-succes)
 */
function flashMessage(message, elementClass) {
    var messageDiv = document.getElementById("message");
    messageDiv.innerHTML = message;

    messageDiv.classList.add(elementClass);
    messageDiv.style.display = '';

    //hide message
    setTimeout(function (){
        messageDiv.style.display = 'none';
    }, 2000);
}
