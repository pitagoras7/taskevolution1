
    function submit_modal_serv_click(x) {
        goto_lsdajax001('new_serv', [x], 'content-modal-serv','module/service/modal/serv/serv_AJAX.php');
    }



    function submit_form_serv_click() {
        var vista = 'view';
        var data = $('#form_serv').serialize();
        goto_lsdajax002('save_serv', [data], vista,'module/service/modal/serv/serv_AJAX.php');
    }

    