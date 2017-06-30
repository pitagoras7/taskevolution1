<?php
session_start();
include '../../url.php';

if ($_POST['accion'] == "oddest")
{

  $ORDERS = new ordersModelo();
  $ORDERDETAIL = new orderDetailModelo();
  $ORDERDETAIL->set_id($ORDERDETAIL->decrypt($_POST['v1']),1);

  $_POST['oddest']='f';

  unset($_SESSION['temp']['SERVICE_id']);

  $ORDERDETAIL->setter__($_POST);
  $ORDERDETAIL->save();

  echo $ORDERS->cards_total($_SESSION['temp']['ORDERS_id']);
  echo $ORDERDETAIL->datatable_cards($_SESSION['temp']['ORDERS_id']);
  exit;

}





if ($_POST['accion'] == "srpest")
{


  $SERVICEPREFERENCES = new servicePreferencesModelo();
  $SERVICEPREFERENCES->set_id($SERVICEPREFERENCES->decrypt($_POST['v1']),1);

  $_POST['srpest']='f';


  $SERVICEPREFERENCES->setter__($_POST);
  $SERVICEPREFERENCES->save();


  $SERVICEPREFERENCES->DATATABLE_CONDICIONAL=" srpest in ('t') and  srpoddid  in (".$_SESSION['temp']['ORDERDETAIL_id']."  ) order by srpid desc ";
  $JSON = $SERVICEPREFERENCES->json_element($SERVICEPREFERENCES->tabla,'srp_cards_datatable');
  echo $SERVICEPREFERENCES->DATATABLE__($JSON);
  exit;

}


if ($_POST['accion'] == "srp")
{


 $SUPPLIES = new suppliesModelo();
 $SUPPLIES->set_id($SUPPLIES->decrypt($_POST['v1']));
 $RESULTSUPPLIES = $SUPPLIES->select_all(1);


 
 $SERVICEPREFERENCES = new servicePreferencesModelo();
 $SERVICEPREFERENCES->set_srpoddid( $_SESSION['temp']['ORDERDETAIL_id'] );
 $SERVICEPREFERENCES->set_srpsupid($SERVICEPREFERENCES->decrypt($_POST['v1']));
 $SERVICEPREFERENCES->set_srptip($_POST['v2']);
 $SERVICEPREFERENCES->set_srpden($_POST['v2']." ".$RESULTSUPPLIES['supden']);
 $SERVICEPREFERENCES->set_srpest('t');  
 $SERVICEPREFERENCES->save();

 $SERVICEPREFERENCES->DATATABLE_CONDICIONAL=" srpest in ('t') and  srpoddid  in (".$_SESSION['temp']['ORDERDETAIL_id']."  ) order by srpid desc ";
 $JSON = $SERVICEPREFERENCES->json_element($SERVICEPREFERENCES->tabla,'srp_cards_datatable');
 echo $SERVICEPREFERENCES->DATATABLE__($JSON);
 exit;

}


if ($_POST['accion'] == "ode")
{


 $ORDERDETAIL = new orderDetailModelo();
 $RESULT_ORDERDETAIL = $ORDERDETAIL->select_all(" oddblo  in (".$ORDERDETAIL->oddblo_enespera.") and oddest in ('t') and oddordid in (".$_SESSION['temp']['ORDERS_id'].")");


 foreach ($RESULT_ORDERDETAIL as $ODD) {

   if($ODD['oddid_odetip']=='0'){

     $ORDERDETAILESTATU = new orderDetailEstatuModelo();
     $ORDERDETAILESTATU->set_odeoddid($ODD['oddid'] );
     $ORDERDETAILESTATU->set_odeest('t');
     $ORDERDETAILESTATU->set_odeusuid(); 
     $ORDERDETAILESTATU->set_odereg($ORDERDETAILESTATU->datetime_now());
     $ORDERDETAILESTATU->set_odetipid($ORDERDETAILESTATU->orderDetailEstatu_enespera);
     $ORDERDETAILESTATU->save();

   }


 $ORDERDETAIL = new orderDetailModelo();
 $ORDERDETAIL->set_oddordid($_SESSION['temp']['ORDERS_id'],1);
 $ORDERDETAIL->set_oddblo($ORDERDETAIL->oddblo_enespera,1);

 $ORDERDETAIL->set_oddblo($ORDERDETAIL->oddblo_sinpago);
 $ORDERDETAIL->save();



 }

 $ORDERS = new ordersModelo();
 echo $ORDERS->cards_total($_SESSION['temp']['ORDERS_id']);
 echo $ORDERDETAIL->datatable_cards($_SESSION['temp']['ORDERS_id']);
 exit;

}


/* PAGO DE PEDIDO */

if ($_POST['accion'] == "oddblo3")
{


  $ORDERDETAIL = new orderDetailModelo();
  $ORDERDETAIL->set_oddordid($_SESSION['temp']['ORDERS_id'],1);
  $ORDERDETAIL->set_oddblo($ORDERDETAIL->oddblo_enproceso,1);
  $ORDERDETAIL->set_oddest('t',1);
  $ORDERDETAIL->set_oddblo($ORDERDETAIL->oddblo_pagado);
  $ORDERDETAIL->save();

  echo "-----";

  exit;

}



/*CARROUSEL DE LAS CATEGORIAS D*/

