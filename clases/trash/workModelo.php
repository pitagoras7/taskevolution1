<?php 
 
 require_once 'padreModelo.php';

class workModelo extends padreModelo {

            private $value_default = "work.json";
            public $vista = "work";
            public $tabla = "work";
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
            $res['campo'] = "wrkid";
            $res['id'] = $this->get_wrkid();
            return $res;
        }

        public function set_id($x, $w = 0)
        {

            if ($x == 0)
            {
                $this->set_wrkid($x);
            }
            else
            {
                $this->set_wrkid($x, $w);
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


      public $wrkid="";
public $wrkresid="";
public $wrkusuid="";
public $wrkasiid="";
public $wrkest="";
public $wrkreg="";
public $wrkcul="";
public $wrkedo="";
public $wrkden="";
public $wrkobs="";
public $wrktyp="";
public $wrkmod="";


 public function set_wrkmod($x, $w = 0) { 
       $nombre = 'wrkmod';  
      $x = $this->_fix_type($nombre, $x);
      $this->wrkmod = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
      $this->campo[] = $nombre; 
      $this->value[] = $x; 
      } 
  } 
 
 public function get_wrkmod() { 
 return $this->wrkmod; 
 } 


 public function set_wrktyp($x, $w = 0) { 
       $nombre = 'wrktyp';  
      $x = $this->_fix_type($nombre, $x);
      $this->wrktyp = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
      $this->campo[] = $nombre; 
      $this->value[] = $x; 
      } 
  } 
 
 public function get_wrktyp() { 
 return $this->wrktyp; 
 } 


 public function set_wrkid($x, $w = 0) { 
       $nombre = 'wrkid';  
      $x = $this->_fix_type($nombre, $x);
      $this->wrkid = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
     	$this->campo[] = $nombre; 
     	$this->value[] = $x; 
      } 
  } 
 
 public function get_wrkid() { 
 return $this->wrkid; 
 } 





 public function set_wrkresid($x, $w = 0) { 
       $nombre = 'wrkresid';  
      $x = $this->_fix_type($nombre, $x);
      $this->wrkresid = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
     	$this->campo[] = $nombre; 
     	$this->value[] = $x; 
      } 
  } 
 
 public function get_wrkresid() { 
 return $this->wrkresid; 
 } 





 public function set_wrkusuid($x, $w = 0) { 
       $nombre = 'wrkusuid';  
      $x = $this->_fix_type($nombre, $x);
      $this->wrkusuid = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
     	$this->campo[] = $nombre; 
     	$this->value[] = $x; 
      } 
  } 
 
 public function get_wrkusuid() { 
 return $this->wrkusuid; 
 } 





 public function set_wrkasiid($x, $w = 0) { 
       $nombre = 'wrkasiid';  
      $x = $this->_fix_type($nombre, $x);
      $this->wrkasiid = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
     	$this->campo[] = $nombre; 
     	$this->value[] = $x; 
      } 
  } 
 
 public function get_wrkasiid() { 
 return $this->wrkasiid; 
 } 





 public function set_wrkest($x, $w = 0) { 
       $nombre = 'wrkest';  
      $x = $this->_fix_type($nombre, $x);
      $this->wrkest = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
     	$this->campo[] = $nombre; 
     	$this->value[] = $x; 
      } 
  } 
 
 public function get_wrkest() { 
 return $this->wrkest; 
 } 





 public function set_wrkreg($x, $w = 0) { 
       $nombre = 'wrkreg';  
      $x = $this->_fix_type($nombre, $x);
      $this->wrkreg = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
     	$this->campo[] = $nombre; 
     	$this->value[] = $x; 
      } 
  } 
 
 public function get_wrkreg() { 
 return $this->wrkreg; 
 } 





 public function set_wrkcul($x, $w = 0) { 
       $nombre = 'wrkcul';  
      $x = $this->_fix_type($nombre, $x);
      $this->wrkcul = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
     	$this->campo[] = $nombre; 
     	$this->value[] = $x; 
      } 
  } 
 
 public function get_wrkcul() { 
 return $this->wrkcul; 
 } 





 public function set_wrkedo($x, $w = 0) { 
       $nombre = 'wrkedo';  
      $x = $this->_fix_type($nombre, $x);
      $this->wrkedo = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
     	$this->campo[] = $nombre; 
     	$this->value[] = $x; 
      } 
  } 
 
 public function get_wrkedo() { 
 return $this->wrkedo; 
 } 





 public function set_wrkden($x, $w = 0) { 
       $nombre = 'wrkden';  
      $x = $this->_fix_type($nombre, $x);
      $this->wrkden = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
     	$this->campo[] = $nombre; 
     	$this->value[] = $x; 
      } 
  } 
 
 public function get_wrkden() { 
 return $this->wrkden; 
 } 





 public function set_wrkobs($x, $w = 0) { 
       $nombre = 'wrkobs';  
      $x = $this->_fix_type($nombre, $x);
      $this->wrkobs = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
     	$this->campo[] = $nombre; 
     	$this->value[] = $x; 
      } 
  } 
 
 public function get_wrkobs() { 
 return $this->wrkobs; 
 } 



} 
 
 ?>