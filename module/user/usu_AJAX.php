<?php
session_start();
include '../../url.php';


if ($_POST['accion'] == "edit_usu")
{

    $OBJ_user = new userModelo();
    $OBJ_user->set_id($OBJ_user->decrypt($_POST['v1']));
    $RESULT_user = $OBJ_user->select_all(1);
    $_SESSION['temp']['user_id'] = $OBJ_user->decrypt($_POST['v1']);
    echo $OBJ_user->modal_($RESULT_user);
    exit;
}



if ($_POST['accion'] == "new_usu")
{

    $OBJ_user = new userModelo();
    $OBJ_user->set_id(0);
    $RESULT_user = $OBJ_user->select_all(1);
    $_SESSION['temp']['user_id'] = $OBJ_user->decrypt($_POST['v1']);


    echo $OBJ_user->modal_($RESULT_user, 'new');
    exit;
}




if (($_POST['accion'] == "save_usu"))
{

    $OBJ_user = new userModelo();
    $OBJ_user->set_id($_SESSION['temp']['user_id'], 1);
    $OBJ_user->set_usunom($_POST['usunom']);
    $OBJ_user->set_usuced($_POST['usuced']);
    $OBJ_user->set_usucar($_POST['usucar']);
    $OBJ_user->set_usugen($_POST['usugen']);
    $OBJ_user->set_usucor($_POST['usucor']);
    $OBJ_user->set_usulog($_POST['usulog']);
    $OBJ_user->set_usupas($_POST['usupas']);
    $OBJ_user->set_usureg($_POST['usureg']);
    $OBJ_user->set_usuest($_POST['usuest']);
    $OBJ_user->set_usuusuid($_POST['usuusuid']);
    $OBJ_user->set_usudir($_POST['usudir']);
    $OBJ_user->set_usuing($_POST['usuing']);
    $OBJ_user->save();
    echo $OBJ_user->datatable_();
    exit;
}

if (($_POST['accion'] == "save_usu001"))
{

    $OBJ_user = new userModelo();
    $OBJ_user->set_id($_SESSION['temp']['user_id'], 1);
    $OBJ_user->setter__($_POST);
    $OBJ_user->save();
    echo $OBJ_user->datatable_();
    exit;
}



?>

