<?php  session_start(); 
 
 require_once '../../url.php';



 if ($_POST['accion'] == "edit_srp")
    {
        $SERVICEPREFERENCES = new servicePreferencesModelo();
        $SERVICEPREFERENCES->set_id($SERVICEPREFERENCES->decrypt($_POST['v1']));
        $RESULT_SERVICEPREFERENCES = $SERVICEPREFERENCES->select_all(1);
        $_SESSION['temp']['servicePreferences_id'] = $SERVICEPREFERENCES->decrypt($_POST['v1']);
        echo $SERVICEPREFERENCES->modal_($RESULT_SERVICEPREFERENCES);
        exit;
    }

    if ($_POST['accion'] == "new_srp")
    {


        $SERVICEPREFERENCES = new servicePreferencesModelo();
        $SERVICEPREFERENCES->set_id(0);
        unset($_SESSION['temp']['servicePreferences_id']);

        $RESULT_SERVICEPREFERENCES = $SERVICEPREFERENCES->select_all(1);
        echo $SERVICEPREFERENCES->modal_($RESULT_SERVICEPREFERENCES,'new');
        exit;
    }

    if (($_POST['accion'] == "save_srp"))
    {

        $SERVICEPREFERENCES = new servicePreferencesModelo();


        if ($_SESSION['temp']['servicePreferences_id'])
        {
          $SERVICEPREFERENCES->set_id($_SESSION['temp']['servicePreferences_id'], 1);  
      }

 


      $SERVICEPREFERENCES->setter__($_POST);
      $SERVICEPREFERENCES->save();
      echo $SERVICEPREFERENCES->datatable_();
      exit;
  }

  
 
 

  ?>
  