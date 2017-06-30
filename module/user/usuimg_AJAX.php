<?php
session_start();
include '../../url.php';


if ($_POST['accion'] == "edit_usuimg")
{

    $OBJ_user = new userModelo();
    $OBJ_user->set_id($OBJ_user->decrypt($_POST['v1']));
    $RESULT_user = $OBJ_user->select_all(1);
    $_SESSION['temp']['user_id'] = $OBJ_user->decrypt($_POST['v1']);
    echo $OBJ_user->modal_usuimg($RESULT_user);
    exit;
}




?>

