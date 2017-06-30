
  <?php
  session_start();
  include "../../../../url.php";

 if ($_POST['accion'] == "openModalDatatabledoctorList")
 {


# IMPORTANTE EN EL DATATABLE_CONDICIONAL HAY QUE COLOCAR LOS PARAMETROS PARA LA SENTENCIA WHERE

# HAY QUE CREAR EL JSON DATATABLE EN DE LA TABLA 

   $ = new Modelo();

  $->DATATABLE_CONDICIONAL=" 1=1  ";
  $JSON = $->json_element($->tabla,'datatable_consulta');
 echo $->modal_content_view($->DATATABLE__());

exit;

  }



 ?>