<?php 
 
 require_once 'padreModelo.php';

class consultaDetailModelo extends padreModelo {

             private $value_default = "consultaDetail.json";
             public $vista = "consultaDetail";
             public $tabla = "consultaDetail";
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
               $res['campo'] = "cndid";
               $res['id'] = $this->get_cndid();
               return $res;
             }

             public function set_id($x, $w = 0)
             {

               if ($x == 0)
               {
                 $this->set_cndid($x);
               }
               else
               {
                 $this->set_cndid($x, $w);
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


             public $cndid="";
public $cndanxid="";
public $cndanx="";
public $cndden="";
public $cndcan="";
public $cndedo="";
public $cndref="";
public $cndfec="";
public $cndind="";
public $cndinh="";
public $cndinm="";
public $cndest="";
public $cndemi="";
public $cndobs="";


 public function set_cndid($x, $w = 0) { 
       $nombre = 'cndid';  
      $x = $this->_fix_type($nombre, $x);
      $this->cndid = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_cndid() { 
 return $this->cndid; 
 } 





 public function set_cndanxid($x, $w = 0) { 
       $nombre = 'cndanxid';  
      $x = $this->_fix_type($nombre, $x);
      $this->cndanxid = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_cndanxid() { 
 return $this->cndanxid; 
 } 





 public function set_cndanx($x, $w = 0) { 
       $nombre = 'cndanx';  
      $x = $this->_fix_type($nombre, $x);
      $this->cndanx = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_cndanx() { 
 return $this->cndanx; 
 } 





 public function set_cndden($x, $w = 0) { 
       $nombre = 'cndden';  
      $x = $this->_fix_type($nombre, $x);
      $this->cndden = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_cndden() { 
 return $this->cndden; 
 } 





 public function set_cndcan($x, $w = 0) { 
       $nombre = 'cndcan';  
      $x = $this->_fix_type($nombre, $x);
      $this->cndcan = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_cndcan() { 
 return $this->cndcan; 
 } 





 public function set_cndedo($x, $w = 0) { 
       $nombre = 'cndedo';  
      $x = $this->_fix_type($nombre, $x);
      $this->cndedo = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_cndedo() { 
 return $this->cndedo; 
 } 





 public function set_cndref($x, $w = 0) { 
       $nombre = 'cndref';  
      $x = $this->_fix_type($nombre, $x);
      $this->cndref = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_cndref() { 
 return $this->cndref; 
 } 





 public function set_cndfec($x, $w = 0) { 
       $nombre = 'cndfec';  
      $x = $this->_fix_type($nombre, $x);
      $this->cndfec = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_cndfec() { 
 return $this->cndfec; 
 } 





 public function set_cndind($x, $w = 0) { 
       $nombre = 'cndind';  
      $x = $this->_fix_type($nombre, $x);
      $this->cndind = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_cndind() { 
 return $this->cndind; 
 } 





 public function set_cndinh($x, $w = 0) { 
       $nombre = 'cndinh';  
      $x = $this->_fix_type($nombre, $x);
      $this->cndinh = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_cndinh() { 
 return $this->cndinh; 
 } 





 public function set_cndinm($x, $w = 0) { 
       $nombre = 'cndinm';  
      $x = $this->_fix_type($nombre, $x);
      $this->cndinm = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_cndinm() { 
 return $this->cndinm; 
 } 





 public function set_cndest($x, $w = 0) { 
       $nombre = 'cndest';  
      $x = $this->_fix_type($nombre, $x);
      $this->cndest = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_cndest() { 
 return $this->cndest; 
 } 





 public function set_cndemi($x, $w = 0) { 
       $nombre = 'cndemi';  
      $x = $this->_fix_type($nombre, $x);
      $this->cndemi = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_cndemi() { 
 return $this->cndemi; 
 } 





 public function set_cndobs($x, $w = 0) { 
       $nombre = 'cndobs';  
      $x = $this->_fix_type($nombre, $x);
      $this->cndobs = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_cndobs() { 
 return $this->cndobs; 
 } 



} 
 
 ?>