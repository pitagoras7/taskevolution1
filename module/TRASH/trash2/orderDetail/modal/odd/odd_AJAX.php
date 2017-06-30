<?php  session_start(); 

require_once '../../../../url.php';


if ($_POST['accion'] == "edit_odd")
{


  $ORDERDETAIL = new orderDetailModelo();
  $ORDERDETAIL->set_id($ORDERDETAIL->decrypt($_POST['v1']));
  $RESULT_ORDERDETAIL = $ORDERDETAIL->select_all(1);

  $_SESSION['temp']['orderDetail_id'] = $ORDERDETAIL->decrypt($_POST['v1']);
  $_SESSION['temp']['SERVICE_id']     = $RESULT_ORDERDETAIL['oddsrvid'];


  $ORDERDETAIL->modal_json = "form_order";        
  echo $ORDERDETAIL->modal_($RESULT_ORDERDETAIL);
  exit;
}




if ($_POST['accion'] == "new_odd")
{


          unset($_SESSION['temp']['orderDetail_id']);


          $SERVICE = new serviceModelo();
          $_SESSION['temp']['SERVICE_id'] = $SERVICE->decrypt($_POST['v1']);
          $RESULT_SERVICE = $SERVICE->select_all(" srvest in ('t') and srvid in (".$_SESSION['temp']['SERVICE_id'].")");
          $MODO =  $RESULT_SERVICE[0]['srvmod'];

          $_SESSION['temp']['MODO_ORDERS'] = $MODO;



          if($MODO==1)
          {

                    $ORDERDETAIL = new orderDetailModelo();
                    $_SESSION['temp']['SERVICE_id'] = $ORDERDETAIL->decrypt($_POST['v1']);


                    $SERVICE = new serviceModelo();
                    $RESULT_SERVICE = $SERVICE->select_all(" srvid in (".$_SESSION['temp']['SERVICE_id'].") ");


                    $ORDERS = new ordersModelo();


                    if ($_SESSION['temp']['orderDetail_id'])
                    {
                      $ORDERDETAIL->set_id($_SESSION['temp']['orderDetail_id'], 1);  
                    }
                    $_POST['oddcan']  = 1;
                    $_POST['oddest']  = 't';
                    $_POST['oddordid']= $_SESSION['temp']['ORDERS_id'];
                    $_POST['oddsrvid']= $_SESSION['temp']['SERVICE_id'];
                    $_POST['oddpvp']  = $RESULT_SERVICE[0]['srvpvp']*$_POST['oddcan'];
                    $_POST['odddes']  = "0";
                    $_POST['oddblo']  = $ORDERDETAIL->oddblo_enespera;

                    unset($_SESSION['temp']['SERVICE_id']);
                    $ORDERDETAIL->setter__($_POST);
                    $ORDERDETAIL->save();

                    echo $ORDERS->cards_total($_SESSION['temp']['ORDERS_id']);

                    echo $ORDERDETAIL->datatable_cards_solicitud($_SESSION['temp']['ORDERS_id']);

                      //$ORDERDETAIL->datatable_cards_estatu($ORDERS_id);

                      //echo $ORDERDETAIL->datatable_cards($_SESSION['temp']['ORDERS_id']);
                    exit; 
          }


          if($MODO==2)
          {

                    $ORDERDETAIL        = new orderDetailModelo();
                    $SUPPLIES = new suppliesModelo();
                    $_SESSION['temp']['SERVICE_id'] = $ORDERDETAIL->decrypt($_POST['v1']);

                    $RESULT_SUPPLIES = $SUPPLIES->select_all(" supest in ('t') and supsucid in (8) limit 0 , 10 ");

                    $res.="<form name='form001' id='form_odd' method='post'>
                    <input checked   name=\"supid[0]\" value=\"0\" style='display:none' type=\"checkbox\">
                    ";


                      foreach ($RESULT_SUPPLIES as $key ) 
                      {

                        $res.="<div class='col-md-4' style='margin-bottom:10px;'>
                        <input  name=\"supid[]\" value=\"".$key['supid']." \" id=\"supid".$key['supid']."\" type=\"checkbox\">
                        <label for=\"supid".$key['supid']."\" style='font-size:16px;font-weight:bold;'>".$key['supden']."</label>
                        </div>";

                      }

                      $res.="</form><div class=\"col-xs-12\">

                      <button data-dismiss=\"modal\" name=\"pagoparcial\" class=\"btn btn-success pull-right \"
                      value=\"true\"  onclick=\"submit_form_odd_click()\">
                      <i class=\"ace-icon fa fa-check bigger-110\"></i>
                      Siguiente
                      </button>
                      </div>";


                      echo $ORDERDETAIL->modal_content_view($res);
                      exit;
          }


          if($MODO==3)
          {
          }


          if($MODO==4){

                  $ORDERDETAIL        = new orderDetailModelo();
                  $SUPPLIES = new suppliesModelo();
                  $_SESSION['temp']['SERVICE_id'] = $ORDERDETAIL->decrypt($_POST['v1']);

                  $RESULT_SUPPLIES = $SUPPLIES->select_all(" supest in ('t') and supsrvid in (".$_SESSION['temp']['SERVICE_id'].") limit 0 , 10 ");

                  $res.="<form name='form001' id='form_odd' method='post'>
                  <input checked   name=\"supid[0]\" value=\"0\" style='display:none' type=\"checkbox\">
                  ";


                  foreach ($RESULT_SUPPLIES as $key ) 
                  {

                    $res.="<div class='col-md-4' style='margin-bottom:10px;'>
                    <input  name=\"supid[]\" value=\"".$key['supid']." \" id=\"supid".$key['supid']."\" type=\"checkbox\">
                    <label for=\"supid".$key['supid']."\" style='font-size:16px;font-weight:bold;'>".$key['supden']."</label>
                    </div>";

                  }

                  $res.="</form><div class=\"col-xs-12\">

                  <button data-dismiss=\"modal\" name=\"pagoparcial\" class=\"btn btn-success pull-right \"
                  value=\"true\"  onclick=\"submit_form_odd_click()\">
                  <i class=\"ace-icon fa fa-check bigger-110\"></i>
                  Siguiente
                  </button>
                  </div>";


                  echo $ORDERDETAIL->modal_content_view($res);
                  exit;
          }









}




