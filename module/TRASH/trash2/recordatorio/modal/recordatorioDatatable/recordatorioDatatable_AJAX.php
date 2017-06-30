
  <?php
  session_start();
  include "../../../../url.php";

 if ($_POST['accion'] == "openModalDatatablerecordatorioDatatable")
 {


# IMPORTANTE EN EL DATATABLE_CONDICIONAL HAY QUE COLOCAR LOS PARAMETROS PARA LA SENTENCIA WHERE

# HAY QUE CREAR EL JSON DATATABLE EN DE LA TABLA 

   $RECORDATORIO = new recordatorioModelo();

  $RECORDATORIO->DATATABLE_CONDICIONAL=" 1=1  ";
  $JSON = $RECORDATORIO->json_element($RECORDATORIO->tabla,'datatable_consulta');
 echo $RECORDATORIO->DATATABLE__($JSON);

exit;

  }



 ?>