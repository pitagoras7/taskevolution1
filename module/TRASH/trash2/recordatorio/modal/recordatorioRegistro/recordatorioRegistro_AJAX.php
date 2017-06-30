
  <?php
  session_start();
  include "../../../../url.php";


   # ACTIVAR ESTE CODIGO SI EL MODAL SERA TYPE SEARCH  
  /*



  if ($_POST['accion'] == "edit_recordatorioRegistro")
  {

   $ = new Modelo();
   $->set_id($_SESSION["temp"]["_id"]);
   $RESULT_ = $->select_all(1);
   
   $RECORDATORIO = new Modelo();
   
   if($_POST["v1"]){
     $RESULT_RECORDATORIO = $RECORDATORIO->select_all(" cliid in (".$RECORDATORIO->decrypt($_POST["v1"]).")" );    
   }else if($RESULT_ORDERS[""]>0){
     $RESULT_RECORDATORIO = $RECORDATORIO->select_all(" cliid in (".$RESULT_[""].")" );    
   }
   
   $JSON = $RECORDATORIO->soyjson($RECORDATORIO->tabla,"modal","clienteOrder");
   echo $RECORDATORIO->MODAL__($JSON,$RESULT_RECORDATORIO[0]);
   exit;
 }

   */


 if ($_POST['accion'] == "edit_recordatorioRegistro")
 {

   $RECORDATORIO = new recordatorioModelo();
   $RECORDATORIO->set_id($RECORDATORIO->decrypt($_POST['v1']));
   $RESULT_RECORDATORIO = $RECORDATORIO->select_all(1);
   $_SESSION['temp']['RECORDATORIO_id'] = $RECORDATORIO->decrypt($_POST['v1']);
   $JSON = $RECORDATORIO->soyjson($RECORDATORIO->tabla,'modal','recordatorioRegistro');
   echo $RECORDATORIO->MODAL__($JSON,$RESULT_RECORDATORIO);
   exit;
 }




 if ($_POST['accion'] == "new_recordatorioRegistro")
 {
   unset($_SESSION['temp']['RECORDATORIO_id']);
   $RECORDATORIO = new recordatorioModelo();
   $RECORDATORIO->set_id(0);
   $RESULT_RECORDATORIO = $RECORDATORIO->select_all(1);
   
   $JSON = $RECORDATORIO->soyjson($RECORDATORIO->tabla,'modal','recordatorioRegistro');
   echo $RECORDATORIO->MODAL__($JSON,$RESULT_RECORDATORIO);
   exit;
 }

 if (($_POST['accion'] == "save_recordatorioRegistro"))
 {

   $RECORDATORIO = new recordatorioModelo();
   
   if ($_SESSION['temp']['RECORDATORIO_id'])
   {
     $RECORDATORIO->set_id($_SESSION['temp']['RECORDATORIO_id'], 1);
   }
   
   $RECORDATORIO->setter__($_POST);
   $RECORDATORIO->save();
       #**************************** IMPORTANTE EDITAR DE soyjsondatatable EL ULTIMO PARAMETRO ******************************************
   
  $RECORDATORIO->DATATABLE_CONDICIONAL=" 1=1  ";
  $JSON = $RECORDATORIO->json_element($RECORDATORIO->tabla,'datatable_consulta');
 echo $RECORDATORIO->DATATABLE__($JSON);

   exit;
 }

 ?>