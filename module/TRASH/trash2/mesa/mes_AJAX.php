<?php 
 require_once '../../clases/mesaModelo.php';
 session_start(); 
 
 
if ($_POST['accion'] == "edit_mes")
    {

        $MESA = new mesaModelo();
        $MESA->set_id($MESA->decrypt($_POST['v1']));
        $RESULT_MESA = $MESA->select_all(1);
        $_SESSION['temp']['mesa_id'] = $MESA->decrypt($_POST['v1']);
        echo $MESA->modal_($RESULT_MESA);
        exit;
    }

    if ($_POST['accion'] == "new_mes")
    {

        $MESA = new mesaModelo();
        $MESA->set_id(0);
        unset($_SESSION['temp']['mesa_id']);

        $RESULT_MESA = $MESA->select_all(1);
        echo $MESA->modal_($RESULT_MESA,'new');
        exit;
    }

    if (($_POST['accion'] == "save_mes"))
    {

        $MESA = new mesaModelo();


        if ($_SESSION['temp']['mesa_id'])
        {
          $MESA->set_id($_SESSION['temp']['mesa_id'], 1);  
      }



      $MESA->setter__($_POST);
      $MESA->save();
      echo $MESA->datatable_();
      exit;
  }

  
 
 

  ?>
  