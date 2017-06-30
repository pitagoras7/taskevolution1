<?php  session_start(); 
 
 require_once '../../url.php';



 if ($_POST['accion'] == "edit_odc")
    {

        $ORDERCATEGORY = new orderCategoryModelo();
        $ORDERCATEGORY->set_id($ORDERCATEGORY->decrypt($_POST['v1']));
        $RESULT_ORDERCATEGORY = $ORDERCATEGORY->select_all(1);
        $_SESSION['temp']['orderCategory_id'] = $ORDERCATEGORY->decrypt($_POST['v1']);
        echo $ORDERCATEGORY->modal_($RESULT_ORDERCATEGORY);
        exit;
    }

    if ($_POST['accion'] == "new_odc")
    {

        $ORDERCATEGORY = new orderCategoryModelo();
        $ORDERCATEGORY->set_id(0);
        unset($_SESSION['temp']['orderCategory_id']);

        $RESULT_ORDERCATEGORY = $ORDERCATEGORY->select_all(1);
        echo $ORDERCATEGORY->modal_($RESULT_ORDERCATEGORY,'new');
        exit;
    }

    if (($_POST['accion'] == "save_odc"))
    {

        $ORDERCATEGORY = new orderCategoryModelo();


        if ($_SESSION['temp']['orderCategory_id'])
        {
          $ORDERCATEGORY->set_id($_SESSION['temp']['orderCategory_id'], 1);  
      }



      $ORDERCATEGORY->setter__($_POST);
      $ORDERCATEGORY->save();
      echo $ORDERCATEGORY->datatable_();
      exit;
  }

  
 
 

  ?>
  