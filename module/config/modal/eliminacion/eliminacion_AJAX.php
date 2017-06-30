
    <?php
    session_start();
    include "../../../../url.php";


    if ($_POST['accion'] == "edit_eliminacion")
    {

        $CONFIG = new configModelo();
        $CONFIG->set_id($CONFIG->decrypt($_POST['v1']));
        $RESULT_CONFIG = $CONFIG->select_all(1);


        $_SESSION['temp']['CONFIG_id'] = $CONFIG->decrypt($_POST['v1']);
        $JSON = $CONFIG->soyjson($CONFIG->tabla,'modal','eliminacion');

        echo $CONFIG->MODAL__($JSON,$RESULT_CONFIG);
        exit;
    }



    if (($_POST['accion'] == "save_eliminacion"))
    {

        $CONFIG = new configModelo();

        if ($_SESSION['temp']['CONFIG_id'])
        {
            $CONFIG->set_id($_SESSION['temp']['CONFIG_id'], 1);
        }

        $CONFIG->setter__($_POST);
        $CONFIG->save();

        $JSON = $CONFIG->json_element($CONFIG->tabla,'cfg');
        echo $CONFIG->DATATABLE__($JSON);
        exit;
    }

    ?>