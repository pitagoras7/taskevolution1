<?php  session_start(); 
 
 require_once '../../url.php';



 if ($_POST['accion'] == "edit_log")
            {

             $LOG = new logModelo();
             $LOG->set_id($LOG->decrypt($_POST['v1']));
             $RESULT_LOG = $LOG->select_all(1);
             $_SESSION['temp']['log_id'] = $LOG->decrypt($_POST['v1']);
             echo $LOG->modal_($RESULT_LOG);
             exit;
           }

           if ($_POST['accion'] == "new_log")
           {

             $LOG = new logModelo();
             $LOG->set_id(0);
             unset($_SESSION['temp']['log_id']);

             $RESULT_LOG = $LOG->select_all(1);
             echo $LOG->modal_($RESULT_LOG,'new');
             exit;
           }

           if (($_POST['accion'] == "save_log"))
           {

             $LOG = new logModelo();


             if ($_SESSION['temp']['log_id'])
             {
               $LOG->set_id($_SESSION['temp']['log_id'], 1);  
             }



             $LOG->setter__($_POST);
             $LOG->save();
             echo $LOG->datatable_();
             exit;
           }

           
 
 

           ?>
           