if ($_POST['accion'] == "spc_limit")
{



    $SUPPLIESCATEGORY = new suppliesCategoryModelo();
    $RESULT_SUPPLIESCATEGORY = $SUPPLIESCATEGORY->select_all("sucest in ('t')");

     echo " <ul class=\"nav nav-list\" style=\"top: 0px; border-bottom:none\"><input type=\"hidden\" value=\"Con\"  id=\"botonplus\" >";
     echo  $SUPPLIESCATEGORY->menu_goback_cards();
     echo  $SUPPLIESCATEGORY->menu_con_cards();
     echo  $SUPPLIESCATEGORY->menu_sin_cards();
     echo  $SUPPLIESCATEGORY->menu_minus_cards();
     echo  $SUPPLIESCATEGORY->menu_filter_cards($_POST['v1']);
     echo  $SUPPLIESCATEGORY->menu_more_cards($_POST['v1']);
     echo "</ul>";

      exit;

}



if ($_POST['accion'] == "spc_limit_minus")
{



    $SUPPLIESCATEGORY = new suppliesCategoryModelo();
    $RESULT_SUPPLIESCATEGORY = $SUPPLIESCATEGORY->select_all("sucest in ('t')");

     echo " <ul class=\"nav nav-list\" style=\"top: 0px; border-bottom:none\"><input type=\"hidden\" value=\"Con\"  id=\"botonplus\" >";
     echo  $SUPPLIESCATEGORY->menu_goback_cards();
     echo  $SUPPLIESCATEGORY->menu_con_cards();
     echo  $SUPPLIESCATEGORY->menu_sin_cards();
     echo  $SUPPLIESCATEGORY->menu_minus_cards($_POST['v1']);
     echo  $SUPPLIESCATEGORY->menu_filter_cards($_POST['v1']);
     echo  $SUPPLIESCATEGORY->menu_more_cards();
     echo "</ul>";

      exit;

}



/*CARROUSEL DE LAS CATEGORIAS DE LOS SERVICIOS*/

if ($_POST['accion'] == "src_limit")
{



    $SERVICECATEGORY = new serviceCategoryModelo();
    $RESULT_SUPPLIESCATEGORY = $SERVICECATEGORY->select_all("srcest in ('t')");

     echo $SERVICECATEGORY->menu_goback_cards();
     echo $SERVICECATEGORY->menu_minus_cards();
     echo $SERVICECATEGORY->menu_filter_cards($_POST['v1']);
     echo $SERVICECATEGORY->menu_more_cards($_POST['v1']);
     echo $SERVICECATEGORY->menu_con_calculator();
     echo $SERVICECATEGORY->menu_sin_calculator();
     echo $SERVICECATEGORY->menu_cliente();
     echo $SERVICECATEGORY->menu_anular();
     echo $SERVICECATEGORY->menu_pagar();
     echo $SERVICECATEGORY->menu_pagar_parcial();




      exit;

}



if ($_POST['accion'] == "src_limit_minus")
{



    $SERVICECATEGORY = new serviceCategoryModelo();
    $RESULT_SERVICECATEGORY = $SERVICECATEGORY->select_all("srcest in ('t')");

     echo $SERVICECATEGORY->menu_goback_cards();
     echo $SERVICECATEGORY->menu_minus_cards();
     echo $SERVICECATEGORY->menu_filter_cards($_POST['v1']);
     echo $SERVICECATEGORY->menu_more_cards($_POST['v1']);
     echo $SERVICECATEGORY->menu_con_calculator();
     echo $SERVICECATEGORY->menu_sin_calculator();
     echo $SERVICECATEGORY->menu_cliente();
     echo $SERVICECATEGORY->menu_anular();
     echo $SERVICECATEGORY->menu_pagar();
     echo $SERVICECATEGORY->menu_pagar_parcial();

      exit;

}



/********************************* MEDICLUFF ********************************************/



if ($_POST['accion'] == "enfermedadConsulta"){

    $ENFERMEDAD = new enfermedadModelo();
    $ENFERMEDAD->set_id($ENFERMEDAD->decrypt($_POST['v1']));
    $RESULT_ENFERMEDAD = $ENFERMEDAD->select_all(1);
    $campo_emisor = "enfden";


    $CONSULTA = new consultaModelo();
    $CONSULTA->set_id(1);    
    $RESULT_CONSULTA = $CONSULTA->select_all(1);
    $campo_receptor = "conidx";

    $RESULT_CONSULTA[$campo_emisor] = $RESULT_CONSULTA[$campo_receptor]." | ".$RESULT_ENFERMEDAD[$campo_emisor];

    $CONSULTA->set_conid(1,1);
    $CONSULTA->set_conidx($RESULT_CONSULTA[$campo_emisor]);
    $CONSULTA->save();

                $CONSULTA = new consultaModelo();
                $CONSULTA->set_id($CONSULTA->decrypt($_SESSION['temp']['CONSULTA_id']));
                $RESULT_CONSULTA = $CONSULTA->select_all(" conest in ('t') and conid in ('1')");

                $JSON = $CONSULTA->soyjson($CONSULTA->tabla,'modal','formInforme');
                $ANEXO = new anexoModelo();
                 echo "

                  <div id=\"visor1\"  class=\"col-md-12\">
                  ".$CONSULTA->MODAL__($JSON,$RESULT_CONSULTA[0])."
                  </div>
                  <div id=\"visor2\" >
                  </div>";

exit;
}





?>