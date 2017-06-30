<?php 
 
 require_once 'padreModelo.php';

class consultaModelo extends padreModelo {

             private $value_default = "consulta.json";
             public $vista = "consulta";
             public $tabla = "consulta";
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
               $res['campo'] = "conid";
               $res['id'] = $this->get_conid();
               return $res;
             }

             public function set_id($x, $w = 0)
             {

               if ($x == 0)
               {
                 $this->set_conid($x);
               }
               else
               {
                 $this->set_conid($x, $w);
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


             public $conid="";
public $conusuid="";
public $conpacid="";
public $conubiid="";
public $conreg="";
public $conest="";
public $conobs="";
public $conlab="";
public $conexf="";
public $conpla="";
public $conreq="";
public $conidx="";
public $conhis="";
public $conrep="";
public $contto="";
public $conesp="";
public $consug="";
public $condoc="";
public $conmdm="";
public $concit="";
public $condrs="";
public $confin="";
public $concie="";
public $conefa="";
public $conefb="";
public $conefc="";
public $conefd="";
public $conefe="";
public $conefg="";
public $conefh="";
public $conefi="";
public $conefj="";
public $conefk="";
public $coneff="";
public $conref="";
public $conind="";
public $conpos="";


 public function set_conpos($x, $w = 0) { 
       $nombre = 'conpos';  
      $x = $this->_fix_type($nombre, $x);
      $this->conpos = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_conpos() { 
 return $this->conpos; 
 } 





 public function set_conind($x, $w = 0) { 
       $nombre = 'conind';  
      $x = $this->_fix_type($nombre, $x);
      $this->conind = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_conind() { 
 return $this->conind; 
 } 




 public function set_conref($x, $w = 0) { 
       $nombre = 'conref';  
      $x = $this->_fix_type($nombre, $x);
      $this->conref = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_conref() { 
 return $this->conref; 
 } 



 public function set_coneff($x, $w = 0) { 
       $nombre = 'coneff';  
      $x = $this->_fix_type($nombre, $x);
      $this->coneff = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_coneff() { 
 return $this->coneff; 
 } 




 public function set_conefk($x, $w = 0) { 
       $nombre = 'conefk';  
      $x = $this->_fix_type($nombre, $x);
      $this->conefk = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_conefk() { 
 return $this->conefk; 
 } 


 public function set_conefj($x, $w = 0) { 
       $nombre = 'conefj';  
      $x = $this->_fix_type($nombre, $x);
      $this->conefj = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_conefj() { 
 return $this->conefj; 
 } 



 public function set_conefi($x, $w = 0) { 
       $nombre = 'conefi';  
      $x = $this->_fix_type($nombre, $x);
      $this->conefi = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_conefi() { 
 return $this->conefi; 
 } 



 public function set_conefh($x, $w = 0) { 
       $nombre = 'conefh';  
      $x = $this->_fix_type($nombre, $x);
      $this->conefh = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_conefh() { 
 return $this->conefh; 
 } 

 public function set_conefg($x, $w = 0) { 
       $nombre = 'conefg';  
      $x = $this->_fix_type($nombre, $x);
      $this->conefg = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_conefg() { 
 return $this->conefg; 
 } 


 public function set_conefe($x, $w = 0) { 
       $nombre = 'conefe';  
      $x = $this->_fix_type($nombre, $x);
      $this->conefe = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_conefe() { 
 return $this->conefe; 
 } 

 public function set_conefd($x, $w = 0) { 
       $nombre = 'conefd';  
      $x = $this->_fix_type($nombre, $x);
      $this->conefd = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_conefd() { 
 return $this->conefd; 
 } 


 public function set_conefc($x, $w = 0) { 
       $nombre = 'conefc';  
      $x = $this->_fix_type($nombre, $x);
      $this->conefc = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_conefc() { 
 return $this->conefc; 
 } 



 public function set_conefb($x, $w = 0) { 
       $nombre = 'conefb';  
      $x = $this->_fix_type($nombre, $x);
      $this->conefb = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_conefb() { 
 return $this->conefb; 
 } 



 public function set_conefa($x, $w = 0) { 
       $nombre = 'conefa';  
      $x = $this->_fix_type($nombre, $x);
      $this->conefa = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_conefa() { 
 return $this->conefa; 
 } 



 public function set_concie($x, $w = 0) { 
       $nombre = 'concie';  
      $x = $this->_fix_type($nombre, $x);
      $this->concie = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_concie() { 
 return $this->concie; 
 } 




 public function set_confin($x, $w = 0) { 
       $nombre = 'confin';  
      $x = $this->_fix_type($nombre, $x);
      $this->confin = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_confin() { 
 return $this->confin; 
 } 


 public function set_conid($x, $w = 0) { 
       $nombre = 'conid';  
      $x = $this->_fix_type($nombre, $x);
      $this->conid = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_conid() { 
 return $this->conid; 
 } 





 public function set_conusuid($x, $w = 0) { 
       $nombre = 'conusuid';  
      $x = $this->_fix_type($nombre, $x);
      $this->conusuid = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_conusuid() { 
 return $this->conusuid; 
 } 





 public function set_conpacid($x, $w = 0) { 
       $nombre = 'conpacid';  
      $x = $this->_fix_type($nombre, $x);
      $this->conpacid = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_conpacid() { 
 return $this->conpacid; 
 } 





 public function set_conubiid($x, $w = 0) { 
       $nombre = 'conubiid';  
      $x = $this->_fix_type($nombre, $x);
      $this->conubiid = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_conubiid() { 
 return $this->conubiid; 
 } 





 public function set_conreg($x, $w = 0) { 
       $nombre = 'conreg';  
      $x = $this->_fix_type($nombre, $x);
      $this->conreg = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_conreg() { 
 return $this->conreg; 
 } 





 public function set_conest($x, $w = 0) { 
       $nombre = 'conest';  
      $x = $this->_fix_type($nombre, $x);
      $this->conest = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_conest() { 
 return $this->conest; 
 } 





 public function set_conobs($x, $w = 0) { 
       $nombre = 'conobs';  
      $x = $this->_fix_type($nombre, $x);
      $this->conobs = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_conobs() { 
 return $this->conobs; 
 } 





 public function set_conlab($x, $w = 0) { 
       $nombre = 'conlab';  
      $x = $this->_fix_type($nombre, $x);
      $this->conlab = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_conlab() { 
 return $this->conlab; 
 } 





 public function set_conexf($x, $w = 0) { 
       $nombre = 'conexf';  
      $x = $this->_fix_type($nombre, $x);
      $this->conexf = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_conexf() { 
 return $this->conexf; 
 } 





 public function set_conpla($x, $w = 0) { 
       $nombre = 'conpla';  
      $x = $this->_fix_type($nombre, $x);
      $this->conpla = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_conpla() { 
 return $this->conpla; 
 } 





 public function set_conreq($x, $w = 0) { 
       $nombre = 'conreq';  
      $x = $this->_fix_type($nombre, $x);
      $this->conreq = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_conreq() { 
 return $this->conreq; 
 } 





 public function set_conidx($x, $w = 0) { 
       $nombre = 'conidx';  
      $x = $this->_fix_type($nombre, $x);
      $this->conidx = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_conidx() { 
 return $this->conidx; 
 } 





 public function set_conhis($x, $w = 0) { 
       $nombre = 'conhis';  
      $x = $this->_fix_type($nombre, $x);
      $this->conhis = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_conhis() { 
 return $this->conhis; 
 } 





 public function set_conrep($x, $w = 0) { 
       $nombre = 'conrep';  
      $x = $this->_fix_type($nombre, $x);
      $this->conrep = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_conrep() { 
 return $this->conrep; 
 } 





 public function set_contto($x, $w = 0) { 
       $nombre = 'contto';  
      $x = $this->_fix_type($nombre, $x);
      $this->contto = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_contto() { 
 return $this->contto; 
 } 





 public function set_conesp($x, $w = 0) { 
       $nombre = 'conesp';  
      $x = $this->_fix_type($nombre, $x);
      $this->conesp = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_conesp() { 
 return $this->conesp; 
 } 





 public function set_consug($x, $w = 0) { 
       $nombre = 'consug';  
      $x = $this->_fix_type($nombre, $x);
      $this->consug = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_consug() { 
 return $this->consug; 
 } 





 public function set_condoc($x, $w = 0) { 
       $nombre = 'condoc';  
      $x = $this->_fix_type($nombre, $x);
      $this->condoc = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_condoc() { 
 return $this->condoc; 
 } 





 public function set_conmdm($x, $w = 0) { 
       $nombre = 'conmdm';  
      $x = $this->_fix_type($nombre, $x);
      $this->conmdm = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_conmdm() { 
 return $this->conmdm; 
 } 





 public function set_concit($x, $w = 0) { 
       $nombre = 'concit';  
      $x = $this->_fix_type($nombre, $x);
      $this->concit = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_concit() { 
 return $this->concit; 
 } 





 public function set_condrs($x, $w = 0) { 
       $nombre = 'condrs';  
      $x = $this->_fix_type($nombre, $x);
      $this->condrs = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_condrs() { 
 return $this->condrs; 
 } 



} 
 
 ?>