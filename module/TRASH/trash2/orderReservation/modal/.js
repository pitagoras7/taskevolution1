
    function submit_modal__click(x) {
        goto_lsdajax001('edit_', [x], 'content-modal-','module/orderReservation/modal//_AJAX.php');
    }



    function submit_form__click() {
        var vista = 'view';
        var data = $('#form_').serialize();
        goto_lsdajax002('save_', [data], vista,'module/orderReservation/modal//_AJAX.php');
    }

    