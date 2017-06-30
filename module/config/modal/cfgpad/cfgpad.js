
function submit_modal_cfgpad_click(x) {
    goto_lsdajax001('new_cfgpad', [x], 'content-modal-cfgpad','module/config/modal/cfgpad/cfgpad_AJAX.php');
}



function submit_form_cfgpad_click() {
    var vista = 'view';
    var data = $('#form_cfgpad').serialize();
    goto_lsdajax002('save_cfgpad', [data], vista,'module/config/modal/cfgpad/cfgpad_AJAX.php');
}

