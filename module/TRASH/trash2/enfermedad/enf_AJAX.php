<?php  session_start(); 
 
 require_once '../../url.php';



 if ($_POST['accion'] == "edit_enf")
            {

             $ENFERMEDAD = new enfermedadModelo();
             $ENFERMEDAD->set_id($ENFERMEDAD->decrypt($_POST['v1']));
             $RESULT_ENFERMEDAD = $ENFERMEDAD->select_all(1);
             $_SESSION['temp']['enfermedad_id'] = $ENFERMEDAD->decrypt($_POST['v1']);
             echo $ENFERMEDAD->modal_($RESULT_ENFERMEDAD);
             exit;
           }

           if ($_POST['accion'] == "new_enf")
           {

             $ENFERMEDAD = new enfermedadModelo();
             $ENFERMEDAD->set_id(0);
             unset($_SESSION['temp']['enfermedad_id']);

             $RESULT_ENFERMEDAD = $ENFERMEDAD->select_all(1);
             echo $ENFERMEDAD->modal_($RESULT_ENFERMEDAD,'new');
             exit;
           }

           if (($_POST['accion'] == "save_enf"))
           {

             $ENFERMEDAD = new enfermedadModelo();


             if ($_SESSION['temp']['enfermedad_id'])
             {
               $ENFERMEDAD->set_id($_SESSION['temp']['enfermedad_id'], 1);  
             }



             $ENFERMEDAD->setter__($_POST);
             $ENFERMEDAD->save();
             echo $ENFERMEDAD->datatable_();
             exit;
           }

           
 
 

           ?>
           