
    function submit_modal_schedule_click(x) {
        goto_lsdajax001('new_schedule', [x], 'content-modal-schedule','module/orderReservation/modal/schedule/schedule_AJAX.php');
    }



    function submit_form_schedule_click() {
        var vista = 'view';
        var data = $('#form_schedule').serialize();
        goto_lsdajax002('save_schedule', [data], vista,'module/orderReservation/modal/schedule/schedule_AJAX.php');
    }

    