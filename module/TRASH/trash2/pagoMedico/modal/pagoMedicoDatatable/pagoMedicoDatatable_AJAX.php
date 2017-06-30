
  <?php
  session_start();
  include "../../../../url.php";

 if ($_POST['accion'] == "openModalDatatablepagoMedicoDatatable")
 {


# IMPORTANTE EN EL DATATABLE_CONDICIONAL HAY QUE COLOCAR LOS PARAMETROS PARA LA SENTENCIA WHERE

# HAY QUE CREAR EL JSON DATATABLE EN DE LA TABLA 

   $PAGOMEDICO = new pagoMedicoModelo();

	  $PAGOMEDICO->DATATABLE_CONDICIONAL=" pagest in ('t') ";
	  $JSON = $PAGOMEDICO->json_element($PAGOMEDICO->tabla,'datatable_consulta');
 echo $PAGOMEDICO->DATATABLE__($JSON);

exit;

  }



 ?>