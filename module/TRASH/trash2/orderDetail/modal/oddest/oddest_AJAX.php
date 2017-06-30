
    <?php
    session_start();
    include "../../../../url.php";


    if ($_POST['accion'] == "edit_oddest")
    {

        $ORDERDETAIL = new orderDetailModelo();
        $ORDERDETAIL->set_id($ORDERDETAIL->decrypt($_POST['v1']));
        $RESULT_ORDERDETAIL = $ORDERDETAIL->select_all(1);
        
       $_SESSION['temp']['SERVICE_id']     = $RESULT_ORDERDETAIL['oddsrvid'];


        $_SESSION['temp']['ORDERDETAIL_id'] = $ORDERDETAIL->decrypt($_POST['v1']);
        $JSON = $ORDERDETAIL->soyjson($ORDERDETAIL->tabla,'modal','oddest');
        echo $ORDERDETAIL->MODAL__($JSON,$RESULT_ORDERDETAIL);
        exit;
    }

    if ($_POST['accion'] == "new_oddest")
    {
        unset($_SESSION['temp']['ORDERDETAIL_id']);
        $ORDERDETAIL = new orderDetailModelo();
        $ORDERDETAIL->set_id(0);
        $RESULT_ORDERDETAIL = $ORDERDETAIL->select_all(1);

        $JSON = $ORDERDETAIL->soyjson($ORDERDETAIL->tabla,'modal','oddest');
        echo $ORDERDETAIL->MODAL__($JSON,$RESULT_ORDERDETAIL);
        exit;
    }

    if (($_POST['accion'] == "save_oddest"))
    {
        
        $ORDERS = new ordersModelo();
        $ORDERDETAIL = new orderDetailModelo();

        if ($_SESSION['temp']['ORDERDETAIL_id'])
        {
            $ORDERDETAIL->set_id($_SESSION['temp']['ORDERDETAIL_id'], 1);
        }

        $ORDERDETAIL->setter__($_POST);
        $ORDERDETAIL->save();

        $ORDERDETAIL->DATATABLE_CONDICIONAL=" oddest in ('t') and  oddordid  in (".$_SESSION['temp']['ORDERS_id'].")";

        $JSON = $ORDERDETAIL->json_element($ORDERDETAIL->tabla,'armarpedido');

        echo $ORDERS->cards_total($_SESSION['temp']['ORDERS_id']);
        echo $ORDERDETAIL->DATATABLE__($JSON);
        exit;
    }

    ?>