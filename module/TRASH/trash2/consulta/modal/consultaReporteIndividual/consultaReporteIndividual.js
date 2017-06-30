
  function submit_modal_consultaReporteIndividual_click(x) {

  	view = '#content-modal-consultaReporteIndividual';
  	//view = visor;

    goto_lsdajax001('edit_consultaReporteIndividual', [x], 'content-modal-consultaReporteIndividual','module/consulta/modal/consultaReporteIndividual/consultaReporteIndividual_AJAX.php');
  }



  function submit_form_consultaReporteIndividual_click() {
    var vista = 'view';
    var data = $('#form_consultaReporteIndividual').serialize();
    goto_lsdajax002('save_consultaReporteIndividual', [data], vista,'module/consulta/modal/consultaReporteIndividual/consultaReporteIndividual_AJAX.php');
  }
  