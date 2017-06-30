<?php
session_start();
include '../../url.php';



if ($_POST['accion'] == "edit_src")
{

    $SERVICECATEGORY = new serviceCategoryModelo();
    $SERVICECATEGORY->set_id($SERVICECATEGORY->decrypt($_POST['v1']));
    $RESULT_SERVICECATEGORY = $SERVICECATEGORY->select_all(1);
    $_SESSION['temp']['serviceCategory_id'] = $SERVICECATEGORY->decrypt($_POST['v1']);
    echo $SERVICECATEGORY->modal_($RESULT_SERVICECATEGORY);
    exit;
}



if ($_POST['accion'] == "new_src")
{

    $SERVICECATEGORY = new serviceCategoryModelo();
    $SERVICECATEGORY->set_id(0);
    unset($_SESSION['temp']['serviceCategory_id']);


    $RESULT_SERVICECATEGORY = $SERVICECATEGORY->select_all(1);
    echo $SERVICECATEGORY->modal_($RESULT_SERVICECATEGORY,'new');
    exit;
}



if (($_POST['accion'] == "save_src"))
{
    $SERVICECATEGORY = new serviceCategoryModelo();


    if ($_SESSION['temp']['serviceCategory_id']){
      $SERVICECATEGORY->set_id($_SESSION['temp']['serviceCategory_id'], 1);
    }

    $_POST['srcest']='t';
    $SERVICECATEGORY->setter__($_POST);
    $SERVICECATEGORY->save();
    echo $SERVICECATEGORY->datatable_();
    exit;
}



?>
