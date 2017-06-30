
    function submit_modal_eliminacion_click(x) {
        goto_lsdajax001('edit_eliminacion', [x], 'content-modal-eliminacion','module/config/modal/eliminacion/eliminacion_AJAX.php');
    }



    function submit_form_eliminacion_click() {
        var vista = 'view';
        var data = $('#form_eliminacion').serialize();
        goto_lsdajax002('save_eliminacion', [data], vista,'module/config/modal/eliminacion/eliminacion_AJAX.php');
    }

    