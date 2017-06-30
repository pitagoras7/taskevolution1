<?php 
 
 require_once 'padreModelo.php';

class examenFisicoModelo extends padreModelo {

             private $value_default = "examenFisico.json";
             public $vista = "examenFisico";
             public $tabla = "examenFisico";
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
               $res['campo'] = "exfid";
               $res['id'] = $this->get_exfid();
               return $res;
             }

             public function set_id($x, $w = 0)
             {

               if ($x == 0)
               {
                 $this->set_exfid($x);
               }
               else
               {
                 $this->set_exfid($x, $w);
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


             public $exfid="";
public $exfconid="";
public $exftal="";
public $exffcf="";
public $exffrf="";
public $exften="";
public $exfobs="";
public $exffec="";
public $exfest="";
public $exfemi="";
public $exfdaa="";
public $exfdab="";
public $exfdac="";
public $exfdad="";
public $exfdae="";
public $exfdaf="";
public $exfdag="";
public $exfdah="";
public $exfdai="";
public $exfdaj="";
public $exfdak="";
public $exfdal="";
public $exfdam="";
public $exfdan="";


 public function set_exfid($x, $w = 0) { 
       $nombre = 'exfid';  
      $x = $this->_fix_type($nombre, $x);
      $this->exfid = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_exfid() { 
 return $this->exfid; 
 } 





 public function set_exfconid($x, $w = 0) { 
       $nombre = 'exfconid';  
      $x = $this->_fix_type($nombre, $x);
      $this->exfconid = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_exfconid() { 
 return $this->exfconid; 
 } 





 public function set_exftal($x, $w = 0) { 
       $nombre = 'exftal';  
      $x = $this->_fix_type($nombre, $x);
      $this->exftal = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_exftal() { 
 return $this->exftal; 
 } 





 public function set_exffcf($x, $w = 0) { 
       $nombre = 'exffcf';  
      $x = $this->_fix_type($nombre, $x);
      $this->exffcf = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_exffcf() { 
 return $this->exffcf; 
 } 





 public function set_exffrf($x, $w = 0) { 
       $nombre = 'exffrf';  
      $x = $this->_fix_type($nombre, $x);
      $this->exffrf = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_exffrf() { 
 return $this->exffrf; 
 } 





 public function set_exften($x, $w = 0) { 
       $nombre = 'exften';  
      $x = $this->_fix_type($nombre, $x);
      $this->exften = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_exften() { 
 return $this->exften; 
 } 





 public function set_exfobs($x, $w = 0) { 
       $nombre = 'exfobs';  
      $x = $this->_fix_type($nombre, $x);
      $this->exfobs = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_exfobs() { 
 return $this->exfobs; 
 } 





 public function set_exffec($x, $w = 0) { 
       $nombre = 'exffec';  
      $x = $this->_fix_type($nombre, $x);
      $this->exffec = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_exffec() { 
 return $this->exffec; 
 } 





 public function set_exfest($x, $w = 0) { 
       $nombre = 'exfest';  
      $x = $this->_fix_type($nombre, $x);
      $this->exfest = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_exfest() { 
 return $this->exfest; 
 } 





 public function set_exfemi($x, $w = 0) { 
       $nombre = 'exfemi';  
      $x = $this->_fix_type($nombre, $x);
      $this->exfemi = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_exfemi() { 
 return $this->exfemi; 
 } 





 public function set_exfdaa($x, $w = 0) { 
       $nombre = 'exfdaa';  
      $x = $this->_fix_type($nombre, $x);
      $this->exfdaa = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_exfdaa() { 
 return $this->exfdaa; 
 } 





 public function set_exfdab($x, $w = 0) { 
       $nombre = 'exfdab';  
      $x = $this->_fix_type($nombre, $x);
      $this->exfdab = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_exfdab() { 
 return $this->exfdab; 
 } 





 public function set_exfdac($x, $w = 0) { 
       $nombre = 'exfdac';  
      $x = $this->_fix_type($nombre, $x);
      $this->exfdac = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_exfdac() { 
 return $this->exfdac; 
 } 





 public function set_exfdad($x, $w = 0) { 
       $nombre = 'exfdad';  
      $x = $this->_fix_type($nombre, $x);
      $this->exfdad = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_exfdad() { 
 return $this->exfdad; 
 } 





 public function set_exfdae($x, $w = 0) { 
       $nombre = 'exfdae';  
      $x = $this->_fix_type($nombre, $x);
      $this->exfdae = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_exfdae() { 
 return $this->exfdae; 
 } 





 public function set_exfdaf($x, $w = 0) { 
       $nombre = 'exfdaf';  
      $x = $this->_fix_type($nombre, $x);
      $this->exfdaf = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_exfdaf() { 
 return $this->exfdaf; 
 } 





 public function set_exfdag($x, $w = 0) { 
       $nombre = 'exfdag';  
      $x = $this->_fix_type($nombre, $x);
      $this->exfdag = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_exfdag() { 
 return $this->exfdag; 
 } 





 public function set_exfdah($x, $w = 0) { 
       $nombre = 'exfdah';  
      $x = $this->_fix_type($nombre, $x);
      $this->exfdah = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_exfdah() { 
 return $this->exfdah; 
 } 





 public function set_exfdai($x, $w = 0) { 
       $nombre = 'exfdai';  
      $x = $this->_fix_type($nombre, $x);
      $this->exfdai = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_exfdai() { 
 return $this->exfdai; 
 } 





 public function set_exfdaj($x, $w = 0) { 
       $nombre = 'exfdaj';  
      $x = $this->_fix_type($nombre, $x);
      $this->exfdaj = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_exfdaj() { 
 return $this->exfdaj; 
 } 





 public function set_exfdak($x, $w = 0) { 
       $nombre = 'exfdak';  
      $x = $this->_fix_type($nombre, $x);
      $this->exfdak = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_exfdak() { 
 return $this->exfdak; 
 } 





 public function set_exfdal($x, $w = 0) { 
       $nombre = 'exfdal';  
      $x = $this->_fix_type($nombre, $x);
      $this->exfdal = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_exfdal() { 
 return $this->exfdal; 
 } 





 public function set_exfdam($x, $w = 0) { 
       $nombre = 'exfdam';  
      $x = $this->_fix_type($nombre, $x);
      $this->exfdam = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_exfdam() { 
 return $this->exfdam; 
 } 





 public function set_exfdan($x, $w = 0) { 
       $nombre = 'exfdan';  
      $x = $this->_fix_type($nombre, $x);
      $this->exfdan = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
         $this->campo[] = $nombre; 
         $this->value[] = $x; 
      } 
  } 
 
 public function get_exfdan() { 
 return $this->exfdan; 
 } 



} 
 
 ?>