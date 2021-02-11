// open edit categoory modal
$('.editStore').on('click', function() {
    var storeID = $(this).attr('data-storId');
    $.ajax({
        type: 'get',
        url: url + '/stores/' + storeID + '/edit',
        success: function(data) {
            $('.requestStore').html(data);
            $('#editModal').modal('toggle');
        }
    });
});

/*** Open Deleting Category  Modal ***/
$('.deleteStore').on('click', function() {
    var storeID = $(this).attr('data-storId');
    $('#DeleteModal').modal('toggle');
    $('#deleteStoreBtn').val(storeID);
});

/*** Deleting Category  ***/
$('#deleteStoreBtn').on('click', function() {
    var storeID = $(this).val();
    $.ajax({
        type: 'DELETE',
        url: url + '/stores/' + storeID,
        data: { id: storeID, _token: token, _method: 'DELETE' },
        success: function(data) {
            $("#DeleteModal").modal("hide");
            $("#target_" + storeID).hide();
            $('#success_errror_any').addClass("hide");
            $('#messageDiv').removeClass("alert-danger hide");
            $('#messageDiv').addClass("alert-success");
            $('#message').html(data);
        },
        error: function() {
            $('#success_errror_any').addClass("hide");
            $('#messageDiv').removeClass("alert-success hide");
            $('#messageDiv').addClass("alert-danger");
            $('#message').html('Category not found or Something is wrong');
            $('#DeleteModal').modal('hide');
        }

    });
});