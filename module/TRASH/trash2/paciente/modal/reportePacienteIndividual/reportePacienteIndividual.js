
  function submit_modal_reportePacienteIndividual_click(x) {
    goto_lsdajax001('edit_reportePacienteIndividual', [x], 'content-modal-reportePacienteIndividual','module/paciente/modal/reportePacienteIndividual/reportePacienteIndividual_AJAX.php');
  }
  function submit_form_reportePacienteIndividual_click() {
    var vista = 'view';
    var data = $('#form_reportePacienteIndividual').serialize();
    goto_lsdajax002('save_reportePacienteIndividual', [data], vista,'module/paciente/modal/reportePacienteIndividual/reportePacienteIndividual_AJAX.php');
  }
  