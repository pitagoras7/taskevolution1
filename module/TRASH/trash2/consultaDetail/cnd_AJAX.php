<?php  session_start(); 

require_once '../../url.php';



if ($_POST['accion'] == "edit_cnd")
{

 $CONSULTADETAIL = new consultaDetailModelo();
 $CONSULTADETAIL->set_id($CONSULTADETAIL->decrypt($_POST['v1']));
 $RESULT_CONSULTADETAIL = $CONSULTADETAIL->select_all(1);
 $_SESSION['temp']['consultaDetail_id'] = $CONSULTADETAIL->decrypt($_POST['v1']);
 echo $CONSULTADETAIL->modal_($RESULT_CONSULTADETAIL);
 exit;
}

if ($_POST['accion'] == "new_cnd")
{

 $CONSULTADETAIL = new consultaDetailModelo();
 $CONSULTADETAIL->set_id(0);
 unset($_SESSION['temp']['consultaDetail_id']);

 $RESULT_CONSULTADETAIL = $CONSULTADETAIL->select_all(1);
 echo $CONSULTADETAIL->modal_($RESULT_CONSULTADETAIL,'new');
 exit;
}



if (($_POST['accion'] == "save_cnd"))
{

 $CONSULTADETAIL = new consultaDetailModelo();


 if ($_SESSION['temp']['consultaDetail_id'])
 {
   $CONSULTADETAIL->set_id($_SESSION['temp']['consultaDetail_id'], 1);  
 }



 $CONSULTADETAIL->setter__($_POST);
 $CONSULTADETAIL->save();
 echo $CONSULTADETAIL->datatable_();
 exit;
}





if ($_POST['accion'] == "add_cnd")
{


 $CONSULTADETAIL    = new consultaDetailModelo();
 $_POST['cndanxid'] = $CONSULTADETAIL->decrypt($_POST['v1']);
 $_POST['cndanx']   = $_SESSION['temp']['tabla_anexo'];

  if($_SESSION['temp']['tabla_anexo']=='enfermedad'){
  $ENFERMEDAD = new enfermedadModelo();
  $RESULT_ENFERMEDAD = $ENFERMEDAD->select_all(" enfid in (".$ENFERMEDAD->decrypt($_POST['v1'])." ) ");
  $_POST['cndden']   = $RESULT_ENFERMEDAD[0]['enfden'];
  }
     


 $CONSULTADETAIL->setter__($_POST);
 $CONSULTADETAIL->save();
 echo $CONSULTADETAIL->datatable_();


}




?>
