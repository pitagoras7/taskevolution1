<?php  session_start(); 
 
 require_once '../../url.php';



 if ($_POST['accion'] == "edit_cli")
    {

        $CLIENTE = new clienteModelo();
        $CLIENTE->set_id($CLIENTE->decrypt($_POST['v1']));
        $RESULT_CLIENTE = $CLIENTE->select_all(1);
        $_SESSION['temp']['cliente_id'] = $CLIENTE->decrypt($_POST['v1']);
        echo $CLIENTE->modal_($RESULT_CLIENTE);
        exit;
    }

    if ($_POST['accion'] == "new_cli")
    {

        $CLIENTE = new clienteModelo();
        $CLIENTE->set_id(0);
        unset($_SESSION['temp']['cliente_id']);

        $RESULT_CLIENTE = $CLIENTE->select_all(1);
        echo $CLIENTE->modal_($RESULT_CLIENTE,'new');
        exit;
    }

    if (($_POST['accion'] == "save_cli"))
    {

        $CLIENTE = new clienteModelo();


        if ($_SESSION['temp']['cliente_id'])
        {
          $CLIENTE->set_id($_SESSION['temp']['cliente_id'], 1);  
      }



      $CLIENTE->setter__($_POST);
      $CLIENTE->save();
      echo $CLIENTE->datatable_();
      exit;
  }

  
 
 

  ?>
  