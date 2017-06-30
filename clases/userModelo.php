<?php

require_once 'padreModelo.php';

class userModelo extends padreModelo {

    private $value_default = "user.json";
    public $vista = "user";
    public $tabla = "user";
    public $usuid = "";
    public $usunom = "";
    public $usuced = "";
    public $usucar = "";
    public $usugen = "";
    public $usucor = "";
    public $usulog = "";
    public $usupas = "";
    public $usureg = "";
    public $usuest = "";
    public $usuusuid = "";
    public $usugruid = "";
    public $usudir = "";
    public $usuing = "";
    public $usuimg = "";

    public function get_select_all()
    {
        $res['campo'] = "usuid";
        $res['id'] = $this->get_usuid();
        return $res;
    }

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


    public function validation($VAR){


      $USER_DATA = $this->select_all(" usulog in ('" . $_POST['usulog'] . "')");

      if (($USER_DATA[0]['usulog'] == $VAR['usulog']) 
        && ($USER_DATA[0]['usupas'] == md5($VAR['usupas'])) ) 
        {

            return $USER_DATA;

        }else{

            return 0;
        }

    }









    public function set_id($x, $w = 0)
    {

        if ($x == 0)
        {
            $this->set_usuid($x);
        }
        else
        {
            $this->set_usuid($x, $w);
        }
    }

    public function set_usuid($x, $w = 0)
    {
        $nombre = 'usuid';
        $x = $this->_fix_type($nombre, $x);
        $this->usuid = $x;
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

    public function get_usuid()
    {
        return $this->usuid;
    }

    public function set_usunom($x, $w = 0)
    {
        $nombre = 'usunom';
        $x = $this->_fix_type($nombre, $x);
        $this->usunom = $x;
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

    public function get_usunom()
    {
        return $this->usunom;
    }

    public function set_usuced($x, $w = 0)
    {
        $nombre = 'usuced';
        $x = $this->_fix_type($nombre, $x);
        $this->usuced = $x;
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

    public function get_usuced()
    {
        return $this->usuced;
    }

    public function set_usucar($x, $w = 0)
    {
        $nombre = 'usucar';
        $x = $this->_fix_type($nombre, $x);
        $this->usucar = $x;
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

    public function get_usucar()
    {
        return $this->usucar;
    }

    public function set_usugen($x, $w = 0)
    {
        $nombre = 'usugen';
        $x = $this->_fix_type($nombre, $x);
        $this->usugen = $x;
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

    public function get_usugen()
    {
        return $this->usugen;
    }

    public function set_usucor($x, $w = 0)
    {
        $nombre = 'usucor';
        $x = $this->_fix_type($nombre, $x);
        $this->usucor = $x;
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

    public function get_usucor()
    {
        return $this->usucor;
    }

    public function set_usulog($x, $w = 0)
    {
        $nombre = 'usulog';
        $x = $this->_fix_type($nombre, $x);
        $this->usulog = $x;
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

    public function get_usulog()
    {
        return $this->usulog;
    }

    public function set_usupas($x, $w = 0)
    {
        $nombre = 'usupas';
        $x = $this->_fix_type($nombre, $x);
        $this->usupas = $x;
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

    public function get_usupas()
    {
        return $this->usupas;
    }

    public function set_usureg($x, $w = 0)
    {
        $nombre = 'usureg';
        $x = $this->_fix_type($nombre, $x);
        $this->usureg = $x;
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

    public function get_usureg()
    {
        return $this->usureg;
    }

    public function set_usuest($x, $w = 0)
    {
        $nombre = 'usuest';
        $x = $this->_fix_type($nombre, $x);
        $this->usuest = $x;
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

    public function get_usuest()
    {
        return $this->usuest;
    }

    public function set_usuusuid($x, $w = 0)
    {
        $nombre = 'usuusuid';
        $x = $this->_fix_type($nombre, $x);
        $this->usuusuid = $x;
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

    public function get_usuusuid()
    {
        return $this->usuusuid;
    }

    public function set_usugruid($x, $w = 0)
    {
        $nombre = 'usugruid';
        $x = $this->_fix_type($nombre, $x);
        $this->usugruid = $x;
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

    public function get_usugruid()
    {
        return $this->usugruid;
    }

    public function set_usudir($x, $w = 0)
    {
        $nombre = 'usudir';
        $x = $this->_fix_type($nombre, $x);
        $this->usudir = $x;
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

    public function get_usudir()
    {
        return $this->usudir;
    }

    public function set_usuing($x, $w = 0)
    {
        $nombre = 'usuing';
        $x = $this->_fix_type($nombre, $x);
        $this->usuing = $x;
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

    public function get_usuing()
    {
        return $this->usuing;
    }

    public function set_usumig($x, $w = 0)
    {
        $nombre = 'usuimg';
        $x = $this->_fix_type($nombre, $x);
        $this->usuimg = $x;
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

    public function get_usuimg()
    {
        return $this->usuimg;
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

public function modal_001($data)
{
    $data_json = $this->_config_();
    $form_new = $data_json['form_001'];
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

public function modal_usuimg($data)
{
    $data_json = $this->_config_();
    $form_new = $data_json['form_usuimg'];
    $this->modal_reset();

    $this->modal_only_form = true;
    $this->modal_id = $form_new['id'];
    $this->modal_name = $form_new['name'];
    $this->modal_class = $form_new['class'];
    $this->modal_body_height = $form_new['height'];
    $this->title_modal = $form_new['title'];
    $this->modal_data = $data;
    $this->modal_form_class = $form_new['form_class'];
    $this->modal_form_enctype = $form_new['form_enctype'];
    $this->modal_form_action = $form_new['form_action'];
    $this->modal_form_name = $form_new['form_id'];
    $this->modal_javascript = $form_new['javascript'];

    $this->modal_form_id = $form_new['form_id'];

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
    return $this->DATATABLE_content($this->datatable_struct['version']);
}

/* FUNCIONES BASICAS */


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