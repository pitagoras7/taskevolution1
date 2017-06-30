<?php 
 require_once '../../url.php';
 session_start(); 
 
 
if ($_POST['accion'] == "edit_acm")
    {

        $ACTIVITYMESA = new activityMesaModelo();
        $ACTIVITYMESA->set_id($ACTIVITYMESA->decrypt($_POST['v1']));
        $RESULT_ACTIVITYMESA = $ACTIVITYMESA->select_all(1);
        $_SESSION['temp']['activityMesa_id'] = $ACTIVITYMESA->decrypt($_POST['v1']);
        echo $ACTIVITYMESA->modal_($RESULT_ACTIVITYMESA);
        exit;
    }





    if ($_POST['accion'] == "new_acm")
    {

        $ACTIVITYMESA = new activityMesaModelo();
        $ACTIVITYMESA->set_id(0);
        $_SESSION['temp']['mesa_id']=$ACTIVITYMESA->decrypt($_POST['v1']); 
        unset($_SESSION['temp']['activityMesa_id']);

        $RESULT_ACTIVITYMESA = $ACTIVITYMESA->select_all(1);

        $ACTIVITYMESA->modal_json = "form_pedido";
        echo $ACTIVITYMESA->modal_($RESULT_ACTIVITYMESA,'new');
        exit;
    }




    if (($_POST['accion'] == "save_acm"))
    {

      $ACTIVITYMESA = new activityMesaModelo();

      if ($_SESSION['temp']['activityMesa_id'])
      {
          $ACTIVITYMESA->set_id($_SESSION['temp']['activityMesa_id'], 1);  
      }

      $_POST['acmmesid'] = $_SESSION['temp']['mesa_id'];
      unset($_SESSION['temp']['mesa_id']);
      $ACTIVITYMESA->abrir($_POST);


      /* IMPRESION DE LAS MESAS */
      $MESA = new mesaModelo();
      $MESA->set_messalid(2);
      echo  $MESA->cardsimple_();

    //  echo $ACTIVITYMESA->datatable_();
      exit;
  }








if ($_POST['accion'] == "edit_acmest")
{



    $ACTIVITYMESA = new activityMesaModelo();
    $ACTIVITYMESA->set_acmmesid($ACTIVITYMESA->decrypt($_POST['v1']));
    $RESULT_ACTIVITYMESA = $ACTIVITYMESA->select_all(" acmmesid in (".$ACTIVITYMESA->get_acmmesid().") and acmest in ('t') limit 1 ");

    $_SESSION['temp']['ACTIVITYMESA_id'] = $RESULT_ACTIVITYMESA[0]['acmid'];
    unset($_SESSION['temp']['orders']);
    $_SESSION['temp']['orders']['here']=true;
    $_SESSION['temp']['MESA_id'] = $RESULT_ACTIVITYMESA[0]['acmmesid'];


    //$ACTIVITYMESA->modal_json ="form_acmest";
    

    $content = "

<a 
    href=\"?opcion=abrirOrders\" role=\"button\" 
    data-toggle=\"modal\" 
    onclick=\"\" 
    style=\"width: 80%;  margin:10px;  margin-left: 50px;\" class=\"btn  btn-app radius-4 btn-success\">

              <i class=\"ace-icon fa fa-pencil bigger-230\"></i>
              Abrir Pedido 

              </a>

    <a 
    href=\"\" role=\"\" 
    data-dismiss=\"modal\" 
    onclick=\"submit_modal_acmest_click( '2' )\" 
    style=\"    width: 80%;  margin:10px;  margin-left: 50px; \" class=\"btn  btn-app radius-4 btn-danger\">

              <i class=\"ace-icon fa fa-sign-out bigger-230\"></i>
              Cerrar Mesa

              </a>



              ";


    echo $ACTIVITYMESA->modal_content_view($content);
    


    exit;
}







if (($_POST['accion'] == "save_acmest_f")){

  $ACTIVITYMESA = new activityMesaModelo();


  $ACTIVITYMESA->set_id($_SESSION['temp']['ACTIVITYMESA_id'], 1);
  $_POST['acmest']='f'; 
  $ACTIVITYMESA->setter__($_POST);
  $ACTIVITYMESA->save();

  $MESA = new mesaModelo();
  $MESA->set_messalid(2);
  echo $MESA->cardsimple_();


  exit;


}





if (($_POST['accion'] == "save_acmest"))
{

    $ACTIVITYMESA = new activityMesaModelo();


    if ($_SESSION['temp']['ACTIVITYMESA_id'])
    {
      $ACTIVITYMESA->set_id($_SESSION['temp']['ACTIVITYMESA_id'], 1);  
  }


  $ACTIVITYMESA->setter__($_POST);
  $ACTIVITYMESA->save();
  $ACTIVITYMESA->id_dependiente = $_SESSION['temp']['service_id'];
  echo $ACTIVITYMESA->datatable_();
  exit;
}



if (($_POST['accion'] == "save_acmest"))
{

    $ACTIVITYMESA = new activityMesaModelo();


    if ($_SESSION['temp']['ACTIVITYMESA_id'])
    {
      $ACTIVITYMESA->set_id($_SESSION['temp']['ACTIVITYMESA_id'], 1);  
  }



  $ACTIVITYMESA->setter__($_POST);
  $ACTIVITYMESA->save();
  $ACTIVITYMESA->id_dependiente = $_SESSION['temp']['service_id'];
  echo $ACTIVITYMESA->datatable_();
  exit;
}

 
 

  ?>
  