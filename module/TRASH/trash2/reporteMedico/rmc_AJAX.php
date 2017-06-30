<?php  session_start(); 
 
 require_once '../../url.php';



 if ($_POST['accion'] == "edit_rmc")
            {

             $REPORTEMEDICO = new reporteMedicoModelo();
             $REPORTEMEDICO->set_id($REPORTEMEDICO->decrypt($_POST['v1']));
             $RESULT_REPORTEMEDICO = $REPORTEMEDICO->select_all(1);
             $_SESSION['temp']['reporteMedico_id'] = $REPORTEMEDICO->decrypt($_POST['v1']);
             echo $REPORTEMEDICO->modal_($RESULT_REPORTEMEDICO);
             exit;
           }

           if ($_POST['accion'] == "new_rmc")
           {

             $REPORTEMEDICO = new reporteMedicoModelo();
             $REPORTEMEDICO->set_id(0);
             unset($_SESSION['temp']['reporteMedico_id']);

             $RESULT_REPORTEMEDICO = $REPORTEMEDICO->select_all(1);
             echo $REPORTEMEDICO->modal_($RESULT_REPORTEMEDICO,'new');
             exit;
           }

           if (($_POST['accion'] == "save_rmc"))
           {

             $REPORTEMEDICO = new reporteMedicoModelo();


             if ($_SESSION['temp']['reporteMedico_id'])
             {
               $REPORTEMEDICO->set_id($_SESSION['temp']['reporteMedico_id'], 1);  
             }



             $REPORTEMEDICO->setter__($_POST);
             $REPORTEMEDICO->save();
             echo $REPORTEMEDICO->datatable_();
             exit;
           }

           
 
 

           ?>
           