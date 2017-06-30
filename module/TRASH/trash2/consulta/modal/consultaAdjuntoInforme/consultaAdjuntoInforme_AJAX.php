
  <?php
  session_start();
  include "../../../../url.php";


   # ACTIVAR ESTE CODIGO SI EL MODAL SERA TYPE SEARCH  
  /*



  if ($_POST['accion'] == "edit_consultaAdjuntoInforme")
  {

   $ = new Modelo();
   $->set_id($_SESSION["temp"]["_id"]);
   $RESULT_ = $->select_all(1);
   
   $CONSULTA = new Modelo();
   
   if($_POST["v1"]){
     $RESULT_CONSULTA = $CONSULTA->select_all(" cliid in (".$CONSULTA->decrypt($_POST["v1"]).")" );    
   }else if($RESULT_ORDERS[""]>0){
     $RESULT_CONSULTA = $CONSULTA->select_all(" cliid in (".$RESULT_[""].")" );    
   }
   
   $JSON = $CONSULTA->soyjson($CONSULTA->tabla,"modal","clienteOrder");
   echo $CONSULTA->MODAL__($JSON,$RESULT_CONSULTA[0]);
   exit;
 }

   */


 if ($_POST['accion'] == "edit_consultaAdjuntoInforme")
 {

    $CONSULTA = new   consultaModelo();
    $JSON = $CONSULTA->json_element($CONSULTA->tabla,'datatable_informeAdjunto');
    echo $CONSULTA->modal_content_view($CONSULTA->DATATABLE__($JSON));  
     exit;
 }




 if ($_POST['accion'] == "new_consultaAdjuntoInforme")
 {
   unset($_SESSION['temp']['CONSULTA_id']);
   $CONSULTA = new consultaModelo();
   $CONSULTA->set_id(0);
   $RESULT_CONSULTA = $CONSULTA->select_all(1);
   
   $JSON = $CONSULTA->soyjson($CONSULTA->tabla,'modal','consultaAdjuntoInforme');
   echo $CONSULTA->MODAL__($JSON,$RESULT_CONSULTA);
   exit;
 }

 if (($_POST['accion'] == "save_consultaAdjuntoInforme"))
 {

   $CONSULTA = new consultaModelo();
   
   if ($_SESSION['temp']['CONSULTA_id'])
   {
     $CONSULTA->set_id($_SESSION['temp']['CONSULTA_id'], 1);
   }
   
   $CONSULTA->setter__($_POST);
   $CONSULTA->save();
       #**************************** IMPORTANTE EDITAR DE soyjsondatatable EL ULTIMO PARAMETRO ******************************************
   
   $JSON = $CONSULTA->soyjsondatatable($CONSULTA->tabla,'datatable','consultaAdjuntoInforme');
   echo $CONSULTA->DATATABLE__($JSON);
   exit;
 }

 ?>