<?php  session_start(); 
 
 require_once '../../url.php';



 if ($_POST['accion'] == "edit_pac")
            {

             $PACIENTE = new pacienteModelo();
             $PACIENTE->set_id($PACIENTE->decrypt($_POST['v1']));
             $RESULT_PACIENTE = $PACIENTE->select_all(1);
             $_SESSION['temp']['paciente_id'] = $PACIENTE->decrypt($_POST['v1']);
             echo $PACIENTE->modal_($RESULT_PACIENTE);
             exit;
           }

           if ($_POST['accion'] == "new_pac")
           {

             $PACIENTE = new pacienteModelo();
             $PACIENTE->set_id(0);
             unset($_SESSION['temp']['paciente_id']);

             $RESULT_PACIENTE = $PACIENTE->select_all(1);
             echo $PACIENTE->modal_($RESULT_PACIENTE,'new');
             exit;
           }

           if (($_POST['accion'] == "save_pac"))
           {

             $PACIENTE = new pacienteModelo();


             if ($_SESSION['temp']['paciente_id'])
             {
               $PACIENTE->set_id($_SESSION['temp']['paciente_id'], 1);  
             }



             $PACIENTE->setter__($_POST);
             $PACIENTE->save();
             echo $PACIENTE->datatable_();
             exit;
           }

           
 
 

           ?>
           