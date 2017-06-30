
  function submit_modal_formInforme_click(x) {
    goto_lsdajax001('edit_formInforme', [x], 'content-modal-formInforme','module/consulta/modal/formInforme/formInforme_AJAX.php');
  }
  function submit_form_formInforme_click() {
    var vista = 'view';
    var data = $('#form_formInforme').serialize();
    goto_lsdajax002('save_formInforme', [data], vista,'module/consulta/modal/formInforme/formInforme_AJAX.php');
  }
  