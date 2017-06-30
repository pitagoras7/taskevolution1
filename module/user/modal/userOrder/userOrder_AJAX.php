
    <?php
    session_start();
    include "../../../../url.php";


  # ACTIVAR ESTE CODIGO SI EL MODAL SERA TYPE SEARCH  
 /*



   if ($_POST['accion'] == "edit_userOrder")
    {

    $ = new Modelo();
    $->set_id($_SESSION["temp"]["_id"]);
    $RESULT_ = $->select_all(1);

    $USER = new Modelo();

    if($_POST["v1"]){
        $RESULT_USER = $USER->select_all(" cliid in (".$USER->decrypt($_POST["v1"]).")" );    
    }else if($RESULT_ORDERS[""]>0){
        $RESULT_USER = $USER->select_all(" cliid in (".$RESULT_[""].")" );    
    }

    $JSON = $USER->soyjson($USER->tabla,"modal","clienteOrder");
    echo $USER->MODAL__($JSON,$RESULT_USER[0]);
    exit;
   }

  */


    if ($_POST['accion'] == "edit_userOrder")
    {

        $USER = new userModelo();
        $USER->set_id($USER->decrypt($_POST['v1']));
        $RESULT_USER = $USER->select_all(1);
        $_SESSION['temp']['USER_id'] = $USER->decrypt($_POST['v1']);
        $JSON = $USER->soyjson($USER->tabla,'modal','userOrder');
        echo $USER->MODAL__($JSON,$RESULT_USER);
        exit;
    }




    if ($_POST['accion'] == "new_userOrder")
    {
        unset($_SESSION['temp']['USER_id']);
        $USER = new userModelo();
        $USER->set_id(0);
        $RESULT_USER = $USER->select_all(1);

        $JSON = $USER->soyjson($USER->tabla,'modal','userOrder');
        echo $USER->MODAL__($JSON,$RESULT_USER);
        exit;
    }

    if (($_POST['accion'] == "save_userOrder"))
    {

        $USER = new userModelo();

        if ($_SESSION['temp']['USER_id'])
        {
            $USER->set_id($_SESSION['temp']['USER_id'], 1);
        }

        $USER->setter__($_POST);
        $USER->save();
        #**************************** IMPORTANTE EDITAR DE soyjsondatatable EL ULTIMO PARAMETRO ******************************************

        $JSON = $USER->soyjsondatatable($USER->tabla,'datatable','userOrder');
        echo $USER->DATATABLE__($JSON);
        exit;
    }


if ($_POST['accion'] == "search_userOrder")
{
  $USER = new userModelo(); 
  $USER->DATATABLE_CONDICIONAL=" usuest in ('t') order by usuid desc ";
  $JSON = $USER->json_element($USER->tabla,'datatable_userOrder');
  echo $USER->modal_content_view($USER->DATATABLE__($JSON));
}

    ?>