<?php
session_start();
include '../../url.php';


if ($_POST['accion'] == "new_ssp")
{

    $SERVICESUPPLIES = new serviceSuppliesModelo();
    $SERVICESUPPLIES->set_id(0);
    unset($_SESSION['temp']['serviceSupplies_id']);
    $SERVICESUPPLIES->id_dependiente = $_SESSION['temp']['service_id'];
    $RESULT_SERVICESUPPLIES = $SERVICESUPPLIES->select_all(1);
    echo $SERVICESUPPLIES->modal_($RESULT_SERVICESUPPLIES,'new');
    exit;
}




if (($_POST['accion'] == "save_ssp"))
{

    $SERVICESUPPLIES = new serviceSuppliesModelo();
    $var= $_POST['sspsupid'];
    $SERVICESUPPLIES->reset($_SESSION['temp']['service_id']);


    for ($i=0; $i < count($var); $i++) { 

        $SERVICESUPPLIES = new serviceSuppliesModelo();
        

        if ($_SESSION['temp']['serviceSupplies_id'])
        {
          $SERVICESUPPLIES->set_id($_SESSION['temp']['serviceSupplies_id'], 1);  
      }
      
      $_POST['sspsupid']=$var[$i];
      $_POST['sspsrvid']=$_SESSION['temp']['service_id']; 
      $SERVICESUPPLIES->setter__($_POST);

        #SOLO REGISTRA LOS REGISTRO Q NO ESTAN EN LA LISTA 
        /*if($SERVICESUPPLIES->validation($_POST['sspsupid'],$_POST['sspsrvid'])) {
            $SERVICESUPPLIES->save();
        } */

        $SERVICESUPPLIES->save();
    }


    $SERVICESUPPLIES->id_dependiente = $_SESSION['temp']['service_id'];
    echo $SERVICESUPPLIES->datatable_();
    exit;
}






if ($_POST['accion'] == "edit_sspcan")
{

    $SERVICESUPPLIES = new serviceSuppliesModelo();
    $SERVICESUPPLIES->set_id($SERVICESUPPLIES->decrypt($_POST['v1']));
    $RESULT_SERVICESUPPLIES = $SERVICESUPPLIES->select_all(1);
    $_SESSION['temp']['SERVICESUPPLIES_id'] = $SERVICESUPPLIES->decrypt($_POST['v1']);
    $SERVICESUPPLIES->modal_json ="form_sspcan";
    echo $SERVICESUPPLIES->modal_($RESULT_SERVICESUPPLIES);
    exit;
}


if (($_POST['accion'] == "save_sspcan"))
{

    $SERVICESUPPLIES = new serviceSuppliesModelo();


    if ($_SESSION['temp']['SERVICESUPPLIES_id'])
    {
      $SERVICESUPPLIES->set_id($_SESSION['temp']['SERVICESUPPLIES_id'], 1);  
  }


  
  $SERVICESUPPLIES->setter__($_POST);
  $SERVICESUPPLIES->save();
  $SERVICESUPPLIES->id_dependiente = $_SESSION['temp']['service_id'];
  echo $SERVICESUPPLIES->datatable_();
  exit;
}


?>

