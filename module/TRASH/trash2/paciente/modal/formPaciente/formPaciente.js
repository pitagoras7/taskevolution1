
  function submit_modal_formPaciente_click(x) {
    goto_lsdajax001('edit_formPaciente', [x], 'content-modal-formPaciente','module/paciente/modal/formPaciente/formPaciente_AJAX.php');
  }
  function submit_form_formPaciente_click() {
      $( "#form_formPaciente" ).submit();
  }
  