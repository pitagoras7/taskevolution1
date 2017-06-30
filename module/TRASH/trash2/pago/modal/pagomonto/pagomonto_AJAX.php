
<?php
session_start();
include "../../../../url.php";


if ($_POST['accion'] == "edit_pagomonto")
{




    $PAGO = new pagoModelo();
    $PAGO->decrypt($_POST['v1']);
    $RESULT_PAGO = $PAGO->select_all(1);
    $_SESSION['temp']['TIPOPAGO_id'] = $PAGO->decrypt($_POST['v1']);
    $JSON = $PAGO->soyjson($PAGO->tabla,'modal','pagomonto');
    echo $PAGO->MODAL__($JSON,$RESULT_PAGO);
    exit;
}


if (($_POST['accion'] == "save_pagomonto"))
{


    $PAGO = new pagoModelo();
    $CAJA = new cajaModelo();
    $ORDERDETAIL = new orderDetailModelo();

       /* if ($_SESSION['temp']['PAGO_id'])
        {
            $PAGO->set_id($_SESSION['temp']['PAGO_id'], 1);
        }*/


        $_POST['pagcajid']  =   $_SESSION['temp']['CAJA_id'];
        $_POST['pagest']    =   't';
        $_POST['pagreg']    =   '';
        $_POST['pagtpgid']  =   $_SESSION['temp']['TIPOPAGO_id'];


        $PAGO->setter__($_POST);
        $PAGO->save();

        echo $CAJA->cards_total($_SESSION['temp']['CAJA_id']);
        echo $PAGO->datatable_cards($_SESSION['temp']['CAJA_id']);
        echo $ORDERDETAIL->datatable_cards_pago($_SESSION['temp']['ORDERS_id']);

        exit;
    }

    ?>