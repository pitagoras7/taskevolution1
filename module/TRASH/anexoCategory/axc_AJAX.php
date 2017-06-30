<?php  session_start(); 
 
 require_once '../../url.php';



 if ($_POST['accion'] == "edit_axc")
            {

             $ANEXOCATEGORY = new anexoCategoryModelo();
             $ANEXOCATEGORY->set_id($ANEXOCATEGORY->decrypt($_POST['v1']));
             $RESULT_ANEXOCATEGORY = $ANEXOCATEGORY->select_all(1);
             $_SESSION['temp']['anexoCategory_id'] = $ANEXOCATEGORY->decrypt($_POST['v1']);
             echo $ANEXOCATEGORY->modal_($RESULT_ANEXOCATEGORY);
             exit;
           }

           if ($_POST['accion'] == "new_axc")
           {

             $ANEXOCATEGORY = new anexoCategoryModelo();
             $ANEXOCATEGORY->set_id(0);
             unset($_SESSION['temp']['anexoCategory_id']);

             $RESULT_ANEXOCATEGORY = $ANEXOCATEGORY->select_all(1);
             echo $ANEXOCATEGORY->modal_($RESULT_ANEXOCATEGORY,'new');
             exit;
           }

           if (($_POST['accion'] == "save_axc"))
           {

             $ANEXOCATEGORY = new anexoCategoryModelo();


             if ($_SESSION['temp']['anexoCategory_id'])
             {
               $ANEXOCATEGORY->set_id($_SESSION['temp']['anexoCategory_id'], 1);  
             }



             $ANEXOCATEGORY->setter__($_POST);
             $ANEXOCATEGORY->save();
             echo $ANEXOCATEGORY->datatable_();
             exit;
           }

           
 



 if ($_POST['accion'] == "filter_cards_")
 {


                 $CONSULTA = new consultaModelo();
                 $CONSULTA->set_id($CONSULTA->decrypt($_SESSION['temp']['CONSULTA_id']));
                 $RESULT_CONSULTA = $CONSULTA->select_all(" conest in ('t') and conid in ('1')");



                 $anexoCategory_id = ($CONSULTA->decrypt($_POST['v1']));



              if($anexoCategory_id == 1 ){

                 $JSON = $CONSULTA->soyjson($CONSULTA->tabla,'modal','formEvolucionMedica');
               

                 $ANEXO = new anexoModelo();
          
                  echo "


                  <div id=\"visor1\"  class=\"col-md-12\">
                  ".$CONSULTA->MODAL__($JSON,$RESULT_CONSULTA[0])."
                  </div>

                  <div id=\"visor2\" >

                  </div>";

                }



                if($anexoCategory_id == 2){


                $JSON = $CONSULTA->soyjson($CONSULTA->tabla,'modal','formInforme');
                $ANEXO = new anexoModelo();
                 echo "
                  <div id=\"navVisor\" class=\"col-md-12\"  >
                    ".$ANEXO->menu_filter_cards($ANEXO->decrypt($_POST['v1']))."
                  </div>
                  <div id=\"visor1\"  class=\"col-md-12\">
                  ".$CONSULTA->MODAL__($JSON,$RESULT_CONSULTA[0])."
                  </div>
                  <div id=\"visor2\" >
                  </div>";
                }



                if($anexoCategory_id == 4){
                 $JSON = $CONSULTA->soyjson($CONSULTA->tabla,'modal','formIndicaciones');
               


                  $ANEXO = new anexoModelo();
          
                 echo "

                  <div id=\"navVisor\" class=\"col-md-12\"  >
                    ".$ANEXO->menu_filter_cards($ANEXO->decrypt($_POST['v1']))."
                  </div>



                  <div id=\"visor1\"  class=\"col-md-12\">
                  ".$CONSULTA->MODAL__($JSON,$RESULT_CONSULTA[0])."
                  </div>



                  <div id=\"visor2\" >

                  </div>";

                }




                if($anexoCategory_id == 3){
                 $JSON = $CONSULTA->soyjson($CONSULTA->tabla,'modal','formReferencia');
               


                  $ANEXO = new anexoModelo();
          
                 echo "

                  <div id=\"navVisor\" class=\"col-md-12\"  >
                    ".$ANEXO->menu_filter_cards($ANEXO->decrypt($_POST['v1']))."
                  </div>



                  <div id=\"visor1\"  class=\"col-md-12\">
                  ".$CONSULTA->MODAL__($JSON,$RESULT_CONSULTA[0])."
                  </div>



                  <div id=\"visor2\" >

                  </div>";

                }





                if($anexoCategory_id == 5){

                 $EXAMENFISICO = new examenFisicoModelo();

                 $JSON = $EXAMENFISICO->soyjson($EXAMENFISICO->tabla,'modal','examenFisico');
                 $RESULT_EXAMENFISICO = $EXAMENFISICO->select_all(" exfest in ('t') and exfconid in ('1')");



                  $ANEXO = new anexoModelo();
          
                 echo "

                  <div id=\"navVisor\" class=\"col-md-12\"  >
                    ".$ANEXO->menu_filter_cards($ANEXO->decrypt($_POST['v1']))."
                  </div>



                  <div id=\"visor1\"  class=\"col-md-8\">
                  ".$EXAMENFISICO->MODAL__($JSON,$RESULT_EXAMENFISICO[0])."
                  </div>



                  <div id=\"visor2\" class=\"col-md-4\" >

                  </div>";

                }







 }



 

           ?>
           