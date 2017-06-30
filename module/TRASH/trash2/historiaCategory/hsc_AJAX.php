<?php  session_start(); 
 
 require_once '../../url.php';



 if ($_POST['accion'] == "edit_hsc")
            {

             $HISTORIACATEGORY = new historiaCategoryModelo();
             $HISTORIACATEGORY->set_id($HISTORIACATEGORY->decrypt($_POST['v1']));
             $RESULT_HISTORIACATEGORY = $HISTORIACATEGORY->select_all(1);
             $_SESSION['temp']['historiaCategory_id'] = $HISTORIACATEGORY->decrypt($_POST['v1']);
             echo $HISTORIACATEGORY->modal_($RESULT_HISTORIACATEGORY);
             exit;
           }

           if ($_POST['accion'] == "new_hsc")
           {

             $HISTORIACATEGORY = new historiaCategoryModelo();
             $HISTORIACATEGORY->set_id(0);
             unset($_SESSION['temp']['historiaCategory_id']);

             $RESULT_HISTORIACATEGORY = $HISTORIACATEGORY->select_all(1);
             echo $HISTORIACATEGORY->modal_($RESULT_HISTORIACATEGORY,'new');
             exit;
           }

           if (($_POST['accion'] == "save_hsc"))
           {

             $HISTORIACATEGORY = new historiaCategoryModelo();


             if ($_SESSION['temp']['historiaCategory_id'])
             {
               $HISTORIACATEGORY->set_id($_SESSION['temp']['historiaCategory_id'], 1);  
             }



             $HISTORIACATEGORY->setter__($_POST);
             $HISTORIACATEGORY->save();
             echo $HISTORIACATEGORY->datatable_();
             exit;
           }

           
 
 

           ?>
           