$(function() {
    const URL_CATEGORY = '/admin/api/categories';

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
        var url = URL_CATEGORY + '/delete';
        destroy(url, ids);
    })

    $('#tbl').on("click", '.btn-status', function() {
        var id = $(this).attr('id');
        url = URL_CATEGORY + '/change-status/' + id;
        changeStatus(url);
    });

    $('#tbl').on("click", '.btn-delete', function() {
        var ids = [$(this).attr('id')];
        var url = URL_CATEGORY + '/delete';
        destroy(url, ids);
    });

});