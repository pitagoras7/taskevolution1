<?php  session_start(); 
 
 require_once '../../url.php';



 if ($_POST['accion'] == "edit_pag")
    {

        $PAGO = new pagoModelo();
        $PAGO->set_id($PAGO->decrypt($_POST['v1']));
        $RESULT_PAGO = $PAGO->select_all(1);
        $_SESSION['temp']['pago_id'] = $PAGO->decrypt($_POST['v1']);
        echo $PAGO->modal_($RESULT_PAGO);
        exit;
    }

    if ($_POST['accion'] == "new_pag")
    {

        $PAGO = new pagoModelo();
        $PAGO->set_id(0);
        unset($_SESSION['temp']['pago_id']);

        $RESULT_PAGO = $PAGO->select_all(1);
        echo $PAGO->modal_($RESULT_PAGO,'new');
        exit;
    }

    if (($_POST['accion'] == "save_pag"))
    {

        $PAGO = new pagoModelo();


        if ($_SESSION['temp']['pago_id'])
        {
          $PAGO->set_id($_SESSION['temp']['pago_id'], 1);  
      }



      $PAGO->setter__($_POST);
      $PAGO->save();
      echo $PAGO->datatable_();
      exit;
  }

  
 
 

  ?>
  