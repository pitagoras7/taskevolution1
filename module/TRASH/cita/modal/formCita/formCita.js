
  function submit_modal_formCita_click(x) {
    goto_lsdajax001('edit_formCita', [x], 'content-modal-formCita','module/cita/modal/formCita/formCita_AJAX.php');
  }
  function submit_form_formCita_click() {
    var vista = 'view';
    var data = $('#form_formCita').serialize();
    goto_lsdajax002('save_formCita', [data], vista,'module/cita/modal/formCita/formCita_AJAX.php');
  }
  