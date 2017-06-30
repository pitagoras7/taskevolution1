
  <?php
  session_start();
  include "../../../../url.php";


   # ACTIVAR ESTE CODIGO SI EL MODAL SERA TYPE SEARCH  
  /*



  if ($_POST['accion'] == "edit_doctorRegistro")
  {

   $ = new Modelo();
   $->set_id($_SESSION["temp"]["_id"]);
   $RESULT_ = $->select_all(1);
   
   $DOCTOR = new Modelo();
   
   if($_POST["v1"]){
     $RESULT_DOCTOR = $DOCTOR->select_all(" cliid in (".$DOCTOR->decrypt($_POST["v1"]).")" );    
   }else if($RESULT_ORDERS[""]>0){
     $RESULT_DOCTOR = $DOCTOR->select_all(" cliid in (".$RESULT_[""].")" );    
   }
   
   $JSON = $DOCTOR->soyjson($DOCTOR->tabla,"modal","clienteOrder");
   echo $DOCTOR->MODAL__($JSON,$RESULT_DOCTOR[0]);
   exit;
 }

   */


 if ($_POST['accion'] == "edit_doctorRegistro")
 {

   $DOCTOR = new doctorModelo();
   $DOCTOR->set_id(1);
   $RESULT_DOCTOR = $DOCTOR->select_all(1);
   $_SESSION['temp']['DOCTOR_id'] = $DOCTOR->decrypt($_POST['v1']);
   $JSON = $DOCTOR->soyjson($DOCTOR->tabla,'modal','doctorRegistro');
   echo $DOCTOR->MODAL__($JSON,$RESULT_DOCTOR);
   exit;
 }




 if ($_POST['accion'] == "new_doctorRegistro")
 {
   unset($_SESSION['temp']['DOCTOR_id']);
   $DOCTOR = new doctorModelo();
   $DOCTOR->set_id(0);
   $RESULT_DOCTOR = $DOCTOR->select_all(1);
   
   $JSON = $DOCTOR->soyjson($DOCTOR->tabla,'modal','doctorRegistro');
   echo $DOCTOR->MODAL__($JSON,$RESULT_DOCTOR);
   exit;
 }

 if (($_POST['accion'] == "save_doctorRegistro"))
 {

   $DOCTOR = new doctorModelo();
   
   if ($_SESSION['temp']['DOCTOR_id'])
   {
     $DOCTOR->set_id($_SESSION['temp']['DOCTOR_id'], 1);
   }
   
   $DOCTOR->setter__($_POST);
   $DOCTOR->save();
       #**************************** IMPORTANTE EDITAR DE soyjsondatatable EL ULTIMO PARAMETRO ******************************************
   
   $JSON = $DOCTOR->soyjsondatatable($DOCTOR->tabla,'datatable','doctorRegistro');
   echo $DOCTOR->DATATABLE__($JSON);
   exit;
 }

 ?>