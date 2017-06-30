
  <?php
  session_start();
  include "../../../../url.php";






 if ($_POST['accion'] == "openModalDatatableMedicamentoConsultaDetail")
 {


   $MEDICAMENTO = new medicamentoModelo();

  $MEDICAMENTO->DATATABLE_CONDICIONAL=" mdmest in ('t') ";
  $JSON = $MEDICAMENTO->json_element($MEDICAMENTO->tabla,'datatable_consulta');
 echo $MEDICAMENTO->modal_content_view($MEDICAMENTO->DATATABLE__($JSON));

exit;

  }





 if ($_POST['accion'] == "edit_medicamentoConsultaDetail")
 {


   $CONSULTADETAIL = new consultaDetailModelo();
   $MEDICAMENTO = new medicamentoModelo();
   $MEDICAMENTO->set_id($MEDICAMENTO->decrypt($_POST['v1']));

   $RESULT_MEDICAMENTO = $MEDICAMENTO->select_all(1);


# $_SESSION['temp']['CONSULTADETAIL_id'] = $CONSULTADETAIL->decrypt($_POST['v1']);
   $RESULT_CONSULTADETAIL['cndden'] =$RESULT_MEDICAMENTO['mdmden'];



  # $_SESSION['temp']['CONSULTADETAIL_id'] = $CONSULTADETAIL->decrypt($_POST['v1']);
   $JSON = $CONSULTADETAIL->soyjson($CONSULTADETAIL->tabla,'modal','medicamentoConsultaDetail');
   echo $CONSULTADETAIL->MODAL__($JSON,$RESULT_CONSULTADETAIL);
   exit;
 }



 if (($_POST['accion'] == "save_medicamentoConsultaDetail"))
 {

   $CONSULTADETAIL = new consultaDetailModelo();
   $_POST['cndanx'] = $_SESSION['temp']['tabla_anexo'];
   $_POST['cndden'] =  strtoupper($_POST['cndref'])." | ".$_POST['cndden']." |  Cada ".$_POST['cndinh']." Horas Por ".$_POST['cndind']." Días "."|".$_POST['cndobs'];
   $CONSULTADETAIL->setter__($_POST);
   $CONSULTADETAIL->save();
   echo $CONSULTADETAIL->datatable_();
   exit;
 }

 ?>