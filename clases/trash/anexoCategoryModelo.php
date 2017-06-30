<?php 

require_once 'padreModelo.php';

class anexoCategoryModelo extends padreModelo {

 private $value_default = "anexoCategory.json";
 public $vista = "anexoCategory";
 public $tabla = "anexoCategory";
 public $id_dependiente = "";


 public function _config_($json="")
 {

   if(strlen($json)>1){
     $this->value_default=$json;
   }


   $str_datos = file_get_contents($_SERVER['DOCUMENT_ROOT']."/".$this->proyecto."/module/".$this->tabla."/data/".$this->value_default);
   $datos = json_decode($str_datos, true);
   fwrite($fh, json_encode($datos, JSON_UNESCAPED_UNICODE));
   fclose($fh);
   return $datos;
 }




 public function get_select_all()
 {
   $res['campo'] = "axcid";
   $res['id'] = $this->get_axcid();
   return $res;
 }

 public function set_id($x, $w = 0)
 {

   if ($x == 0)
   {
     $this->set_axcid($x);
   }
   else
   {
     $this->set_axcid($x, $w);
   }
 }




 public function modal_($data, $modo = 'edit')
 {


   if($this->modal_json==""){
     $this->modal_json = "form_";          
   }


   $data_json = $this->_config_();
   $form_new = $data_json[$this->modal_json];
   $this->modal_reset();
   $this->modal_only_form = true;
   $this->modal_id = $form_new['id'];
   $this->modal_class = $form_new['class'];
   $this->modal_body_height = $form_new['height'];
   $this->title_modal = $form_new['title'];
   $this->modal_data = $data;
   $this->modal_form_class = $form_new['form_class'];
   $this->modal_form_enctype = false;
   $this->modal_form_id = $form_new['form_id'];


   if ($modo == 'new')
   {
     $this->modal_data_new = true;
   }



   for ($i = 0; $i < count($form_new['col']); $i++)
   {
     $this->modal_body_row_input_json($form_new['col'][$i]);
   }


   for ($i = 0; $i < count($form_new['button_footer']); $i++)
   {
     $this->modal_footer_buttons_json($form_new['button_footer'][$i]);
   }


   return $this->modal_form_content();
 }


 public function validation($sspsupid,$sspsrvid){


   $data = $this->_config_();
   $est = $data['type_combo_multiple'][0]['fk_table_est'];
   $campo_dependiente = $data['type_combo_multiple'][0]['fk_table_id3']; 
   $campo_independiente = $data['type_combo_multiple'][0]['fk_table_id2']; 


   $sql = "
   select ".$data['type_combo_multiple'][0]['fk_id2']."  as id  from ".$data['config']['table']."  where  ".$est."='t' and ".$campo_dependiente." in (".$sspsrvid.") and ".$campo_independiente."  in ( ".$sspsupid.")";
   $data = $this->ejecutar_query($sql);

   if($data[0]['id']>0){
     echo $data[0]['id'];
     return false;
   }else{
     echo $data[0]['id'];
     return true;
   }
 }


 public function reset($sspsrvid){

   $data = $this->_config_();

   $est = $data['type_combo_multiple'][0]['fk_table_est'];
   $campo_dependiente = $data['type_combo_multiple'][0]['fk_table_id3']; 

   $sql = "update  ".$data['config']['table']." set  ".$est."='f' Where ".$campo_dependiente." in (".$sspsrvid.")";

   $data = $this->ejecutar_query($sql);
 }

 /* DATATABLE */

 public function datatable_()
 {
   $data = $this->_config_();
   $this->datatable_struct = $data['datatable'];


   $est = $data['type_combo_multiple'][0]['fk_table_est'];
   $campo_dependiente = $data['type_combo_multiple'][0]['fk_table_id3'];    

   $this->datatable_data = $this->select_all($this->datatable_struct['select_conditional']);
         //$this->datatable_data = $this->select_all("  ". $est."='t' and ".$campo_dependiente." in (".$this->id_dependiente.")"  );
   return $this->DATATABLE_content();
 }



 public function datatable_data($data1)
 {
   $data = $this->_config_();
   $this->datatable_struct = $data['datatable'];
   $this->datatable_data = $data1;
   return $this->DATATABLE_content();
 }

 /* FUNCIONES BASICAS */


 public function _dataprint_($data)
 {

      // $this->idddddd = 1;
      // $data = $this->DATAPRINT__($data, $this->_config_());

      //return $data;
 }

 public function select_all($condicion = '0')
 {


   $this->dataprint_data_json = $this->_config_();
   $this->select_select_all = $this->get_select_all();
   $this->sql_combomultiple_id = $this->id_dependiente;    
   $this->select_vista = $this->vista;
   return $this->SELECT__($condicion);
 }




 public function _fix_type($nombre, $valor)
 {

   $data_json = $this->_config_();
   $valor = $this->FIXTYPE__($nombre, $valor, $data_json);
   return $valor;
 }

