$(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#tbl').on("click", '.btn-status', function() {
        var id = $(this).attr('id');
        $.ajax({
            type: "put",
            processData: false,
            contentType: false,
            url: URL_CATEGORY + '/thay-doi-trang-thai?id='+id,
            success: function(res) {
               showAlert(res);
            },
            error: function() {
                res = {'class':'alert-danger', 'icon': 'fa fa-exclamation-circle'};
                showAlert(res);
            }
        })
    });
});