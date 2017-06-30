
  function submit_modal_reporteMedicoIndividual_click(x) {
    goto_lsdajax001('edit_reporteMedicoIndividual', [x], 'content-modal-reporteMedicoIndividual','module/reporteMedico/modal/reporteMedicoIndividual/reporteMedicoIndividual_AJAX.php');
  }
  function submit_form_reporteMedicoIndividual_click() {
    var vista = 'view';
    var data = $('#form_reporteMedicoIndividual').serialize();
    goto_lsdajax002('save_reporteMedicoIndividual', [data], vista,'module/reporteMedico/modal/reporteMedicoIndividual/reporteMedicoIndividual_AJAX.php');
  }
  