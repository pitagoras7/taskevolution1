
<?php
session_start();
include "../../../../url.php";

if ($_POST['accion'] == "openModalDatatableconsultaRequerimiento")
{


# IMPORTANTE EN EL DATATABLE_CONDICIONAL HAY QUE COLOCAR LOS PARAMETROS PARA LA SENTENCIA WHERE

# HAY QUE CREAR EL JSON DATATABLE EN DE LA TABLA 

	$HISTORIA = new historiaModelo();

	$HISTORIA->DATATABLE_CONDICIONAL=" hischsid in (10) and hisest in ('t')";

	$JSON = $HISTORIA->json_element($HISTORIA->tabla,'datatable_consulta');

	echo $HISTORIA->modal_content_view($HISTORIA->DATATABLE__($JSON));


	exit;

}



?>