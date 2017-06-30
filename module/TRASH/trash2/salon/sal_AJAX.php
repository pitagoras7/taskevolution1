<?php 
 require_once '../../url.php';
 session_start(); 
 
 
if ($_POST['accion'] == "edit_sal")
    {

        $SALON = new salonModelo();
        $SALON->set_id($SALON->decrypt($_POST['v1']));
        $RESULT_SALON = $SALON->select_all(1);
        $_SESSION['temp']['salon_id'] = $SALON->decrypt($_POST['v1']);
        echo $SALON->modal_($RESULT_SALON);
        exit;
    }

    if ($_POST['accion'] == "new_sal")
    {

        $SALON = new salonModelo();
        $SALON->set_id(0);
        unset($_SESSION['temp']['salon_id']);

        $RESULT_SALON = $SALON->select_all(1);
        echo $SALON->modal_($RESULT_SALON,'new');
        exit;
    }

    if (($_POST['accion'] == "save_sal"))
    {

        $SALON = new salonModelo();


        if ($_SESSION['temp']['salon_id'])
        {
          $SALON->set_id($_SESSION['temp']['salon_id'], 1);  
      }



      $SALON->setter__($_POST);
      $SALON->save();
      echo $SALON->datatable_();
      exit;
  }

  
 
 

  ?>
  