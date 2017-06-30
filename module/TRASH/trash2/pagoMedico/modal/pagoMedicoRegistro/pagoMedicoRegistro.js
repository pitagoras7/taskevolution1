
  function submit_modal_pagoMedicoRegistro_click(x) {
    goto_lsdajax001('new_pagoMedicoRegistro', [x], 'content-modal-pagoMedicoRegistro','module/pagoMedico/modal/pagoMedicoRegistro/pagoMedicoRegistro_AJAX.php');
  }
  function submit_form_pagoMedicoRegistro_click() {
    var vista = 'view';
    var data = $('#form_pagoMedicoRegistro').serialize();
    goto_lsdajax002('save_pagoMedicoRegistro', [data], vista,'module/pagoMedico/modal/pagoMedicoRegistro/pagoMedicoRegistro_AJAX.php');
  }
  