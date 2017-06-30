<?php  session_start(); 
 
 require_once '../../url.php';



 if ($_POST['accion'] == "edit_clc")
    {

        $CLIENTECATEGORY = new clienteCategoryModelo();
        $CLIENTECATEGORY->set_id($CLIENTECATEGORY->decrypt($_POST['v1']));
        $RESULT_CLIENTECATEGORY = $CLIENTECATEGORY->select_all(1);
        $_SESSION['temp']['clienteCategory_id'] = $CLIENTECATEGORY->decrypt($_POST['v1']);
        echo $CLIENTECATEGORY->modal_($RESULT_CLIENTECATEGORY);
        exit;
    }

    if ($_POST['accion'] == "new_clc")
    {

        $CLIENTECATEGORY = new clienteCategoryModelo();
        $CLIENTECATEGORY->set_id(0);
        unset($_SESSION['temp']['clienteCategory_id']);

        $RESULT_CLIENTECATEGORY = $CLIENTECATEGORY->select_all(1);
        echo $CLIENTECATEGORY->modal_($RESULT_CLIENTECATEGORY,'new');
        exit;
    }

    if (($_POST['accion'] == "save_clc"))
    {

        $CLIENTECATEGORY = new clienteCategoryModelo();


        if ($_SESSION['temp']['clienteCategory_id'])
        {
          $CLIENTECATEGORY->set_id($_SESSION['temp']['clienteCategory_id'], 1);  
      }



      $CLIENTECATEGORY->setter__($_POST);
      $CLIENTECATEGORY->save();
      echo $CLIENTECATEGORY->datatable_();
      exit;
  }

  
 
 

  ?>
  