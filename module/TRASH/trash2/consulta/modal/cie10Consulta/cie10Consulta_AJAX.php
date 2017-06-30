
  <?php
  session_start();
  include "../../../../url.php";

 if ($_POST['accion'] == "openModalDatatablecie10Consulta")
 {


# IMPORTANTE EN EL DATATABLE_CONDICIONAL HAY QUE COLOCAR LOS PARAMETROS PARA LA SENTENCIA WHERE

# HAY QUE CREAR EL JSON DATATABLE EN DE LA TABLA ENFERMEDAD

   $ENFERMEDAD = new enfermedadModelo();

  //$ENFERMEDAD->DATATABLE_CONDICIONAL=" enfest in ('t')  ";
  $JSON = $ENFERMEDAD->json_element($ENFERMEDAD->tabla,'datatable_consulta');
 echo $ENFERMEDAD->modal_content_view($ENFERMEDAD->DATATABLE__($JSON));

exit;

  }



 ?>