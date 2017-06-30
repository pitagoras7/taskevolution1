
  <?php
  session_start();
  include "../../../../url.php";


   # ACTIVAR ESTE CODIGO SI EL MODAL SERA TYPE SEARCH  
  /*



  if ($_POST['accion'] == "edit_formPaciente")
  {

   $ = new Modelo();
   $->set_id($_SESSION["temp"]["_id"]);
   $RESULT_ = $->select_all(1);
   
   $PACIENTE = new Modelo();
   
   if($_POST["v1"]){
     $RESULT_PACIENTE = $PACIENTE->select_all(" cliid in (".$PACIENTE->decrypt($_POST["v1"]).")" );    
   }else if($RESULT_ORDERS[""]>0){
     $RESULT_PACIENTE = $PACIENTE->select_all(" cliid in (".$RESULT_[""].")" );    
   }
   
   $JSON = $PACIENTE->soyjson($PACIENTE->tabla,"modal","clienteOrder");
   echo $PACIENTE->MODAL__($JSON,$RESULT_PACIENTE[0]);
   exit;
 }

   */


 if ($_POST['accion'] == "edit_formPaciente")
 {

   $PACIENTE = new pacienteModelo();
   $PACIENTE->set_id($PACIENTE->decrypt($_POST['v1']));
   $RESULT_PACIENTE = $PACIENTE->select_all(1);
   $_SESSION['temp']['PACIENTE_id'] = $PACIENTE->decrypt($_POST['v1']);
   $JSON = $PACIENTE->soyjson($PACIENTE->tabla,'modal','formPaciente');
   echo $PACIENTE->MODAL__($JSON,$RESULT_PACIENTE);
   exit;
 }




 if ($_POST['accion'] == "new_formPaciente")
 {
   unset($_SESSION['temp']['PACIENTE_id']);
   $PACIENTE = new pacienteModelo();
   $PACIENTE->set_id(0);
   $RESULT_PACIENTE = $PACIENTE->select_all(1);
   
   $JSON = $PACIENTE->soyjson($PACIENTE->tabla,'modal','formPaciente');
   echo $PACIENTE->MODAL__($JSON,$RESULT_PACIENTE);
   exit;
 }

 if (($_POST['accion'] == "save_formPaciente"))
 {

   $PACIENTE = new pacienteModelo();
   
   if ($_SESSION['temp']['PACIENTE_id'])
   {
     $PACIENTE->set_id($_SESSION['temp']['PACIENTE_id'], 1);
   }
   
   $PACIENTE->setter__($_POST);
   $PACIENTE->save();
       #**************************** IMPORTANTE EDITAR DE soyjsondatatable EL ULTIMO PARAMETRO ******************************************
   
   $JSON = $PACIENTE->soyjsondatatable($PACIENTE->tabla,'datatable','formPaciente');
   echo $PACIENTE->DATATABLE__($JSON);
   exit;
 }

 ?>