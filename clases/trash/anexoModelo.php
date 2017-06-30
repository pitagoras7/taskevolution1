<?php 
 
 require_once 'padreModelo.php';

class anexoModelo extends padreModelo {

             private $value_default = "anexo.json";
             public $vista = "anexo";
             public $tabla = "anexo";
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
               $res['campo'] = "anxid";
               $res['id'] = $this->get_anxid();
               return $res;
             }

             public function set_id($x, $w = 0)
             {

               if ($x == 0)
               {
                 $this->set_anxid($x);
               }
               else
               {
                 $this->set_anxid($x, $w);
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


             public $anxid="";
public $anxden="";
public $anxico="";
public $anxava="";
public $anxcol="";
public $anxreg="";
public $anxcod="";
public $anxest="";
public $anxobs="";


 public function set_anxid($x, $w = 0) { 
       $nombre = 'anxid';  
      $x = $this->_fix_type($nombre, $x);
      $this->anxid = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_anxid() { 
 return $this->anxid; 
 } 





 public function set_anxden($x, $w = 0) { 
       $nombre = 'anxden';  
      $x = $this->_fix_type($nombre, $x);
      $this->anxden = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_anxden() { 
 return $this->anxden; 
 } 





 public function set_anxico($x, $w = 0) { 
       $nombre = 'anxico';  
      $x = $this->_fix_type($nombre, $x);
      $this->anxico = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_anxico() { 
 return $this->anxico; 
 } 





 public function set_anxava($x, $w = 0) { 
       $nombre = 'anxava';  
      $x = $this->_fix_type($nombre, $x);
      $this->anxava = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_anxava() { 
 return $this->anxava; 
 } 





 public function set_anxcol($x, $w = 0) { 
       $nombre = 'anxcol';  
      $x = $this->_fix_type($nombre, $x);
      $this->anxcol = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_anxcol() { 
 return $this->anxcol; 
 } 





 public function set_anxreg($x, $w = 0) { 
       $nombre = 'anxreg';  
      $x = $this->_fix_type($nombre, $x);
      $this->anxreg = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_anxreg() { 
 return $this->anxreg; 
 } 





 public function set_anxcod($x, $w = 0) { 
       $nombre = 'anxcod';  
      $x = $this->_fix_type($nombre, $x);
      $this->anxcod = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_anxcod() { 
 return $this->anxcod; 
 } 





 public function set_anxest($x, $w = 0) { 
       $nombre = 'anxest';  
      $x = $this->_fix_type($nombre, $x);
      $this->anxest = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_anxest() { 
 return $this->anxest; 
 } 





 public function set_anxobs($x, $w = 0) { 
       $nombre = 'anxobs';  
      $x = $this->_fix_type($nombre, $x);
      $this->anxobs = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_anxobs() { 
 return $this->anxobs; 
 } 




public function menu_filter_cards($x)
{


    $result = $this->select_all(" anxest in ('t') and anxaxcid in (".$x.") ");



    for($i=0;$i<count($result);$i++){
        $this->menu_ico                 = $result[$i]['anxico'];
        $this->menu_den                 = $result[$i]['anxden'];
        $this->menu_col                 = $result[$i]['anxcol'];
        $this->menu_class               = " btn  menu_category_card  ";
        $this->menu_style               = " width:150px; height:50px; font-size:14px; font-weight:bold ";
        $this->menu_parametro_onclick   = $result[$i]['anxid_code'];
        $this->menu_parametro_url       = "module/".$this->tabla."/anx_AJAX.php";
        $this->menu_parametro_view      = "visor1";
        $this->menu_onclick             = "filter_cards_002";
        $res.=$this->MENU_4();
    }

    return $res;
}


public function mostrar_anexo($x,$decrypt=true)
{
    if($decrypt) $x = $this->decrypt($x);
    
    $result = $this->select_all(" anxest in ('t') and  anxid in (".$x.") ");
    return $result[0]['anxobs'];
}



} 
 
 ?>