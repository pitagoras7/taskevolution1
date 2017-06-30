
    <?php
    session_start();
    include "../../../../url.php";


    if ($_POST['accion'] == "edit_avatar")
    {

        $USER = new userModelo();
        $USER->set_id($USER->decrypt($_POST['v1']));
        $RESULT_USER = $USER->select_all(1);
        $_SESSION['temp']['USER_id'] = $USER->decrypt($_POST['v1']);
        $JSON = $USER->soyjson($USER->tabla,'modal','avatar');
        echo $USER->MODAL__($JSON,$RESULT_USER);
        exit;
    }


    ?>