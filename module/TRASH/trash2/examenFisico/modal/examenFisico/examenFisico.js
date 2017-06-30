
  function submit_modal_examenFisico_click(x) {
    goto_lsdajax001('edit_examenFisico', [x], 'content-modal-examenFisico','module/examenFisico/modal/examenFisico/examenFisico_AJAX.php');
  }
  function submit_form_examenFisico_click() {
    var vista = 'view';
    var data = $('#form_examenFisico').serialize();
    goto_lsdajax002('save_examenFisico', [data], vista,'module/examenFisico/modal/examenFisico/examenFisico_AJAX.php');
  }
  