<?php  session_start(); 
 
 require_once '../../url.php';



 if ($_POST['accion'] == "edit_fac")
    {

        $FACTURA = new facturaModelo();
        $FACTURA->set_id($FACTURA->decrypt($_POST['v1']));
        $RESULT_FACTURA = $FACTURA->select_all(1);
        $_SESSION['temp']['factura_id'] = $FACTURA->decrypt($_POST['v1']);
        echo $FACTURA->modal_($RESULT_FACTURA);
        exit;
    }

    if ($_POST['accion'] == "new_fac")
    {

        $FACTURA = new facturaModelo();
        $FACTURA->set_id(0);
        unset($_SESSION['temp']['factura_id']);

        $RESULT_FACTURA = $FACTURA->select_all(1);
        echo $FACTURA->modal_($RESULT_FACTURA,'new');
        exit;
    }

    if (($_POST['accion'] == "save_fac"))
    {

        $FACTURA = new facturaModelo();


        if ($_SESSION['temp']['factura_id'])
        {
          $FACTURA->set_id($_SESSION['temp']['factura_id'], 1);  
      }



      $FACTURA->setter__($_POST);
      $FACTURA->save();
      echo $FACTURA->datatable_();
      exit;
  }

  
 
 

  ?>
  