<?php
session_start();
include '../../url.php';


if ($_POST['accion'] == "edit_suc")
{

    $SUPPLIESCATEGORY = new suppliesCategoryModelo();
    $SUPPLIESCATEGORY->set_id($SUPPLIESCATEGORY->decrypt($_POST['v1']));
    $RESULT_SUPPLIESCATEGORY = $SUPPLIESCATEGORY->select_all(1);
    $_SESSION['temp']['suppliesCategory_id'] = $SUPPLIESCATEGORY->decrypt($_POST['v1']);
    echo $SUPPLIESCATEGORY->modal_($RESULT_SUPPLIESCATEGORY);
    exit;
}

if ($_POST['accion'] == "new_suc")
{

    $SUPPLIESCATEGORY = new suppliesCategoryModelo();
    $SUPPLIESCATEGORY->set_id(0);
    unset($_SESSION['temp']['suppliesCategory_id']);

    $RESULT_SUPPLIESCATEGORY = $SUPPLIESCATEGORY->select_all(1);
    echo $SUPPLIESCATEGORY->modal_($RESULT_SUPPLIESCATEGORY, 'new');
    exit;
}

if (($_POST['accion'] == "save_suc"))
{

    $SUPPLIESCATEGORY = new suppliesCategoryModelo();

    if ($_SESSION['temp']['suppliesCategory_id'])
    {
        $SUPPLIESCATEGORY->set_id($_SESSION['temp']['suppliesCategory_id'], 1);
    }

    $SUPPLIESCATEGORY->setter__($_POST);
    $SUPPLIESCATEGORY->save();
    echo $SUPPLIESCATEGORY->datatable_();
    exit;
}



?>

