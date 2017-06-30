
  function submit_modal_consultaRecipeIndividual_click(x) {
    goto_lsdajax001('edit_consultaRecipeIndividual', [x], 'content-modal-consultaRecipeIndividual','module/consulta/modal/consultaRecipeIndividual/consultaRecipeIndividual_AJAX.php');
  }
  function submit_form_consultaRecipeIndividual_click() {
    var vista = 'view';
    var data = $('#form_consultaRecipeIndividual').serialize();
    goto_lsdajax002('save_consultaRecipeIndividual', [data], vista,'module/consulta/modal/consultaRecipeIndividual/consultaRecipeIndividual_AJAX.php');
  }
  