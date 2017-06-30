<?php  session_start(); 
 
 require_once '../../url.php';



 if ($_POST['accion'] == "edit_con")
    {

        $CONTENIDO = new contenidoModelo();
        $CONTENIDO->set_id($CONTENIDO->decrypt($_POST['v1']));
        $RESULT_CONTENIDO = $CONTENIDO->select_all(1);
        $_SESSION['temp']['contenido_id'] = $CONTENIDO->decrypt($_POST['v1']);
        echo $CONTENIDO->modal_($RESULT_CONTENIDO);
        exit;
    }

    if ($_POST['accion'] == "new_con")
    {

        $CONTENIDO = new contenidoModelo();
        $CONTENIDO->set_id(0);
        unset($_SESSION['temp']['contenido_id']);

        $RESULT_CONTENIDO = $CONTENIDO->select_all(1);
        echo $CONTENIDO->modal_($RESULT_CONTENIDO,'new');
        exit;
    }

    if (($_POST['accion'] == "save_con"))
    {

        $CONTENIDO = new contenidoModelo();


        if ($_SESSION['temp']['contenido_id'])
        {
          $CONTENIDO->set_id($_SESSION['temp']['contenido_id'], 1);  
      }



      $CONTENIDO->setter__($_POST);
      $CONTENIDO->save();
      echo $CONTENIDO->datatable_();
      exit;
  }

  
 
 

  ?>
  