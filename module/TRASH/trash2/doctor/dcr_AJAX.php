<?php  session_start(); 
 
 require_once '../../url.php';



 if ($_POST['accion'] == "edit_dcr")
            {

             $DOCTOR = new doctorModelo();
             $DOCTOR->set_id($DOCTOR->decrypt($_POST['v1']));
             $RESULT_DOCTOR = $DOCTOR->select_all(1);
             $_SESSION['temp']['doctor_id'] = $DOCTOR->decrypt($_POST['v1']);
             echo $DOCTOR->modal_($RESULT_DOCTOR);
             exit;
           }

           if ($_POST['accion'] == "new_dcr")
           {

             $DOCTOR = new doctorModelo();
             $DOCTOR->set_id(0);
             unset($_SESSION['temp']['doctor_id']);

             $RESULT_DOCTOR = $DOCTOR->select_all(1);
             echo $DOCTOR->modal_($RESULT_DOCTOR,'new');
             exit;
           }

           if (($_POST['accion'] == "save_dcr"))
           {

             $DOCTOR = new doctorModelo();


             if ($_SESSION['temp']['doctor_id'])
             {
               $DOCTOR->set_id($_SESSION['temp']['doctor_id'], 1);  
             }



             $DOCTOR->setter__($_POST);
             $DOCTOR->save();
             echo $DOCTOR->datatable_();
             exit;
           }

           
 
 

           ?>
           