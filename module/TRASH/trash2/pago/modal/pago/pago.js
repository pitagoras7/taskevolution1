
    function submit_modal_pago_click(x) {
        goto_lsdajax001('edit_pago', [x], 'content-modal-pago','module/pago/modal/pago/pago_AJAX.php');
    }



    function submit_form_pago_click() {
        var vista = 'view';
        var data = $('#form_pago').serialize();
        goto_lsdajax002('save_pago', [data], vista,'module/pago/modal/pago/pago_AJAX.php');
    }

    