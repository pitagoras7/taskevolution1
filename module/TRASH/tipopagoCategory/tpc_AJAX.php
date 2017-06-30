<?php  session_start(); 
 
 require_once '../../url.php';



 if ($_POST['accion'] == "edit_tpc")
    {

        $TIPOPAGOCATEGORY = new tipopagoCategoryModelo();
        $TIPOPAGOCATEGORY->set_id($TIPOPAGOCATEGORY->decrypt($_POST['v1']));
        $RESULT_TIPOPAGOCATEGORY = $TIPOPAGOCATEGORY->select_all(1);
        $_SESSION['temp']['tipopagoCategory_id'] = $TIPOPAGOCATEGORY->decrypt($_POST['v1']);
        echo $TIPOPAGOCATEGORY->modal_($RESULT_TIPOPAGOCATEGORY);
        exit;
    }

    if ($_POST['accion'] == "new_tpc")
    {

        $TIPOPAGOCATEGORY = new tipopagoCategoryModelo();
        $TIPOPAGOCATEGORY->set_id(0);
        unset($_SESSION['temp']['tipopagoCategory_id']);

        $RESULT_TIPOPAGOCATEGORY = $TIPOPAGOCATEGORY->select_all(1);
        echo $TIPOPAGOCATEGORY->modal_($RESULT_TIPOPAGOCATEGORY,'new');
        exit;
    }

    if (($_POST['accion'] == "save_tpc"))
    {

        $TIPOPAGOCATEGORY = new tipopagoCategoryModelo();


        if ($_SESSION['temp']['tipopagoCategory_id'])
        {
          $TIPOPAGOCATEGORY->set_id($_SESSION['temp']['tipopagoCategory_id'], 1);  
      }



      $TIPOPAGOCATEGORY->setter__($_POST);
      $TIPOPAGOCATEGORY->save();
      echo $TIPOPAGOCATEGORY->datatable_();
      exit;
  }

  
 
 

  ?>
  