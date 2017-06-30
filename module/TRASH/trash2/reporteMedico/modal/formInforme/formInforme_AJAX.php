
  <?php
  session_start();
  include "../../../../url.php";


   # ACTIVAR ESTE CODIGO SI EL MODAL SERA TYPE SEARCH  
  /*



  if ($_POST['accion'] == "edit_formInforme")
  {

   $ = new Modelo();
   $->set_id($_SESSION["temp"]["_id"]);
   $RESULT_ = $->select_all(1);
   
   $REPORTEMEDICO = new Modelo();
   
   if($_POST["v1"]){
     $RESULT_REPORTEMEDICO = $REPORTEMEDICO->select_all(" cliid in (".$REPORTEMEDICO->decrypt($_POST["v1"]).")" );    
   }else if($RESULT_ORDERS[""]>0){
     $RESULT_REPORTEMEDICO = $REPORTEMEDICO->select_all(" cliid in (".$RESULT_[""].")" );    
   }
   
   $JSON = $REPORTEMEDICO->soyjson($REPORTEMEDICO->tabla,"modal","clienteOrder");
   echo $REPORTEMEDICO->MODAL__($JSON,$RESULT_REPORTEMEDICO[0]);
   exit;
 }

   */


 if ($_POST['accion'] == "edit_formInforme")
 {

   $REPORTEMEDICO = new reporteMedicoModelo();
   $REPORTEMEDICO->set_id($REPORTEMEDICO->decrypt($_POST['v1']));
   $RESULT_REPORTEMEDICO = $REPORTEMEDICO->select_all(1);
   $_SESSION['temp']['REPORTEMEDICO_id'] = $REPORTEMEDICO->decrypt($_POST['v1']);
   $JSON = $REPORTEMEDICO->soyjson($REPORTEMEDICO->tabla,'modal','formInforme');
   echo $REPORTEMEDICO->MODAL__($JSON,$RESULT_REPORTEMEDICO);
   exit;
 }




 if ($_POST['accion'] == "new_formInforme")
 {
   unset($_SESSION['temp']['REPORTEMEDICO_id']);
   $REPORTEMEDICO = new reporteMedicoModelo();
   $REPORTEMEDICO->set_id(0);
   $RESULT_REPORTEMEDICO = $REPORTEMEDICO->select_all(1);
   
   $JSON = $REPORTEMEDICO->soyjson($REPORTEMEDICO->tabla,'modal','formInforme');
   echo $REPORTEMEDICO->MODAL__($JSON,$RESULT_REPORTEMEDICO);
   exit;
 }

 if (($_POST['accion'] == "save_formInforme"))
 {

   $REPORTEMEDICO = new reporteMedicoModelo();
   
   if ($_SESSION['temp']['REPORTEMEDICO_id'])
   {
     $REPORTEMEDICO->set_id($_SESSION['temp']['REPORTEMEDICO_id'], 1);
   }
   
   $REPORTEMEDICO->setter__($_POST);
   $REPORTEMEDICO->save();
       #**************************** IMPORTANTE EDITAR DE soyjsondatatable EL ULTIMO PARAMETRO ******************************************
   
   $JSON = $REPORTEMEDICO->soyjsondatatable($REPORTEMEDICO->tabla,'datatable','formInforme');
   echo $REPORTEMEDICO->DATATABLE__($JSON);
   exit;
 }

 ?>