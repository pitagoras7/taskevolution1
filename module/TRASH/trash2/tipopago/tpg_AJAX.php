<?php  session_start(); 
 
 require_once '../../url.php';



 if ($_POST['accion'] == "edit_tpg")
    {

        $TIPOPAGO = new tipopagoModelo();
        $TIPOPAGO->set_id($TIPOPAGO->decrypt($_POST['v1']));
        $RESULT_TIPOPAGO = $TIPOPAGO->select_all(1);
        $_SESSION['temp']['tipopago_id'] = $TIPOPAGO->decrypt($_POST['v1']);
        echo $TIPOPAGO->modal_($RESULT_TIPOPAGO);
        exit;
    }

    if ($_POST['accion'] == "new_tpg")
    {

        $TIPOPAGO = new tipopagoModelo();
        $TIPOPAGO->set_id(0);
        unset($_SESSION['temp']['tipopago_id']);

        $RESULT_TIPOPAGO = $TIPOPAGO->select_all(1);
        echo $TIPOPAGO->modal_($RESULT_TIPOPAGO,'new');
        exit;
    }

    if (($_POST['accion'] == "save_tpg"))
    {

        $TIPOPAGO = new tipopagoModelo();


        if ($_SESSION['temp']['tipopago_id'])
        {
          $TIPOPAGO->set_id($_SESSION['temp']['tipopago_id'], 1);  
      }



      $TIPOPAGO->setter__($_POST);
      $TIPOPAGO->save();
      echo $TIPOPAGO->datatable_();
      exit;
  }

  
 
 

  ?>
  