
setTimeout(function(){ $('#flash-message').hide() }, 1500);

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function showAlert(res) {
    $('#flash-message').show();
    $("#flash-message div:first").addClass(res['class']);
    $("#flash-message i").addClass(res['icon']);
    $("#flash-message label").text(res['message']);
    setTimeout(function(){ $('#flash-message').hide() }, 1500);
}

$("#check-all").on('change', function() {
    $("input[name=checked]").prop("checked", $(this).prop("checked"));
    alert('va')
});
  
$("input[name=checked]").on('click', function() {
    if (!$(this).prop("checked")) {
        $("#check-all").prop("checked", false);
    }
});

function destroy(url, ids) {
    var data = {'ids': ids};
    $.confirm({
        title: 'Xác nhận!',
        content: 'Bạn chắc chắn muốn xóa?',
        buttons: {
            confirm: {
                text: 'Xác nhận',
                btnClass: 'btn-green',
                action: function () {
                    $.ajax({
                        type: "delete",
                        processData: false,
                        contentType: 'application/json; charset=utf-8',
                        data: JSON.stringify(data),
                        url: url,
                        success: function(res) {
                            showAlert(res);
                            if(res['status'] == 200) {
                                ids.forEach(function(id) {
                                    $("#row-"+id).remove();
                                });
                                $("#check-all").prop("checked", false);
                            }
                        },
                        error: function() {
                            res = {'class':'alert-danger', 'icon': 'fa fa-exclamation-circle'};
                            showAlert(res);
                        }
                    })
                }
            },
        
            cancel: {
                text: 'Hủy'
            },
        }
    });
}

function changeStatus(url) {
    $.ajax({
        type: "put",
        processData: false,
        contentType: false,
        url: url,
        success: function(res) {
           showAlert(res);
        },
        error: function() {
            res = {'class':'alert-danger', 'icon': 'fa fa-exclamation-circle'};
            showAlert(res);
        }
    })
}
