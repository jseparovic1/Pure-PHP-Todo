/**
 * List controls
 */

function listDelete(clicked){
    var id = clicked.dataset.listid;

    var data = {
        list_id : id
    };

    makeRequest('POST', 'todos/delete', createParametars(data), "list-container");
    flashMessage("List deleted", "alert-success");
}

function listSort() {
    var selectDiv = document.getElementById("list-sort");
    var sortParam = selectDiv.options[selectDiv.selectedIndex].value;

    var sortSelect = '';
    var order = '';

    switch (sortParam)
    {
        case "nameAsc":
            sortSelect = 'name';
            order = 'ASC';
            break;
        case "nameDesc" :
            sortSelect = 'name';
            order = 'DESC';
            break;
        case "createdAsc" :
            sortSelect = 'created';
            order = 'ASC';
            break;
        case "createdDesc" :
            sortSelect = 'name';
            order = 'DESC';
            break;
        default :
            return false;
    }

    var data = {
        name : sortSelect,
        order : order
    };

    makeRequest('POST', 'todos/sort', createParametars(data), "list-container");
    flashMessage("List sorted", "alert-success");
}

