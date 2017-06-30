<?php

require_once 'padreModelo.php';

class configModelo extends padreModelo {

    private $value_default = "config.json";
    public $vista = "config";
    public $tabla = "config";

    public function get_select_all()
    {
        $res['campo'] = "cfgid";
        $res['id'] = $this->get_cfgid();
        return $res;
    }

    public function set_id($x, $w = 0)
    {

        if ($x == 0)
        {
           $this->set_cfgid($x);
        }
        else
        {
            $this->set_cfgid($x, $w);
        }
    }

    public $cfgid = "";
    public $cfgpad = "";
    public $cfgden = "";
    public $cfgext = "";
    public $cfgnum = "";
    public $cfgreg = "";
    public $cfguse = "";
    public $cfgobs = "";
    public $cfgest = "";

    public function set_cfgid($x, $w = 0)
    {
        $nombre = 'cfgid';
        $x = $this->_fix_type($nombre, $x);
        $this->cfgid = $x;
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

    public function get_cfgid()
    {
        return $this->cfgid;
    }

    public function set_cfgpad($x, $w = 0)
    {
        $nombre = 'cfgpad';
        $x = $this->_fix_type($nombre, $x);
        $this->cfgpad = $x;
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

    public function get_cfgpad()
    {
        return $this->cfgpad;
    }

    public function set_cfgden($x, $w = 0)
    {
        $nombre = 'cfgden';
        $x = $this->_fix_type($nombre, $x);
        $this->cfgden = $x;
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

    public function get_cfgden()
    {
        return $this->cfgden;
    }

    public function set_cfgext($x, $w = 0)
    {
        $nombre = 'cfgext';
        $x = $this->_fix_type($nombre, $x);
        $this->cfgext = $x;
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

    public function get_cfgext()
    {
        return $this->cfgext;
    }

    public function set_cfgnum($x, $w = 0)
    {
        $nombre = 'cfgnum';
        $x = $this->_fix_type($nombre, $x);
        $this->cfgnum = $x;
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

    public function get_cfgnum()
    {
        return $this->cfgnum;
    }

    public function set_cfgreg($x, $w = 0)
    {
        $nombre = 'cfgreg';
        $x = $this->_fix_type($nombre, $x);
        $this->cfgreg = $x;
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

    public function get_cfgreg()
    {
        return $this->cfgreg;
    }

    public function set_cfguse($x, $w = 0)
    {
        $nombre = 'cfguse';
        $x = $this->_fix_type($nombre, $x);
        $this->cfguse = $x;
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

    public function get_cfguse()
    {
        return $this->cfguse;
    }

    public function set_cfgobs($x, $w = 0)
    {
        $nombre = 'cfgobs';
        $x = $this->_fix_type($nombre, $x);
        $this->cfgobs = $x;
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

    public function get_cfgobs()
    {
        return $this->cfgobs;
    }

    public function set_cfgest($x, $w = 0)
    {
        $nombre = 'cfgest';
        $x = $this->_fix_type($nombre, $x);
        $this->cfgest = $x;
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

    public function get_cfgest()
    {
        return $this->cfgest;
    }

    /* MODAL */

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

    /* DATATABLE */

    public function datatable_()
    {
        $data = $this->_config_();
        $this->datatable_struct = $data['datatable'];
        $this->datatable_data = $this->select_all($this->datatable_struct['select_conditional']);
        return $this->DATATABLE_content();
    }

    /* FUNCIONES BASICAS */
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

    public function _dataprint_($data)
    {

        $data = $this->DATAPRINT__($data, $this->_config_());

        return $data;
    }

    public function select_all($condicion = '0')
    {

        $this->dataprint_data_json = $this->_config_();
        $this->select_select_all = $this->get_select_all();
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
                #   echo "El fichero es válido y se subió con éxito.\n";
            }
            else
            {
                echo "¡Posible ataque de subida de ficheros!\n";
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
    
   

}

?>