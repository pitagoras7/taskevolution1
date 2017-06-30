<?php  session_start(); 
 
 require_once '../../url.php';



 if ($_POST['accion'] == "edit_cit")
            {

             $CITA = new citaModelo();
             $CITA->set_id($CITA->decrypt($_POST['v1']));
             $RESULT_CITA = $CITA->select_all(1);
             $_SESSION['temp']['cita_id'] = $CITA->decrypt($_POST['v1']);
             echo $CITA->modal_($RESULT_CITA);
             exit;
           }

           if ($_POST['accion'] == "new_cit")
           {

             $CITA = new citaModelo();
             $CITA->set_id(0);
             unset($_SESSION['temp']['cita_id']);

             $RESULT_CITA = $CITA->select_all(1);
             echo $CITA->modal_($RESULT_CITA,'new');
             exit;
           }

           if (($_POST['accion'] == "save_cit"))
           {

             $CITA = new citaModelo();


             if ($_SESSION['temp']['cita_id'])
             {
               $CITA->set_id($_SESSION['temp']['cita_id'], 1);  
             }



             $CITA->setter__($_POST);
             $CITA->save();
             echo $CITA->datatable_();
             exit;
           }

           
 
 

           ?>
           