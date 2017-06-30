
  function submit_modal_formIndicaciones_click(x) {
    goto_lsdajax001('edit_formIndicaciones', [x], 'content-modal-formIndicaciones','module/consulta/modal/formIndicaciones/formIndicaciones_AJAX.php');
  }
  function submit_form_formIndicaciones_click() {
    var vista = 'view';
    var data = $('#form_formIndicaciones').serialize();
    goto_lsdajax002('save_formIndicaciones', [data], vista,'module/consulta/modal/formIndicaciones/formIndicaciones_AJAX.php');
  }
  