 public function save()
 {
   $this->save_campo = $this->campo;
   $this->save_value = $this->value;
   $this->save_campo_where = $this->campo_where;
   $this->save_value_where = $this->value_where;
   $this->save_tabla = $this->tabla;
   $this->SAVE__();
 }

 public function input_file($file, $dir)
 {


   if (strlen($file['name']) > 3)
   {

     $fichero_subido = $dir . basename($file['name']);

     $resultado = $file['name'];

     if (move_uploaded_file($file['tmp_name'], $fichero_subido))
     {
             #   echo "El fichero es válido y se subió con éxito.";
     }
     else
     {
       echo "¡Posible ataque de subida de ficheros!";
     }
   }

   return $resultado;
 }

 public function setter__($x, $w = 0)
 {

   $json = $this->_config_();
   $cols = $json['config'];

   $key = array_keys($x);

   $i = 0;
   foreach ($key as $val)
   {

     $post[$i]['campo'] = $val;
     $i++;
   }

   $y = 0;
   foreach ($x as $val1)
   {
     $post[$y]['value'] = $val1;
     $y++;
   }


   for ($i = 0; $i < count($post); $i++)
   {

     foreach ($cols['col'] as $col)
     {


       if (($col['campo'] == $post[$i]['campo']) && ($col['key'] !== 'PRI' ))
       {

         $nombre = $post[$i]['campo'];
         $x = $post[$i]['value'];

         $x = $this->_fix_type($nombre, $x);

         if ($w > 0)
         {
           $this->campo_where[] = $nombre;
           $this->value_where[] = $x;
         }
         else
         {
           $this->campo[] = $nombre;
           $this->value[] = $x;
         }
       }
     }
   }
 }



 public function formatos_especiales($data)
 {



               /*
               for ($i = 0; $i < count($data); $i++)
               {


                 $total01 = $data[$i]['subtotal'] + $data[$i]['iva'];

                 $descuento = $total01 * ($data[$i]['descuento'] / 100);

                 $total02 = $total01 - $descuento;

                 $data[$i]['total'] = $this->_is_formato_moneda_($total02);
                 $data[$i]['estatus_aprobacion'] = $this->get_estatus_de_aprobacion($data[$i]['presupuesto_id']);
               }
      */
               return $data;
             }


             public $axcid="";
             public $axcden="";
             public $axcest="";
             public $axcreg="";
             public $axcuse="";
             public $axcobs="";
             public $axccol="";
             public $axcico="";


             public function set_axcid($x, $w = 0) { 
               $nombre = 'axcid';  
               $x = $this->_fix_type($nombre, $x);
               $this->axcid = $x; 
               if ($w > 0) {
                $this->campo_where[] = $nombre; 
                $this->value_where[] = $x; 
              } else { 
               $this->campo[] = $nombre; 
               $this->value[] = $x; 
             } 
           } 

           public function get_axcid() { 
             return $this->axcid; 
           } 





           public function set_axcden($x, $w = 0) { 
             $nombre = 'axcden';  
             $x = $this->_fix_type($nombre, $x);
             $this->axcden = $x; 
             if ($w > 0) {
              $this->campo_where[] = $nombre; 
              $this->value_where[] = $x; 
            } else { 
             $this->campo[] = $nombre; 
             $this->value[] = $x; 
           } 
         } 

         public function get_axcden() { 
           return $this->axcden; 
         } 





         public function set_axcest($x, $w = 0) { 
           $nombre = 'axcest';  
           $x = $this->_fix_type($nombre, $x);
           $this->axcest = $x; 
           if ($w > 0) {
            $this->campo_where[] = $nombre; 
            $this->value_where[] = $x; 
          } else { 
           $this->campo[] = $nombre; 
           $this->value[] = $x; 
         } 
       } 

       public function get_axcest() { 
         return $this->axcest; 
       } 





       public function set_axcreg($x, $w = 0) { 
         $nombre = 'axcreg';  
         $x = $this->_fix_type($nombre, $x);
         $this->axcreg = $x; 
         if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
        } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
       } 
     } 

     public function get_axcreg() { 
       return $this->axcreg; 
     } 





     public function set_axcuse($x, $w = 0) { 
       $nombre = 'axcuse';  
       $x = $this->_fix_type($nombre, $x);
       $this->axcuse = $x; 
       if ($w > 0) {
        $this->campo_where[] = $nombre; 
        $this->value_where[] = $x; 
      } else { 
       $this->campo[] = $nombre; 
       $this->value[] = $x; 
     } 
   } 

   public function get_axcuse() { 
     return $this->axcuse; 
   } 





   public function set_axcobs($x, $w = 0) { 
     $nombre = 'axcobs';  
     $x = $this->_fix_type($nombre, $x);
     $this->axcobs = $x; 
     if ($w > 0) {
      $this->campo_where[] = $nombre; 
      $this->value_where[] = $x; 
    } else { 
     $this->campo[] = $nombre; 
     $this->value[] = $x; 
   } 
 } 
 
 public function get_axcobs() { 
   return $this->axcobs; 
 } 





 public function set_axccol($x, $w = 0) { 
   $nombre = 'axccol';  
   $x = $this->_fix_type($nombre, $x);
   $this->axccol = $x; 
   if ($w > 0) {
    $this->campo_where[] = $nombre; 
    $this->value_where[] = $x; 
  } else { 
   $this->campo[] = $nombre; 
   $this->value[] = $x; 
 } 
} 