if (($_POST['accion'] == "save_odd"))
{


  $SERVICE = new serviceModelo();
  $RESULT_SERVICE = $SERVICE->select_all(" srvid in (".$_SESSION['temp']['SERVICE_id'].") ");
  

  $ORDERS = new ordersModelo();



  $ORDERDETAIL = new orderDetailModelo();


  if ($_SESSION['temp']['orderDetail_id'])
  {
    $ORDERDETAIL->set_id($_SESSION['temp']['orderDetail_id'], 1);  
  }

  if(!$_POST['oddcan'])   $_POST['oddcan']  = 1;

  $_POST['oddcan']  = $_POST['oddcan'];
  $_POST['oddest']  = 't';
  $_POST['oddordid']= $_SESSION['temp']['ORDERS_id'];
  $_POST['oddsrvid']= $_SESSION['temp']['SERVICE_id'];
  $_POST['oddpvp']  = $RESULT_SERVICE[0]['srvpvp']*$_POST['oddcan'];
  $_POST['odddes']  = "0";
  $_POST['oddblo']  = $ORDERDETAIL->oddblo_enespera;


  $ORDERDETAIL->setter__($_POST);
  $ORDERDETAIL->save();
  $_SESSION['temp']['ORDERDETAIL_id'] = $ORDERDETAIL->ultimoId;







  for($i=0;$i<count($_POST['supid']);$i++) {



    $SUPPLIES = new suppliesModelo();
    $RESULT_SUPPLIES = $SUPPLIES->select_all(" supid in (".$_POST['supid'][$i].") ");
    

    if($_SESSION['temp']['MODO_ORDERS']==2){
      $_POST['srptip'] = ucfirst(substr($RESULT_SUPPLIES[0]['supden'],0,3));
    }


    if($_SESSION['temp']['MODO_ORDERS']==4){
      $_POST['srptip'] = "Con";
    }


    $SERVICEPREFERENCES = new servicePreferencesModelo();
    $SERVICEPREFERENCES->set_srpoddid($_SESSION['temp']['ORDERDETAIL_id']);
    $SERVICEPREFERENCES->set_srpsupid($_POST['supid'][$i]);
    $SERVICEPREFERENCES->set_srpest('t');
    $SERVICEPREFERENCES->set_srptip($_POST['srptip']);
    $SERVICEPREFERENCES->set_srpden($RESULT_SUPPLIES[0]['supden']);
    $SERVICEPREFERENCES->set_srpmod($_SESSION['temp']['MODO_ORDERS']);


    $SERVICEPREFERENCES->save();
  }
  
  unset($_SESSION['temp']['MODO_ORDERS']);
  unset($_SESSION['temp']['SERVICE_id']);
  echo $ORDERS->cards_total($_SESSION['temp']['ORDERS_id']);

  echo $ORDERDETAIL->datatable_cards_solicitud($_SESSION['temp']['ORDERS_id']);

      //$ORDERDETAIL->datatable_cards_estatu($ORDERS_id);


  exit;
}





?>
