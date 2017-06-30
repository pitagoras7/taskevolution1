/*
  function new_modal_odd_click(x) {
      goto_lsdajax001('new_odd', [x], 'view_orderDetail','module/orderDetail/modal/odd/odd_AJAX.php');
  }
*/

  function new_modal_odd_click(x) {
      goto_lsdajax001('new_odd', [x], 'content-modal-odd','module/orderDetail/modal/odd/odd_AJAX.php');
  }


  function direct_modal_odd_click(x) {
      goto_lsdajax001('new_odd', [x], 'view_orderDetail','module/orderDetail/modal/odd/odd_AJAX.php');
  }


  function submit_modal_odd_click(x) {
      goto_lsdajax001('edit_odd', [x], 'content-modal-odd','module/orderDetail/modal/odd/odd_AJAX.php');
  }



  function submit_form_odd_click() {

      var vista = 'view_orderDetail';
      var data = $('#form_odd').serialize();
      goto_lsdajax002('save_odd', [data], vista,'module/orderDetail/modal/odd/odd_AJAX.php');

  }


