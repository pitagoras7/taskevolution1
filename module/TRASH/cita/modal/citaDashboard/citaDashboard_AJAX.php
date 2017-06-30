
  <?php
  session_start();
  include "../../../../url.php";

 if ($_POST['accion'] == "openModalDatatablecitaDashboard")
 {


# IMPORTANTE EN EL DATATABLE_CONDICIONAL HAY QUE COLOCAR LOS PARAMETROS PARA LA SENTENCIA WHERE

# HAY QUE CREAR EL JSON DATATABLE EN DE LA TABLA 

  $CITA = new citaModelo();
  $CITA->filtro_datatable($_POST['parametro']);
  $JSON = $CITA->json_element($CITA->tabla,'datatable_dashboard');
  echo $CITA->DATATABLE__($JSON);

  exit;

  }



if ($_POST['accion'] == "edit_citedo")
{

    $CITA = new citaModelo();
    $CITA->set_id($CITA->decrypt($_POST['v1']));
    $RESULT_CITA = $CITA->select_all(1);

  
   $_SESSION['temp']['CITA_edo'] = $RESULT_CITA['citedo'];

   $_SESSION['temp']['CITA_id'] = $CITA->decrypt($_POST['v1']);

   $JSON = $CITA->soyjson($CITA->tabla,'modal','citaDashboard');

   echo $CITA->MODAL__($JSON,$RESULT_CITA);




    exit;
}




if (($_POST['accion'] == "save_citedo"))
{

 $CITA = new citaModelo();

  if($_SESSION['temp']['CITA_edo']==$_POST['citedo']){

  }else{
    $_POST['cittur']=$CITA->reg();
  }


 
  $CITA->set_id($_SESSION['temp']['CITA_id'], 1);  
  $CITA->setter__($_POST);
  $CITA->save();


  $CITA = new citaModelo();
  $CITA->DATATABLE_CONDICIONAL=" citid > 0 and citest in ('t')  ";
  $JSON = $CITA->json_element($CITA->tabla,'datatable_dashboard');

  $PARAMETRO['datatable'] = $CITA->DATATABLE__($JSON);
  echo $VIEW->dashboardConsultaVisor($PARAMETRO);

  exit;
}

 ?>