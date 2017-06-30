<?php  session_start(); 
 
 require_once '../../url.php';



 if ($_POST['accion'] == "edit_his")
            {

             $HISTORIA = new historiaModelo();
             $HISTORIA->set_id($HISTORIA->decrypt($_POST['v1']));
             $RESULT_HISTORIA = $HISTORIA->select_all(1);
             $_SESSION['temp']['historia_id'] = $HISTORIA->decrypt($_POST['v1']);
             echo $HISTORIA->modal_($RESULT_HISTORIA);
             exit;
           }

           if ($_POST['accion'] == "new_his")
           {

             $HISTORIA = new historiaModelo();
             $HISTORIA->set_id(0);
             unset($_SESSION['temp']['historia_id']);

             $RESULT_HISTORIA = $HISTORIA->select_all(1);
             echo $HISTORIA->modal_($RESULT_HISTORIA,'new');
             exit;
           }

           if (($_POST['accion'] == "save_his"))
           {

             $HISTORIA = new historiaModelo();


             if ($_SESSION['temp']['historia_id'])
             {
               $HISTORIA->set_id($_SESSION['temp']['historia_id'], 1);  
             }



             $HISTORIA->setter__($_POST);
             $HISTORIA->save();
             echo $HISTORIA->datatable_();
             exit;
           }

           
 
 

           ?>
           