
  function submit_modal_formReferencia_click(x) {
    goto_lsdajax001('edit_formReferencia', [x], 'content-modal-formReferencia','module/consulta/modal/formReferencia/formReferencia_AJAX.php');
  }
  function submit_form_formReferencia_click() {
    var vista = 'view';
    var data = $('#form_formReferencia').serialize();
    goto_lsdajax002('save_formReferencia', [data], vista,'module/consulta/modal/formReferencia/formReferencia_AJAX.php');
  }
  