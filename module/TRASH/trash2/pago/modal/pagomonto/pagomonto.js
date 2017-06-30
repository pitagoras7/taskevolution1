
    function submit_modal_pagomonto_click(x) {
        goto_lsdajax001('edit_pagomonto', [x], 'content-modal-pagomonto','module/pago/modal/pagomonto/pagomonto_AJAX.php');
    }



    function submit_form_pagomonto_click() {
        var vista = 'view_orderDetail';
        var data = $('#form_pagomonto').serialize();
        goto_lsdajax002('save_pagomonto', [data], vista,'module/pago/modal/pagomonto/pagomonto_AJAX.php');
    }

    