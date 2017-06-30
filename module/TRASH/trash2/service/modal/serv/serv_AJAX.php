
    <?php
    session_start();
    include "../../../url.php";


    if ($_POST['accion'] == "edit_serv")
    {

        $SERVICE = new serviceModelo();
        $SERVICE->set_id($SERVICE->decrypt($_POST['v1']));
        $RESULT_SERVICE = $SERVICE->select_all(1);
        $_SESSION['temp']['SERVICE_id'] = $SERVICE->decrypt($_POST['v1']);
        $JSON = $SERVICE->soyjson($SERVICE->tabla,'serv','serv');
        echo $SERVICE->MODAL__($JSON,$RESULT_SERVICE);
        exit;
    }

    if ($_POST['accion'] == "new_serv")
    {
        unset($_SESSION['temp']['SERVICE_id']);
        $SERVICE = new serviceModelo();
        $SERVICE->set_id(0);
        $RESULT_SERVICE = $SERVICE->select_all(1);

        $JSON = $SERVICE->soyjson($SERVICE->tabla,'serv','serv');
        echo $SERVICE->MODAL__($JSON,$RESULT_SERVICE);
        exit;
    }

    if (($_POST['accion'] == "save_serv"))
    {

        $SERVICE = new serviceModelo();

        if ($_SESSION['temp']['SERVICE_id'])
        {
            $SERVICE->set_id($_SESSION['temp']['SERVICE_id'], 1);
        }

        $SERVICE->setter__($_POST);
        $SERVICE->save();

        $JSON = $SERVICE->soyjson($SERVICE->tabla,'datatable','serv');
        echo $SERVICE->DATATABLE__($JSON);
        exit;
    }

    ?>