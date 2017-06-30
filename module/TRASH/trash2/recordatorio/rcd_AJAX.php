<?php  session_start(); 
 
 require_once '../../url.php';



 if ($_POST['accion'] == "edit_rcd")
            {

             $RECORDATORIO = new recordatorioModelo();
             $RECORDATORIO->set_id($RECORDATORIO->decrypt($_POST['v1']));
             $RESULT_RECORDATORIO = $RECORDATORIO->select_all(1);
             $_SESSION['temp']['recordatorio_id'] = $RECORDATORIO->decrypt($_POST['v1']);
             echo $RECORDATORIO->modal_($RESULT_RECORDATORIO);
             exit;
           }

           if ($_POST['accion'] == "new_rcd")
           {

             $RECORDATORIO = new recordatorioModelo();
             $RECORDATORIO->set_id(0);
             unset($_SESSION['temp']['recordatorio_id']);

             $RESULT_RECORDATORIO = $RECORDATORIO->select_all(1);
             echo $RECORDATORIO->modal_($RESULT_RECORDATORIO,'new');
             exit;
           }

           if (($_POST['accion'] == "save_rcd"))
           {

             $RECORDATORIO = new recordatorioModelo();


             if ($_SESSION['temp']['recordatorio_id'])
             {
               $RECORDATORIO->set_id($_SESSION['temp']['recordatorio_id'], 1);  
             }



             $RECORDATORIO->setter__($_POST);
             $RECORDATORIO->save();
             echo $RECORDATORIO->datatable_();
             exit;
           }

           
 
 

           ?>
           