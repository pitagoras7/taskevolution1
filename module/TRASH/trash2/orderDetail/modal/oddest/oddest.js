
    function submit_modal_oddest_click(x) {
        goto_lsdajax001('edit_oddest', [x], 'content-modal-oddest','module/orderDetail/modal/oddest/oddest_AJAX.php');
    }



    function submit_form_oddest_click() {
        var vista = 'view_orderDetail';
        var data = $('#form_oddest').serialize();
        goto_lsdajax002('save_oddest', [data], vista,'module/orderDetail/modal/oddest/oddest_AJAX.php');
    }

    