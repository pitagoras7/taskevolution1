<?php 
 
 require_once 'padreModelo.php';

class jugadorModelo extends padreModelo {

        private $value_default = "jugador.json";
        public $vista = "jugador";
        public $tabla = "jugador";
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
        $res['campo'] = "jugid";
        $res['id'] = $this->get_jugid();
        return $res;
    }

    public function set_id($x, $w = 0)
    {

        if ($x == 0)
        {
            $this->set_jugid($x);
        }
        else
        {
            $this->set_jugid($x, $w);
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


  public $jugid="";
public $jugnom="";
public $jugsex="";
public $jugequid="";
public $jugest="";
public $jugereg="";


 public function set_jugid($x, $w = 0) { 
       $nombre = 'jugid';  
      $x = $this->_fix_type($nombre, $x);
      $this->jugid = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
     	$this->campo[] = $nombre; 
     	$this->value[] = $x; 
      } 
  } 
 
 public function get_jugid() { 
 return $this->jugid; 
 } 





 public function set_jugnom($x, $w = 0) { 
       $nombre = 'jugnom';  
      $x = $this->_fix_type($nombre, $x);
      $this->jugnom = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
     	$this->campo[] = $nombre; 
     	$this->value[] = $x; 
      } 
  } 
 
 public function get_jugnom() { 
 return $this->jugnom; 
 } 





 public function set_jugsex($x, $w = 0) { 
       $nombre = 'jugsex';  
      $x = $this->_fix_type($nombre, $x);
      $this->jugsex = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
     	$this->campo[] = $nombre; 
     	$this->value[] = $x; 
      } 
  } 
 
 public function get_jugsex() { 
 return $this->jugsex; 
 } 





 public function set_jugequid($x, $w = 0) { 
       $nombre = 'jugequid';  
      $x = $this->_fix_type($nombre, $x);
      $this->jugequid = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
     	$this->campo[] = $nombre; 
     	$this->value[] = $x; 
      } 
  } 
 
 public function get_jugequid() { 
 return $this->jugequid; 
 } 





 public function set_jugest($x, $w = 0) { 
       $nombre = 'jugest';  
      $x = $this->_fix_type($nombre, $x);
      $this->jugest = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
     	$this->campo[] = $nombre; 
     	$this->value[] = $x; 
      } 
  } 
 
 public function get_jugest() { 
 return $this->jugest; 
 } 





 public function set_jugereg($x, $w = 0) { 
       $nombre = 'jugereg';  
      $x = $this->_fix_type($nombre, $x);
      $this->jugereg = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
     	$this->campo[] = $nombre; 
     	$this->value[] = $x; 
      } 
  } 
 
 public function get_jugereg() { 
 return $this->jugereg; 
 } 



} 
 
 ?>