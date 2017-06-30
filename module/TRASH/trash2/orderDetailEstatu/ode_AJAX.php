<?php  session_start(); 
 
 require_once '../../url.php';



 if ($_POST['accion'] == "edit_ode")
    {

        $ORDERDETAILESTATU = new orderDetailEstatuModelo();
        $ORDERDETAILESTATU->set_id($ORDERDETAILESTATU->decrypt($_POST['v1']));
        $RESULT_ORDERDETAILESTATU = $ORDERDETAILESTATU->select_all(1);
        $_SESSION['temp']['orderDetailEstatu_id'] = $ORDERDETAILESTATU->decrypt($_POST['v1']);
        echo $ORDERDETAILESTATU->modal_($RESULT_ORDERDETAILESTATU);
        exit;
    }

    if ($_POST['accion'] == "new_ode")
    {

        $ORDERDETAILESTATU = new orderDetailEstatuModelo();
        $ORDERDETAILESTATU->set_id(0);
        unset($_SESSION['temp']['orderDetailEstatu_id']);

        $RESULT_ORDERDETAILESTATU = $ORDERDETAILESTATU->select_all(1);
        echo $ORDERDETAILESTATU->modal_($RESULT_ORDERDETAILESTATU,'new');
        exit;
    }

    if (($_POST['accion'] == "save_ode"))
    {

        $ORDERDETAILESTATU = new orderDetailEstatuModelo();


        if ($_SESSION['temp']['orderDetailEstatu_id'])
        {
          $ORDERDETAILESTATU->set_id($_SESSION['temp']['orderDetailEstatu_id'], 1);  
      }



      $ORDERDETAILESTATU->setter__($_POST);
      $ORDERDETAILESTATU->save();
      echo $ORDERDETAILESTATU->datatable_();
      exit;
  }

  
 
 

  ?>
  