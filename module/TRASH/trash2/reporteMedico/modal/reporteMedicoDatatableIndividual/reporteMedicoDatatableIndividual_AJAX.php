
<?php
session_start();
include "../../../../url.php";

if ($_POST['accion'] == "openModalDatatablereporteMedicoDatatableIndividual")
{


# IMPORTANTE EN EL DATATABLE_CONDICIONAL HAY QUE COLOCAR LOS PARAMETROS PARA LA SENTENCIA WHERE

# HAY QUE CREAR EL JSON DATATABLE EN DE LA TABLA 

	$REPORTEMEDICO = new reporteMedicoModelo();



	if( $_POST['parametro']=='informe'){
	$REPORTEMEDICO->DATATABLE_CONDICIONAL=" rmcpacid in (".$_SESSION['temp']['PACIENTE_id'].") and rmcest in ('t')";
	}



	if( $_POST['parametro']=='referencia'){
	$REPORTEMEDICO->DATATABLE_CONDICIONAL=" rmctyp in ('REFERENCIA') and rmcpacid in (".$_SESSION['temp']['PACIENTE_id'].") and rmcest in ('t')";
	}


	$JSON = $REPORTEMEDICO->json_element($REPORTEMEDICO->tabla,'datatable_consulta');
	echo $REPORTEMEDICO->DATATABLE__($JSON);

	exit;

}



?>