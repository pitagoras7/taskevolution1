<?php  session_start(); 
 
 require_once '../../url.php';



 if ($_POST['accion'] == "edit_tsk")
            {

             $TASK = new taskModelo();
             $TASK->set_id($TASK->decrypt($_POST['v1']));
             $RESULT_TASK = $TASK->select_all(1);
             $_SESSION['temp']['task_id'] = $TASK->decrypt($_POST['v1']);
             echo $TASK->modal_($RESULT_TASK);
             exit;
           }

           if ($_POST['accion'] == "new_tsk")
           {

             $TASK = new taskModelo();
             $TASK->set_id(0);
   
             unset($_SESSION['temp']['task_id']);

             $RESULT_TASK = $TASK->select_all(1);
             echo $TASK->modal_($RESULT_TASK,'new');
             exit;
           }

           if (($_POST['accion'] == "save_tsk"))
           {

             $TASK = new taskModelo();


             if ($_SESSION['temp']['task_id'])
             {
               $TASK->set_id($_SESSION['temp']['task_id'], 1);
             }

             $TASK->setter__($_POST);
             $TASK->save();
             echo $TASK->datatable_();
             exit;
           }

           
 


           ?>
           