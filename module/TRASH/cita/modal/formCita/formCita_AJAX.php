
  <?php
  session_start();
  include "../../../../url.php";


   # ACTIVAR ESTE CODIGO SI EL MODAL SERA TYPE SEARCH  
  /*



  if ($_POST['accion'] == "edit_formCita")
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


 if ($_POST['accion'] == "edit_formCita")
 {

   $CITA = new citaModelo();
   $CITA->set_id($CITA->decrypt($_POST['v1']));
   $RESULT_CITA = $CITA->select_all(1);
   $_SESSION['temp']['CITA_id'] = $CITA->decrypt($_POST['v1']);


   $JSON = $CITA->soyjson($CITA->tabla,'modal','formCita');
   echo $CITA->MODAL__($JSON,$RESULT_CITA);
   exit;
 }




 if ($_POST['accion'] == "new_formCita")
 {
   unset($_SESSION['temp']['CITA_id']);
   $CITA = new citaModelo();
   $CITA->set_id(0);
   $RESULT_CITA = $CITA->select_all(1);
   
   $JSON = $CITA->soyjson($CITA->tabla,'modal','formCita');
   echo $CITA->MODAL__($JSON,$RESULT_CITA);
   exit;
 }

 if (($_POST['accion'] == "save_formCita"))
 {

   $CITA = new citaModelo();
   
   if ($_SESSION['temp']['CITA_id'])
   {
     $CITA->set_id($_SESSION['temp']['CITA_id'], 1);
   }
   
   $CITA->setter__($_POST);
   $CITA->save();
       #**************************** IMPORTANTE EDITAR DE soyjsondatatable EL ULTIMO PARAMETRO ******************************************
   
   $JSON = $CITA->soyjsondatatable($CITA->tabla,'datatable','formCita');
   echo $CITA->DATATABLE__($JSON);
   exit;
 }

 ?>