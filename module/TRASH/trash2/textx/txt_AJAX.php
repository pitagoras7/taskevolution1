<?php  session_start(); 
 
 require_once '../../url.php';



 if ($_POST['accion'] == "edit_txt")
            {

             $TEXTX = new textxModelo();
             $TEXTX->set_id($TEXTX->decrypt($_POST['v1']));
             $RESULT_TEXTX = $TEXTX->select_all(1);
             $_SESSION['temp']['textx_id'] = $TEXTX->decrypt($_POST['v1']);
             echo $TEXTX->modal_($RESULT_TEXTX);
             exit;
           }

           if ($_POST['accion'] == "new_txt")
           {

             $TEXTX = new textxModelo();
             $TEXTX->set_id(0);
             unset($_SESSION['temp']['textx_id']);

             $RESULT_TEXTX = $TEXTX->select_all(1);
             echo $TEXTX->modal_($RESULT_TEXTX,'new');
             exit;
           }

           if (($_POST['accion'] == "save_txt"))
           {

             $TEXTX = new textxModelo();


             if ($_SESSION['temp']['textx_id'])
             {
               $TEXTX->set_id($_SESSION['temp']['textx_id'], 1);
             }



             $TEXTX->setter__($_POST);
             $TEXTX->save();
             echo $TEXTX->datatable_();
             exit;
           }

           
 


           ?>
           