<?php
session_start();
include "../../../../url.php";


if ($_POST['accion'] == "edit_cfg")
{

    $CONFIG = new configModelo();
    $CONFIG->set_id($CONFIG->decrypt($_POST['v1']));
    $RESULT_CONFIG = $CONFIG->select_all(1);
    $_SESSION['temp']['config_id'] = $CONFIG->decrypt($_POST['v1']);
    $JSON = $CONFIG->soyjson($CONFIG->tabla,'modal','cfg');
    echo $CONFIG->MODAL__($JSON,$RESULT_CONFIG);
    exit;
}

if ($_POST['accion'] == "new_cfg")
{
    unset($_SESSION['temp']['config_id']);
    $CONFIG = new configModelo();
    $CONFIG->set_id(0);
    $RESULT_CONFIG = $CONFIG->select_all(1);
    
    $JSON = $CONFIG->soyjson($CONFIG->tabla,'modal','cfg');
    echo $CONFIG->MODAL__($JSON,$RESULT_CONFIG);
    exit;
}

if (($_POST['accion'] == "save_cfg"))
{

    $CONFIG = new configModelo();

    if ($_SESSION['temp']['config_id'])
    {
        $CONFIG->set_id($_SESSION['temp']['config_id'], 1);
    }

    $CONFIG->setter__($_POST);
    $CONFIG->save();
    
    $JSON = $CONFIG->json_element($CONFIG->tabla,'cfg');
    echo $CONFIG->DATATABLE__($JSON);
    exit;
}



?>

