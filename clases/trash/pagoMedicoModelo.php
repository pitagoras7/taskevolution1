<?php 
 
 require_once 'padreModelo.php';

class pagoMedicoModelo extends padreModelo {

             private $value_default = "pagoMedico.json";
             public $vista = "pagoMedico";
             public $tabla = "pagoMedico";
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
               $res['campo'] = "pagid";
               $res['id'] = $this->get_pagid();
               return $res;
             }

             public function set_id($x, $w = 0)
             {

               if ($x == 0)
               {
                 $this->set_pagid($x);
               }
               else
               {
                 $this->set_pagid($x, $w);
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


             public $pagid="";
public $pagden="";
public $pagtrfid="";
public $pagcod="";
public $pagmon="";
public $pagdes="";
public $pagcup="";
public $pagobs="";
public $pagedo="";
public $pagmod="";
public $pagncl="";
public $pagrcl="";
public $pagdcl="";
public $pagtcl="";
public $pagttp="";
public $pagtax="";
public $pagest="";
public $pagcnp="";
public $pagreg="";
public $pagusuid="";

public $pagpacid="";


 public function set_pagpacid($x, $w = 0) { 
       $nombre = 'pagpacid';  
      $x = $this->_fix_type($nombre, $x);
      $this->pagpacid = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_pagpacid() { 
 return $this->pagpacid; 
 } 



 public function set_pagid($x, $w = 0) { 
       $nombre = 'pagid';  
      $x = $this->_fix_type($nombre, $x);
      $this->pagid = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_pagid() { 
 return $this->pagid; 
 } 





 public function set_pagden($x, $w = 0) { 
       $nombre = 'pagden';  
      $x = $this->_fix_type($nombre, $x);
      $this->pagden = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_pagden() { 
 return $this->pagden; 
 } 





 public function set_pagtrfid($x, $w = 0) { 
       $nombre = 'pagtrfid';  
      $x = $this->_fix_type($nombre, $x);
      $this->pagtrfid = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_pagtrfid() { 
 return $this->pagtrfid; 
 } 





 public function set_pagcod($x, $w = 0) { 
       $nombre = 'pagcod';  
      $x = $this->_fix_type($nombre, $x);
      $this->pagcod = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_pagcod() { 
 return $this->pagcod; 
 } 





 public function set_pagmon($x, $w = 0) { 
       $nombre = 'pagmon';  
      $x = $this->_fix_type($nombre, $x);
      $this->pagmon = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_pagmon() { 
 return $this->pagmon; 
 } 





 public function set_pagdes($x, $w = 0) { 
       $nombre = 'pagdes';  
      $x = $this->_fix_type($nombre, $x);
      $this->pagdes = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_pagdes() { 
 return $this->pagdes; 
 } 





 public function set_pagcup($x, $w = 0) { 
       $nombre = 'pagcup';  
      $x = $this->_fix_type($nombre, $x);
      $this->pagcup = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_pagcup() { 
 return $this->pagcup; 
 } 





 public function set_pagobs($x, $w = 0) { 
       $nombre = 'pagobs';  
      $x = $this->_fix_type($nombre, $x);
      $this->pagobs = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_pagobs() { 
 return $this->pagobs; 
 } 





 public function set_pagedo($x, $w = 0) { 
       $nombre = 'pagedo';  
      $x = $this->_fix_type($nombre, $x);
      $this->pagedo = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_pagedo() { 
 return $this->pagedo; 
 } 





 public function set_pagmod($x, $w = 0) { 
       $nombre = 'pagmod';  
      $x = $this->_fix_type($nombre, $x);
      $this->pagmod = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_pagmod() { 
 return $this->pagmod; 
 } 





 public function set_pagncl($x, $w = 0) { 
       $nombre = 'pagncl';  
      $x = $this->_fix_type($nombre, $x);
      $this->pagncl = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_pagncl() { 
 return $this->pagncl; 
 } 





 public function set_pagrcl($x, $w = 0) { 
       $nombre = 'pagrcl';  
      $x = $this->_fix_type($nombre, $x);
      $this->pagrcl = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_pagrcl() { 
 return $this->pagrcl; 
 } 





 public function set_pagdcl($x, $w = 0) { 
       $nombre = 'pagdcl';  
      $x = $this->_fix_type($nombre, $x);
      $this->pagdcl = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_pagdcl() { 
 return $this->pagdcl; 
 } 





 public function set_pagtcl($x, $w = 0) { 
       $nombre = 'pagtcl';  
      $x = $this->_fix_type($nombre, $x);
      $this->pagtcl = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_pagtcl() { 
 return $this->pagtcl; 
 } 





 public function set_pagttp($x, $w = 0) { 
       $nombre = 'pagttp';  
      $x = $this->_fix_type($nombre, $x);
      $this->pagttp = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_pagttp() { 
 return $this->pagttp; 
 } 





 public function set_pagtax($x, $w = 0) { 
       $nombre = 'pagtax';  
      $x = $this->_fix_type($nombre, $x);
      $this->pagtax = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_pagtax() { 
 return $this->pagtax; 
 } 





 public function set_pagest($x, $w = 0) { 
       $nombre = 'pagest';  
      $x = $this->_fix_type($nombre, $x);
      $this->pagest = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_pagest() { 
 return $this->pagest; 
 } 





 public function set_pagcnp($x, $w = 0) { 
       $nombre = 'pagcnp';  
      $x = $this->_fix_type($nombre, $x);
      $this->pagcnp = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_pagcnp() { 
 return $this->pagcnp; 
 } 





 public function set_pagreg($x, $w = 0) { 
       $nombre = 'pagreg';  
      $x = $this->_fix_type($nombre, $x);
      $this->pagreg = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_pagreg() { 
 return $this->pagreg; 
 } 





 public function set_pagusuid($x, $w = 0) { 
       $nombre = 'pagusuid';  
      $x = $this->_fix_type($nombre, $x);
      $this->pagusuid = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_pagusuid() { 
 return $this->pagusuid; 
 } 



} 
 
 ?>