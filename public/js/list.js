$(document).ready(function () {
    $(document).on("click","#deleteList",function () {
        var id = this.dataset.listid;
        console.log('clicked ' + id);
        deleteList(id);
    });

    $(document).on("click","#sort-icon-asc",function () {
        sortList("ASC");
    });

    $(document).on("click","#sort-icon-desc",function () {
         sortList("DESC");
    });
});

function deleteList(id){
    $.ajax({
        type: 'POST',
        url: 'delete',
        data: {list_id: id},
    })
        .done(function(data) {
            $("#list-container").empty();
            $("#list-container").append(data);
            console.log("deleted " + id);
        })
}
function sortList(order)
{
    $.ajax({
        type: 'POST',
        url: 'sort',
        data: {order: order}
    })
        .done(function(data) {
            $("#list-container").empty();
            $("#list-container").append(data);
        })
}
