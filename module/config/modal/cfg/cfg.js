function new_modal_cfg_click(x) {
    goto_lsdajax001('new_cfg', [x], 'content-modal-cfg','module/config/modal/cfg/cfg_AJAX.php');

}

function submit_modal_cfg_click(x) {
    goto_lsdajax001('edit_cfg', [x], 'content-modal-cfg','module/config/modal/cfg/cfg_AJAX.php');

}


function submit_form_cfg_click() {

    var vista = 'view';
    var data = $('#form_cfg').serialize();
    goto_lsdajax002('save_cfg', [data], vista,'module/config/modal/cfg/cfg_AJAX.php');
}

