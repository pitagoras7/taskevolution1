
  function submit_modal_recordatorioRegistro_click(x) {
    goto_lsdajax001('new_recordatorioRegistro', [x], 'content-modal-recordatorioRegistro','module/recordatorio/modal/recordatorioRegistro/recordatorioRegistro_AJAX.php');
  }
  function submit_form_recordatorioRegistro_click() {
    var vista = 'visor';
    var data = $('#form_recordatorioRegistro').serialize();
    goto_lsdajax002('save_recordatorioRegistro', [data], vista,'module/recordatorio/modal/recordatorioRegistro/recordatorioRegistro_AJAX.php');
  }
  