<?php  session_start(); 
 
 require_once '../../url.php';



 if ($_POST['accion'] == "edit_pag")
            {

             $PAGOMEDICO = new pagoMedicoModelo();
             $PAGOMEDICO->set_id($PAGOMEDICO->decrypt($_POST['v1']));
             $RESULT_PAGOMEDICO = $PAGOMEDICO->select_all(1);
             $_SESSION['temp']['pagoMedico_id'] = $PAGOMEDICO->decrypt($_POST['v1']);
             echo $PAGOMEDICO->modal_($RESULT_PAGOMEDICO);
             exit;
           }

           if ($_POST['accion'] == "new_pag")
           {

             $PAGOMEDICO = new pagoMedicoModelo();
             $PAGOMEDICO->set_id(0);
             unset($_SESSION['temp']['pagoMedico_id']);

             $RESULT_PAGOMEDICO = $PAGOMEDICO->select_all(1);
             echo $PAGOMEDICO->modal_($RESULT_PAGOMEDICO,'new');
             exit;
           }

           if (($_POST['accion'] == "save_pag"))
           {

             $PAGOMEDICO = new pagoMedicoModelo();


             if ($_SESSION['temp']['pagoMedico_id'])
             {
               $PAGOMEDICO->set_id($_SESSION['temp']['pagoMedico_id'], 1);  
             }



             $PAGOMEDICO->setter__($_POST);
             $PAGOMEDICO->save();
             echo $PAGOMEDICO->datatable_();
             exit;
           }

           
 
 

           ?>
           