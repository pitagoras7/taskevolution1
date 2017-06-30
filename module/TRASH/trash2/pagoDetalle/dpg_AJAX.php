<?php  session_start(); 
 
 require_once '../../url.php';



 if ($_POST['accion'] == "edit_dpg")
            {

             $PAGODETALLE = new pagoDetalleModelo();
             $PAGODETALLE->set_id($PAGODETALLE->decrypt($_POST['v1']));
             $RESULT_PAGODETALLE = $PAGODETALLE->select_all(1);
             $_SESSION['temp']['pagoDetalle_id'] = $PAGODETALLE->decrypt($_POST['v1']);
             echo $PAGODETALLE->modal_($RESULT_PAGODETALLE);
             exit;
           }

           if ($_POST['accion'] == "new_dpg")
           {

             $PAGODETALLE = new pagoDetalleModelo();
             $PAGODETALLE->set_id(0);
             unset($_SESSION['temp']['pagoDetalle_id']);

             $RESULT_PAGODETALLE = $PAGODETALLE->select_all(1);
             echo $PAGODETALLE->modal_($RESULT_PAGODETALLE,'new');
             exit;
           }

           if (($_POST['accion'] == "save_dpg"))
           {

             $PAGODETALLE = new pagoDetalleModelo();


             if ($_SESSION['temp']['pagoDetalle_id'])
             {
               $PAGODETALLE->set_id($_SESSION['temp']['pagoDetalle_id'], 1);  
             }



             $PAGODETALLE->setter__($_POST);
             $PAGODETALLE->save();
             echo $PAGODETALLE->datatable_();
             exit;
           }

           
 
 

           ?>
           