public function get_axccol() { 
 return $this->axccol; 
} 





public function set_axcico($x, $w = 0) { 
 $nombre = 'axcico';  
 $x = $this->_fix_type($nombre, $x);
 $this->axcico = $x; 
 if ($w > 0) {
  $this->campo_where[] = $nombre; 
  $this->value_where[] = $x; 
} else { 
 $this->campo[] = $nombre; 
 $this->value[] = $x; 
} 
} 

public function get_axcico() { 
 return $this->axcico; 
} 



public function menu_filter_cards($x)
{

  $result = $this->select_all(" axcest in ('t') limit 0,5");

  if( count($result)<1 ){
    $result = $this->select_all(" axcest in ('t') limit 0,5");
  } 


  for($i=0;$i<count($result);$i++){
    $this->menu_ico                 = $result[$i]['axcico'];
    $this->menu_den                 = $result[$i]['axcden'];
    $this->menu_col                 = $result[$i]['axccol'];
    $this->menu_class               = " btn  menu_category_card  ";
    $this->menu_style               = " width:150px; height:40px; font-size:14px; font-weight:bold ";
    $this->menu_parametro_onclick   = $result[$i]['axcid_code'];
    $this->menu_parametro_url       = "module/".$this->tabla."/axc_AJAX.php";
    $this->menu_parametro_view      = "panel";
    $this->menu_onclick             = "filter_cards_";
    $res.=$this->MENU_4();
  }

  return $res;
}


public function menu_dashboard(){
  $this->menu_ico                 = "";
  $this->menu_den                 = "Evolucion medica";
  $this->menu_col                 = "btn-success";
  $this->menu_class               = " btn  menu_category_card  ";
  $this->menu_style               = " width:150px; height:40px; font-size:14px; font-weight:bold ";
  $this->menu_parametro_onclick   = "";
  $this->menu_parametro_url       = "";
  $this->menu_parametro_view      = "";
  $this->menu_onclick             = "";
  $this->menu_href                = "?opcion=abrirConsulta";
  return  $res.=$this->MENU_4();
}


public function menu_newhistoria(){
  $this->menu_ico                 = "";
  $this->menu_den                 = " Historia Médica ";
  $this->menu_col                 = "btn-danger";
  $this->menu_class               = " btn  menu_category_card  ";
  $this->menu_style               = " width:150px; height:40px; font-size:14px; font-weight:bold ";
  $this->menu_parametro_onclick   = "";
  $this->menu_parametro_url       = "";
  $this->menu_parametro_view      = "";
  $this->menu_onclick             = "";
  $this->menu_href                = "?opcion=abrirHistoria";
  return  $res.=$this->MENU_4();
}


public function menu_newInforme(){
  $this->menu_ico                 = "";
  $this->menu_den                 = " Informe ";
  $this->menu_col                 = "btn-info";
  $this->menu_class               = " btn  menu_category_card  ";
  $this->menu_style               = " width:150px; height:40px; font-size:14px; font-weight:bold ";
  $this->menu_parametro_onclick   = "";
  $this->menu_parametro_url       = "";
  $this->menu_parametro_view      = "";
  $this->menu_onclick             = "";
  $this->menu_href                = "?opcion=abrirInforme";
  return  $res.=$this->MENU_4();
}

public function menu_newReferencia(){
  $this->menu_ico                 = "";
  $this->menu_den                 = " Referencia ";
  $this->menu_col                 = "btn-info";
  $this->menu_class               = " btn  menu_category_card  ";
  $this->menu_style               = " width:150px; height:40px; font-size:14px; font-weight:bold ";
  $this->menu_parametro_onclick   = "";
  $this->menu_parametro_url       = "";
  $this->menu_parametro_view      = "";
  $this->menu_onclick             = "";
  $this->menu_href                = "?opcion=abrirReferencia";
  return  $res.=$this->MENU_4();
}

public function menu_newIndicaciones(){
  $this->menu_ico                 = "";
  $this->menu_den                 = " Indicaciones ";
  $this->menu_col                 = "btn-info";
  $this->menu_class               = " btn  menu_category_card  ";
  $this->menu_style               = " width:150px; height:40px; font-size:14px; font-weight:bold ";
  $this->menu_parametro_onclick   = "";
  $this->menu_parametro_url       = "";
  $this->menu_parametro_view      = "";
  $this->menu_onclick             = "";
  $this->menu_href                = "?opcion=abrirIndicaciones";
  return  $res.=$this->MENU_4();
}


} 

?>