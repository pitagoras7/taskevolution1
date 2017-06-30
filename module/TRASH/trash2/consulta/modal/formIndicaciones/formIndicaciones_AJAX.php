
  <?php
  session_start();
  include "../../../../url.php";


   # ACTIVAR ESTE CODIGO SI EL MODAL SERA TYPE SEARCH  
  /*



  if ($_POST['accion'] == "edit_formIndicaciones")
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


 if ($_POST['accion'] == "edit_formIndicaciones")
 {

   $CONSULTA = new consultaModelo();
   $CONSULTA->set_id($CONSULTA->decrypt($_POST['v1']));
   $RESULT_CONSULTA = $CONSULTA->select_all(1);
   $_SESSION['temp']['CONSULTA_id'] = $CONSULTA->decrypt($_POST['v1']);
   $JSON = $CONSULTA->soyjson($CONSULTA->tabla,'modal','formIndicaciones');
   echo $CONSULTA->MODAL__($JSON,$RESULT_CONSULTA);
   exit;
 }




 if ($_POST['accion'] == "new_formIndicaciones")
 {
   unset($_SESSION['temp']['CONSULTA_id']);
   $CONSULTA = new consultaModelo();
   $CONSULTA->set_id(0);
   $RESULT_CONSULTA = $CONSULTA->select_all(1);
   
   $JSON = $CONSULTA->soyjson($CONSULTA->tabla,'modal','formIndicaciones');
   echo $CONSULTA->MODAL__($JSON,$RESULT_CONSULTA);
   exit;
 }

 if (($_POST['accion'] == "save_formIndicaciones"))
 {

   $CONSULTA = new consultaModelo();
   
   if ($_SESSION['temp']['CONSULTA_id'])
   {
     $CONSULTA->set_id($_SESSION['temp']['CONSULTA_id'], 1);
   }
   
   $CONSULTA->setter__($_POST);
   $CONSULTA->save();
       #**************************** IMPORTANTE EDITAR DE soyjsondatatable EL ULTIMO PARAMETRO ******************************************
   
   $JSON = $CONSULTA->soyjsondatatable($CONSULTA->tabla,'datatable','formIndicaciones');
   echo $CONSULTA->DATATABLE__($JSON);
   exit;
 }

 ?>