$(function() {
    const URL_API = '/admin/api/banners';

    $("#check-all").on('click', function() {
        $(".input-checkbox").prop('checked', $(this).prop('checked'));  
    });
    
    $(".input-checkbox").on('click', function() {
        if (!$(this).prop("checked")) {
            $("#check-all").prop("checked", false);
        }
    });    

    $('#btn-delete-selected').on('click', function() {
        var ids = $('input[name="ids[]"]:checked').map(function(){
            return $(this).val();
        }).get();
        var url = URL_API + '/delete';
        destroy(url, ids);
    })

    $('#tbl').on("click", '.btn-status', function() {
        var id = $(this).attr('id');
        url = URL_API + '/change-status/' + id;
        changeStatus(url);
    });

    $('#tbl').on("click", '.btn-delete', function() {
        var ids = [$(this).attr('id')];
        var url = URL_API + '/delete';
        destroy(url, ids);
    });

});