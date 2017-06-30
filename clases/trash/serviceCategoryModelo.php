<?php

require_once 'padreModelo.php';

class serviceCategoryModelo extends padreModelo {

    private $value_default = "serviceCategory.json";
    public $vista = "serviceCategory";
    public $tabla = "serviceCategory";
    public $id_dependiente = "";

    public function get_select_all()
    {
        $res['campo'] = "srcid";
        $res['id'] = $this->get_srcid();
        return $res;
    }

    public function set_id($x, $w = 0)
    {

        if ($x == 0)
        {
            $this->set_srcid($x);
        }
        else
        {
            $this->set_srcid($x, $w);
        }
    }


    public $srcid="";
    public $srcden="";
    public $srcest="";
    public $srcreg="";
    public $srcuse="";
    public $srcobs="";
    public $srccol="";
    public $srcico="";




    public function set_srccol($x, $w = 0) { 
       $nombre = 'srccol';  
       $x = $this->_fix_type($nombre, $x);
       $this->srccol = $x; 
       if ($w > 0) {
          $this->campo_where[] = $nombre; 
          $this->value_where[] = $x; 
      } else { 
        $this->campo[] = $nombre; 
        $this->value[] = $x; 
    } 
} 

public function get_srccol() { 
 return $this->srccol; 
} 





public function set_srcico($x, $w = 0) { 
   $nombre = 'srcico';  
   $x = $this->_fix_type($nombre, $x);
   $this->srcico = $x; 
   if ($w > 0) {
      $this->campo_where[] = $nombre; 
      $this->value_where[] = $x; 
  } else { 
    $this->campo[] = $nombre; 
    $this->value[] = $x; 
} 
} 

public function get_srcico() { 
 return $this->srcico; 
} 



public function set_srcid($x, $w = 0) { 
    $nombre = 'srcid'; 
    $x = $this->_fix_type($nombre, $x);
    $this->srcid = $x;
    if ($w > 0) {
        $this->campo_where[] = $nombre;
        $this->value_where[] = $x;
    } else {
        $this->campo[] = $nombre;
        $this->value[] = $x;
    }
}

public function get_srcid() {
    return $this->srcid;

}



public function set_srcden($x, $w = 0) { 
    $nombre = 'srcden'; 
    $x = $this->_fix_type($nombre, $x);
    $this->srcden = $x;
    if ($w > 0) {
        $this->campo_where[] = $nombre;
        $this->value_where[] = $x;
    } else {
        $this->campo[] = $nombre;
        $this->value[] = $x;
    }
}

public function get_srcden() {
    return $this->srcden;

}



public function set_srcest($x, $w = 0) { 
    $nombre = 'srcest'; 
    $x = $this->_fix_type($nombre, $x);
    $this->srcest = $x;
    if ($w > 0) {
        $this->campo_where[] = $nombre;
        $this->value_where[] = $x;
    } else {
        $this->campo[] = $nombre;
        $this->value[] = $x;
    }
}

public function get_srcest() {
    return $this->srcest;

}



public function set_srcreg($x, $w = 0) { 
    $nombre = 'srcreg'; 
    $x = $this->_fix_type($nombre, $x);
    $this->srcreg = $x;
    if ($w > 0) {
        $this->campo_where[] = $nombre;
        $this->value_where[] = $x;
    } else {
        $this->campo[] = $nombre;
        $this->value[] = $x;
    }
}

public function get_srcreg() {
    return $this->srcreg;

}



public function set_srcuse($x, $w = 0) { 
    $nombre = 'srcuse'; 
    $x = $this->_fix_type($nombre, $x);
    $this->srcuse = $x;
    if ($w > 0) {
        $this->campo_where[] = $nombre;
        $this->value_where[] = $x;
    } else {
        $this->campo[] = $nombre;
        $this->value[] = $x;
    }
}

public function get_srcuse() {
    return $this->srcuse;

}



public function set_srcobs($x, $w = 0) { 
    $nombre = 'srcobs'; 
    $x = $this->_fix_type($nombre, $x);
    $this->srcobs = $x;
    if ($w > 0) {
        $this->campo_where[] = $nombre;
        $this->value_where[] = $x;
    } else {
        $this->campo[] = $nombre;
        $this->value[] = $x;
    }
}

public function get_srcobs() {
    return $this->srcobs;

}



public function modal_($data, $modo = 'edit')
{


    $data_json = $this->_config_();
    $form_new = $data_json['form_'];
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







public function menu_goback_cards(){
    $res = "<a  style=\"font-size:20px; \" href=\"?opcion=home\" class=\"btn btn-primary menu_category_card\" >
    <i class=\"fa fa-home \"></i></a>";
    return $res;
}



public function menu_filter_cards($x)
{

    $result = $this->select_all(" srcest in ('t') limit ".$x.",4");

    if( count($result)<1 ){
        $result = $this->select_all(" srcest in ('t') limit 0,4");
    } 


    for($i=0;$i<count($result);$i++){
        $this->menu_ico                 = $result[$i]['srcico'];
        $this->menu_den                 = $result[$i]['srcden'];
        $this->menu_col                 = $result[$i]['srccol'];
        $this->menu_class               = " btn  menu_category_card  ";
        $this->menu_style               = "  ";
        $this->menu_parametro_onclick   = $result[$i]['srcid_code'];
        $this->menu_parametro_url       = "module/".$this->tabla."/cards/src/src_card_ajax.php";
        $this->menu_parametro_view      = "view";
        $this->menu_onclick             = "filter_cards_";
        $res.=$this->MENU_3();
    }

    return $res;
}


public function menu_more_cards($x){


    $x= $x+3;


    $result = $this->select_all(" srcest in ('t') limit ".$x.",4");
    if( count($result)<1 ){
        $x=0;
    } 


    $res = "
    <a  onclick=\" ajax('src_limit',".$x.",'panel_opciones') \" href=\"#\" class=\"btn menu_category_card\" >

    <i class=\"fa fa-chevron-right\" aria-hidden=\"true\" style=\"\"></i>
    <br>

    </a>
    ";

    return $res;
}



public function menu_minus_cards($x){

    $x= 4-$x;
    $result = $this->select_all(" srcest in ('t') limit ".$x.",4");
    if( count($result)<1 ){
        $x=0;
    } 

    $res = "
    <a  onclick=\" ajax('src_limit_minus',".$x.",'panel_opciones') \" href=\"#\" class=\"btn menu_category_card\" >
    <i class=\"fa fa-chevron-left\" aria-hidden=\"true\" style=\"\"></i>
    </a>";

    return $res;
}


public function menu_con_calculator(){

    $res = "
    <a  style=\"display:none;   width: 100px; height:70px;  text-align: center;  color: white; \" href=\"#\" 
    class=\"btn btn-success botonyes  menu_category_card\" onclick=\"botonplus(1); accionbotonplus(1)\">
    <i class=\"  fa fa-calculator \"></i></a>";

    return $res;

}



public function menu_sin_calculator(){

    $res = "
    <a href=\"#\" style=\"width: 100px; height:70px;  text-align: center;  color: white;\" class=\"  btn  btn-danger 
     botonno menu_category_card\" onclick=\"botonplus(0); accionbotonplus(0) \" >
    <i class=\" fa fa-calculator \"></i></a>";

    return $res;

}


public function menu_cliente(){
    $res = "
    <a onclick=\"submit_modal_clienteOrder_click()\" href=\"#modal-clienteOrder\" data-toggle=\"modal\" class=\"  btn  btn-warning  menu_category_card\"  >
    <i class=\" fa fa-user \"></i></a>";
    return $res;
}


public function menu_anular(){
    $res = "
    <a href=\"#\" style=\"\" class=\"  btn  btn-danger  menu_category_card\" onclick=\"\" >
    <i class=\" fa fa-close \"></i></a>";
    return $res;
}


public function menu_pagar(){
    $res = "
    <a href=\"?opcion=payOrder\" style=\"\" class=\"  btn  btn-success  menu_category_card\" onclick=\"\" >
    <i class=\" fa fa-credit-card \"></i></a>";
    return $res;
}

public function menu_pagar_parcial(){
    $res = "
    <a   onclick=\"submit_modal_pago_click()\" href=\"#modal-pago\" data-toggle=\"modal\"  style=\"\" class=\"  btn  btn-success menu_category_card  \"  >
    <i class=\" fa fa-pie-chart \"></i></a>";
    return $res;
}


public function menu_asignar_responsable(){
    $res = "
    <a  onclick=\"ajax_url('filter_enfermedad','Mg==','view','module/serviceCategory/cards/src/src_card_ajax.php')\"  href=\"#\"  class=\"  btn  btn-info menu_category_card  \"  >
    <i class=\" fa fa-smile-o \"></i></a>";
    return $res;
}



public function nav_ordersCards($x){

        $res.= $SERVICECATEGORY->menu_goback_cards();
        $res.= $SERVICECATEGORY->menu_minus_cards();
        $res.= $SERVICECATEGORY->menu_filter_cards();
        $res.= $SERVICECATEGORY->menu_more_cards();
        $res.= $SERVICECATEGORY->menu_con_calculator();
        $res.= $SERVICECATEGORY->menu_sin_calculator();

        return $res;

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