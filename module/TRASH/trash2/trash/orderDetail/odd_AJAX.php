<?php  session_start(); 
 
 require_once '../../url.php';



 if ($_POST['accion'] == "edit_odd")
    {

        $ORDERDETAIL = new orderDetailModelo();
        $ORDERDETAIL->set_id($ORDERDETAIL->decrypt($_POST['v1']));
        $RESULT_ORDERDETAIL = $ORDERDETAIL->select_all(1);
        $_SESSION['temp']['orderDetail_id'] = $ORDERDETAIL->decrypt($_POST['v1']);
        echo $ORDERDETAIL->modal_($RESULT_ORDERDETAIL);
        exit;
    }

    if ($_POST['accion'] == "new_odd")
    {

        $ORDERDETAIL = new orderDetailModelo();
        $ORDERDETAIL->set_id(0);
        unset($_SESSION['temp']['orderDetail_id']);

        $RESULT_ORDERDETAIL = $ORDERDETAIL->select_all(1);
        echo $ORDERDETAIL->modal_($RESULT_ORDERDETAIL,'new');
        exit;
    }

    if (($_POST['accion'] == "save_odd"))
    {

        $ORDERDETAIL = new orderDetailModelo();


        if ($_SESSION['temp']['orderDetail_id'])
        {
          $ORDERDETAIL->set_id($_SESSION['temp']['orderDetail_id'], 1);  
      }



      $ORDERDETAIL->setter__($_POST);
      $ORDERDETAIL->save();
      echo $ORDERDETAIL->datatable_();
      exit;
  }

  
 
 

  ?>
  