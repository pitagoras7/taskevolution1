
  <?php
  session_start();
  include "../../../../url.php";


   # ACTIVAR ESTE CODIGO SI EL MODAL SERA TYPE SEARCH  
  /*



  if ($_POST['accion'] == "edit_examenFisico")
  {

   $ = new Modelo();
   $->set_id($_SESSION["temp"]["_id"]);
   $RESULT_ = $->select_all(1);
   
   $EXAMENFISICO = new Modelo();
   
   if($_POST["v1"]){
     $RESULT_EXAMENFISICO = $EXAMENFISICO->select_all(" cliid in (".$EXAMENFISICO->decrypt($_POST["v1"]).")" );    
   }else if($RESULT_ORDERS[""]>0){
     $RESULT_EXAMENFISICO = $EXAMENFISICO->select_all(" cliid in (".$RESULT_[""].")" );    
   }
   
   $JSON = $EXAMENFISICO->soyjson($EXAMENFISICO->tabla,"modal","clienteOrder");
   echo $EXAMENFISICO->MODAL__($JSON,$RESULT_EXAMENFISICO[0]);
   exit;
 }

   */


 if ($_POST['accion'] == "edit_examenFisico")
 {

   $EXAMENFISICO = new examenFisicoModelo();
   $EXAMENFISICO->set_id($EXAMENFISICO->decrypt($_POST['v1']));
   $RESULT_EXAMENFISICO = $EXAMENFISICO->select_all(1);
   $_SESSION['temp']['EXAMENFISICO_id'] = $EXAMENFISICO->decrypt($_POST['v1']);
   $JSON = $EXAMENFISICO->soyjson($EXAMENFISICO->tabla,'modal','examenFisico');
   echo $EXAMENFISICO->MODAL__($JSON,$RESULT_EXAMENFISICO);
   exit;
 }




 if ($_POST['accion'] == "new_examenFisico")
 {
   unset($_SESSION['temp']['EXAMENFISICO_id']);
   $EXAMENFISICO = new examenFisicoModelo();
   $EXAMENFISICO->set_id(0);
   $RESULT_EXAMENFISICO = $EXAMENFISICO->select_all(1);
   
   $JSON = $EXAMENFISICO->soyjson($EXAMENFISICO->tabla,'modal','examenFisico');
   echo $EXAMENFISICO->MODAL__($JSON,$RESULT_EXAMENFISICO);
   exit;
 }

 if (($_POST['accion'] == "save_examenFisico"))
 {

   $EXAMENFISICO = new examenFisicoModelo();
   
   if ($_SESSION['temp']['EXAMENFISICO_id'])
   {
     $EXAMENFISICO->set_id($_SESSION['temp']['EXAMENFISICO_id'], 1);
   }
   
   $EXAMENFISICO->setter__($_POST);
   $EXAMENFISICO->save();
       #**************************** IMPORTANTE EDITAR DE soyjsondatatable EL ULTIMO PARAMETRO ******************************************
   
   $JSON = $EXAMENFISICO->soyjsondatatable($EXAMENFISICO->tabla,'datatable','examenFisico');
   echo $EXAMENFISICO->DATATABLE__($JSON);
   exit;
 }

 ?>