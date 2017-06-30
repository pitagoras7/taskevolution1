
  <?php
  session_start();
  include "../../../../url.php";

 if ($_POST['accion'] == "openModalDatatableconsultaDashboardPaciente")
 {


# IMPORTANTE EN EL DATATABLE_CONDICIONAL HAY QUE COLOCAR LOS PARAMETROS PARA LA SENTENCIA WHERE

# HAY QUE CREAR EL JSON DATATABLE EN DE LA TABLA 
 $PACIENTE = new pacienteModelo();
 $JSON = $PACIENTE->json_element($PACIENTE->tabla,'datatable_dashboard');
 echo $PACIENTE->DATATABLE__($JSON);

exit;

  }



 ?>