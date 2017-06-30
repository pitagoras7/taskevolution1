<?php  session_start(); 
 
 require_once '../../url.php';



 if ($_POST['accion'] == "edit_wrk")
    {

        $WORK = new workModelo();
        $WORK->set_id($WORK->decrypt($_POST['v1']));
        $RESULT_WORK = $WORK->select_all(1);
        $_SESSION['temp']['work_id'] = $WORK->decrypt($_POST['v1']);
        echo $WORK->modal_($RESULT_WORK);
        exit;
    }

    if ($_POST['accion'] == "new_wrk")
    {

        $WORK = new workModelo();
        $WORK->set_id(0);
        unset($_SESSION['temp']['work_id']);

        $RESULT_WORK = $WORK->select_all(1);
        echo $WORK->modal_($RESULT_WORK,'new');
        exit;
    }

    if (($_POST['accion'] == "save_wrk"))
    {

        $WORK = new workModelo();


        if ($_SESSION['temp']['work_id'])
        {
          $WORK->set_id($_SESSION['temp']['work_id'], 1);  
      }



      $WORK->setter__($_POST);
      $WORK->save();
      echo $WORK->datatable_();
      exit;
  }

  
 
 

  ?>
  