<?php  session_start(); 
 
 require_once '../../url.php';



 
if ($_POST['accion'] == "edit_srscan")
{

    $SERVICESUGGESTION = new serviceSuggestionModelo();
    $SERVICESUGGESTION->set_id($SERVICESUGGESTION->decrypt($_POST['v1']));
    $RESULT_SERVICESUGGESTION = $SERVICESUGGESTION->select_all(1);
    $_SESSION['temp']['SERVICESUGGESTION_id'] = $SERVICESUGGESTION->decrypt($_POST['v1']);
    $SERVICESUGGESTION->modal_json ="form_srscan";
    echo $SERVICESUGGESTION->modal_($RESULT_SERVICESUGGESTION);
    exit;
}


if (($_POST['accion'] == "save_srscan"))
{

    $SERVICESUGGESTION = new serviceSuggestionModelo();


    if ($_SESSION['temp']['SERVICESUGGESTION_id'])
    {
      $SERVICESUGGESTION->set_id($_SESSION['temp']['SERVICESUGGESTION_id'], 1);  
  }


  $SERVICESUGGESTION->setter__($_POST);
  $SERVICESUGGESTION->save();
  $SERVICESUGGESTION->id_dependiente = $_SESSION['temp']['service_id'];
  echo $SERVICESUGGESTION->datatable_();
  exit;
}
  ?>
  