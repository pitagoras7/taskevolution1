
  function submit_modal_doctorRegistro_click(x) {
    goto_lsdajax001('edit_doctorRegistro', [x], 'content-modal-doctorRegistro','module/doctor/modal/doctorRegistro/doctorRegistro_AJAX.php');
  }
  function submit_form_doctorRegistro_click() {
    var vista = 'view';
    var data = $('#form_doctorRegistro').serialize();
    goto_lsdajax002('save_doctorRegistro', [data], vista,'module/doctor/modal/doctorRegistro/doctorRegistro_AJAX.php');
  }
  