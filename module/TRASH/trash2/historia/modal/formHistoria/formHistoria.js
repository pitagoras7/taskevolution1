
  function submit_modal_formHistoria_click(x) {
    goto_lsdajax001('edit_formHistoria', [x], 'content-modal-formHistoria','module/historia/modal/formHistoria/formHistoria_AJAX.php');
  }
  function submit_form_formHistoria_click() {
    var vista = 'view';
    var data = $('#form_formHistoria').serialize();
    goto_lsdajax002('save_formHistoria', [data], vista,'module/historia/modal/formHistoria/formHistoria_AJAX.php');
  }
  