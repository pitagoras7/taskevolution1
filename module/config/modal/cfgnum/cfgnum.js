
    function submit_modal_cfgnum_click(x) {
        goto_lsdajax001('edit_cfgnum', [x], 'content-modal-cfgnum','module/config/modal/cfgnum/cfgnum_AJAX.php');
    }



    function submit_form_cfgnum_click() {
        var vista = 'view';
        var data = $('#form_cfgnum').serialize();
        goto_lsdajax002('save_cfgnum', [data], vista,'module/config/modal/cfgnum/cfgnum_AJAX.php');
    }

    