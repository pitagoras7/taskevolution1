
  <?php
  session_start();
  include "../../../../url.php";


   # ACTIVAR ESTE CODIGO SI EL MODAL SERA TYPE SEARCH  
  /*



  if ($_POST['accion'] == "edit_reporteCitaIndividual")
  {

   $ = new Modelo();
   $->set_id($_SESSION["temp"]["_id"]);
   $RESULT_ = $->select_all(1);
   
   $CITA = new Modelo();
   
   if($_POST["v1"]){
     $RESULT_CITA = $CITA->select_all(" cliid in (".$CITA->decrypt($_POST["v1"]).")" );    
   }else if($RESULT_ORDERS[""]>0){
     $RESULT_CITA = $CITA->select_all(" cliid in (".$RESULT_[""].")" );    
   }
   
   $JSON = $CITA->soyjson($CITA->tabla,"modal","clienteOrder");
   echo $CITA->MODAL__($JSON,$RESULT_CITA[0]);
   exit;
 }

   */


 if ($_POST['accion'] == "edit_reporteCitaIndividual")
 {

   $CITA = new citaModelo();
   $CITA->set_id($CITA->decrypt($_POST['v1']));

   

   $_POST['cittur']    = $CITA->reg();    

   $RESULT_CITA = $CITA->select_all(1);
   $_SESSION['temp']['CITA_id'] = $CITA->decrypt($_POST['v1']);
   $JSON = $CITA->soyjson($CITA->tabla,'modal','reporteCitaIndividual');
   echo $CITA->MODAL__($JSON,$RESULT_CITA);
   exit;
 }



 ?>