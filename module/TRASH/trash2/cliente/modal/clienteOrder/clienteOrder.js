
    function submit_modal_clienteOrder_click(x) {
        goto_lsdajax001('edit_clienteOrder', [x], 'content-modal-clienteOrder','module/cliente/modal/clienteOrder/clienteOrder_AJAX.php');
    }



    function submit_form_clienteOrder_click() {
        var vista = 'view_orderDetail';
        var data = $('#form_clienteOrder').serialize();
        goto_lsdajax002('save_clienteOrder', [data], vista,'module/cliente/modal/clienteOrder/clienteOrder_AJAX.php');
    }

    