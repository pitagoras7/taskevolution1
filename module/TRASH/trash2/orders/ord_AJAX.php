<?php  session_start(); 
 
 require_once '../../url.php';



 if ($_POST['accion'] == "edit_ord")
    {

        $ORDERS = new ordersModelo();
        $ORDERS->set_id($ORDERS->decrypt($_POST['v1']));
        $RESULT_ORDERS = $ORDERS->select_all(1);
        $_SESSION['temp']['orders_id'] = $ORDERS->decrypt($_POST['v1']);
        echo $ORDERS->modal_($RESULT_ORDERS);
        exit;
    }

    if ($_POST['accion'] == "new_ord")
    {

        $ORDERS = new ordersModelo();
        $ORDERS->set_id(0);
        unset($_SESSION['temp']['orders_id']);

        $RESULT_ORDERS = $ORDERS->select_all(1);
        echo $ORDERS->modal_($RESULT_ORDERS,'new');
        exit;
    }

    if (($_POST['accion'] == "save_ord"))
    {

        $ORDERS = new ordersModelo();


        if ($_SESSION['temp']['orders_id'])
        {
          $ORDERS->set_id($_SESSION['temp']['orders_id'], 1);  
      }



      $ORDERS->setter__($_POST);
      $ORDERS->save();
      echo $ORDERS->datatable_();
      exit;
  }

  
 
 

  ?>
  