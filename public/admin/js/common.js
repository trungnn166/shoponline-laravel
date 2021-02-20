
const URL_CATEGORY = '/quan-ly/danh-muc-san-pham';

setTimeout(function(){ $('#flash-message').hide() }, 1500);

function showAlert(res) {
    $('#flash-message').show();
    $("#flash-message div:first").addClass(res['class']);
    $("#flash-message i").addClass(res['icon']);
    $("#flash-message label").text(res['message']);
    setTimeout(function(){ $('#flash-message').hide() }, 1500);
}


