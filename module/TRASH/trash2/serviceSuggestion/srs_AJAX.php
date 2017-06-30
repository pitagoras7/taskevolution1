<?php  session_start(); 

require_once '../../url.php';



if ($_POST['accion'] == "edit_srs")
{

  $SERVICESUGGESTION = new serviceSuggestionModelo();
  $SERVICESUGGESTION->set_id($SERVICESUGGESTION->decrypt($_POST['v1']));
  $RESULT_SERVICESUGGESTION = $SERVICESUGGESTION->select_all(1);
  $_SESSION['temp']['serviceSuggestion_id'] = $SERVICESUGGESTION->decrypt($_POST['v1']);
  echo $SERVICESUGGESTION->modal_($RESULT_SERVICESUGGESTION);
  exit;
}

if ($_POST['accion'] == "new_srs")
{

  $SERVICESUGGESTION = new serviceSuggestionModelo();
  $SERVICESUGGESTION->set_id(0);
  unset($_SESSION['temp']['serviceSuggestion_id']);
  $SERVICESUGGESTION->id_dependiente = $_SESSION['temp']['service_id'];

  $RESULT_SERVICESUGGESTION = $SERVICESUGGESTION->select_all(1);
  echo $SERVICESUGGESTION->modal_($RESULT_SERVICESUGGESTION,'new');
  exit;
}


    /*

    $SERVICESUPPLIES = new serviceSuppliesModelo();
    $SERVICESUPPLIES->set_id(0);
    unset($_SESSION['temp']['serviceSupplies_id']);
    $SERVICESUPPLIES->id_dependiente = $_SESSION['temp']['service_id'];
    $RESULT_SERVICESUPPLIES = $SERVICESUPPLIES->select_all(1);
    echo $SERVICESUPPLIES->modal_($RESULT_SERVICESUPPLIES,'new');

    */

    if (($_POST['accion'] == "save_srs"))
    {


      $SERVICESUGGESTION = new serviceSuggestionModelo();
      $var= $_POST['srssugid'];
      $SERVICESUGGESTION->reset($_SESSION['temp']['service_id']);


      for ($i=0; $i < count($var); $i++) { 

        $SERVICESUGGESTION = new serviceSuggestionModelo();
        

        if ($_SESSION['temp']['serviceSuggestion_id'])
        {
          $SERVICESUGGESTION->set_id($_SESSION['temp']['serviceSuggestion_id'], 1);  
        }

        $_POST['srssugid']=$var[$i];
        $_POST['srssrvid']=$_SESSION['temp']['service_id']; 
        $_POST['srsest']='t';         
        $SERVICESUGGESTION->setter__($_POST);

        #SOLO REGISTRA LOS REGISTRO Q NO ESTAN EN LA LISTA 
        /*if($SERVICESUPPLIES->validation($_POST['sspsupid'],$_POST['sspsrvid'])) {
            $SERVICESUPPLIES->save();
          } */

          $SERVICESUGGESTION->save();
        }


        $SERVICESUGGESTION->id_dependiente = $_SESSION['temp']['service_id'];
        echo $SERVICESUGGESTION->datatable_();
        exit;
      }




      ?>
