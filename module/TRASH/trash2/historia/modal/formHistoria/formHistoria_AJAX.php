
  <?php
  session_start();
  include "../../../../url.php";


   # ACTIVAR ESTE CODIGO SI EL MODAL SERA TYPE SEARCH  
  /*



  if ($_POST['accion'] == "edit_formHistoria")
  {

   $ = new Modelo();
   $->set_id($_SESSION["temp"]["_id"]);
   $RESULT_ = $->select_all(1);
   
   $HISTORIA = new Modelo();
   
   if($_POST["v1"]){
     $RESULT_HISTORIA = $HISTORIA->select_all(" cliid in (".$HISTORIA->decrypt($_POST["v1"]).")" );    
   }else if($RESULT_ORDERS[""]>0){
     $RESULT_HISTORIA = $HISTORIA->select_all(" cliid in (".$RESULT_[""].")" );    
   }
   
   $JSON = $HISTORIA->soyjson($HISTORIA->tabla,"modal","clienteOrder");
   echo $HISTORIA->MODAL__($JSON,$RESULT_HISTORIA[0]);
   exit;
 }

   */


 if ($_POST['accion'] == "edit_formHistoria")
 {

   $HISTORIA = new historiaModelo();
   $HISTORIA->set_id($HISTORIA->decrypt($_POST['v1']));
   $RESULT_HISTORIA = $HISTORIA->select_all(1);
   $_SESSION['temp']['HISTORIA_id'] = $HISTORIA->decrypt($_POST['v1']);
   $JSON = $HISTORIA->soyjson($HISTORIA->tabla,'modal','formHistoria');
   echo $HISTORIA->MODAL__($JSON,$RESULT_HISTORIA);
   exit;
 }




 if ($_POST['accion'] == "new_formHistoria")
 {
   unset($_SESSION['temp']['HISTORIA_id']);
   $HISTORIA = new historiaModelo();
   $HISTORIA->set_id(0);
   $RESULT_HISTORIA = $HISTORIA->select_all(1);
   
   $JSON = $HISTORIA->soyjson($HISTORIA->tabla,'modal','formHistoria');
   echo $HISTORIA->MODAL__($JSON,$RESULT_HISTORIA);
   exit;
 }

 if (($_POST['accion'] == "save_formHistoria"))
 {

   $HISTORIA = new historiaModelo();
   
   if ($_SESSION['temp']['HISTORIA_id'])
   {
     $HISTORIA->set_id($_SESSION['temp']['HISTORIA_id'], 1);
   }
   
   $HISTORIA->setter__($_POST);
   $HISTORIA->save();
       #**************************** IMPORTANTE EDITAR DE soyjsondatatable EL ULTIMO PARAMETRO ******************************************
   
   $JSON = $HISTORIA->soyjsondatatable($HISTORIA->tabla,'datatable','formHistoria');
   echo $HISTORIA->DATATABLE__($JSON);
   exit;
 }

 ?>