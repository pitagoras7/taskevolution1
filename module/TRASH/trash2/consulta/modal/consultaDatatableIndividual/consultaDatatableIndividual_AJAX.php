
  <?php
  session_start();
  include "../../../../url.php";

 if ($_POST['accion'] == "openModalDatatableconsultaDatatableIndividual")
 {

  $CONSULTA = new consultaModelo();

  $CONSULTA->DATATABLE_CONDICIONAL=" conpacid in (".$_SESSION['temp']['PACIENTE_id'].")";
  $JSON = $CONSULTA->json_element($CONSULTA->tabla,'datatable_dashboardConsulta');
  echo $CONSULTA->DATATABLE__($JSON);

  exit;

  }



 ?>