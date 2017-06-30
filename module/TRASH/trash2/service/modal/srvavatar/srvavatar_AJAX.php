
    <?php
    session_start();
    include "../../../../url.php";


    if ($_POST['accion'] == "edit_srvavatar")
    {

        $SERVICE = new serviceModelo();
        $SERVICE->set_id($SERVICE->decrypt($_POST['v1']));
        $RESULT_SERVICE = $SERVICE->select_all(1);
        $_SESSION['temp']['SERVICE_id'] = $SERVICE->decrypt($_POST['v1']);
        $JSON = $SERVICE->soyjson($SERVICE->tabla,'modal','srvavatar');
        echo $SERVICE->MODAL__($JSON,$RESULT_SERVICE);
        exit;
    }


    ?>