<?php  session_start(); 

require_once '../../url.php';



if ($_POST['accion'] == "edit_anx")
{

 $ANEXO = new anexoModelo();
 $ANEXO->set_id($ANEXO->decrypt($_POST['v1']));
 $RESULT_ANEXO = $ANEXO->select_all(1);
 $_SESSION['temp']['anexo_id'] = $ANEXO->decrypt($_POST['v1']);
 echo $ANEXO->modal_($RESULT_ANEXO);
 exit;
}

if ($_POST['accion'] == "new_anx")
{

 $ANEXO = new anexoModelo();
 $ANEXO->set_id(0);
 unset($_SESSION['temp']['anexo_id']);

 $RESULT_ANEXO = $ANEXO->select_all(1);
 echo $ANEXO->modal_($RESULT_ANEXO,'new');
 exit;
}

if (($_POST['accion'] == "save_anx"))
{

 $ANEXO = new anexoModelo();


 if ($_SESSION['temp']['anexo_id'])
 {
   $ANEXO->set_id($_SESSION['temp']['anexo_id'], 1);  
 }



 $ANEXO->setter__($_POST);
 $ANEXO->save();
 echo $ANEXO->datatable_();
 exit;
}


if ($_POST['accion'] == "filter_cards_")
{

  $ANEXO = new anexoModelo();
  $tabla_anexo = $ANEXO->mostrar_anexo($_POST['parametro'],false);
  $_SESSION['temp']['tabla_anexo'] = $tabla_anexo;




  if($_SESSION['temp']['tabla_anexo']=="enfermedad"){

    $ENFERMEDAD = new enfermedadModelo(); 
    $JSON = $ENFERMEDAD->json_element($ENFERMEDAD->tabla,'datatable_consulta');
    echo $ENFERMEDAD->DATATABLE__($JSON);      

  }


  if($_SESSION['temp']['tabla_anexo']=="medicamento"){

    $MEDICAMENTO = new medicamentoModelo(); 
    $JSON = $MEDICAMENTO->json_element($MEDICAMENTO->tabla,'datatable_consulta');
    echo $MEDICAMENTO->DATATABLE__($JSON);      

  }

}


?>
