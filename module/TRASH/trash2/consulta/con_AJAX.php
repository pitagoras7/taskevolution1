<?php  session_start(); 
 
 require_once '../../url.php';



 if ($_POST['accion'] == "edit_con")
            {

             $CONSULTA = new consultaModelo();
             $CONSULTA->set_id($CONSULTA->decrypt($_POST['v1']));
             $RESULT_CONSULTA = $CONSULTA->select_all(1);
             $_SESSION['temp']['consulta_id'] = $CONSULTA->decrypt($_POST['v1']);
             echo $CONSULTA->modal_($RESULT_CONSULTA);
             exit;
           }

           if ($_POST['accion'] == "new_con")
           {

             $CONSULTA = new consultaModelo();
             $CONSULTA->set_id(0);
             unset($_SESSION['temp']['consulta_id']);

             $RESULT_CONSULTA = $CONSULTA->select_all(1);
             echo $CONSULTA->modal_($RESULT_CONSULTA,'new');
             exit;
           }

           if (($_POST['accion'] == "save_con"))
           {

             $CONSULTA = new consultaModelo();


             if ($_SESSION['temp']['consulta_id'])
             {
               $CONSULTA->set_id($_SESSION['temp']['consulta_id'], 1);  
             }



             $CONSULTA->setter__($_POST);
             $CONSULTA->save();
             echo $CONSULTA->datatable_();
             exit;
           }

           
 
 

           ?>
           