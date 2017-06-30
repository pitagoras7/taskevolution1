
<?php
session_start();
include "../../../../url.php";

if ($_POST['accion'] == "openConsultaMedicamento")
{


 $MEDICAMENTO = new medicamentoModelo();

  //$ENFERMEDAD->DATATABLE_CONDICIONAL=" enfest in ('t')  ";
 $JSON = $MEDICAMENTO->json_element($MEDICAMENTO->tabla,'datatable_consulta');
 echo $MEDICAMENTO->modal_content_view($MEDICAMENTO->DATATABLE__($JSON));

 exit;

}



?>