
  function submit_modal_reporteCitaIndividual_click(x) {
    goto_lsdajax001('edit_reporteCitaIndividual', [x], 'content-modal-reporteCitaIndividual','module/cita/modal/reporteCitaIndividual/reporteCitaIndividual_AJAX.php');
  }
  
  function submit_form_reporteCitaIndividual_click() {
    var vista = 'view';
    var data = $('#form_reporteCitaIndividual').serialize();
    goto_lsdajax002('save_reporteCitaIndividual', [data], vista,'module/cita/modal/reporteCitaIndividual/reporteCitaIndividual_AJAX.php');
  }
  