
  function submit_modal_formPacienteMinimo_click(x) {
    goto_lsdajax001('edit_formPacienteMinimo', [x], 'content-modal-formPacienteMinimo','module/paciente/modal/formPacienteMinimo/formPacienteMinimo_AJAX.php');
  }
  function submit_form_formPacienteMinimo_click() {
    var vista = 'visor';
    var data = $('#form_formPacienteMinimo').serialize();
    goto_lsdajax002('save_formPacienteMinimo', [data], vista,'module/paciente/modal/formPacienteMinimo/formPacienteMinimo_AJAX.php');
  }
  