<?php  session_start(); 
require_once '../../../../url.php';


if ($_POST['accion'] == "filter_cards_")
{


		 $SERVICE = new serviceModelo();
		 $SERVICE->set_srvsrcid($SERVICE->decrypt($_POST['v1']));
		 

		 if( $SERVICE->get_srvsrcid()==1){
		  $condicional = " srvest in ('t') ";
		}else{
		  $condicional = " srvest in ('t') and srvsrcid in (".$SERVICE->get_srvsrcid().")";
		}



		$_SESSION['temp']['SERVICE_id'] = $SERVICE->get_srvsrcid();
		echo $datos['cardsimple'] = $SERVICE->cardsimple_($condicional);
		exit;



}



if ($_POST['accion'] == "filter_enfermedad")
{

		$ENFERMEDAD = new enfermedadModelo();
        $JSON = $ENFERMEDAD->json_element($ENFERMEDAD->tabla,'datatable_orders');
		echo $ENFERMEDAD->DATATABLE__($JSON);
		exit;

}




?>