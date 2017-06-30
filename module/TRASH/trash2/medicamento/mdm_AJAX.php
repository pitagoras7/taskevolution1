<?php  session_start(); 
 
 require_once '../../url.php';



 if ($_POST['accion'] == "edit_mdm")
            {

             $MEDICAMENTO = new medicamentoModelo();
             $MEDICAMENTO->set_id($MEDICAMENTO->decrypt($_POST['v1']));
             $RESULT_MEDICAMENTO = $MEDICAMENTO->select_all(1);
             $_SESSION['temp']['medicamento_id'] = $MEDICAMENTO->decrypt($_POST['v1']);
             echo $MEDICAMENTO->modal_($RESULT_MEDICAMENTO);
             exit;
           }

           if ($_POST['accion'] == "new_mdm")
           {

             $MEDICAMENTO = new medicamentoModelo();
             $MEDICAMENTO->set_id(0);
             unset($_SESSION['temp']['medicamento_id']);

             $RESULT_MEDICAMENTO = $MEDICAMENTO->select_all(1);
             echo $MEDICAMENTO->modal_($RESULT_MEDICAMENTO,'new');
             exit;
           }

           if (($_POST['accion'] == "save_mdm"))
           {

             $MEDICAMENTO = new medicamentoModelo();


             if ($_SESSION['temp']['medicamento_id'])
             {
               $MEDICAMENTO->set_id($_SESSION['temp']['medicamento_id'], 1);  
             }



             $MEDICAMENTO->setter__($_POST);
             $MEDICAMENTO->save();
             echo $MEDICAMENTO->datatable_();
             exit;
           }

           
 
 

           ?>
           