    <?php
    session_start();
    include "../../../../url.php";

    if ($_POST['accion'] == "edit_pago")
    {
        $PAGO = new pagoModelo();     
        $RESULT =  $PAGO->buscar_pago_parcial($_SESSION['temp']['ORDERS_id']);
        echo $PAGO->modal_content_view($RESULT);
        exit;
    }

    

    if (($_POST['accion'] == "save_pago"))
    {

        $PAGO = new pagoModelo();

        if ($_SESSION['temp']['PAGO_id'])
        {
            $PAGO->set_id($_SESSION['temp']['PAGO_id'], 1);
        }

        $PAGO->setter__($_POST);
        $PAGO->save();
        #**************************** IMPORTANTE EDITAR DE soyjsondatatable EL ULTIMO PARAMETRO ******************************************

        $JSON = $PAGO->soyjsondatatable($PAGO->tabla,'datatable','pago');



        echo $PAGO->DATATABLE__($JSON);
        exit;
    }

    ?>