<?php  session_start(); 
 
 require_once '../../url.php';



 if ($_POST['accion'] == "edit_exf")
            {

             $EXAMENFISICO = new examenFisicoModelo();
             $EXAMENFISICO->set_id($EXAMENFISICO->decrypt($_POST['v1']));
             $RESULT_EXAMENFISICO = $EXAMENFISICO->select_all(1);
             $_SESSION['temp']['examenFisico_id'] = $EXAMENFISICO->decrypt($_POST['v1']);
             echo $EXAMENFISICO->modal_($RESULT_EXAMENFISICO);
             exit;
           }

           if ($_POST['accion'] == "new_exf")
           {

             $EXAMENFISICO = new examenFisicoModelo();
             $EXAMENFISICO->set_id(0);
             unset($_SESSION['temp']['examenFisico_id']);

             $RESULT_EXAMENFISICO = $EXAMENFISICO->select_all(1);
             echo $EXAMENFISICO->modal_($RESULT_EXAMENFISICO,'new');
             exit;
           }

           if (($_POST['accion'] == "save_exf"))
           {

             $EXAMENFISICO = new examenFisicoModelo();


             if ($_SESSION['temp']['examenFisico_id'])
             {
               $EXAMENFISICO->set_id($_SESSION['temp']['examenFisico_id'], 1);  
             }



             $EXAMENFISICO->setter__($_POST);
             $EXAMENFISICO->save();
             echo $EXAMENFISICO->datatable_();
             exit;
           }

           
 
 

           ?>
           