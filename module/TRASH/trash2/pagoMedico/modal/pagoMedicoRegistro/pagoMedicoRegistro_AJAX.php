
  <?php
  session_start();
  include "../../../../url.php";


   # ACTIVAR ESTE CODIGO SI EL MODAL SERA TYPE SEARCH  
  /*



  if ($_POST['accion'] == "edit_pagoMedicoRegistro")
  {

   $ = new Modelo();
   $->set_id($_SESSION["temp"]["_id"]);
   $RESULT_ = $->select_all(1);
   
   $PAGOMEDICO = new Modelo();
   
   if($_POST["v1"]){
     $RESULT_PAGOMEDICO = $PAGOMEDICO->select_all(" cliid in (".$PAGOMEDICO->decrypt($_POST["v1"]).")" );    
   }else if($RESULT_ORDERS[""]>0){
     $RESULT_PAGOMEDICO = $PAGOMEDICO->select_all(" cliid in (".$RESULT_[""].")" );    
   }
   
   $JSON = $PAGOMEDICO->soyjson($PAGOMEDICO->tabla,"modal","clienteOrder");
   echo $PAGOMEDICO->MODAL__($JSON,$RESULT_PAGOMEDICO[0]);
   exit;
 }

   */


 if ($_POST['accion'] == "edit_pagoMedicoRegistro")
 {

   $PAGOMEDICO = new pagoMedicoModelo();
   $PAGOMEDICO->set_id($PAGOMEDICO->decrypt($_POST['v1']));
   $RESULT_PAGOMEDICO = $PAGOMEDICO->select_all(1);
   $_SESSION['temp']['PAGOMEDICO_id'] = $PAGOMEDICO->decrypt($_POST['v1']);
   $JSON = $PAGOMEDICO->soyjson($PAGOMEDICO->tabla,'modal','pagoMedicoRegistro');
   echo $PAGOMEDICO->MODAL__($JSON,$RESULT_PAGOMEDICO);
   exit;
 }




 if ($_POST['accion'] == "new_pagoMedicoRegistro")
 {
   unset($_SESSION['temp']['PAGOMEDICO_id']);
   $PAGOMEDICO = new pagoMedicoModelo();
   $PAGOMEDICO->set_id(0);
   $RESULT_PAGOMEDICO = $PAGOMEDICO->select_all(1);

   $_SESSION['temp']['PACIENTE_id'] = $PAGOMEDICO->decrypt($_POST['v1']);

   $JSON = $PAGOMEDICO->soyjson($PAGOMEDICO->tabla,'modal','pagoMedicoRegistro');
   echo $PAGOMEDICO->MODAL__($JSON,$RESULT_PAGOMEDICO);
   exit;
 }

 if (($_POST['accion'] == "save_pagoMedicoRegistro"))
 {

   $PAGOMEDICO = new pagoMedicoModelo();
   
   if ($_SESSION['temp']['PAGOMEDICO_id'])
   {
     $PAGOMEDICO->set_id($_SESSION['temp']['PAGOMEDICO_id'], 1);
   }

   $_POST['pagpacid']=$_SESSION['temp']['PACIENTE_id'];
   unset($_SESSION['temp']['PACIENTE_id']);

   $PAGOMEDICO->setter__($_POST);
   $PAGOMEDICO->save();
       #**************************** IMPORTANTE EDITAR DE soyjsondatatable EL ULTIMO PARAMETRO ******************************************
   
   $JSON = $PAGOMEDICO->soyjsondatatable($PAGOMEDICO->tabla,'datatable','pagoMedicoRegistro');
   echo $PAGOMEDICO->DATATABLE__($JSON);
   exit;
 }

 ?>