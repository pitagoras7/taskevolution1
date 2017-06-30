
    <?php
    session_start();
    include "../../../../url.php";



    if ($_POST['accion'] == "new_schedule")
    {

        $ORDERS = new ordersModelo();
        $ORDERS->set_ordodc('2');
        $ORDERS->set_ordest('t');
        $ORDERS->set_ordreg();
        $ORDERS->save();
        $_SESSION['temp']['ORDERS_id'] = $ORDERS->ultimoId;


        unset($_SESSION['temp']['ORDERRESERVATION_id']);
        $ORDERRESERVATION = new orderReservationModelo();
        $ORDERRESERVATION->set_orrini($_POST['v1']);
        $ORDERRESERVATION->set_orrordid($_SESSION['temp']['ORDERS_id']);
        $ORDERRESERVATION->save();
        $_SESSION['temp']['ORDERRESERVATION_id'] = $ORDERRESERVATION->ultimoId;

        $ORDERRESERVATION->set_id($_SESSION['temp']['ORDERRESERVATION_id']);
        $RESULT_ORDERRESERVATION = $ORDERRESERVATION->select_all(1);

        $JSON = $ORDERRESERVATION->soyjson($ORDERRESERVATION->tabla,'modal','schedule');
        echo $ORDERRESERVATION->MODAL__($JSON,$RESULT_ORDERRESERVATION);
        exit;
    }

    if (($_POST['accion'] == "save_schedule"))
    {

        $ORDERRESERVATION = new orderReservationModelo();

        if ($_SESSION['temp']['ORDERRESERVATION_id'])
        {
            $ORDERRESERVATION->set_id($_SESSION['temp']['ORDERRESERVATION_id'], 1);
        }

        $ORDERRESERVATION->setter__($_POST);
        $ORDERRESERVATION->save();
        #**************************** IMPORTANTE EDITAR DE soyjsondatatable EL ULTIMO PARAMETRO ******************************************

        $JSON = $ORDERRESERVATION->soyjsondatatable($ORDERRESERVATION->tabla,'datatable','schedule');
        echo $ORDERRESERVATION->DATATABLE__($JSON);
        exit;
    }

    ?>