<?php 
 
 require_once 'padreModelo.php';

class facturaModelo extends padreModelo {

            private $value_default = "factura.json";
            public $vista = "factura";
            public $tabla = "factura";
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
            $res['campo'] = "facid";
            $res['id'] = $this->get_facid();
            return $res;
        }

        public function set_id($x, $w = 0)
        {

            if ($x == 0)
            {
                $this->set_facid($x);
            }
            else
            {
                $this->set_facid($x, $w);
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


      public $facid="";
public $facusuid="";
public $faccod="";
public $factyp="";
public $facced="";
public $facnom="";
public $facdir="";
public $faccor="";
public $factel="";
public $faccon="";
public $facemi="";
public $factot="";
public $factax="";
public $facdes="";
public $facest="";
public $facobs="";


 public function set_facid($x, $w = 0) { 
       $nombre = 'facid';  
      $x = $this->_fix_type($nombre, $x);
      $this->facid = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
     	$this->campo[] = $nombre; 
     	$this->value[] = $x; 
      } 
  } 
 
 public function get_facid() { 
 return $this->facid; 
 } 





 public function set_facusuid($x, $w = 0) { 
       $nombre = 'facusuid';  
      $x = $this->_fix_type($nombre, $x);
      $this->facusuid = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
     	$this->campo[] = $nombre; 
     	$this->value[] = $x; 
      } 
  } 
 
 public function get_facusuid() { 
 return $this->facusuid; 
 } 





 public function set_faccod($x, $w = 0) { 
       $nombre = 'faccod';  
      $x = $this->_fix_type($nombre, $x);
      $this->faccod = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
     	$this->campo[] = $nombre; 
     	$this->value[] = $x; 
      } 
  } 
 
 public function get_faccod() { 
 return $this->faccod; 
 } 





 public function set_factyp($x, $w = 0) { 
       $nombre = 'factyp';  
      $x = $this->_fix_type($nombre, $x);
      $this->factyp = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
     	$this->campo[] = $nombre; 
     	$this->value[] = $x; 
      } 
  } 
 
 public function get_factyp() { 
 return $this->factyp; 
 } 





 public function set_facced($x, $w = 0) { 
       $nombre = 'facced';  
      $x = $this->_fix_type($nombre, $x);
      $this->facced = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
     	$this->campo[] = $nombre; 
     	$this->value[] = $x; 
      } 
  } 
 
 public function get_facced() { 
 return $this->facced; 
 } 





 public function set_facnom($x, $w = 0) { 
       $nombre = 'facnom';  
      $x = $this->_fix_type($nombre, $x);
      $this->facnom = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
     	$this->campo[] = $nombre; 
     	$this->value[] = $x; 
      } 
  } 
 
 public function get_facnom() { 
 return $this->facnom; 
 } 





 public function set_facdir($x, $w = 0) { 
       $nombre = 'facdir';  
      $x = $this->_fix_type($nombre, $x);
      $this->facdir = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
     	$this->campo[] = $nombre; 
     	$this->value[] = $x; 
      } 
  } 
 
 public function get_facdir() { 
 return $this->facdir; 
 } 





 public function set_faccor($x, $w = 0) { 
       $nombre = 'faccor';  
      $x = $this->_fix_type($nombre, $x);
      $this->faccor = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
     	$this->campo[] = $nombre; 
     	$this->value[] = $x; 
      } 
  } 
 
 public function get_faccor() { 
 return $this->faccor; 
 } 





 public function set_factel($x, $w = 0) { 
       $nombre = 'factel';  
      $x = $this->_fix_type($nombre, $x);
      $this->factel = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
     	$this->campo[] = $nombre; 
     	$this->value[] = $x; 
      } 
  } 
 
 public function get_factel() { 
 return $this->factel; 
 } 





 public function set_faccon($x, $w = 0) { 
       $nombre = 'faccon';  
      $x = $this->_fix_type($nombre, $x);
      $this->faccon = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
     	$this->campo[] = $nombre; 
     	$this->value[] = $x; 
      } 
  } 
 
 public function get_faccon() { 
 return $this->faccon; 
 } 





 public function set_facemi($x, $w = 0) { 
       $nombre = 'facemi';  
      $x = $this->_fix_type($nombre, $x);
      $this->facemi = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
     	$this->campo[] = $nombre; 
     	$this->value[] = $x; 
      } 
  } 
 
 public function get_facemi() { 
 return $this->facemi; 
 } 





 public function set_factot($x, $w = 0) { 
       $nombre = 'factot';  
      $x = $this->_fix_type($nombre, $x);
      $this->factot = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
     	$this->campo[] = $nombre; 
     	$this->value[] = $x; 
      } 
  } 
 
 public function get_factot() { 
 return $this->factot; 
 } 





 public function set_factax($x, $w = 0) { 
       $nombre = 'factax';  
      $x = $this->_fix_type($nombre, $x);
      $this->factax = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
     	$this->campo[] = $nombre; 
     	$this->value[] = $x; 
      } 
  } 
 
 public function get_factax() { 
 return $this->factax; 
 } 





 public function set_facdes($x, $w = 0) { 
       $nombre = 'facdes';  
      $x = $this->_fix_type($nombre, $x);
      $this->facdes = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
     	$this->campo[] = $nombre; 
     	$this->value[] = $x; 
      } 
  } 
 
 public function get_facdes() { 
 return $this->facdes; 
 } 





 public function set_facest($x, $w = 0) { 
       $nombre = 'facest';  
      $x = $this->_fix_type($nombre, $x);
      $this->facest = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
     	$this->campo[] = $nombre; 
     	$this->value[] = $x; 
      } 
  } 
 
 public function get_facest() { 
 return $this->facest; 
 } 





 public function set_facobs($x, $w = 0) { 
       $nombre = 'facobs';  
      $x = $this->_fix_type($nombre, $x);
      $this->facobs = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
     	$this->campo[] = $nombre; 
     	$this->value[] = $x; 
      } 
  } 
 
 public function get_facobs() { 
 return $this->facobs; 
 } 



} 
 
 ?>