
  <?php
  session_start();
  include "../../../../url.php";

 if ($_POST['accion'] == "openModalDatatableconsultaDashboardconsulta")
 {


# IMPORTANTE EN EL DATATABLE_CONDICIONAL HAY QUE COLOCAR LOS PARAMETROS PARA LA SENTENCIA WHERE

# HAY QUE CREAR EL JSON DATATABLE EN DE LA TABLA 



   $CONSULTA = new consultaModelo();

  $JSON = $CONSULTA->json_element($CONSULTA->tabla,'datatable_dashboardConsulta');

 

  echo $CONSULTA->DATATABLE__($JSON);

exit;

  }



 ?>