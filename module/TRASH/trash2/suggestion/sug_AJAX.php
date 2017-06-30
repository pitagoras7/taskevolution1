<?php  session_start(); 
 
 require_once '../../url.php';



 if ($_POST['accion'] == "edit_sug")
    {

        $SUGGESTION = new suggestionModelo();
        $SUGGESTION->set_id($SUGGESTION->decrypt($_POST['v1']));
        $RESULT_SUGGESTION = $SUGGESTION->select_all(1);
        $_SESSION['temp']['suggestion_id'] = $SUGGESTION->decrypt($_POST['v1']);
        echo $SUGGESTION->modal_($RESULT_SUGGESTION);
        exit;
    }

    if ($_POST['accion'] == "new_sug")
    {

        $SUGGESTION = new suggestionModelo();
        $SUGGESTION->set_id(0);
        unset($_SESSION['temp']['suggestion_id']);

        $RESULT_SUGGESTION = $SUGGESTION->select_all(1);
        echo $SUGGESTION->modal_($RESULT_SUGGESTION,'new');
        exit;
    }

    if (($_POST['accion'] == "save_sug"))
    {

        $SUGGESTION = new suggestionModelo();


        if ($_SESSION['temp']['suggestion_id'])
        {
          $SUGGESTION->set_id($_SESSION['temp']['suggestion_id'], 1);  
      }



      $SUGGESTION->setter__($_POST);
      $SUGGESTION->save();
      echo $SUGGESTION->datatable_();
      exit;
  }

  
 
 

  ?>
  