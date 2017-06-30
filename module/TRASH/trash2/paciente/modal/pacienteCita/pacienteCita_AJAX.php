
  <?php
  session_start();
  include "../../../../url.php";

 if ($_POST['accion'] == "openModalDatatablepacienteCita")
 {


# IMPORTANTE EN EL DATATABLE_CONDICIONAL HAY QUE COLOCAR LOS PARAMETROS PARA LA SENTENCIA WHERE

# HAY QUE CREAR EL JSON DATATABLE EN DE LA TABLA 



  $PACIENTE = new pacienteModelo();
  $PACIENTE->DATATABLE_CONDICIONAL=" 1=1  ";

  if($_POST['parametro']=='cita'){
  	  $JSON = $PACIENTE->json_element($PACIENTE->tabla,'datatable_cita');
  }

  if($_POST['parametro']=='consulta'){
  	  $JSON = $PACIENTE->json_element($PACIENTE->tabla,'datatable_consulta_minima');
  }

  if($_POST['parametro']=='pago'){
  	  $JSON = $PACIENTE->json_element($PACIENTE->tabla,'datatable_pago');
  }



  echo $PACIENTE->modal_content_view($PACIENTE->DATATABLE__($JSON));
  exit;

  }



 ?>