<?php
session_start();
include "../../../../url.php";


if ($_POST['accion'] == "edit_cfgpad")
{

    $CONFIG = new configModelo();
    $CONFIG->set_id($CONFIG->decrypt($_POST['v1']));
    $RESULT_CONFIG = $CONFIG->select_all(1);
    $_SESSION['temp']['config_id'] = $CONFIG->decrypt($_POST['v1']);

    $JSON = $CONFIG->soyjson($CONFIG->tabla,'modal','cfgpad');
    echo $CONFIG->MODAL__($JSON,$RESULT_CONFIG);    exit;
}

if ($_POST['accion'] == "new_cfgpad")
{
    unset($_SESSION['temp']['config_id']);
    $CONFIG = new configModelo();
    $CONFIG->set_id(0);
    $RESULT_CONFIG = $CONFIG->select_all(1);
    $_SESSION['temp']['CONFIG_id'] = $CONFIG->decrypt($_POST['v1']);
    
    $JSON = $CONFIG->soyjson($CONFIG->tabla,'modal','cfgpad');
    echo $CONFIG->MODAL__($JSON,$RESULT_CONFIG);    exit;
}





if (($_POST['accion'] == "save_cfgpad"))
{

    $CONFIG = new configModelo();

    if ($_SESSION['temp']['config_id'])
    {
        $CONFIG->set_id($_SESSION['temp']['config_id'], 1);
    }

    $_POST['cfgpad'] = $_SESSION['temp']['CONFIG_id'];
    unset($_SESSION['temp']['CONFIG_id']);
    
    $CONFIG->setter__($_POST);
    $CONFIG->save();
    $JSON = $CONFIG->json_element($CONFIG->tabla,'cfg');
    echo $CONFIG->DATATABLE__($JSON);
    exit; 
}







?>

