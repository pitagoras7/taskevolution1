<?php
session_start();
include '../../url.php';



if ($_POST['accion'] == "edit_sup")
{

    $SUPPLIES = new suppliesModelo();
    $SUPPLIES->set_id($SUPPLIES->decrypt($_POST['v1']));
    $RESULT_SUPPLIES = $SUPPLIES->select_all(1);
    $_SESSION['temp']['supplies_id'] = $SUPPLIES->decrypt($_POST['v1']);
    echo $SUPPLIES->modal_($RESULT_SUPPLIES);
    exit;
}

if ($_POST['accion'] == "new_sup")
{

    $SUPPLIES = new suppliesModelo();
    $SUPPLIES->set_id(0);
    unset($_SESSION['temp']['supplies_id']);

    $RESULT_SUPPLIES = $SUPPLIES->select_all(1);
    echo $SUPPLIES->modal_($RESULT_SUPPLIES, 'new');
    exit;
}

if (($_POST['accion'] == "save_sup"))
{

    $SUPPLIES = new suppliesModelo();


    if ($_SESSION['temp']['supplies_id'])
    {
        $SUPPLIES->set_id($_SESSION['temp']['supplies_id'], 1);
    }



    $SUPPLIES->setter__($_POST);
    $SUPPLIES->save();
    echo $SUPPLIES->datatable_();
    exit;
}





?>

