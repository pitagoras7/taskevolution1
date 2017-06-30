
  <?php
  session_start();
  include "../../../../url.php";




 if ($_POST['accion'] == "edit_tskest")
 {

   $TASK = new taskModelo();
   $TASK->set_id($TASK->decrypt($_POST['v1']));
   $RESULT_TASK = $TASK->select_all(1);
   $_SESSION['temp']['TASK_id'] = $TASK->decrypt($_POST['v1']);
   $JSON = $TASK->soyjson($TASK->tabla,'modal','tskest');
   echo $TASK->MODAL__($JSON,$RESULT_TASK);
   exit;
 }



 if ($_POST['accion'] == "new_tskest")
 {
   unset($_SESSION['temp']['TASK_id']);
   $TASK = new taskModelo();
   $TASK->set_id(0);
   $RESULT_TASK = $TASK->select_all(1);

   $JSON = $TASK->soyjson($TASK->tabla,'modal','tskest');
   echo $TASK->MODAL__($JSON,$RESULT_TASK);
   exit;
 }

 if (($_POST['accion'] == "save_tskest"))
 {

   $TASK = new taskModelo();

   if ($_SESSION['temp']['TASK_id'])
   {
     $TASK->set_id($_SESSION['temp']['TASK_id'], 1);
   }

   $TASK->setter__($_POST);
   $TASK->save();
       #**************************** IMPORTANTE EDITAR DE soyjsondatatable EL ULTIMO PARAMETRO ******************************************


  echo $TASK->datatable_();
   exit;
 }

 ?>