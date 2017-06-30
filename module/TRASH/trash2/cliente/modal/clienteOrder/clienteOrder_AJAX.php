
<?php
session_start();
include "../../../../url.php";


if ($_POST['accion'] == "edit_clienteOrder")
{

    $ORDERS = new ordersModelo();
    $ORDERS->set_id($_SESSION['temp']['ORDERS_id']);
    $RESULT_ORDERS = $ORDERS->select_all(1);

    $CLIENTE = new clienteModelo();


    if($CLIENTE->decrypt($_POST['v1'])>0){

        $RESULT_CLIENTE = $CLIENTE->select_all(" cliid in (".$CLIENTE->decrypt($_POST['v1']).")" );    
        $_SESSION['temp']['CLIENTE_id'] = $CLIENTE->decrypt($_POST['v1']);
   
    }else if($_SESSION['temp']['CLIENTE_id']){

        $RESULT_CLIENTE = $CLIENTE->select_all(" cliid in (".$_SESSION['temp']['CLIENTE_id'].")" );    

    }else if($RESULT_ORDERS['ordcliid']>0){

        $RESULT_CLIENTE = $CLIENTE->select_all(" cliid in (".$RESULT_ORDERS['ordcliid'].")" );    
    }



    $JSON = $CLIENTE->soyjson($CLIENTE->tabla,'modal','clienteOrder');
    echo $CLIENTE->MODAL__($JSON,$RESULT_CLIENTE[0]);
    exit;
}


if (($_POST['accion'] == "save_clienteOrder"))
{

    $CLIENTE = new clienteModelo();

    if ($_SESSION['temp']['CLIENTE_id'])
    {
        $CLIENTE->set_id($_SESSION['temp']['CLIENTE_id'], 1);
    }
    
    $_POST['cliest'] = "t";
    $CLIENTE->setter__($_POST);
    $CLIENTE->save();
 
    if (!$_SESSION['temp']['CLIENTE_id'])
    {
     $_SESSION['temp']['CLIENTE_id'] = $CLIENTE->ultimoId;
    }

   $_SESSION['temp']['CLIENTE_id'];

   $ORDERS = new ordersModelo();
   $ORDERDETAIL = new orderDetailModelo();
   $ORDERS->set_ordid($_SESSION['temp']['ORDERS_id'],1);
   $ORDERS->set_ordcliid($_SESSION['temp']['CLIENTE_id']);
   $ORDERS->save();

   echo $ORDERS->cards_total($_SESSION['temp']['ORDERS_id']);
   echo $ORDERDETAIL->datatable_cards($_SESSION['temp']['ORDERS_id']);
   exit;
}


if ($_POST['accion'] == "search_clienteOrder")
{
  $CLIENTE = new clienteModelo(); 
  $CLIENTE->DATATABLE_CONDICIONAL=" cliest in ('t') order by cliid desc ";
  $JSON = $CLIENTE->json_element($CLIENTE->tabla,'datatableCliente');
  echo $CLIENTE->modal_content_view($CLIENTE->DATATABLE__($JSON));
}


?>