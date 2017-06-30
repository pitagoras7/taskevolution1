
  <?php
  session_start();
  include "../../../../url.php";


   # ACTIVAR ESTE CODIGO SI EL MODAL SERA TYPE SEARCH  
  /*



  if ($_POST['accion'] == "edit_reportePacienteIndividual")
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


 if ($_POST['accion'] == "edit_reportePacienteIndividual")
 {


   $PACIENTE = new pacienteModelo();
   $PACIENTE->set_id($_SESSION['temp']['PACIENTE_id']);
   $RESULT_PACIENTE = $PACIENTE->select_all(1);
   $_SESSION['temp']['PACIENTE_id'] = $_SESSION['temp']['PACIENTE_id'];
   $JSON = $PACIENTE->soyjson($PACIENTE->tabla,'modal','reportePacienteIndividual');
   echo $PACIENTE->MODAL__($JSON,$RESULT_PACIENTE);
   exit;
 }



 ?>