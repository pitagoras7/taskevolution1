<?php
session_start();
include '../../url.php';


if ($_POST['accion'] == "edit_srv")
{

    $SERVICE = new serviceModelo();
    $SERVICE->set_id($SERVICE->decrypt($_POST['v1']));
    $RESULT_SERVICE = $SERVICE->select_all(1);
    $_SESSION['temp']['service_id'] = $SERVICE->decrypt($_POST['v1']);
    echo $SERVICE->modal_($RESULT_SERVICE);
    exit;
}

if ($_POST['accion'] == "new_srv")
{

    $SERVICE = new serviceModelo();
    $SERVICE->set_id(0);
    unset($_SESSION['temp']['service_id']);

    $RESULT_SERVICE = $SERVICE->select_all(1);
    echo $SERVICE->modal_($RESULT_SERVICE,'new');
    exit;
}

if (($_POST['accion'] == "save_srv"))
{

    $SERVICE = new serviceModelo();


    if ($_SESSION['temp']['service_id'])
    {
      $SERVICE->set_id($_SESSION['temp']['service_id'], 1);  
  }


  
  $SERVICE->setter__($_POST);
  $SERVICE->save();
  echo $SERVICE->datatable_();
  exit;
}

?>
