<?php  session_start(); 
 
 require_once '../../url.php';



 if ($_POST['accion'] == "edit_orr")
    {

        $ORDERRESERVATION = new orderReservationModelo();
        $ORDERRESERVATION->set_id($ORDERRESERVATION->decrypt($_POST['v1']));
        $RESULT_ORDERRESERVATION = $ORDERRESERVATION->select_all(1);
        $_SESSION['temp']['orderReservation_id'] = $ORDERRESERVATION->decrypt($_POST['v1']);
        echo $ORDERRESERVATION->modal_($RESULT_ORDERRESERVATION);
        exit;
    }

    if ($_POST['accion'] == "new_orr")
    {

        $ORDERRESERVATION = new orderReservationModelo();
        $ORDERRESERVATION->set_id(0);
        unset($_SESSION['temp']['orderReservation_id']);

        $RESULT_ORDERRESERVATION = $ORDERRESERVATION->select_all(1);
        echo $ORDERRESERVATION->modal_($RESULT_ORDERRESERVATION,'new');
        exit;
    }

    if (($_POST['accion'] == "save_orr"))
    {

        $ORDERRESERVATION = new orderReservationModelo();


        if ($_SESSION['temp']['orderReservation_id'])
        {
          $ORDERRESERVATION->set_id($_SESSION['temp']['orderReservation_id'], 1);  
      }



      $ORDERRESERVATION->setter__($_POST);
      $ORDERRESERVATION->save();
      echo $ORDERRESERVATION->datatable_();
      exit;
  }

  
 
 

  ?>
  