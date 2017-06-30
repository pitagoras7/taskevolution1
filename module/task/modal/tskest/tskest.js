
  function submit_modal_tskest_click(x) {
    goto_lsdajax001('edit_tskest', [x], 'content-modal-tskest','module/task/modal/tskest/tskest_AJAX.php');
  }
  function submit_form_tskest_click() {
    var vista = 'view';
    var data = $('#form_tskest').serialize();
    goto_lsdajax002('save_tskest', [data], vista,'module/task/modal/tskest/tskest_AJAX.php');
  }
  