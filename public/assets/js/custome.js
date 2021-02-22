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




// open edit user modal
$('.editUser').on('click', function() {
    var userID = $(this).attr('data-UserId');
    $.ajax({
        type: 'get',
        url: url + '/users/' + userID + '/edit',
        success: function(data) {
            $('.requestdata').html(data);
            $('#editUserModal').modal('toggle');
        }
    });
});

/*** Open Deleting Category  Modal ***/
$('.deleteUser').on('click', function() {
    var userID = $(this).attr('data-UserId');
    $('#DeleteUserModal').modal('toggle');
    $('#deleteModalBtn').val(userID);
});

/*** Deleting Category  ***/
$('#deleteModalBtn').on('click', function() {
    var userID = $(this).val();
    $.ajax({
        type: 'DELETE',
        url: url + '/users/' + userID,
        data: { id: userID, _token: token, _method: 'DELETE' },
        success: function(data) {
            $("#DeleteUserModal").modal("hide");
            $("#target_" + userID).hide();
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
            $('#DeleteUserModal').modal('hide');
        }

    });
});

// open order status change modal
$('.single_order_status').on('click', function() {
    var orderID = $(this).attr('data-orderId');
    url = $('#singleorderStatus').attr('action')
    url = url + "/" + orderID;
    $('#singleorderStatus').attr('action', url);
    $('#OrderStatusmodalForm').modal('toggle');
});



// Order Note add modal
$('.orderNote').on('click', function() {
    var orderID = $(this).attr('data-orderId');
    $('#order_id').val(orderID);
    $('#OrderNoteModalForm').modal('toggle');
});
/*** Open Deleting note  Modal ***/
$('.deleteNote').on('click', function() {
    var NoteID = $(this).attr('data-NoteId');
    $('#DeleteNoteModal').modal('toggle');
    $('#deleteNoteBtn').val(NoteID);
});

/*** Deleting NOte  ***/
$('#deleteNoteBtn').on('click', function() {
    var NoteID = $(this).val();
    var OrderID = $('.order_id').val();
    var store_url = $('.store_url').val();
    var key = $('.consumer_key').val();
    var secret = $('.consumer_secret').val();
    $.ajax({
        type: 'DELETE',
        url: url + '/ordernotes/' + NoteID,
        data: { store_url: store_url, key: key, secret: secret, order_id: OrderID, id: NoteID, _token: token, _method: 'DELETE' },
        success: function(data) {
            $("#DeleteNoteModal").modal("hide");
            $("#target_" + NoteID).hide();
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
            $('#DeleteNoteModal').modal('hide');
        }

    });
});


/*** Open Deleting Question  Modal ***/
$('.deleteQuestion').on('click', function() {
    var QuestionID = $(this).attr('data-QuestionId');
    $('#DeleteQuestionModal').modal('toggle');
    $('#deleteQuestionBtn').val(QuestionID);
});

/*** Deleting Question  ***/
$('#deleteQuestionBtn').on('click', function() {
    var QuestionID = $(this).val();

    $.ajax({
        type: 'DELETE',
        url: url + '/questions/' + QuestionID,
        data: { id: QuestionID, _token: token, _method: 'DELETE' },
        success: function(data) {
            $("#DeleteQuestionModal").modal("hide");
            $("#target_" + QuestionID).hide();
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
            $('#DeleteQuestionModal').modal('hide');
        }

    });
});
// edit Question
$('.editQuestion').on('click', function() {
    var QuestionID = $(this).attr('data-QuestionId');
    alert($(this).attr('data-Question'))
    $('#question').val($(this).attr('data-Question'));
    url = $('#editQuestionForm').attr('action');
    url = url + "/" + QuestionID;
    $('#editQuestionForm').attr('action', url);
    $('#EditCustomQuestionModal').modal('toggle');
});
// open edit Product modal
$('.editProduct').on('click', function() {
    var productID = $(this).attr('data-productId');
    $.ajax({
        type: 'get',
        url: url + '/products/' + productID + '/edit',
        success: function(data) {
            $('.requestdata').html(data);
            $('#modalForm').modal('toggle');
        }
    });
    // $('#regular_price').val($(this).attr('data-productPrice'))
    // $('#sale_price').val($(this).attr('data-salePrice'))
    // url = $('#productEditForm').attr('action')
    // url = url + "/" + productID;
    // $('#productEditForm').attr('action', url);
    // $('#modalForm').modal('toggle');
});


/*** Open Deleting product  Modal ***/
$('.deleteProduct').on('click', function() {
    var productID = $(this).attr('data-productId');
    $('#DeleteModal').modal('toggle');
    $('#deleteProductModalBtn').val(productID);
});

/*** Deleting product  ***/
$('#deleteProductModalBtn').on('click', function() {
    var productID = $(this).val();
    $.ajax({
        type: 'DELETE',
        url: url + '/products/' + productID,
        data: { id: productID, _token: token, _method: 'DELETE' },
        success: function(data) {
            $("#DeleteModal").modal("hide");
            $("#target_" + productID).hide();
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


// auto logout
$(document).ready(function() {
    const timeout = $('#expiry_page_time').val(); // 900000 ms = 15 minutes
    var idleTimer = null;
    $('*').bind('mousemove click mouseup mousedown keydown keypress keyup submit change mouseenter scroll resize dblclick', function() {
        clearTimeout(idleTimer);

        idleTimer = setTimeout(function() {
            document.getElementById('logout-form').submit();
        }, timeout);
    });
    $("body").trigger("mousemove");
});

// image zoom in
$(document.body).on("click", "img.product_image", function() {
    // Get the modal
    var modal = document.getElementById("myModal");
    var modalImg = document.getElementById("img01");
    modal.style.display = "block";
    modalImg.src = $(this).attr('src');

    // Get the <span> element that closes the modal
    var span = document.getElementById("close");

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }
});