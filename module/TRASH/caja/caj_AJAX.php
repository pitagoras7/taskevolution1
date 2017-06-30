<?php  session_start(); 
 
 require_once '../../url.php';



 if ($_POST['accion'] == "edit_caj")
    {

        $CAJA = new cajaModelo();
        $CAJA->set_id($CAJA->decrypt($_POST['v1']));
        $RESULT_CAJA = $CAJA->select_all(1);
        $_SESSION['temp']['caja_id'] = $CAJA->decrypt($_POST['v1']);
        echo $CAJA->modal_($RESULT_CAJA);
        exit;
    }

    if ($_POST['accion'] == "new_caj")
    {

        $CAJA = new cajaModelo();
        $CAJA->set_id(0);
        unset($_SESSION['temp']['caja_id']);

        $RESULT_CAJA = $CAJA->select_all(1);
        echo $CAJA->modal_($RESULT_CAJA,'new');
        exit;
    }

    if (($_POST['accion'] == "save_caj"))
    {

        $CAJA = new cajaModelo();


        if ($_SESSION['temp']['caja_id'])
        {
          $CAJA->set_id($_SESSION['temp']['caja_id'], 1);  
      }



      $CAJA->setter__($_POST);
      $CAJA->save();
      echo $CAJA->datatable_();
      exit;
  }

  
 
 

  ?>
  