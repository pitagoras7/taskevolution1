<?php  session_start(); 
 
 require_once '../../url.php';



 if ($_POST['accion'] == "edit_gui")
            {

             $GUITARRA = new guitarraModelo();
             $GUITARRA->set_id($GUITARRA->decrypt($_POST['v1']));
             $RESULT_GUITARRA = $GUITARRA->select_all(1);
             $_SESSION['temp']['guitarra_id'] = $GUITARRA->decrypt($_POST['v1']);
             echo $GUITARRA->modal_($RESULT_GUITARRA);
             exit;
           }

           if ($_POST['accion'] == "new_gui")
           {

             $GUITARRA = new guitarraModelo();
             $GUITARRA->set_id(0);
             unset($_SESSION['temp']['guitarra_id']);

             $RESULT_GUITARRA = $GUITARRA->select_all(1);
             echo $GUITARRA->modal_($RESULT_GUITARRA,'new');
             exit;
           }

           if (($_POST['accion'] == "save_gui"))
           {

             $GUITARRA = new guitarraModelo();


             if ($_SESSION['temp']['guitarra_id'])
             {
               $GUITARRA->set_id($_SESSION['temp']['guitarra_id'], 1);  
             }



             $GUITARRA->setter__($_POST);
             $GUITARRA->save();
             echo $GUITARRA->datatable_();
             exit;
           }

           
 
 

           ?>
           