<?php  session_start(); 
 
 require_once '../../url.php';



 if ($_POST['accion'] == "edit_fad")
    {

        $FACTURADETAIL = new facturaDetailModelo();
        $FACTURADETAIL->set_id($FACTURADETAIL->decrypt($_POST['v1']));
        $RESULT_FACTURADETAIL = $FACTURADETAIL->select_all(1);
        $_SESSION['temp']['facturaDetail_id'] = $FACTURADETAIL->decrypt($_POST['v1']);
        echo $FACTURADETAIL->modal_($RESULT_FACTURADETAIL);
        exit;
    }

    if ($_POST['accion'] == "new_fad")
    {

        $FACTURADETAIL = new facturaDetailModelo();
        $FACTURADETAIL->set_id(0);
        unset($_SESSION['temp']['facturaDetail_id']);

        $RESULT_FACTURADETAIL = $FACTURADETAIL->select_all(1);
        echo $FACTURADETAIL->modal_($RESULT_FACTURADETAIL,'new');
        exit;
    }

    if (($_POST['accion'] == "save_fad"))
    {

        $FACTURADETAIL = new facturaDetailModelo();


        if ($_SESSION['temp']['facturaDetail_id'])
        {
          $FACTURADETAIL->set_id($_SESSION['temp']['facturaDetail_id'], 1);  
      }



      $FACTURADETAIL->setter__($_POST);
      $FACTURADETAIL->save();
      echo $FACTURADETAIL->datatable_();
      exit;
  }

  
 
 

  ?>
  