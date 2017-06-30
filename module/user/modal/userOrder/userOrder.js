
    function submit_modal_userOrder_click(x) {
        goto_lsdajax001('edit_userOrder', [x], 'content-modal-userOrder','module/user/modal/userOrder/userOrder_AJAX.php');
    }



    function submit_form_userOrder_click() {
        var vista = 'view';
        var data = $('#form_userOrder').serialize();
        goto_lsdajax002('save_userOrder', [data], vista,'module/user/modal/userOrder/userOrder_AJAX.php');
    }

    