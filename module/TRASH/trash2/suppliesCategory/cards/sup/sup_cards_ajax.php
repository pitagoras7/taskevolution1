<?php
session_start();
include '../../../../url.php';




if ($_POST['accion'] == "filter_cards_")
{



 $SUPPLIES = new suppliesModelo();
 $SUPPLIES->set_supsucid($SUPPLIES->decrypt($_POST['v1']));
    

 

 if( $SUPPLIES->get_supsucid()==1){
  $condicional = " supest in ('t') ";
}else{
  $condicional = " supest in ('t') and supsucid in (".$SUPPLIES->get_supsucid().")";
}

//$_SESSION['temp']['SUPPLIESCATEGORY_id'] = $SUPPLIES->get_supsucid();
echo $datos['cardsimple'] = $SUPPLIES->cardsimple_($condicional);
exit;

}


?>