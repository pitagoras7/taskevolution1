<?php 
 require_once '../../clases/mesaCategoryModelo.php';
 session_start(); 
 
 
if ($_POST['accion'] == "edit_msc")
    {

        $MESACATEGORY = new mesaCategoryModelo();
        $MESACATEGORY->set_id($MESACATEGORY->decrypt($_POST['v1']));
        $RESULT_MESACATEGORY = $MESACATEGORY->select_all(1);
        $_SESSION['temp']['mesaCategory_id'] = $MESACATEGORY->decrypt($_POST['v1']);
        echo $MESACATEGORY->modal_($RESULT_MESACATEGORY);
        exit;
    }

    if ($_POST['accion'] == "new_msc")
    {

        $MESACATEGORY = new mesaCategoryModelo();
        $MESACATEGORY->set_id(0);
        unset($_SESSION['temp']['mesaCategory_id']);

        $RESULT_MESACATEGORY = $MESACATEGORY->select_all(1);
        echo $MESACATEGORY->modal_($RESULT_MESACATEGORY,'new');
        exit;
    }

    if (($_POST['accion'] == "save_msc"))
    {

        $MESACATEGORY = new mesaCategoryModelo();


        if ($_SESSION['temp']['mesaCategory_id'])
        {
          $MESACATEGORY->set_id($_SESSION['temp']['mesaCategory_id'], 1);  
      }



      $MESACATEGORY->setter__($_POST);
      $MESACATEGORY->save();
      echo $MESACATEGORY->datatable_();
      exit;
  }

  
 
 

  ?>
  