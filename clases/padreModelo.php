<?php
require_once 'Conexion.php';

class padreModelo extends conexion
{
    
    private $id;
    private $id_padre;
    private $tabla;
    private $nuevo;
    private $sql_campo;
    private $sql_valor;
    private $correlativo;
    private $numero_documento;
    private $sigla;
    public $estatu = "true";
    public $bd = "pg";
    public $motorbd = "mysql";
    public $ultimoId;
    public $nombre_moneda = "";
    public $simbolo_moneda = " ";
    
    public $oddblo_sinpago = 61;
    public $oddblo_enproceso = 62;
    public $oddblo_pagado = 63;
    public $oddblo_anulado = 65;
    public $oddblo_enespera = 64;
    
    public $ordedo_solicitud = 67;
    public $ordedo_enpreparacion = 68;
    public $ordedo_enviada = 69;
    public $ordedo_entregada = 70;
    public $ordedo_anulada = 71;
    public $ordedo_cerrada = 72;
    
    
    public $cita_sinconfirmar = "Por confirmar";
    public $cita_confirmada = "Confirmada";
    public $cita_enespera = "Por atender";
    public $cita_anulada = "Anulada";
    public $cita_atendida = "Atendida";
    
    
    public function __construct($bd = "pg")
    {
        $this->bd = $bd;
        
    }
    
    
    public function sql_inyection($sql)
    {
        
        //$sql = strtolower($sql);
        $sql = str_replace("DELETE", "#", $sql);
        $sql = str_replace("UPDATE", "#", $sql);
        $sql = str_replace("SET", "#", $sql);
        
        return $sql;
    }
    
    public function call_module($name, $modulo = "config")
    {
        return "<script src= \"module/" . $modulo . "/modal/" . $name . "/" . $name . ".js\"></script>
   <div id=\"modal-" . $name . "\" class=\"modal fade\" tabindex=\"-1\">
   <div id=\"content-modal-" . $name . "\"></div>
   </div>";
    }
    
    
    public function call_highcharts()
    {
        return "<script src=\"https://code.highcharts.com/highcharts.js\"></script>";
    }
    
    
    
    
    public function call_json($tabla, $name)
    {
        $str_datos = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/" . $this->proyecto . "/module/" . $tabla . "/" . $name . "/" . $name . ".json");
        $datos     = json_decode($str_datos, true);
        return $datos;
    }
    
    public function llamada_json($tabla, $name, $type = "modal")
    {
        
        $str_datos = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/" . $this->proyecto . "/module/" . $tabla . "/" . $type . "/" . $name . ".json");
        $datos     = json_decode($str_datos, true);
        return $datos;
    }
    
    public function soyjson($tabla, $type, $name)
    {
        
        # $_SERVER['DOCUMENT_ROOT']."/".$this->proyecto."/module/".$tabla."/".$type."/".$name.".json";
        
        $str_datos = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/" . $this->proyecto . "/module/" . $tabla . "/" . $type . "/" . $name . "/" . $name . ".json");
        $datos     = json_decode($str_datos, true);
        return $datos[$name];
    }
    
    
    public function view_perfil()
    {
        
        return "
 <div class='col-xs-9' style=\"text-align:right; font-size:16px\">
 <b>" . strtoupper($_SESSION['user']['usunom']) . "</b><br>
 " . $_SESSION['user']['usucar'] . "<br>
 " . date(" Y-M-d  ") . "
 </div>

 <div class='col-xs-3'>
 <img  style=\"border-radius: 50%;\" width='70px' src='" . $_SESSION['user']['usuimg_format_img_url'] . "'>
 </div>";
        
    }
    
    
    public function view_perfil_footer()
    {
        
        /* return "
        <div class='col-xs-6' >
        
        </div>
        
        <div class='col-xs-6'>
        
        <img  style=\"border-radius: 50%;\" width='30px' src='".$_SESSION['user']['usuimg_format_img_url']."'>
        ".strtoupper($_SESSION['user']['usunom'])."| ".$_SESSION['user']['usucar']."
        </div>";
        */
    }
    
    
    public function moneda($x)
    {
        
        return "<small>" . $this->nombre_moneda . " " . $this->simbolo_moneda . "</small>" . number_format($x);
        
    }
    
    
    
    /*
    public function soyjsondatatable($tabla,$type,$name){
    
    # $_SERVER['DOCUMENT_ROOT']."/".$this->proyecto."/module/".$tabla."/".$type."/".$name.".json";
    
    $str_datos = file_get_contents($_SERVER['DOCUMENT_ROOT']."/".$this->proyecto."/module/".$tabla."/".$type."/".$name.".json");
    $datos = json_decode($str_datos, true);
    return $datos[$name];
    }
    */
    
    
    public function json_element($tabla, $name)
    {
        
        # $_SERVER['DOCUMENT_ROOT']."/".$this->proyecto."/module/".$tabla."/".$type."/".$name.".json";
        
        // $_SERVER['DOCUMENT_ROOT']."/".$this->proyecto."/module/".$tabla."/data/".$tabla.".json";
        
        
        $str_datos = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/" . $this->proyecto . "/module/" . $tabla . "/data/" . $tabla . ".json");
        $datos     = json_decode($str_datos, true);
        
        
        return $datos[$name];
    }
    
    
    
    
    
    public function json_principal($tabla)
    {
        
        $str_datos = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/" . $this->proyecto . "/module/" . $tabla . "/data/" . $tabla . ".json");
        $datos     = json_decode($str_datos, true);
        return $datos;
    }
    
    
    
    public function fecha_alreves($fecha)
    {
        $dd    = substr($fecha, 0, 2);
        $mm    = substr($fecha, 3, 2);
        $yy    = substr($fecha, 6, 4);
        $fecha = $yy . "/" . $mm . "/" . $dd;
        return $fecha;
    }
    
    
    public function fecha_alreves_v2($fecha, $limitador = "-")
    {
        $dd    = substr($fecha, 0, 2);
        $mm    = substr($fecha, 3, 2);
        $yy    = substr($fecha, 6, 4);
        $fecha = $yy . $limitador . $mm . $limitador . $dd;
        return $fecha;
    }
    
    
    public function datetime_now()
    {
        return date('Y-m-d H:i:s');
    }
    
    public function reg()
    {
        return date('Y-m-d H:i:s');
    }
    
    
    public function user_now()
    {
        return $_SESSION['user_id'];
    }
    
    
    public function vacio($var, $msj = "")
    {
        
        if (strlen($var) > 0) {
            
            return false;
        } else {
            
            if (strlen($msj) > 0) {
                echo $msj;
            }
            
            return true;
        }
    }
    
    public function novacio($var)
    {
        
        if (strlen($var) > 0)
            return true;
        else
            return false;
    }
    
    public function setId($id)
    {
        $this->id = $id;
    }
    
    public function setTabla($tabla)
    {
        $this->tabla = $tabla;
    }
    
    public function setConfig($tabla, $id = null)
    {
        $this->tabla = $tabla;
        $this->id    = $id;
        
        if (!$id) {
            $this->nuevo = true;
            //            $operacion = 'nuevo';
        } else {
            //            $operacion = 'editar';
        }
        //        $this->historico($this->id, $operacion);
    }
    
    public function getId()
    {
        return $this->id;
    }
    
    public function ejecutar_query01($query)
    {
        
        if ($this->bd == 'pg') {
            $this->abrirConexionPg();
            $this->sql = $query;
            $data      = $this->ejecutarSentenciaPg01(2);
            return $data;
        }
        
        if ($this->bd == 'mysql') {
            $this->abrirConexionMysql();
            $this->sql = $query;
            $data      = $this->ejecutarSentenciaMysql(2);
            return $data;
        }
    }
    
    public function ejecutar_query02($query)
    {
        
        $this->abrirConexionMysql();
        $this->sql = $query;
        $data      = $this->ejecutarSentenciaMysql(2);
        return $data;
    }
    
    public function ejecutar_query($sql)
    {
        
        $this->sql = $sql;
        
        if ($this->motorbd == "mysql")
            return $this->ejecutarSentenciaMysql();
        if ($this->motorbd == "pg")
            return $this->ejecutarSentenciaPg(2);
    }
    
    public function add_data($campo, $valor, $strtoupper = TRUE)
    {
        
        if ($strtoupper == 'false') {
            strlen($valor) <= 0 ? $valor = 'null , ' : $valor = "'" . $valor . "' , ";
        } else {
            strlen($valor) <= 0 ? $valor = 'null , ' : $valor = "'" . trim($strtoupper ? strtoupper(strtr($valor, "àáâãäåæçèéêëìíîïðñòóôõöøùüú", "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÜÚ")) : $valor) . "', ";
        }
        
        
        if (isset($this->nuevo)) { //Nuevo Registro
            $this->sql_campo .= $campo . ',';
            $this->sql_valor .= $valor;
        } else { //Actualización de Registro
            $this->sql_valor .= $campo . " = " . $valor;
        }
    }
    
    
    public function add_($campo, $valor, $strtoupper = TRUE)
    {
        
        strlen($valor) <= 0 ? $valor = false : $valor = "'" . trim(pg_escape_string($strtoupper ? strtoupper(strtr($valor, "àáâãäåæçèéêëìíîïðñòóôõöøùüú", "ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÜÚ")) : $valor)) . "', ";
        if ($valor != false) {
            if (isset($this->nuevo)) { //Nuevo Registro
                $this->sql_campo .= $campo . ',';
                $this->sql_valor .= $valor;
            } else { //Actualización de Registro
                $this->sql_valor .= $campo . " = " . $valor;
            }
        }
    }
    
    public function ejecutar($tipo_id = 'id')
    {
        
        
        
        if ($this->motorbd == "pg") {
            
            $this->abrirConexionPg();
            if (isset($this->nuevo)) { //Nuevo Registro
                $this->sql = " INSERT INTO " . $this->tabla . " (" . $this->sql_campo . "registro,estatu) VALUES (" . $this->sql_valor . "'now()','" . $this->estatu . "'); ";
            } else { //Actualización de Registro
                $this->sql = "UPDATE  " . $this->tabla . "  SET  " . substr($this->sql_valor, 0, -2);
                $this->sql .= " WHERE " . $tipo_id . " in (" . $this->id . ")";
            }
            $this->ejecutarSentenciaPg(2);
            if (isset($this->nuevo)) //Nuevo Registro
                $this->id = $this->verId($this->tabla);
            unset($this->nuevo, $this->sql_campo, $this->sql_valor);
            
            $this->ultimoId = $this->verId($this->tabla);
        }
        
        
        if ($this->motorbd == "mysql") {
            
            
            $this->abrirConexionMysql();
            
            if (isset($this->nuevo)) {
                $this->sql_valor = substr(trim($this->sql_valor), 0, -1);
                $this->sql_campo = substr(trim($this->sql_campo), 0, -1);
            }
            
            if (isset($this->nuevo)) { //Nuevo Registro
                $this->sql = " INSERT INTO " . $this->tabla . " (" . $this->sql_campo . ") VALUES (" . $this->sql_valor . "); ";
            } else { //Actualización de Registro
                $this->sql = "UPDATE  " . $this->tabla . "  SET  " . substr($this->sql_valor, 0, -2);
                $this->sql .= " WHERE " . $tipo_id . " in (" . $this->id . ")";
            }
            $this->ejecutarSentenciaMysql();
            if (isset($this->nuevo)) //Nuevo Registro
                $this->id = $this->verIdMysql();
            unset($this->nuevo, $this->sql_campo, $this->sql_valor);
            
            $this->ultimoId = $this->verIdMysql();
        }
    }
    
    public function _update_sql($sql)
    {
        
        
        if ($this->motorbd == "pg") {
            
            $this->abrirConexionPg();
            $this->sql = $sql;
            $this->ejecutarSentenciaPg(2);
            $this->id       = $this->verId($this->tabla);
            $this->ultimoId = $this->verId($this->tabla);
        }
        
        
        if ($this->motorbd == "mysql") {
            
            $this->abrirConexionMysql();
            $this->sql = $sql;
            $this->ejecutarSentenciaMysql();
            $this->id       = $this->verIdMysql();
            $this->ultimoId = $this->verIdMysql();
        }
    }
    
    public function get_ultimoId($tabla)
    {
        
        if ($this->motorbd == "mysql")
            return $this->verIdMysql();
        if ($this->motorbd == "pg")
            return $this->verIdPg($tabla);
    }
    
    public function verId($tabla)
    {
        
        if ($this->motorbd == "mysql")
            $this->verIdMysql();
        if ($this->motorbd == "pg")
            $this->verIdPg($tabla);
    }
    
    /**
     * Consulta la siguiente id de una tabla, tomada de la secuencia.
     */
    public function proxId($tabla)
    {
        $this->abrirConexionPg();
        $this->sql = "SELECT MAX(id)+1 as id FROM " . $tabla;
        $data      = $this->ejecutarSentenciaPg(2);
        return $data[0]['id'];
    }
    
    public function ver_todo($condicion = false)
    {
        
        $this->abrirConexionPg();
        
        if (!$condicion) {
            $this->sql = "select  *  from " . $this->tabla . " where estatu=true ;";
        } else {
            $this->sql = "select  *  from " . $this->tabla . " where estatu=true " . $condicion . " ;";
        }
        
        $data = $this->ejecutarSentenciaPg(2);
        return $data;
    }
    
    public function ver_vista($vista, $condicion = '1=1')
    {
        $this->abrirConexionPg();
        $this->sql = "select  *  from " . $vista . " where  " . $condicion . ";";
        $data      = $this->ejecutarSentenciaPg(2);
        return $data;
    }
    
    public function ver_uno($id, $campo = '')
    {
        $this->abrirConexionPg();
        if ($campo)
            $this->sql = "select  *  from " . $this->tabla . " where " . $campo . "='" . $id . "' and estatu=true";
        else
            $this->sql = "select  *  from " . $this->tabla . " where id='" . $id . "' and estatu=true";
        $data = $this->ejecutarSentenciaPg(2);
        return $data;
    }
    
    public function actualizar($tabla, $id, $campo, $valor)
    {
        $this->abrirConexionPg();
        $this->sql = "UPDATE  $tabla SET $campo='$valor'  WHERE id=$id";
        $data      = $this->ejecutarSentenciaPg();
    }
    
    public function eliminar($campo = 'id', $tabla = FALSE)
    {
        $this->abrirConexionPg();
        if ($tabla)
            $this->tabla = $tabla;
        $this->sql = "UPDATE " . $this->tabla . " SET  estatu='FALSE'  WHERE $campo ='" . $_SESSION['id_eliminacion'] . "';";
        $data      = $this->ejecutarSentenciaPg();
        #$this->historico($_SESSION['id_eliminacion'], 'eliminar'); OJO!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
        return $data;
    }
    
    /*  funciones para el correlativo o numero de documento */
    
    private function actual_correlativo_en_maestro()
    {
        $this->abrirConexionPg();
        $this->sql = "select  tipo1 as correlativo  from  maestro where id=" . $this->id_padre;
        $data      = $this->ejecutarSentenciaPg(2);
        return $data[0]['correlativo'];
    }
    
    private function nuevo_correlativo()
    {
        $correlativo       = $this->actual_correlativo_en_maestro();
        $this->correlativo = $correlativo + 1;
        $longitud          = strlen($this->correlativo);
        $ceros             = (5 - $longitud);
        $ceros             = $this->cero_correlativo($ceros);
        
        $numero_documento = $this->numero_documento = $this->sigla . "-" . date('Y') . $ceros . $this->correlativo;
        $this->actualizar_correlativo_en_maestro();
        return $numero_documento;
    }
    
    private function cero_correlativo($total)
    {
        $res = '';
        for ($i = 1; $i <= $total; $i++) {
            $res .= '0';
        }
        return $res;
    }
    
    private function actualizar_correlativo_en_maestro()
    {
        
        $this->abrirConexionPg();
        $this->sql = " UPDATE maestro SET tipo1='" . $this->correlativo . "' WHERE id=" . $this->id_padre;
        $data      = $this->ejecutarSentenciaPg(2);
        return $data[0]['correlativo'];
    }
    
    public function alertas($msj)
    {
        echo "<script>alert('" . $msj . "') </script>";
    }
    
    public function encrypt($string)
    {
        /* $key = "lsdrojas@cluuf.com";
        $result = '';
        $string = base64_encode($string);
        for ($i = 0; $i < strlen($string); $i++) {
        $char = substr($string, $i, 1);
        $keychar = substr($key, ($i % strlen($key)) - 1, 1);
        $char = chr(ord($char) + ord($keychar));
        $result.=$char;
        return base64_encode($string);
        
        } */
        return base64_encode($string);
    }
    
    public function decrypt($string)
    {
        /* $key = "lsdrojas@cluuf.com";
        $result = '';
        $string = base64_decode($string);
        for ($i = 0; $i < strlen($string); $i++) {
        $char = substr($string, $i, 1);
        $keychar = substr($key, ($i % strlen($key)) - 1, 1);
        $char = chr(ord($char) - ord($keychar));
        $result.=$char;
        }
        return $result;
        */
        
        return base64_decode($string);
    }
    
    public function celda_u($label, $valor, $ancho, $ver = "si")
    {
        
        
        $clases['form_group']       = "form-group";
        $clases['form_group_label'] = " control-label label_text";
        $clases['form_group_valor'] = "label_text2";
        $clases['form_col']         = "col-group";
        
        
        if ($ver == "si") {
            
            echo "<div class=\"col-md-" . $ancho . "  " . $clases['form_col'] . " \">
                  <div class='" . $clases['form_group'] . "' >
                  <p>
                  <span  class='" . $clases['form_group_label'] . "'  >" . $label . "</span>
                  <span class='" . $clases['form_group_valor'] . "'    >" . $valor . "</span>
                  </p>
                  </div>
                  </div>";
        }
        
        if ($ver == "no") {
            
            return "<div class=\"col-md-" . $ancho . "  " . $clases['form_col'] . " \">
                  <div class='" . $clases['form_group'] . "' >
                  <p>
                  <span  class='" . $clases['form_group_label'] . "'  >" . $label . "</span>
                  <span class='" . $clases['form_group_valor'] . "'    >" . $valor . "</span>
                  </p>
                  </div>
                  </div>";
        }
    }
    
    public function celda_u_edit($tabla, $label, $campo, $valor, $ancho, $ver = "si")
    {
        
        
        $clases['form_group']       = "form-group";
        $clases['form_group_label'] = " control-label label_text";
        $clases['form_group_valor'] = "label_text2";
        $clases['form_col']         = "col-group";
        
        
        if ($ver == "si") {
            
            echo "<div class=\"col-md-" . $ancho . "  " . $clases['form_col'] . " \">
                  <div class='" . $clases['form_group'] . "' >
                  <p>
                  <span  class='" . $clases['form_group_label'] . "'  >" . " <a href='#' onclick='update_data_" . $tabla . "(\"" . $campo . "\",\"" . $valor . "\")' ><i class='fa fa-edit' ></i></a>" . $label . "</span>


                  <span class='" . $clases['form_group_valor'] . "'    >" . $valor . "</span>
                  </p>
                  </div>
                  </div>";
        }
        
        if ($ver == "no") {
            
            return "<div class=\"col-md-" . $ancho . "  " . $clases['form_col'] . " \">
                  <div class='" . $clases['form_group'] . "' >
                  <p>
                  <span  class='" . $clases['form_group_label'] . "'  >" . " <a href='#' onclick='update_data_" . $tabla . "(\"" . $campo . "\",\"" . $valor . "\")' ><i class='fa fa-edit' ></i></a>" . $label . "</span>


                  <span class='" . $clases['form_group_valor'] . "'    >" . $valor . "</span>
                  </p>
                  </div>
                  </div>";
        }
    }
    
    public function row_u($ver = 'si')
    {
        
        
        if ($ver == "si") {
            echo "  <div class=\"row\">
                  <div class=\"col-xs-12\">";
        }
        
        
        if ($ver == "no") {
            return " <div class=\"row\">
                  <div class=\"col-xs-12\">";
        }
    }
    
    public function end_row_u()
    {
        
        if ($ver == "si") {
            echo "  </div>";
            echo "  </div>";
        }
        
        
        if ($ver == "no") {
            return "</div>  </div>";
        }
    }
    
    public function date_now()
    {
        return date('Y/m/d H:i:s');
    }
    
    
    
    
    /*  MODULO  MODAL  */
    
    public $modal_id = "";
    public $modal = "";
    public $modal_top = "";
    public $modal_row = "";
    public $modal_class = "";
    public $modal_bottom = "";
    public $modal_body_height = "600px";
    public $title_modal = " Titulo del Modal ";
    public $modal_data = "";
    public $modal_only_body = false;
    public $modal_data_new = false;
    public $modal_only_form = false;
    public $modal_form_name = false;
    public $modal_form_id = false;
    public $modal_form_class = "";
    public $modal_form_enctype_value = "enctype=\"multipart/form-data\" ";
    public $modal_form_enctype = false;
    public $modal_form_method = "POST";
    public $modal_form_action = "";
    public $modal_javascript = "";
    public $modal_json = "";
    public $modal_type = "";
    
    public $modal_search_funcion = "";
    public $modal_search_color = "";
    public $modal_search_ico = "";
    public $modal_search_href = "";
    public $modal_search_style = "";
    public $modal_search_label = "";
    public $modal_search_externo = "";
    public $modal_search_class = "";
    public $modal_footer = "";
    
    
    
    public function modal_reset()
    {
        $this->modal_id           = "";
        $this->modal              = "";
        $this->modal_top          = "";
        $this->modal_row          = "";
        $this->modal_bottom       = "";
        $this->modal_body_height  = "600px";
        $this->title_modal        = " Titulo del Modal ";
        $this->modal_data         = "";
        $this->modal_only_body    = false;
        $this->modal_data_new     = false;
        $this->modal_row          = "";
        $this->modal_only_form    = false;
        $this->modal_form_name    = false;
        $this->modal_form_id      = false;
        $this->modal_form_enctype = false;
        $this->modal_form_method  = "POST";
        $this->modal_form_action  = "";
        $this->modal_javascript   = "";
        $this->modal_json         = "";
        $this->modal_footer       = "";
        
        $this->modal_search_funcion = "ajax('cli_search',0,'modal-clienteOrder01')";
        $this->modal_search_style   = "font-weight:bold";
        $this->modal_search_color   = "primary";
        $this->modal_search_ico     = " <i class=\"ace-icon fa fa-search\"></i>";
        $this->modal_search_href    = "#modal-clienteOrder01";
        $this->modal_search_label   = "Search";
        $this->modal_search_class   = "modal-standard";
        $this->modal_search_externo = "";
        
        
    }
    
    public function modal_body_row_input($size, $campo, $label, $class, $type = "text")
    {
        
        
        if (!$this->modal_data_new) {
            
            if ($type == 'select') {
                
                $this->modal_row .= "<div class = \"col-md-" . $size . "\">
                    <div class = \"form-group\" >
                    <label class = \"control-label label_text\" >" . $label . "</label>
                    " . $this->modal_data[$campo] . "
                    </div>
                    </div>";
            } else {
                
                
                $this->modal_row .= "<div class = \"col-md-" . $size . "\">
                    <div class = \"form-group\" >
                    <label class = \"control-label label_text\" >" . $label . "</label>
                    <input  onclick='refresh_JS();' name=\"" . $campo . "\" value = \"" . $this->modal_data[$campo] . "\" class = \"input_text label_text2 " . $class . " \"  type = \"" . $type . "\" id = \"" . $campo . "\" >
                    </div>
                    </div>";
            }
        }
        
        
        
        if ($this->modal_data_new) {
            
            if ($type == 'select') {
                
                $this->modal_row .= "<div class = \"col-md-" . $size . "\">
                    <div class = \"form-group\" >
                    <label class = \"control-label label_text\" >" . $label . "</label>
                    " . $this->modal_data[$campo] . "
                    </div>
                    </div>";
            } else {
                
                $this->modal_row .= "<div class = \"col-md-" . $size . "\">
                    <div class = \"form-group\" >
                    <label class = \"control-label label_text\" >" . $label . "</label>
                    <input  onclick='refresh_JS();' name=\"" . $campo . "\"  value = '' class = \"input_text label_text2\" " . $class . " type = \"text\" id = \"" . $campo . "\" >
                    </div>
                    </div>";
            }
        }
    }
    
    
    
    
    public function modal_body_row_input_json($data_json)
    {
        
        if (!$this->modal_data_new) {
            
            
            if ($data_json['edit'] == 'false') {
                
            } else if ($data_json['type'] == 'select') {
                
                
                $this->modal_row .= "<div id=\"" . $data_json['groupid'] . "\"  class = \"col-md-" . $data_json['size'] . " " . $data_json['class_modal_row'] . " \" style=\" " . $data_json['style_modal_row'] . " \" >
                    <div class = \"form-group\" >
                    <label class = \"control-label label_text\" >" . $data_json['label'] . "</label>
                    " . $this->modal_data[$data_json['campo']] . "
                    </div>
                    </div>";
            } else if ($data_json['type'] == 'file') {
                
                $this->modal_row .= "
                    <div id=\"" . $data_json['groupid'] . "\"  class = \"col-md-" . $data_json['size'] . "\" style=\" " . $data_json['style_modal_row'] . " \" >
                    <div class = \"form-group\" >
                    <label class = \"control-label label_text\" >" . $data_json['label'] . "</label>
                    <input   onclick='refresh_JS();'  style=\" " . $data_json['style'] . " \"  name=\"" . $data_json['campo'] . "\" value = \"" . $this->modal_data[$data_json['campo']] . "\" class = \"input_text label_text2 " . $data_json['class'] . " \"  type = \"" . $data_json['type'] . "\" id = \"" . $data_json['campo'] . "\"  " . $data_json['externo'] . "  >
                    <input type=\"hidden\"   name=\"MAX_FILE_SIZE\" value=\"" . $data_json['maxfilesize'] . "\" />
                    <input type=\"hidden\"   name=\"url\" value=\"" . $data_json['url'] . "\" />
                    </div></div>";
            } else if ($data_json['type'] == 'readonly') {
                
                $this->modal_row .= "<div  id=\"" . $data_json['groupid'] . "\"  class = \"col-md-" . $data_json['size'] . " " . $data_json['class_modal_row'] . "   \" style=\" " . $data_json['style_modal_row'] . " \"  >
                    <div class = \"form-group\" >
                    <label class = \"control-label label_text\" >" . $data_json['label'] . "</label>
                    <div  style=\" " . $data_json['style'] . " \"  class=" . $data_json['class'] . " >" . $this->modal_data[$data_json['campo']] . "</div>
                    </div>
                    </div>";
            } else if ($data_json['type'] == 'textarea') {
                
                $this->modal_row .= "<div  id=\"" . $data_json['groupid'] . "\" class = \"col-md-" . $data_json['size'] . " " . $data_json['class_modal_row'] . " \" style=\" " . $data_json['style_modal_row'] . " \"   >
                    <div class = \"form-group\" >
                    <label class = \"control-label label_text\" >" . $data_json['label'] . "</label>
                    <textarea  " . $data_json['externo'] . " id = \"" . $data_json['id'] . "\" class = \"input_text label_text2 " . $data_json['class'] . " \"  onclick='refresh_JS();'   maxlength=\" " . $data_json['maxlength'] . "\"   style=\" " . $data_json['style'] . " \"  name=\"" . $data_json['campo'] . "\" >" . $this->modal_data[$data_json['campo']] . "</textarea>

                    </div>
                    </div>";
            } else {
                $this->modal_row .= "<div id=\"" . $data_json['groupid'] . "\"  class = \"col-md-" . $data_json['size'] . " " . $data_json['class_modal_row'] . " \" style=\" " . $data_json['style_modal_row'] . " \"   >
                    <div class = \"form-group\" >
                    <label class = \"control-label label_text\" >" . $data_json['label'] . "</label>
                    <input  onclick='refresh_JS();'  style=\" " . $data_json['style'] . " \"  name=\"" . $data_json['campo'] . "\" value = \"" . $this->modal_data[$data_json['campo']] . "\" class = \"input_text label_text2 " . $data_json['class'] . " \"  type = \"" . $data_json['type'] . "\" id = \"" . $data_json['id'] . "\"  " . $data_json['externo'] . "  >
                    </div>
                    </div>";
            }
        }
        
        
        
        /* esto existe porqu aqui no carga  value */
        if ($this->modal_data_new) {
            
            if ($data_json['type'] == 'select') {
                
                $this->modal_row .= "<div class = \"col-md-" . $data_json['size'] . " " . $data_json['class_modal_row'] . " \" style=\" " . $data_json['style_modal_row'] . " \" >
                    <div class = \"form-group\" >
                    <label class = \"control-label label_text\" >" . $data_json['label'] . "</label>
                    " . $this->modal_data[$data_json['campo']] . "
                    </div>
                    </div>";
            } else if ($data_json['type'] == 'textarea') {
                
                $this->modal_row .= "<div class = \"col-md-" . $data_json['size'] . " " . $data_json['class_modal_row'] . " \" style=\" " . $data_json['style_modal_row'] . " \"   >
                    <div class = \"form-group\" >
                    <label class = \"control-label label_text\" >" . $data_json['label'] . "</label>
                    <textarea  " . $data_json['externo'] . " id = \"" . $data_json['id'] . "\" class = \"input_text label_text2 " . $data_json['class'] . " \"  onclick='refresh_JS();'   maxlength=\" " . $data_json['maxlength'] . "\"   style=\" " . $data_json['style'] . " \"  name=\"" . $data_json['campo'] . "\" ></textarea>

                    </div>
                    </div>";
            } else {
                $this->modal_row .= "<div class = \"col-md-" . $data_json['size'] . "  " . $data_json['class_modal_row'] . " \" style=\" " . $data_json['style_modal_row'] . " \" >
                    <div class = \"form-group\" >
                    <label class = \"control-label label_text\" >" . $data_json['label'] . "</label>
                    <input  onclick='refresh_JS();' style=\" " . $data_json['style'] . " \" name=\"" . $data_json['campo'] . "\"  value = ''  class = \"input_text label_text2 " . $data_json['class'] . " \" type = \"" . $data_json['type'] . "\"  id = \"" . $data_json['id'] . "\"  " . $data_json['externo'] . "  >
                    </div>
                    </div>";
            }
        }
    }
    
    
    
    
    
    public function modal_body_row_reporte_json($data_json)
    {
        
        
        $this->modal_row .= "<div id=\"" . $data_json['groupid'] . "\"
                class = \"col-md-" . $data_json['size'] . " " . $data_json['class_modal_row'] . " \"
                style=\" " . $data_json['style_modal_row'] . " \"   >
                <div class = \"form-group\" >
                <label class = \"control-label label_text  " . $data_json['class_label'] . " \" style=\"" . $data_json['style_label'] . "\" >" . $data_json['label'] . "</label>
                <span style=\" " . $data_json['style_value'] . "  \"  class = \"input_text label_text2 " . $data_json['class_value'] . " \"  " . $data_json['externo'] . "  >" . $this->modal_data[$data_json['campo']] . "</span>
                </div>
                </div>";
        
        
    }
    
    
    
    /*
    
    public function modal_body_row_input_json_materialize($data_json)
    {
    
    if (!$this->modal_data_new){
    
    
    if ($data_json['edit'] == 'false')
    {
    
    }
    else if ($data_json['type'] == 'select')
    {
    
    
    $this->modal_row.= "<div class=\"input-field col s" . $data_json['size'] . "\">
    
    " . $this->modal_data[$data_json['campo']] . "
    <label>" . $data_json['label'] . "</label>
    </div>";
    
    
    }
    else if ($data_json['type'] == 'file')
    {
    
    $this->modal_row.= "";
    
    }
    else if ($data_json['type'] == 'readonly')
    {
    
    $this->modal_row.= "";
    }
    else
    {
    
    
    
    $this->modal_row.= "  <div class=\"input-field col s" . $data_json['size'] . " " . $data_json['class_modal_row'] . "\" style=\"" . $data_json['style_modal_row'] . "\">
    <input  onclick=\"" . $data_json['onclick'] . " \" name=\"" . $data_json['campo'] . "\" value=\"" . $this->modal_data[$data_json['campo']] . "\" id=\"" . $data_json['campo'] . "\" type=\"".$data_json['type']."\" class=\"validate " . $data_json['class'] . "\"  style=\" " . $data_json['style'] . "  " . $data_json['externo'] . " >
    <label class=\"active\" for=\"first_name2\">" . $data_json['label'] . "</label>
    </div>";
    
    
    
    
    }
    }
    
    
    if ($this->modal_data_new)
    {
    
    if ($data_json['type'] == 'select')
    {
    
    $this->modal_row.= "<div class=\"input-field col s" . $data_json['size'] . "\">
    
    " . $this->modal_data[$data_json['campo']] . "
    <label>" . $data_json['label'] . "</label>
    </div>";
    }
    else
    {
    
    
    $this->modal_row.= "  <div class=\"input-field col s" . $data_json['size'] . " " . $data_json['class_modal_row'] . "\" style=\"" . $data_json['style_modal_row'] . "\">
    <input  onclick=\"" . $data_json['onclick'] . " \" name=\"" . $data_json['campo'] . "\" value=\"\" id=\"" . $data_json['campo'] . "\" type=\"".$data_json['type']."\" class=\"" . $data_json['class'] . "\"  style=\" " . $data_json['style'] . "  " . $data_json['externo'] . " >
    <label class=\"active\" for=\"first_name2\">" . $data_json['label'] . "</label>
    </div>";
    
    
    
    
    }
    }
    }
    
    public function modal_footer_buttons_json_materialize($json)
    {
    
    $this->modal_bottom.="   <a style=\"" . $json['style'] . "\" id=\"" . $json['id'] . "\" onclick=\"" . $json['onclick'] . " \"  name=\"" . $json['name'] . "\"
    class=\" modal-action modal-close   waves-effect waves-" . $json['color'] . " btn-flat\">
    " . $json['title'] . "
    </a>
    ";
    }
    
    */
    
    
    
    public function modal_body_row_select($size, $campo, $label, $class = "")
    {
        
        $this->modal_row .= "<div class = \"col-md-" . $size . "\">
                  <div class = \"form-group\" >
                  <label class = \"control-label label_text\" >" . $label . "</label>
                  " . $this->modal_data[$campo] . "
                  </div>
                  </div>";
    }
    
    public function modal_body()
    {
        
        return "<div class=\"modal-body\" style=\"height:" . $this->modal_body_height . "\">" . $this->modal_row . "</div>";
    }
    
    public function modal_header()
    {
        return " <div class=\"modal-header\">

                  <button type=\"button\" class=\"close\"  aria-hidden=\"true\">Guardar</button>
                  <button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\">&times;</button>
                  <h3 class=\"smaller lighter blue no-margin\">" . $this->title_modal . "</h3>
                  </div>";
    }
    
    public function modal_footer_buttons($nombre, $title, $color = "success")
    {
        
        $this->modal_bottom .= "<button  style=\"margin-left:5px\" onclick='" . $nombre . "_click()' name='" . $nombre . "' class=\"btn btn-sm btn-" . $color . "  pull-right\" data-dismiss=\"modal\">

                  " . $title . "
                  </button>";
    }
    
    public function modal_footer_buttons_json($json)
    {
        
        
        if ($json['href'] == "") {
            $json['href'] = "#";
        }
        
        $this->modal_bottom .= "<a data-toggle=\"" . $json['data-toggle'] . "\" href=\"" . $json['href'] . "\"  style=\"" . $json['style'] . "\" id=\"" . $json['id'] . "\" onclick=\"" . $json['onclick'] . " \"  name=\"" . $json['name'] . "\"  class=\"btn btn-sm btn-" . $json['color'] . "  pull-right " . $json['class'] . "\" data-dismiss=\"" . $json['data-dismiss'] . "\">
                " . $json['ico'] . " " . $json['title'] . "
                </a>";
    }
    
    
    public function modal_footer_buttons_confirm($nombre, $title, $color = "success")
    {
        
        $this->modal_bottom .= "<a  class=\"btn btn-sm btn-" . $color . "  pull-right\" data-dismiss=\"modal\" ><i class=\"ace-icon fa fa-check\"></i>

                " . $title . "
                </a>";
    }
    
    public function modal_footer()
    {
        
        
        $res .= "<div class=\"modal-footer\">
                " . $this->modal_bottom . "
                <button class=\"btn btn-sm btn-danger pull-right\" data-dismiss=\"modal\">
                <i class=\"ace-icon fa fa-times\"></i>
                Close
                </button>";
        
        
        if ($this->modal_type == "search") {
            $res .= "<button
                  onclick=\"" . $this->modal_search_funcion . "\"
                  href=\"" . $this->modal_search_href . "\"
                  style=\"" . $this->modal_search_style . "\"
                  data-toggle=\"modal\"
                  class=\" " . $this->modal_search_class . " btn btn-sm btn-" . $this->modal_search_color . " pull-right\"
                  data-dismiss=\"modal\" " . $this->modal_search_externo . " >
                  " . $this->modal_search_ico . "
                  " . $this->modal_search_label . "
                  </button>";
        }
        
        $res .= "</div>";
        
        return $res;
    }
    
    
    
    public function modal_header_documento()
    {
        
        
        $cierremodal = "
                <button class=\"btn btn-sm btn-danger pull-right\" data-dismiss=\"modal\">
                <i class=\"ace-icon fa fa-times\"></i>
                Close
                </button>";
        
        
        if ($this->modal_footer == "simple") {
            
            $cierremodal = "";
            
        }
        
        $res .= "<div class=\"modal-footer modal-header\">
                <h3 class=\"smaller lighter blue no-margin pull-left\" >" . $this->title_modal . "</h3>
                " . $this->modal_bottom . $cierremodal;
        
        
        
        
        if ($this->modal_type == "search") {
            $res .= "<button
                  onclick=\"" . $this->modal_search_funcion . "\"
                  href=\"" . $this->modal_search_href . "\"
                  style=\"" . $this->modal_search_style . "\"
                  data-toggle=\"modal\"
                  class=\" " . $this->modal_search_class . " btn btn-sm btn-" . $this->modal_search_color . " pull-right\"
                  data-dismiss=\"modal\" " . $this->modal_search_externo . " >
                  " . $this->modal_search_ico . "
                  " . $this->modal_search_label . "
                  </button>";
        }
        
        $res .= "</div>";
        
        return $res;
    }
    
    
    
    public function modal_form_content()
    {
        
        if (!$this->modal_form_enctype) {
            $this->modal_form_enctype_value = "";
        }
        
        
        
        
        if ($this->modal_type == "documento") {
            return "<form action=\"" . $this->modal_form_action . "\"  method=\"" . $this->modal_form_method . "\" " . $this->modal_form_enctype_value . "  onmouseover=\"refresh_JS()\"  class=\"" . $this->modal_form_class . "\"  name=\"" . $this->modal_form_name . "\"  id=\"" . $this->modal_form_id . "\"  ><input name='cluuf 'type='hidden' value='CLUUF'><div id=\"" . $this->modal_id . "\" ><div class=\"modal-dialog\"><div class=\"modal-content\">" . "" . $this->modal_header_documento() . $this->modal_body() . "</div></div></div></form>" . $this->modal_javascript;
        }
        
        
        if ($this->modal_type == "reporte") {
            return "<div id=\"" . $this->modal_id . "\" >
                  <div class=\"modal-dialog modal-reporte  \">
                  <div class=\"modal-content\">" . "" . $this->modal_header_documento() . $this->modal_body() . "</div></div></div>";
        }
        
        
        if ($this->modal_only_form) {
            
            return "<form action=\"" . $this->modal_form_action . "\"  method=\"" . $this->modal_form_method . "\" " . $this->modal_form_enctype_value . "  onmouseover=\"refresh_JS()\"  class=\"" . $this->modal_form_class . "\"  name=\"" . $this->modal_form_name . "\"  id=\"" . $this->modal_form_id . "\"  ><input name='cluuf 'type='hidden' value='CLUUF'><div id=\"" . $this->modal_id . "\" ><div class=\"modal-dialog\"><div class=\"modal-content\">" . "" . $this->modal_header() . $this->modal_body() . $this->modal_footer() . "</div></div></div></form>" . $this->modal_javascript;
        } else if (!$this->modal_only_body) {
            
            return "<form   action=\"" . $this->modal_form_action . "\"  method=\"" . $this->modal_form_method . "\" " . $this->modal_form_enctype_value . " onmouseover=\"refresh_JS()\"  class=\"" . $this->modal_form_class . "\" name=\"" . $this->modal_form_name . "\"  id=\"" . $this->modal_form_id . "\"  ><input name='cluuf 'type='hidden' value='CLUUF'><div id=\"" . $this->modal_id . "\" class=\"modal fade\" tabindex=\"-1\"><div class=\"modal-dialog\"><div class=\"modal-content\">" . "" . $this->modal_header() . $this->modal_body() . $this->modal_footer() . "</div></div></div></form>" . $this->modal_javascript;
        } else if ($this->modal_only_body) {
            
            return "<form  action=\"" . $this->modal_form_action . "\"  method=\"" . $this->modal_form_method . "\" " . $this->modal_form_enctype_value . "  onmouseover=\"refresh_JS()\"  class=\"" . $this->modal_form_class . "\" name=\"" . $this->modal_form_name . "\"  id=\"" . $this->modal_form_id . "\"  ><input name='cluuf 'type='hidden' value='CLUUF'><div id=\"" . $this->modal_id . "\" class=\"modal fade\" tabindex=\"-1\"><div class=\"modal-dialog\"><div class=\"modal-content\">" . "" . $this->modal_body() . $this->modal_footer() . "</div></div></div></form>" . $this->modal_javascript;
        }
    }
    
    
    public function modal_form_content_json($json)
    {
        
        if (!$json['enctype']) {
            $json['enctype'] = "";
        }
        
        
        
        
        if ($json['type'] == "documento") {
            return "<form action=\"" . $json['action'] . "\"  method=\"" . $json['method'] . "\" " . $json['enctype'] . "  class=\"" . $json['form_class'] . "\"   name=\"" . $json['form_name'] . "\"  id=\"" . $this->modal_form_id . "\"  ><input name='cluuf 'type='hidden' value='CLUUF'><div id=\"" . $this->modal_id . "\" ><div class=\"modal-dialog\"><div class=\"modal-content\">" . "" . $this->modal_header_documento() . $this->modal_body() . "</div></div></div><input name='" . $json['form_submmit'] . "' type='hidden' value='true'></form>" . $this->modal_javascript;
            
        }
        
        
        
        if ($json['type'] == "reporte") {
            return "<div id=\"" . $this->modal_id . "\" >
                  <div class=\"modal-dialog modal-reporte  \" style=\"" . $json['style_modal'] . "\">
                  <div class=\"modal-content\" style=\"" . $json['style'] . "\">" . "" . $this->modal_header_documento() . $this->modal_body() . "</div></div></div>";
        }
        
        
        
        if ($this->modal_only_form) {
            
            return "<form action=\"" . $json['action'] . "\"  method=\"" . $json['method'] . "\" " . $json['enctype'] . "   class=\"" . $json['form_class'] . "\"  name=\"" . $json['form_name'] . "\"  id=\"" . $json['form_id'] . "\"  ><input name='cluuf 'type='hidden' value='CLUUF'><div id=\"" . $this->modal_id . "\" ><div class=\"modal-dialog\"><div class=\"modal-content\">" . "" . $this->modal_header() . $this->modal_body() . $this->modal_footer() . "</div></div></div><input name='" . $json['form_submmit'] . "' type='hidden' value='true'></form>" . $this->modal_javascript;
        } else if (!$this->modal_only_body) {
            
            return "<form   action=\"" . $json['action'] . "\"  method=\"" . $json['method'] . "\" " . $json['enctype'] . "  class=\"" . $json['form_class'] . "\" name=\"" . $json['form_name'] . "\"  id=\"" . $json['form_id'] . "\"  ><input name='cluuf 'type='hidden' value='CLUUF'><div id=\"" . $this->modal_id . "\" class=\"modal fade\" tabindex=\"-1\"><div class=\"modal-dialog\"><div class=\"modal-content\">" . "" . $this->modal_header() . $this->modal_body() . $this->modal_footer() . "</div></div></div><input name='" . $json['form_submmit'] . "' type='hidden' value='true'></form>" . $this->modal_javascript;
        } else if ($this->modal_only_body) {
            
            return "<form  action=\"" . $json['action'] . "\"   method=\"" . $json['method'] . "\" " . $json['enctype'] . "  class=\"" . $json['form_class'] . "\" name=\"" . $json['form_name'] . "\"  id=\"" . $json['form_id'] . "\"  ><input name='cluuf 'type='hidden' value='CLUUF'><div id=\"" . $this->modal_id . "\" class=\"modal fade\" tabindex=\"-1\"><div class=\"modal-dialog\"><div class=\"modal-content\">" . "" . $this->modal_body() . $this->modal_footer() . "</div></div></div><input name='" . $json['form_submmit'] . "' type='hidden' value='true'></form>" . $this->modal_javascript;
        }
    }
    
    
    
    public function modal_content()
    {
        
        
        if ($this->modal_only_form) {
            
            return "<div   class=\"" . $this->modal_class . "\" id=\"" . $this->modal_id . "\" ><div class=\"modal-dialog\"><div class=\"modal-content\">" . "" . $this->modal_header() . $this->modal_body() . $this->modal_footer() . "</div></div></div>" . $this->modal_javascript;
        } else if (!$this->modal_only_body) {
            
            return "<div id=\"" . $this->modal_id . "\" class=\"modal fade  " . $this->modal_class . "\" tabindex=\"-1\"><div class=\"modal-dialog\"><div class=\"modal-content\">" . "" . $this->modal_header() . $this->modal_body() . $this->modal_footer() . "</div></div></div>" . $this->modal_javascript;
        } else if ($this->modal_only_body) {
            
            return "<div id=\"" . $this->modal_id . "\" class=\"modal fade  " . $this->modal_class . "\" tabindex=\"-1\"><div class=\"modal-dialog\"><div class=\"modal-content\">" . "" . $this->modal_body() . $this->modal_footer() . "</div></div></div>" . $this->modal_javascript;
        }
    }
    
    
    
    public function modal_content_view($body)
    {
        
        
        return "<div class=\"modal-dialog\">
               <div class=\"modal-content\">
               <div class=\"modal-header\" style='display:none' >
               <button type=\"button\" class=\"close\" data-dismiss=\"modal\">×</button>
               <h4 class=\"blue bigger\">Please fill the following form fields</h4>
               </div>
               <div class=\"modal-body\">
               <div class=\"row\">

               " . $body . "

               </div>
               </div>

               <div style='display:none' class=\"modal-footer\">
               <button class=\"btn btn-sm\" data-dismiss=\"modal\">
               <i class=\"ace-icon fa fa-times\"></i>
               Cancel
               </button>

               <button class=\"btn btn-sm btn-primary\">
               <i class=\"ace-icon fa fa-check\"></i>
               Save
               </button>
               </div>
               </div>
               </div>";
    }
    
    
    public function MODAL__($json, $data, $modo = 'edit')
    {
        
        $this->modal_reset();
        $form_new                 = $json;
        $this->modal_only_form    = true;
        $this->modal_id           = $form_new['id'];
        $this->modal_class        = $form_new['class'];
        $this->modal_body_height  = $form_new['height'];
        $this->title_modal        = $form_new['title'];
        $this->modal_data         = $data;
        $this->modal_form_class   = $form_new['form_class'];
        $this->modal_form_enctype = $form_new['form_enctype'];
        $this->modal_form_id      = $form_new['form_id'];
        $this->modal_type         = $form_new['type'];
        $this->modal_footer       = $form_new['footer'];
        
        
        
        $this->modal_search_funcion = $form_new['button_search'][0]['funcion'];
        $this->modal_search_style   = $form_new['button_search'][0]['style'];
        $this->modal_search_color   = $form_new['button_search'][0]['color'];
        $this->modal_search_ico     = $form_new['button_search'][0]['ico'];
        $this->modal_search_href    = $form_new['button_search'][0]['href'];
        $this->modal_search_label   = $form_new['button_search'][0]['label'];
        $this->modal_search_class   = $form_new['button_search'][0]['class'];
        $this->modal_search_externo = $form_new['button_search'][0]['externo'];
        
        
        
        
        if ($modo == 'new') {
            $this->modal_data_new = true;
        } else {
            
            
            
            
            if ($form_new['type'] == "reporte") {
                
                for ($i = 0; $i < count($form_new['col']); $i++) {
                    $this->modal_body_row_reporte_json($form_new['col'][$i]);
                }
                
            } else {
                
                for ($i = 0; $i < count($form_new['col']); $i++) {
                    $this->modal_body_row_input_json($form_new['col'][$i]);
                }
                
                
            }
            
            
            
            
            
            for ($i = 0; $i < count($form_new['button_footer']); $i++) {
                $this->modal_footer_buttons_json($form_new['button_footer'][$i]);
            }
            
            
            
            
            if ($form_new['version'] == 'v2') {
                
                
                if ($form_new['type'] == "reporte") {
                    return $this->modal_form_content_json($form_new);
                    
                } else {
                    return $this->modal_form_content_json($form_new);
                }
                
                
                
            } else {
                return $this->modal_form_content();
                
            }
            
            
        }
    }
    
    
    
    
    
    
    
    
    
    
    
    
    /*  MODULO  VIEW  */
    
    public $view_row = "";
    public $view_clase_form_col = "col-group";
    public $view_clase_form_group = "form-group";
    public $view_clase_form_group_label = " control-label label_text ";
    public $view_clase_form_group_valor = "  label_text2 ";
    public $view_display = false;
    public $view_data = "";
    
    public function VIEW_body_row($campo, $label, $ancho = '6')
    {
        
        $this->view_row .= "
          <div class=\"col-md-" . $ancho . "  " . $this->view_clase_form_col . " \">
          <div class='" . $this->view_clase_form_group . "' >
          <p>
          <span  class='" . $this->view_clase_form_group_label . "'  >" . $label . "</span>
          <span class='" . $this->view_clase_form_group_valor . "'    >" . $this->view_data[$campo] . "</span>
          </p>
          </div>
          </div>";
    }
    
    public function VIEW_body()
    {
        
        return "  <div class=\"row\">
          <div class=\"col-xs-12\">" . $this->view_row . "</div>" . "</div>";
    }
    
    public function VIEW_content()
    {
        
        if ($this->view_display) {
            echo $this->VIEW_body();
        }
        
        if (!$this->view_display) {
            return $this->VIEW_body();
        }
    }
    
    /*   FIN VIEW  */
    
    
    
    /*  MODULO  VIEW  */
    
    public $pdf_row = "";
    public $pdf_clase_form_col = "col-group";
    public $pdf_clase_form_group = "form-group";
    public $pdf_clase_form_group_label = " control-label label_text ";
    public $pdf_clase_form_group_valor = "  label_text2 ";
    public $pdf_display = false;
    public $pdf_data = "";
    
    public function PDF_body_row($campo, $label, $ancho = '6')
    {
        
        $this->pdf_row .= "<span><b>" . $label . ":</b></span><span>&nbsp;&nbsp;" . $this->pdf_data[$campo] . "</span><br>";
    }
    
    public function PDF_body()
    {
        
        return $this->pdf_row;
    }
    
    public function PDF_content()
    {
        
        if ($this->pdf_display) {
            echo $this->PDF_body();
        }
        
        if (!$this->pdf_display) {
            return $this->PDF_body();
        }
    }
    
    
    
    
    /* PIE GRAPHICS */
    
    
    
    public $grafico_showInLegend = "true";
    public $grafico_text = "titulo";
    public $grafico_type = "pie";
    public $grafico_plotShadow = "true";
    public $grafico_series_name = "pedro!";
    
    
    
    
    
    public function grafico_pie($json, $data = "")
    {
        
        
        $this->grafico_showInLegend = $json['showInLegend'];
        $this->grafico_text         = $json['text'];
        $this->grafico_type         = $json['type'];
        $this->grafico_plotShadow   = $json['typlotShadowpe'];
        $this->grafico_series_name  = $json['series_name'];
        
        $json['sql'] = $this->sql_inyection($json['sql']);
        
        if ($data == "") {
            $data = $this->ejecutar_query($json['sql']);
        }
        
        
        
        $res .= "{
         chart: {
          plotBackgroundColor: null,
          plotBorderWidth: null,
          plotShadow: false,
          type: 'pie'
        },
        title: {
          text: '" . $this->grafico_text . "'
        },
        tooltip: {
          pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
          pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
              enabled: false
            },
            showInLegend: " . $this->grafico_showInLegend . "
          }
        },
        series: [{
          name: '" . $this->grafico_series_name . "',
          colorByPoint: true,
          data: [";
        
        
        for ($y = 0; $y < count($data); $y++) {
            
            $coma = "";
            if ($y < count($data) - 1) {
                $coma = ",";
            }
            
            $res .= "{
            name: '" . $data[$y]['name'] . "',
            y: " . $data[$y]['value'] . "
          }" . $coma;
        }
        
        $res .= "]
      }]
    }";
        
        
        return $this->grafico01($res, $json['id']);
        
    }
    
    
    public function grafico01($x, $div)
    {
        
        return "<script> $(function () {
      $(document).ready(function () {
        $('#" . $div . "').highcharts(" . $x . ");
      });
});</script>";
        
        
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    /*   FIN VIEW  */
    
    public $datatable_struct = "";
    public $datatable_data = "";
    public $datatable_th = "";
    public $datatable_tr = "";
    public $DATATABLE_CONDICIONAL = "";
    public $DATATABLE_CONDICIONAL_SQL = false;
    
    
    public function datatable_reset()
    {
        
        $this->datatable_struct          = "";
        $this->datatable_data            = "";
        $this->datatable_th              = "";
        $this->datatable_tr              = "";
        $this->DATATABLE_CONDICIONAL     = "";
        $this->DATATABLE_CONDICIONAL_SQL = false;
        
        
    }
    
    
    public function DATATABLE_edit()
    {
        
        
        for ($i = 0; $i < count($this->datatable_struct['edit']); $i++) {
            
            $this->datatable_th .= "<th></th>";
            $this->datatable_tr .= "<td><a href='" . $this->datatable_struct['edit'][$i]['href'] . $this->encrypt($this->datatable_struct['edit'][$i]['href']) . "'>
    " . $this->datatable_struct['edit'][$i]['icon'] . "
    </a></td>";
        }
    }
    
    
    
    public function DATATABLE_head()
    {
        
        $this->datatable_th .= "<thead><tr>";
        
        
        
        
        
        
        if ($this->datatable_struct['version'] == "2") {
            
            
            for ($i = 0; $i < count($this->datatable_struct['tr']); $i++) {
                
                
                if ($this->datatable_struct['tr'][$i]['visible'] == 'true') {
                    
                    $css_tablet = $css_mobil = $css_desktop = "";
                    
                    
                    if ($this->datatable_struct['tr'][$i]['hidden_desktop'] == 'true') {
                        $css_desktop = " hidden-md ";
                    }
                    
                    if ($this->datatable_struct['tr'][$i]['hidden_tablet'] == 'true') {
                        $css_tablet = " hidden-sm ";
                    }
                    
                    if ($this->datatable_struct['tr'][$i]['hidden_mobil'] == 'true') {
                        $css_mobil = " hidden-xs ";
                    }
                    
                    
                    $this->datatable_th .= "<th  style=\"" . $this->datatable_struct['tr'][$i]['style_th'] . "
        \"  class= \" " . $css_mobil . " " . $css_desktop . " " . $css_tablet . "
        " . $this->datatable_struct['tr'][$i]['class'] . "\" >" . $this->datatable_struct['tr'][$i]['label'] . "</th>";
                }
                
            }
            
            
            
        } else {
            
            
            
            
            for ($i = 0; $i < count($this->datatable_struct['th']); $i++) {
                
                
                if ($this->datatable_struct['tr'][$i]['visible'] == 'true') {
                    
                    $css_tablet = $css_mobil = $css_desktop = "";
                    
                    
                    if ($this->datatable_struct['tr'][$i]['hidden_desktop'] == 'true') {
                        $css_desktop = " hidden-md ";
                    }
                    
                    if ($this->datatable_struct['tr'][$i]['hidden_tablet'] == 'true') {
                        $css_tablet = " hidden-sm ";
                    }
                    
                    if ($this->datatable_struct['tr'][$i]['hidden_mobil'] == 'true') {
                        $css_mobil = " hidden-xs ";
                    }
                    
                    
                    $this->datatable_th .= "<th  style=\"" . $this->datatable_struct['th'][$i]['style'] . "
        \"  class= \" " . $css_mobil . " " . $css_desktop . " " . $css_tablet . "
        " . $this->datatable_struct['tr'][$i]['class'] . "\" >" . $this->datatable_struct['th'][$i]['value'] . "</th>";
                }
                
            }
            
            
            
            
            
            
        }
        
        
        
        
        
        
        
        
        
        
        
        $this->datatable_th .= "</tr></thead>";
        
        return $this->datatable_th;
    }
    
    
    
    
    public function DATATABLE_body()
    {
        $this->datatable_tr .= "<tbody>";
        
        for ($y = 0; $y < count($this->datatable_data); $y++) {
            
            $this->datatable_tr .= "<tr style=\"\"   >";
            
            for ($i = 0; $i < count($this->datatable_struct['tr']); $i++) {
                
                $css_tablet = $css_mobil = $css_desktop = "";
                
                if ($this->datatable_struct['tr'][$i]['hidden_desktop'] == 'true') {
                    $css_desktop = " hidden-md ";
                }
                
                if ($this->datatable_struct['tr'][$i]['hidden_tablet'] == 'true') {
                    $css_tablet = " hidden-sm ";
                }
                
                if ($this->datatable_struct['tr'][$i]['hidden_mobil'] == 'true') {
                    $css_mobil = " hidden-xs ";
                }
                
                
                
                if ($this->datatable_struct['tr'][$i]['edit']) {
                    
                    $this->datatable_tr .= "<td  class=\" " . $css_mobil . " " . $css_desktop . " " . $css_tablet . " " . $this->datatable_struct['tr'][$i]['class'] . "\"   style=\"  " . $this->datatable_struct['tr'][$i]['style'] . " ; width:" . $this->datatable_struct['tr'][$i]['width'] . " \"> ";
                    $this->datatable_tr .= "<div class=\"hidden-sm hidden-xs btn-group\">";
                    
                    for ($z = 0; $z < count($this->datatable_struct['tr'][$i]['edit']); $z++) {
                        
                        if ($this->datatable_struct['tr'][$i]['edit'][$z]['mode'] == 'href') {
                            $this->datatable_tr .= "<a  id=\"" . $y . "campo" . $i . "\"   " . $this->datatable_struct['tr'][$i]['edit'][$z]['externo'] . "   class=\"" . $this->datatable_struct['tr'][$i]['edit'][$z]['class'] . "\"  href=\"" . $this->datatable_struct['tr'][$i]['edit'][$z]['href'] . "'" . $this->encrypt($this->datatable_data[$y][$this->datatable_struct['tr'][$i]['edit'][$z]['parametro']]) . "\"    onclick=\" " . $this->datatable_struct['tr'][$i]['edit'][$z]['funcion'] . "\">" . $this->datatable_struct['tr'][$i]['edit'][$z]['icon'] . "</a>&nbsp;";
                        } else if ($this->datatable_struct['tr'][$i]['edit'][$z]['mode'] == 'ajax-directo') {
                            $this->datatable_tr .= "<a  id=\"" . $y . "campo" . $i . "\"   " . $this->datatable_struct['tr'][$i]['edit'][$z]['externo'] . "  class=\"" . $this->datatable_struct['tr'][$i]['edit'][$z]['class'] . "\"   href=\"" . $this->datatable_struct['tr'][$i]['edit'][$z]['href'] . "\" role=\"button\"  data-toggle=\"modal\"  onclick=\"  " . $this->datatable_struct['tr'][$i]['edit'][$z]['funcion'] . "('" . $this->datatable_struct['tr'][$i]['edit'][$z]['ajax_code'] . "','" . $this->encrypt($this->datatable_data[$y][$this->datatable_struct['tr'][$i]['edit'][$z]['ajax_parametro']]) . "','" . $this->datatable_struct['tr'][$i]['edit'][$z]['ajax_view'] . "')\">" . $this->datatable_struct['tr'][$i]['edit'][$z]['icon'] . "</a>&nbsp;";
                        } else if ($this->datatable_struct['tr'][$i]['edit'][$z]['mode'] == 'directo') {
                            $this->datatable_tr .= "<a  id=\"" . $y . "campo" . $i . "\"  " . $this->datatable_struct['tr'][$i]['edit'][$z]['externo'] . "  class=\"" . $this->datatable_struct['tr'][$i]['edit'][$z]['class'] . "\"   href=\"" . $this->datatable_struct['tr'][$i]['edit'][$z]['href'] . "\" role=\"button\"  data-toggle=\"modal\"  onclick=\"  " . $this->datatable_struct['tr'][$i]['edit'][$z]['funcion'] . "(" . $y . ",'" . $this->encrypt($this->datatable_data[$y][$this->datatable_struct['tr'][$i]['edit'][$z]['ajax_parametro']]) . "'," . $this->datatable_struct['tr'][$i]['edit'][$z]['parametro2'] . ")\">" . $this->datatable_struct['tr'][$i]['edit'][$z]['icon'] . "</a>&nbsp;";
                        } else {
                            $this->datatable_tr .= "<a   id=\"" . $y . "campo" . $i . "\"  " . $this->datatable_struct['tr'][$i]['edit'][$z]['externo'] . "  class=\"" . $this->datatable_struct['tr'][$i]['edit'][$z]['class'] . "\"   href=\"" . $this->datatable_struct['tr'][$i]['edit'][$z]['href'] . "\" role=\"button\"  data-toggle=\"modal\"  onclick=\"  " . $this->datatable_struct['tr'][$i]['edit'][$z]['funcion'] . "('" . $this->encrypt($this->datatable_data[$y][$this->datatable_struct['tr'][$i]['edit'][$z]['parametro']]) . "')\">" . $this->datatable_struct['tr'][$i]['edit'][$z]['icon'] . "</a>&nbsp;";
                        }
                    }
                    
                    $this->datatable_tr .= "</div>";
                    
                    
                    
                    $this->datatable_tr .= " <div class='inline pos-rel ' >";
                    $this->datatable_tr .= " <button class='btn btn-minier btn-primary dropdown-toggle hidden-md  hidden-lg' data-toggle='dropdown' data-position='auto'>";
                    $this->datatable_tr .= "  <i class='ace-icon fa fa-cog icon-only bigger-110 hidden-md  hidden-lg' ></i>";
                    $this->datatable_tr .= " </button>";
                    $this->datatable_tr .= "<ul class='dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close'>";
                    
                    
                    for ($z = 0; $z < count($this->datatable_struct['tr'][$i]['edit']); $z++) {
                        
                        if ($this->datatable_struct['tr'][$i]['edit'][$z]['mode'] == 'href') {
                            $this->datatable_tr .= "<li>


            <a   id=\"" . $y . "campo" . $i . "\"  class=\"" . $this->datatable_struct['tr'][$i]['edit'][$z]['class'] . "\"  href=\"" . $this->datatable_struct['tr'][$i]['edit'][$z]['href'] . "'" . $this->encrypt($this->datatable_data[$y][$this->datatable_struct['tr'][$i]['edit'][$z]['parametro']]) . "\"    onclick=\" " . $this->datatable_struct['tr'][$i]['edit'][$z]['funcion'] . "\">" . $this->datatable_struct['tr'][$i]['edit'][$z]['icon'] . "</a>

            </li>";
                        } else if ($this->datatable_struct['tr'][$i]['edit'][$z]['mode'] == 'ajax-directo') {
                            $this->datatable_tr .= "
            <li>
            <a   id=\"" . $y . "campo" . $i . "\"  class=\"" . $this->datatable_struct['tr'][$i]['edit'][$z]['class'] . "\"   href=\"" . $this->datatable_struct['tr'][$i]['edit'][$z]['href'] . "\" role=\"button\"  data-toggle=\"modal\"  onclick=\"  " . $this->datatable_struct['tr'][$i]['edit'][$z]['funcion'] . "('" . $this->datatable_struct['tr'][$i]['edit'][$z]['ajax_code'] . "','" . $this->encrypt($this->datatable_data[$y][$this->datatable_struct['tr'][$i]['edit'][$z]['ajax_parametro']]) . "','" . $this->datatable_struct['tr'][$i]['edit'][$z]['ajax_view'] . "')\">" . $this->datatable_struct['tr'][$i]['edit'][$z]['icon'] . "</a>
            </li>
            ";
                        } else if ($this->datatable_struct['tr'][$i]['edit'][$z]['mode'] == 'directo') {
                            $this->datatable_tr .= "<a  id=\"" . $y . "campo" . $i . "\"  " . $this->datatable_struct['tr'][$i]['edit'][$z]['externo'] . "  class=\"" . $this->datatable_struct['tr'][$i]['edit'][$z]['class'] . "\"   href=\"" . $this->datatable_struct['tr'][$i]['edit'][$z]['href'] . "\" role=\"button\"  data-toggle=\"modal\"  onclick=\"  " . $this->datatable_struct['tr'][$i]['edit'][$z]['funcion'] . "(" . $y . ",'" . $this->encrypt($this->datatable_data[$y][$this->datatable_struct['tr'][$i]['edit'][$z]['ajax_parametro']]) . "'," . $this->datatable_struct['tr'][$i]['edit'][$z]['parametro2'] . ")\">" . $this->datatable_struct['tr'][$i]['edit'][$z]['icon'] . "</a>&nbsp;";
                        } else {
                            $this->datatable_tr .= "<li>
            <a    id=\"" . $y . "campo" . $i . "\"  class='" . $this->datatable_struct['tr'][$i]['edit'][$z]['class'] . "'   href='" . $this->datatable_struct['tr'][$i]['edit'][$z]['href'] . "' role='button'  data-toggle='modal'  onclick='" . $this->datatable_struct['tr'][$i]['edit'][$z]['funcion'] . "(\"" . $this->encrypt($this->datatable_data[$y][$this->datatable_struct['tr'][$i]['edit'][$z]['parametro']]) . "\")'>" . $this->datatable_struct['tr'][$i]['edit'][$z]['icon'] . "</a>
            </li>";
                        }
                    }
                    
                    $this->datatable_tr .= "</ul>";
                    $this->datatable_tr .= "</div>";
                    $this->datatale_tr .= "</td>";
                    
                } else {
                    if ($this->datatable_struct['tr'][$i]['visible'] == 'true') {
                        
                        $css_tablet = $css_mobil = $css_desktop = "";
                        
                        
                        if ($this->datatable_struct['tr'][$i]['hidden_desktop'] == 'true') {
                            $css_desktop = " hidden-md ";
                        }
                        
                        if ($this->datatable_struct['tr'][$i]['hidden_tablet'] == 'true') {
                            $css_tablet = " hidden-sm ";
                        }
                        
                        if ($this->datatable_struct['tr'][$i]['hidden_mobil'] == 'true') {
                            $css_mobil = " hidden-xs ";
                        }
                        
                        
                        if ($this->datatable_struct['tr'][$i]['type'] == 'input') {
                            
                            
                            if ($this->datatable_struct['tr'][$i]['function_name'] == "") {
                                $function_name = "ver";
                            } else {
                                $function_name = $this->datatable_struct['tr'][$i]['function_name'];
                            }
                            
                            
                            
                            $this->datatable_tr .= "<td  class=\"" . $css_mobil . " " . $css_desktop . " " . $css_tablet . " " . $this->datatable_struct['tr'][$i]['class'] . "\"  style=\"  " . $this->datatable_struct['tr'][$i]['style'] . " ; \"  >

            <input onchange=\" " . $function_name . "(" . $y . ")\" value=\"" . $this->datatable_data[$y][$this->datatable_struct['tr'][$i]['value']] . "\" " . $this->datatable_struct['tr'][$i]['type_externo'] . "  id=\"" . $y . "campo" . $i . "\"  type=\"text\" name=\"" . $y . "campo" . $i . "\" ></td>";
                            
                        } else {
                            
                            
                            
                            
                            if ($this->datatable_struct['tr'][$i]['type'] == 'hidden') {
                                $hidden = "<input value=\"" . $this->datatable_data[$y][$this->datatable_struct['tr'][$i]['value']] . "\"  type=\"hidden\" id=\"" . $y . "campo" . $i . "\" name=\"campo" . $i . "\" >";
                            } else {
                                $hidden = "";
                            }
                            
                            
                            
                            /* SI CONSIGUE  MAS DE  UN VALOR CONCATENADOS POR # EN EL JSON AQUI LOS TRABAJA */
                            
                            $valores = explode("#", $this->datatable_struct['tr'][$i]['value']);
                            
                            if (count($valores) > 1) {
                                
                                $fin = "";
                                $fin = $this->datatable_struct['tr'][$i]['fin'];
                                
                                $valortd = "";
                                
                                
                                $valortd1 = $valortd2 = $valortd3 = "";
                                
                                if (strlen($this->datatable_data[$y][$valores[0]]) > 0) {
                                    $valortd1 = $this->datatable_data[$y][$valores[0]] . $fin;
                                }
                                
                                if (strlen($this->datatable_data[$y][$valores[1]]) > 0) {
                                    $valortd2 = $this->datatable_data[$y][$valores[1]] . $fin;
                                }
                                
                                if (strlen($this->datatable_data[$y][$valores[2]]) > 0) {
                                    $valortd3 = $this->datatable_data[$y][$valores[2]] . $fin;
                                }
                                
                                $valortd = $valortd1 . $valortd2 . $valortd3;
                                
                                $this->datatable_tr .= "<td  class=\"" . $css_mobil . " " . $css_desktop . " " . $css_tablet . " " . $this->datatable_struct['tr'][$i]['class'] . "\"  style=\"  " . $this->datatable_struct['tr'][$i]['style'] . " ; \"  >" . $valortd . " " . $hidden . "</td>";
                                
                                
                            }
                            
                            
                            
                            
                            else {
                                
                                $valortd = $this->datatable_data[$y][$this->datatable_struct['tr'][$i]['value']];
                                
                                
                                if ($this->datatable_struct['tr'][$i]['date'] == true) {
                                    
                                    $valortd = $this->fecha_alreves_v2($valortd, '/');
                                    
                                    if (strlen($valortd) < 8) {
                                        
                                        $valortd = "";
                                        
                                    }
                                    
                                    
                                    
                                }
                                
                                
                                
                                $this->datatable_tr .= "<td  class=\"" . $css_mobil . " " . $css_desktop . " " . $css_tablet . " " . $this->datatable_struct['tr'][$i]['class'] . "\"  style=\"  " . $this->datatable_struct['tr'][$i]['style'] . " ; \"  >" . $valortd . " " . $hidden . "</td>";
                                
                                
                            }
                            
                            
                            
                            
                            
                        }
                    }
                }
            }
            $this->datatable_tr .= "</div>";
            $this->datatable_tr .= "</tr>";
        }
        
        return $this->datatable_tr .= "</tbody>";
    }
    
    
    /*
    public function DATATABLE_head_v2()
    {
    
    $this->datatable_th.="<thead><tr>";
    
    
    for ($i = 0; $i < count($this->datatable_struct['th']); $i++)
    {
    
    if ($this->datatable_struct['tr'][$i]['visible'] == 'true')
    {
    $this->datatable_th.= "<th  style=\"". $this->datatable_struct['th'][$i]['style'] . "\"  class= \" ".$css_mobil." ".$css_desktop." ".$css_tablet."  ". $this->datatable_struct['tr'][$i]['class'] . "\" >" . $this->datatable_struct['th'][$i]['value'] . "</th>";
    }
    }
    
    $this->datatable_th.="</tr></thead>";
    
    return $this->datatable_th;
    }
    
    public function DATATABLE_body_v2()
    {
    $this->datatable_tr.="<tbody>";
    
    
    for ($y = 0; $y < count($this->datatable_data); $y++)
    {
    
    
    $this->datatable_tr.="<tr style=\"\"   >";
    
    
    
    for ($i = 0; $i < count($this->datatable_struct['tr']); $i++)
    {
    
    
    if ($this->datatable_struct['tr'][$i]['edit'])
    {
    
    $this->datatable_tr.= "<td  class=\" ".$this->datatable_struct['tr'][$i]['class'] ."\"   style=\"  ". $this->datatable_struct['tr'][$i]['style'] ." ; width:" . $this->datatable_struct['tr'][$i]['width'] . " \"> ";
    
    
    for ($z = 0; $z < count($this->datatable_struct['tr'][$i]['edit']); $z++)
    {
    
    if ($this->datatable_struct['tr'][$i]['edit'][$z]['mode']=='href')
    {
    $this->datatable_tr.= "<a class=\"" . $this->datatable_struct['tr'][$i]['edit'][$z]['class'] . "\"  href=\"" . $this->datatable_struct['tr'][$i]['edit'][$z]['href']."'".$this->encrypt($this->datatable_data[$y][$this->datatable_struct['tr'][$i]['edit'][$z]['parametro']])."\"    onclick=\" ".$this->datatable_struct['tr'][$i]['edit'][$z]['funcion']."\">" . $this->datatable_struct['tr'][$i]['edit'][$z]['icon'] . "</a>&nbsp;";
    }else
    if ($this->datatable_struct['tr'][$i]['edit'][$z]['mode']=='ajax-directo')
    {
    $this->datatable_tr.= "<a class=\"" . $this->datatable_struct['tr'][$i]['edit'][$z]['class'] . "\"   href=\"" . $this->datatable_struct['tr'][$i]['edit'][$z]['href'] . "\" role=\"button\"  data-toggle=\"modal\"  onclick=\"  " . $this->datatable_struct['tr'][$i]['edit'][$z]['funcion'] . "('".$this->datatable_struct['tr'][$i]['edit'][$z]['ajax_code']."','".$this->encrypt($this->datatable_data[$y][$this->datatable_struct['tr'][$i]['edit'][$z]['ajax_parametro']])."','".$this->datatable_struct['tr'][$i]['edit'][$z]['ajax_view']."')\">" . $this->datatable_struct['tr'][$i]['edit'][$z]['icon'] . "</a>&nbsp;";
    } else
    {
    $this->datatable_tr.= "<a class=\"" . $this->datatable_struct['tr'][$i]['edit'][$z]['class'] . "\"   href=\"" . $this->datatable_struct['tr'][$i]['edit'][$z]['href'] . "\" role=\"button\"  data-toggle=\"modal\"  onclick=\"  " . $this->datatable_struct['tr'][$i]['edit'][$z]['funcion'] . "('" . $this->encrypt($this->datatable_data[$y][$this->datatable_struct['tr'][$i]['edit'][$z]['parametro']]) . "')\">" . $this->datatable_struct['tr'][$i]['edit'][$z]['icon'] . "</a>&nbsp;";
    }
    }
    
    
    
    $this->datatable_tr.= "</td>";
    
    }
    else
    {
    if ($this->datatable_struct['tr'][$i]['visible'] == 'true')
    {
    
    $this->datatable_tr.= "<td  class=\"".$this->datatable_struct['tr'][$i]['class'] . "\"  style=\"  ". $this->datatable_struct['tr'][$i]['style'] ." ; \"  >" . $this->datatable_data[$y][$this->datatable_struct['tr'][$i]['value']] . "</td>";
    }
    }
    
    
    
    }
    
    
    $this->datatable_tr.="</div>";
    
    
    
    
    $this->datatable_tr.="</tr>";
    }
    
    return $this->datatable_tr.="</tbody>";
    }
    */
    
    
    public function DATATABLE_content($version = "")
    {
        
        return "<div style=\"" . $this->datatable_struct['div_style'] . "\" ><table  style=\"" . $this->datatable_struct['style'] . "\"  id=\"" . $this->datatable_struct['id'] . "\"  class=\"table table-striped table-bordered table-hover datatable " . $this->datatable_struct['class'] . "\">" . $this->DATATABLE_head() . $this->DATATABLE_body() . "</table></div>";
        
    }
    
    
    public function DATATABLE__($json)
    {
        
        //$data_json = $this->llamada_json($tabla, $name,'datatable');
        $this->datatable_struct = $json;
        
        if ($this->DATATABLE_CONDICIONAL == "") {
            
            
            $this->datatable_data = $this->select_all($this->datatable_struct['select_conditional']);
            
            
        } else if ($this->DATATABLE_CONDICIONAL_SQL) {
            
            $this->datatable_data = $this->select_all_sql($this->DATATABLE_CONDICIONAL);
            
        } else {
            
            
            $this->datatable_data = $this->select_all($this->DATATABLE_CONDICIONAL);
            
            
        }
        
        
        
        return $this->DATATABLE_content($this->datatable_struct['version']);
        
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    public $cardsimple_struct = "";
    public $cardsimple_data = "";
    
    
    public function CARDSIMPLE_body()
    {
        
        for ($y = 0; $y < count($this->cardsimple_data); $y++) {
            
            
            if ($this->cardsimple_data[$y]['ico'] == "") {
                $this->cardsimple_data[$y]['ico'] = $this->cardsimple_struct['class_icon'];
            }
            
            
            $res .= "

 <a
 href=\"" . $this->cardsimple_data[$y]['href'] . "\"
 role=\"" . $this->cardsimple_data[$y]['role'] . "\"
 data-toggle=\"" . $this->cardsimple_data[$y]['data-toggle'] . "\"
 onclick=\"" . $this->cardsimple_data[$y]['onclick'] . "( '" . $this->cardsimple_data[$y][$this->cardsimple_data[$y]['onclick_parametro']] . "' )\"
 style=\"" . $this->cardsimple_struct['style'] . "\"
 class=\"" . $this->cardsimple_struct['class'] . " " . $this->cardsimple_data[$y]['class_color'] . "\" >

 <!--  <i class=\"" . $this->cardsimple_data[$y]['ico'] . "\"></i>-->

 " . $this->cardsimple_data[$y]['ico'] . "

 <br>


 " . $this->cardsimple_data[$y][$this->cardsimple_struct['campo_label']] . "
 <span class=\"badge badge-yellow\">
 " . $this->cardsimple_data[$y]['campo_label_superior'] . "</span>

 </a>

 ";
            
        }
        
        return $res;
    }
    
    
    
    public function CARDSIMPLE_body01()
    {
        
        for ($y = 0; $y < count($this->cardsimple_data); $y++) {
            
            
            if ($this->cardsimple_data[$y]['ico'] == "") {
                $this->cardsimple_data[$y]['ico'] = $this->cardsimple_struct['class_icon'];
            }
            
            
            $res .= "


 <a
 href=\"" . $this->cardsimple_data[$y]['href'] . "\"
 role=\"" . $this->cardsimple_data[$y]['role'] . "\"
 data-toggle=\"" . $this->cardsimple_data[$y]['data-toggle'] . "\"
 onclick=\"" . $this->cardsimple_data[$y]['onclick'] . "( '" . $this->cardsimple_data[$y][$this->cardsimple_data[$y]['onclick_parametro']] . "' )\"
 style=\"" . $this->cardsimple_struct['style'] . "\"
 class=\"" . $this->cardsimple_struct['class'] . " \" >
 <div style='width:100%;     background-repeat: no-repeat;
 height:70px;background-size: 140px 80px; background-image:url( " . $this->cardsimple_data[$y]['ava'] . ")'>

 </div>
 <div style='width:100%; background:#000'>" . $this->cardsimple_data[$y][$this->cardsimple_struct['campo_label']] . "</div>

 <span class=\"badge badge-yellow\">
 " . $this->cardsimple_data[$y]['campo_label_superior'] . "</span>

 </a>

 ";
            
        }
        
        return $res;
    }
    
    
    
    public function CARDSIMPLE_content($x = 1)
    {
        
        if ($x == 1) {
            return $this->CARDSIMPLE_body();
        }
        if ($x == 2) {
            return $this->CARDSIMPLE_body01();
            
        }
        
    }
    
    /************** MENU ****************/
    
    
    public $menu_ico = " fa fa-check";
    public $menu_den = "";
    public $menu_col = "";
    public $menu_class = "";
    public $menu_parametro_onclick = "";
    public $menu_onclick = "";
    public $menu_parametro_url = "";
    public $menu_parametro_view = "view";
    public $menu_href = "#";
    public $menu_parametro_href = "";
    
    public function menu_reset()
    {
        
        $this->menu_ico               = "fa fa-check";
        $this->menu_den               = "";
        $this->menu_col               = "";
        $this->menu_class             = "";
        $this->menu_parametro_onclick = "";
        $this->menu_onclick           = "";
        $this->menu_parametro_url     = "";
        $this->menu_parametro_view    = "view";
        $this->menu_href              = "#";
        $this->menu_parametro_href    = "";
        
    }
    
    public function MENU_()
    {
        
        
        $res .= "<li class=\"hover\">
  <a  class=\"" . $this->menu_class . " " . $this->menu_col . "\"
  style=\"\"
  href=\"" . $this->menu_href . $this->menu_parametro_href . "\"
  onclick=\"" . $this->menu_onclick . "('" . $this->menu_parametro_onclick . "','" . $this->menu_parametro_view . "','" . $this->menu_parametro_url . "')\">
  <i class=\"menu-icon " . $this->menu_ico . "\"></i>
  <span class=\"menu-text\">" . $this->menu_den . "</span>
  </a>

  <b class=\"arrow\"></b>
  </li>";
        
        return $res;
        
    }
    
    
    
    public function MENU_2($body)
    {
        
        
        $res .= "<li class=\"hover\">" . $body . "</li>";
        
        return $res;
        
    }
    
    
    public function MENU_3($body)
    {
        
        $res .= "
  <a style=\"" . $this->menu_style . "\" class=\"" . $this->menu_class . " " . $this->menu_col . "\"
  style=\"\"
  href=\"" . $this->menu_href . $this->menu_parametro_href . "\"
  onclick=\"" . $this->menu_onclick . "('" . $this->menu_parametro_onclick . "','" . $this->menu_parametro_view . "','" . $this->menu_parametro_url . "')\">
  <i class=\" " . $this->menu_ico . "\"></i><br>
  <span class=\"menu-text\">" . $this->menu_den . "</span>
  </a>

  <b class=\"arrow\"></b>
  ";
        
        return $res;
        
    }
    
    
    public function MENU_4($body)
    {
        
        
        if ($this->menu_ico == "") {
            $ico = "";
        } else {
            $ico = $this->menu_ico . " <br> ";
        }
        
        
        
        $res .= "
 <a style=\"" . $this->menu_style . "\" class=\"" . $this->menu_class . " " . $this->menu_col . "\"
 style=\"\"
 href=\"" . $this->menu_href . $this->menu_parametro_href . "\"
 onclick=\"" . $this->menu_onclick . "('" . $this->menu_parametro_onclick . "','" . $this->menu_parametro_view . "','" . $this->menu_parametro_url . "')\">
 " . $ico . "
 <span class=\"menu-text\">" . $this->menu_den . "</span>
 </a>

 <b class=\"arrow\"></b>
 ";
        
        return $res;
        
    }
    
    
    
    
    
    
    public function FORMAT_is_date_complete($fecha)
    {
        
        return $fecha;
    }
    
    public $save_campo = "";
    public $save_value = "";
    public $save_campo_where = "";
    public $save_value_where = "";
    public $save_tabla = "";
    public $save_config = "";
    
    public function SAVE__()
    {
        
        
        $col = $this->save_config['config']['col'];
        
        //print_r($col);
        
        for ($i = 0; $i < count($this->save_campo); $i++) {
            
            
            
            /* ANALISIS DE LOS DATOS VISITA EL JSON PRINCIPAL Y REVISA SI SON TEXT - INT - VARCHAR()*/
            
            foreach ($col as $col_key) {
                
                if ($col_key['campo'] == $this->save_campo[$i]) {
                    
                    if ($col_key['type'] == "text") {
                        $this->save_value[$i] = htmlentities($this->save_value[$i]);
                    }
                }
                
            }
            
            
            $limitador = "  ";
            
            if ((count($this->save_campo) - 1) > $i) {
                
                $limitador = ",";
            }
            
            if (substr($this->save_campo[$i], 3, 3) == 'reg') {
                $this->save_value[$i] = $this->datetime_now();
            }
            
            if (substr($this->save_campo[$i], 3, 3) == 'usu') {
                $this->save_value[$i] = $_SESSION['user']['usuid'];
            }
            
            
            $campo_sql .= $this->save_campo[$i] . $limitador;
            
            $value_sql .= "'" . $this->save_value[$i] . "'" . $limitador;
            
            
            
            $campo_sql_update .= $this->save_campo[$i] . " = ";
            
            $campo_sql_update .= "'" . $this->save_value[$i] . "'" . $limitador;
        }
        
        
        
        for ($z = 0; $z < count($this->save_campo_where); $z++) {
            
            $where_sql_update .= " " . $this->save_campo_where[$z] . " in (";
            $where_sql_update .= "'" . $this->save_value_where[$z] . "') and";
        }
        
        
        $campo_sql        = substr($campo_sql, 0, -1);
        $value_sql        = substr($value_sql, 0, -1);
        $campo_sql_update = substr($campo_sql_update, 0, -1);
        $where_sql_update = substr($where_sql_update, 0, -3);
        
        
        if (strlen($where_sql_update) > 10) {
            
            
            $sql  = "UPDATE " . $this->save_tabla . " SET " . $campo_sql_update . " WHERE " . $where_sql_update . ";";
            $data = $this->_update_sql($sql);
        } else {
            
            if (substr($campo_sql, -1, 1) == ',') {
                $campo_sql = substr($campo_sql, 0, -1);
                $value_sql = substr($value_sql, 0, -1);
            }
            
            
            $sql = "INSERT INTO " . $this->save_tabla . " (" . $campo_sql . ") VALUES (" . $value_sql . ")";
            
            
            $data = $this->_update_sql($sql);
            
            $this->ultimoId = $this->id;
            
            return $this->ultimoId;
        }
    }
    
    public $select_vista = "";
    public $select_select_all = "";
    
    public function SELECT__($condicion, $type = '0')
    {
        
        
        if ($condicion == '0') {
            
            $sql  = "SELECT * FROM " . $this->select_vista . " ;";
            $data = $this->ejecutar_query($sql);
            $data = $this->DATAPRINT__($data);
        } else if ($condicion == '1') {
            
            $sql  = "SELECT * FROM " . $this->select_vista . " WHERE  " . $this->select_select_all['campo'] . "  in (" . $this->select_select_all['id'] . ");";
            $data = $this->ejecutar_query($sql);
            $data = $this->DATAPRINT__($data);
            $data = $data[0];
        } else if ($type == 'sql') {
            
            $sql  = $condicion;
            $data = $this->ejecutar_query($sql);
            $data = $this->DATAPRINT__($data);
        } else {
            
            $sql  = "SELECT * FROM " . $this->select_vista . " WHERE  " . $condicion . ";";
            $data = $this->ejecutar_query($sql);
            $data = $this->DATAPRINT__($data);
        }
        
        
        
        return $data;
    }
    
    
    
    
    
    public function DATAPRINT__ALL($data)
    {
        
        
        for ($p = 0; $p < count($data); $p++) {
            
            $y = array_keys($data[$p]);
            
            foreach ($y as $res) {
                
                $data[$p]['odd_ico'] = $this->DATAPRINT__oddsrvid_ode($data[$p]['oddid']);
                
                $data[$p]["odd_srpden"] = $this->DATAPRINT__oddsrvid($data[$p]['oddid']);
                
                $data[$p]['ord_pvp'] = $this->DATAPRINT__ordpvp_total($data[$p]['ordid']);
                
                $data[$p]['ordid_tot'] = $this->DATAPRINT__ordtot_parcial($data[$p]['ordid']);
                
                $data[$p]['ordcli_clifnm'] = $this->DATAPRINT__ordcli_clifnm($data[$p]['ordid']);
                
                $data[$p]['ordcli_clitel'] = $this->DATAPRINT__ordcli_clitel($data[$p]['ordid']);
                
            }
            
        }
        
        
        return $data;
        
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    public $dataprint_data_json = "";
    
    
    public function DATAPRINT__($data)
    {
        
        
        
        
        $data_json = $this->dataprint_data_json;
        
        
        
        
        
        
        for ($i = 0; $i < count($data); $i++) {
            
            
            for ($y = 0; $y < count($data_json['type_textarea']); $y++) {
                $data[$i][$data_json['type_textarea'][$y]['campo']] = html_entity_decode($data[$i][$data_json['type_textarea'][$y]['campo']]);
            }
            
            
            for ($y = 0; $y < count($data_json['type_pk']); $y++) {
                $data[$i][$data_json['type_pk'][$y]['campo'] . "_code"] = $this->DATAPRINT__is_encrypt($data[$i][$data_json['type_pk'][$y]['campo']]);
            }
            
            
            
            for ($y = 0; $y < count($data_json['type_date']); $y++) {
                
                
                
                $data[$i][$data_json['type_date'][$y]['campo']] = $this->DATAPRINT__is_date_print($data[$i][$data_json['type_date'][$y]['campo']]);
            }
            
            
            
            for ($y = 0; $y < count($data_json['type_moneda']); $y++) {
                $data[$i][$data_json['type_moneda'][$y]['campo'] . "_format"]      = $this->DATAPRINT__is_formato_moneda_($data[$i][$data_json['type_moneda'][$y]['campo']]);
                $data[$i][$data_json['type_moneda'][$y]['campo'] . "_format_type"] = $data_json['type_moneda'][$y]['type'] . " " . $data[$i][$data_json['type_moneda'][$y]['campo'] . "_format"];
            }
            
            
            
            
            for ($y = 0; $y < count($data_json['type_combo_fijo']); $y++) {
                
                
                
                $data[$i][$data_json['type_combo_fijo'][$y]['campo'] . "_combo_fijo"] = $this->DATAPRINT__is_combo_fijo($data[$i][$data_json['type_combo_fijo'][$y]['campo']], $data_json['type_combo_fijo'][$y]['option'], $data_json['type_combo_fijo'][$y]['campo']);
                
                
                $data[$i][$data_json['type_combo_fijo'][$y]['campo'] . "_fk_value_fijo"] = $this->DATAPRINT__fk_value_fijo($data[$i][$data_json['type_combo_fijo'][$y]['campo']], $data_json['type_combo_fijo'][$y]['option'], $data_json['type_combo_fijo'][$y]['campo']);
                
                
                
            }
            
            
            
            for ($y = 0; $y < count($data_json['type_combo']); $y++) {
                $data[$i][$data_json['type_combo'][$y]['fk_id'] . "_combo"] = $this->DATAPRINT__is_combo_($data[$i][$data_json['type_combo'][$y]['fk_id']], $data_json['type_combo'][$y]['fk_id'], $data_json['type_combo'][$y]['fk_table'], $data_json['type_combo'][$y]['fk_table_id'], $data_json['type_combo'][$y]['fk_table_campo'], $data_json['type_combo'][$y]['fk_table_where'], $data_json['type_combo'][$y]);
                $data[$i][$data_json['type_combo'][$y]['fk_id'] . "_fk"]    = $this->DATAPRINT__fk_value($data[$i][$data_json['type_combo'][$y]['fk_id']], $data_json['type_combo'][$y]['fk_id'], $data_json['type_combo'][$y]['fk_table'], $data_json['type_combo'][$y]['fk_table_id'], $data_json['type_combo'][$y]['fk_table_campo'], $data_json['type_combo'][$y]['fk_table_where']);
            }
            
            
            
            for ($y = 0; $y < count($data_json['type_combo_multiple']); $y++) {
                
                $data[$i][$data_json['type_combo_multiple'][$y]['fk_id'] . "_combo_multiple"] = $this->DATAPRINT__is_combo_multiple($data[$i][$data_json['type_combo_multiple'][$y]['fk_id']], $data_json['type_combo_multiple'][$y]['fk_id'], $data_json['type_combo_multiple'][$y]['fk_table'], $data_json['type_combo_multiple'][$y]['fk_table_id'], $data_json['type_combo_multiple'][$y]['fk_table_campo'], $data_json['type_combo_multiple'][$y]['fk_table_where'], $data_json['type_combo_multiple'][$y]);
                
                
                
                
                $data[$i][$data_json['type_combo_multiple'][$y]['fk_id'] . "_fk"] = $this->DATAPRINT__fk_value($data[$i][$data_json['type_combo_multiple'][$y]['fk_id']], $data_json['type_combo_multiple'][$y]['fk_id'], $data_json['type_combo_multiple'][$y]['fk_table'], $data_json['type_combo_multiple'][$y]['fk_table_id'], $data_json['type_combo_multiple'][$y]['fk_table_campo'], $data_json['type_combo_multiple'][$y]['fk_table_where']);
                
            }
            
            
            
            for ($y = 0; $y < count($data_json['type_img']); $y++) {
                
                $data[$i][$data_json['type_img'][$y]['campo'] . "_format_img"] = $this->DATAPRINT__is_img($data[$i][$data_json['type_img'][$y]['campo']], $data_json['type_img'][$y]);
                
                $data[$i][$data_json['type_img'][$y]['campo'] . "_format_img_url"] = $this->DATAPRINT__is_img_url($data[$i][$data_json['type_img'][$y]['campo']], $data_json['type_img'][$y]);
            }
            
            
            for ($y = 0; $y < count($data_json['type_costototal']); $y++) {
                
                $data[$i][$data_json['type_costototal'][$y]['campo'] . "_costototal"] = $this->DATAPRINT__is_costototal($data[$i][$data_json['type_costototal'][$y]['campo']], $data_json['type_costototal'][$y]);
                
                
                #     $data[$i][$data_json['type_costototal'][$y]['campo'] . "_costototal_format"] = $this->DATAPRINT__is_formato_moneda_($data[$i][$data_json['type_costototal'][$y]['campo'] . "_costototal"]);
                #    $data[$i][$data_json['type_costototal'][$y]['campo'] . "_costototal_format_type"] = $data[$i][$data_json['type_costototal'][$y]['campo'] . "_format"] . " " . $data_json['type_costototal'][$y]['type'];
            }
            
            
            
            for ($y = 0; $y < count($data_json['type_srptip']); $y++) {
                
                $data[$i][$data_json['type_srptip'][$y]['campo'] . "_ico"] = $this->DATAPRINT__srptip($data[$i][$data_json['type_srptip'][$y]['campo']]);
            }
            
            
            for ($y = 0; $y < count($data_json['type_oddsrvid']); $y++) {
                
                $data[$i][$data_json['type_oddsrvid'][$y]['campo'] . "_srpden"] = $this->DATAPRINT__oddsrvid($data[$i][$data_json['type_oddsrvid'][$y]['campo']]);
            }
            
            
            for ($y = 0; $y < count($data_json['type_oddsrvid']); $y++) {
                
                $data[$i][$data_json['type_oddsrvid'][$y]['campo'] . "_odetip"] = $this->DATAPRINT__oddsrvid_ode($data[$i][$data_json['type_oddsrvid'][$y]['campo']]);
            }
            
            
            for ($y = 0; $y < count($data_json['type_ordpvp']); $y++) {
                
                
                $data[$i][$data_json['type_ordpvp'][$y]['campo'] . "_ordpvp"] = $this->DATAPRINT__ordpvp_total($data[$i][$data_json['type_ordpvp'][$y]['campo']]);
                
                
                $data[$i][$data_json['type_ordpvp'][$y]['campo'] . "_ordpvp_iva"] = $this->DATAPRINT__ordpvp_iva($data[$i][$data_json['type_ordpvp'][$y]['campo']]);
                
                $data[$i][$data_json['type_ordpvp'][$y]['campo'] . "_ordpvp_sinformato"] = $this->DATAPRINT__ordpvp_total_sinformato($data[$i][$data_json['type_ordpvp'][$y]['campo']]);
                
                
                $data[$i][$data_json['type_ordpvp'][$y]['campo'] . "_ordpvp_iva_sinformato"] = $this->DATAPRINT__ordpvp_iva_sinformato($data[$i][$data_json['type_ordpvp'][$y]['campo']]);
                
            }
            
            
            
            for ($y = 0; $y < count($data_json['type_cajpag']); $y++) {
                
                $data[$i][$data_json['type_cajpag'][$y]['campo'] . "_cajpag"] = $this->DATAPRINT__cajpag_total($data[$i][$data_json['type_cajpag'][$y]['campo']]);
                
                $data[$i][$data_json['type_cajpag'][$y]['campo'] . "_cajpag_format"] = $this->DATAPRINT__cajpag_total_format($data[$i][$data_json['type_cajpag'][$y]['campo']]);
                
            }
            
            
            for ($y = 0; $y < count($data_json['type_oddid']); $y++) {
                $data[$i][$data_json['type_oddid'][$y]['campo'] . "_oddblo_ico"] = $this->DATAPRINT__oddblo_ico($data[$i][$data_json['type_oddid'][$y]['campo']]);
                
            }
            
            
            for ($y = 0; $y < count($data_json['type_ordedo']); $y++) {
                $data[$i][$data_json['type_ordedo'][$y]['campo'] . "_ordedo_ico"] = $this->DATAPRINT__ordedo_ico($data[$i][$data_json['type_ordedo'][$y]['campo']]);
                
            }
            
            
            
            
            
            
        }
        
        
        //$data = $this->formatos_especiales($data);
        
        
        return $data;
    }
    
    
    
    public function DATAPRINT__ordtot_parcial($ordid)
    {
        
        
        $sql1               = "select * from orderDetail where oddordid in (" . $ordid . ") and oddblo in ('2') and oddest in ('t')";
        $RESULT_ORDERDETAIL = $this->ejecutar_query($sql1);
        $total              = 0;
        
        for ($i = 0; $i < count($RESULT_ORDERDETAIL); $i++) {
            $total = $RESULT_ORDERDETAIL[$i]['oddpvp'] + $total;
            
        }
        
        return $total;
    }
    
    
    
    
    public function DATAPRINT__oddsrvid_ode($oddid)
    {
        
        $sql1           = "select cfgext from config , orderDetailEstatu  where odetipid = cfgid and odeoddid in (" . $oddid . ") and odeest in ('t')";
        $RESULT_SERVICE = $this->ejecutar_query($sql1);
        
        if (strlen($RESULT_SERVICE[0]['cfgext']) > 0) {
            
            return $RESULT_SERVICE[0]['cfgext'];
            
        } else {
            
            return '0';
            
        }
    }
    
    public function DATAPRINT__oddblo_ico($oddid)
    {
        $sql1           = "select cfgext from config , orderDetail  where oddblo = cfgid and oddid in (" . $oddid . ") and oddest in ('t')";
        $RESULT_SERVICE = $this->ejecutar_query($sql1);
        
        if (strlen($RESULT_SERVICE[0]['cfgext']) > 0) {
            
            return $RESULT_SERVICE[0]['cfgext'];
            
        } else {
            
            return '0';
            
        }
    }
    
    
    public function DATAPRINT__ordedo_ico($ordedo)
    {
        
        $sql1          = "select cfgext from config  where cfgid in (" . $ordedo . ") and cfgest in ('t')";
        $RESULT_ORDERS = $this->ejecutar_query($sql1);
        
        if (strlen($RESULT_ORDERS[0]['cfgext']) > 0) {
            
            return $RESULT_ORDERS[0]['cfgext'];
            
        } else {
            
            return '0';
            
        }
    }
    
    
    
    public function DATAPRINT__ordcli_clifnm($ordid)
    {
        $sql1          = "select * from orders o , cliente c  where c.cliid = o.ordcliid and o.ordid in (" . $ordid . ") and o.ordest in ('t')";
        $RESULT_ORDERS = $this->ejecutar_query($sql1);
        return $RESULT_ORDERS[0]['clifnm'] . " " . $RESULT_ORDERS[0]['clilnm'];
    }
    
    public function DATAPRINT__ordcli_clitel($ordid)
    {
        $sql1          = "select * from orders o , cliente c  where c.cliid = o.ordcliid and o.ordid in (" . $ordid . ") and o.ordest in ('t')";
        $RESULT_ORDERS = $this->ejecutar_query($sql1);
        return $RESULT_ORDERS[0]['clitel'];
    }
    
    
    public function DATAPRINT__oddsrvid($oddid)
    {
        
        $sql1           = "select srvden from service , orderDetail where oddsrvid = srvid and  oddid in (" . $oddid . ")";
        $RESULT_SERVICE = $this->ejecutar_query($sql1);
        
        
        
        $sql    = "select * from servicePreferences where srpoddid in (" . $oddid . ") and srpest in ('t') order by srpid desc ";
        $result = $this->ejecutar_query($sql);
        
        $res .= "<span style='font-weight:bold; color:gray; font-size:18px'>" . $RESULT_SERVICE[0]['srvden'] . "</span>";
        
        foreach ($result as $data) {
            
            if ($data['srptip'] == "Con") {
                
                $res .= "<span style='color:green; float:none; font-size:12px'> " . $data['srpden'] . " </span>";
                
                
            } else if ($data['srptip'] == "Sin") {
                
                
                $res .= "<span style='color:red; float:none; font-size:12px'> " . $data['srpden'] . " </span>";
                
            }
            
        }
        
        return $res;
        
    }
    
    
    
    public function DATAPRINT__srptip($x)
    {
        
        if ($x == "Con") {
            return "<i class='fa fa-plus green'></i>";
        }
        
        if ($x == "Sin") {
            return "<i class='fa fa-minus  red '></i>";
        }
        
    }
    
    
    
    /* RETORNA EL MONTO DE LO QUE SE HA PAGADO  */
    public function DATAPRINT__cajpag_total_format($x)
    {
        
        $sql1        = "select * from pago where pagcajid in ('" . $x . "') and pagest in ('t') ";
        $RESULT_PAGO = $this->ejecutar_query($sql1);
        $total       = 0;
        
        foreach ($RESULT_PAGO as $data) {
            $total = $data['pagmon'] + $total;
        }
        return " " . number_format($total, 2, ",", ".");
    }
    
    public function DATAPRINT__cajpag_total($x)
    {
        
        $sql1        = "select * from pago where pagcajid in ('" . $x . "') and pagest in ('t') ";
        $RESULT_PAGO = $this->ejecutar_query($sql1);
        $total       = 0;
        
        foreach ($RESULT_PAGO as $data) {
            $total = $data['pagmon'] + $total;
        }
        
        return $total;
    }
    
    
    
    public function DATAPRINT__ordpvp_total($x)
    {
        
        $sql1               = "select * from orderDetail where oddordid in ('" . $x . "') and oddest in ('t') ";
        $RESULT_ORDERDETAIL = $this->ejecutar_query($sql1);
        $total              = 0;
        
        foreach ($RESULT_ORDERDETAIL as $data) {
            $total = $data['oddpvp'] + $total;
        }
        
        return " " . number_format($total, 2, ",", ".");
    }
    
    
    public function DATAPRINT__ordpvp_total_sinformato($x)
    {
        
        $sql1               = "select * from orderDetail where oddordid in ('" . $x . "') and oddest in ('t') ";
        $RESULT_ORDERDETAIL = $this->ejecutar_query($sql1);
        $total              = 0;
        
        foreach ($RESULT_ORDERDETAIL as $data) {
            $total = $data['oddpvp'] + $total;
        }
        
        return $total;
    }
    
    
    
    
    
    
    public function DATAPRINT__ordpvp_iva($x)
    {
        
        $sql1               = "select * from orderDetail where oddordid in ('" . $x . "') and oddest in ('t') ";
        $RESULT_ORDERDETAIL = $this->ejecutar_query($sql1);
        $total              = 0;
        
        foreach ($RESULT_ORDERDETAIL as $data) {
            $total = $data['oddpvp'] + $total;
        }
        
        return " <sub>TAX USD $ </sub>" . number_format(($total * 0.12), 2, ",", ".");
    }
    
    
    public function DATAPRINT__ordpvp_iva_sinformato($x)
    {
        
        $sql1               = "select * from orderDetail where oddordid in ('" . $x . "') and oddest in ('t') ";
        $RESULT_ORDERDETAIL = $this->ejecutar_query($sql1);
        $total              = 0;
        
        foreach ($RESULT_ORDERDETAIL as $data) {
            $total = $data['oddpvp'] + $total;
        }
        return $total * 0.12;
    }
    
    
    
    public function DATAPRINT__ord_estatus_ico($x)
    {
        
        $sql1         = "select * from orders where ordid in ('" . $x . "')  ";
        $RESULT_ORDER = $this->ejecutar_query($sql1);
        
        
        if (strlen($RESULT_ORDER[0]['ordanu']) > 0) {
            
            $res = "<i class=\" fa fa-close red\"> </i>";
            
        } else if (strlen($RESULT_ORDER[0]['ordenv']) > 0) {
            
            
            $res = "<i class=\" fa fa-check green\"> </i>";
            
        } else if (strlen($RESULT_ORDER[0]['ordpre']) > 0) {
            
            $res = "<i class=\" fa fa-clock-o orange\"> </i>";
            
        } else if (strlen($RESULT_ORDER[0]['ordemi']) > 0) {
            
            $res = "<i class=\" fa fa-clock-o orange \"> </i>";
            
        }
        
        
        
        return $res;
        
    }
    
    
    
    public function DATAPRINT__is_date_print($fecha)
    {
        $yy    = substr($fecha, 0, 4);
        $mm    = substr($fecha, 5, 2);
        $dd    = substr($fecha, 8, 2);
        $fecha = $dd . "/" . $mm . "/" . $yy;
        return $fecha;
    }
    
    public function DATAPRINT__is_numeric_($n)
    {
        
        if (is_numeric($n))
            return $n;
        else
            return "";
    }
    
    public function DATAPRINT__is_costototal($n)
    {
        
        return ($n * 1000);
    }
    
    public function DATAPRINT__is_formato_moneda_($n)
    {
        return $n = number_format($n, 2, ",", ".");
    }
    
    public function DATAPRINT__is_date($fecha = "")
    {
        
        if (strlen($fecha) < 4) {
            $fecha = date('Y-m-d H:i:s');
        } else {
            
            $dd    = substr($fecha, 0, 2);
            $mm    = substr($fecha, 3, 2);
            $yy    = substr($fecha, 6, 4);
            $fecha = $yy . "/" . $mm . "/" . $dd;
        }
        
        return $fecha;
    }
    
    public function DATAPRINT__is_encrypt($x)
    {
        return $this->encrypt($x);
    }
    
    public function DATAPRINT__is_decrypt($x)
    {
        return $this->decrypt($x);
    }
    
    public function DATAPRINT__is_md5($x)
    {
        return md5($x);
    }
    
    public function DATAPRINT__is_img($x, $json)
    {
        
        #   return "<img  src='".$x."'  >";
        
        
        return "<img  src='" . $json['url'] . $x . "'  width='" . $json['width'] . "'  class='" . $json['class'] . "'   style='" . $json['style'] . "' >";
    }
    
    public function DATAPRINT__is_img_url($x, $json)
    {
        return $json['url'] . $x;
    }
    
    public function DATAPRINT__is_sec01()
    {
        $obj  = new padreModelo();
        $sql  = "select (id+1) as sec from " . $this->tabla . " order by 1 desc limit 1 ";
        $data = $obj->ejecutar_query($sql);
        return 'MMSV' . date('Ym') . $data[0]['sec'];
    }
    
    public function DATAPRINT__is_delete($x)
    {
        if (strlen($x) < 1) {
            return 't';
        } else {
            return $x;
        }
        ;
    }
    
    public function DATAPRINT__is_format_this($x)
    {
        return ucwords(strtolower($x));
    }
    
    public function DATAPRINT__is_combo_($valor, $campo, $tabla, $tabla_id, $tabla_campo, $condicion, $json = "")
    {
        
        
        if ($json['multiple']) {
            $m = "[]";
        }
        
        
        $sal .= "<select style=\"" . $json['externo'] . "\"  id='" . $json['id_input'] . "' name='" . $campo . $m . "' class='form-control " . $json['class'] . "'  " . $json['externo'] . "  onclick=\"" . $json['onclick'] . "\"   onfocus=\"" . $json['onfocus'] . "\"  >";
        $obj = new padreModelo();
        $sql = "select * from " . $tabla . " where  $condicion  ";
        
        
        $data = $obj->ejecutar_query($sql);
        
        
        
        foreach ($data as $dato) {
            
            if ($valor == $dato[$tabla_id]) {
                $sal .= "<option value='" . $dato[$tabla_id] . "' selected >" . $this->DATAPRINT__is_format_this($dato[$tabla_campo]) . "</option>";
            } else {
                $sal .= "<option value='" . $dato[$tabla_id] . "'>" . $this->DATAPRINT__is_format_this($dato[$tabla_campo]) . "</option>";
            }
        }
        
        $sal .= "</select>";
        
        return $sal;
    }
    
    
    
    public $sql_combomultiple_estan = "";
    public $sql_combomultiple_noestan = "";
    public $sql_combomultiple_id = "";
    
    
    
    public function DATAPRINT__is_combo_multiple($valor, $campo, $tabla, $tabla_id, $tabla_campo, $condicion, $json = "")
    {
        
        
        
        if ($json['multiple']) {
            $m = "[]";
        }
        
        
        $sal .= "<select
  style=\"" . $json['externo'] . "\"
  id='" . $json['id_input'] . "'
  name='" . $campo . $m . "'
  class='form-control " . $json['class'] . "'  " . $json['externo'] . "
  onclick=\"" . $json['onclick'] . "\"
  onfocus=\"" . $json['onfocus'] . "\"  >";
        
        
        
        $obj = new padreModelo();
        
        
        $this->sql_combomultiple_noestan = "select *  from " . $json['fk_table'] . "
  where  " . $json['fk_table_where2'] . "  and " . $json['fk_table_id'] . " not in (
                                                                            select " . $json['fk_table_id2'] . " from " . $json['fk_table2'] . "
                                                                            where " . $json['fk_table_where'] . " and " . $json['fk_table_id3'] . "  in (" . $this->sql_combomultiple_id . "))";
        
        
        $this->sql_combomultiple_estan = "select *  from " . $json['fk_table'] . "
where " . $json['fk_table_where2'] . " and " . $json['fk_table_id'] . "  in (
                                                                     select " . $json['fk_table_id2'] . " from " . $json['fk_table2'] . "
                                                                     where  " . $json['fk_table_where'] . "  and " . $json['fk_table_id3'] . "  in (" . $this->sql_combomultiple_id . "))";
        
        
        
        $estan    = $obj->ejecutar_query($this->sql_combomultiple_estan);
        $no_estan = $obj->ejecutar_query($this->sql_combomultiple_noestan);
        
        
        for ($i = 0; $i < count($estan); $i++) {
            $estan[$i]['select'] = 'select';
        }
        
        
        for ($i = 0; $i < count($no_estan); $i++) {
            $no_estan[$i]['select'] = '';
        }
        
        
        $id_primary   = $json['fk_table_id'];
        $name_primary = $json['fk_table_campo'];
        
        foreach ($estan as $dato) {
            
            
            $sal .= "<option value='" . $dato[$id_primary] . "' selected >" . $this->DATAPRINT__is_format_this($dato[$name_primary]) . "</option>";
            
            
        }
        
        
        foreach ($no_estan as $dato) {
            
            $sal .= "<option value='" . $dato[$id_primary] . "'>" . $this->DATAPRINT__is_format_this($dato[$name_primary]) . "</option>";
        }
        
        
        $sal .= "</select>";
        
        return $sal;
    }
    
    
    
    
    
    
    
    
    
    
    
    
    public function DATAPRINT__fk_value($valor, $campo, $tabla, $tabla_id, $tabla_campo, $condicion)
    {
        
        $obj  = new padreModelo();
        $sql  = "select " . $tabla_campo . " as id  from " . $tabla . " where  " . $tabla_id . " = '" . $valor . "'   ";
        $data = $obj->ejecutar_query($sql);
        return $this->DATAPRINT__is_format_this($data[0]['id']);
    }
    
    public function DATAPRINT__fk_value_fijo($valor, $data, $campo)
    {
        
        foreach ($data as $dato) {
            
            if ($valor == $dato['value']) {
                $sal .= $this->DATAPRINT__is_format_this($dato['name']);
            }
        }
        
        return $sal;
    }
    
    public function DATAPRINT__is_combo_fijo($valor, $data, $campo)
    {
        
        $sal .= "<select id='" . $campo . "' name='" . $campo . "' class='form-control' >";
        
        
        foreach ($data as $dato) {
            
            if ($valor == $dato['value']) {
                $sal .= "<option value='" . $dato['value'] . "' selected >" . $this->DATAPRINT__is_format_this($dato['name']) . "</option>";
            } else {
                $sal .= "<option value='" . $dato['value'] . "'>" . $this->DATAPRINT__is_format_this($dato['name']) . "</option>";
            }
        }
        
        return $sal .= "</select>";
    }
    
    public function FIXTYPE__($nombre, $valor, $data_json)
    {
        
        
        if (strlen($valor) < 1) {
            
            $defecto = $data_json;
            $valor   = $defecto[$nombre];
        }
        
        
        foreach ($data_json['type_date'] as &$value) {
            
            if ($value['campo'] == $nombre) {
                $valor = $this->DATAPRINT__is_date($valor);
                break;
            }
        }
        
        foreach ($data_json['type_numeric'] as &$value) {
            if ($value['campo'] == $nombre) {
                $valor = $this->DATAPRINT__is_numeric_($valor);
                break;
            }
        }
        
        foreach ($data_json['type_sec'] as &$value) {
            if ($value['campo'] == $nombre) {
                $sql   = "select " . $value['alias'] . " as sec from " . $value['table'] . " order by 1 desc limit 1 ";
                $data  = $this->ejecutar_query($sql);
                $valor = $value['part1'] . date('Ym') . $data[0]['sec'];
                
                break;
            }
        }
        
        foreach ($data_json['type_md5'] as &$value) {
            if ($value['campo'] == $nombre) {
                $valor = $this->DATAPRINT__is_md5($valor);
                break;
            }
        }
        
        
        foreach ($data_json['type_delete'] as &$value) {
            if ($value['campo'] == $nombre) {
                $valor = $this->DATAPRINT__is_delete($valor);
                break;
            }
        }
        



        return $valor;
    }
    
    
    public $CLUUFDATA_conexion = "DATA/";
    public $CLUUFDATA_bd = "";
    public $CLUUFDATA_token = "";
    public $CLUUFDATA_nodo = "";
    public $CLUUFDATA_security = false;
    
    
    
    public function cluufdata_iniciar()
    {
        
        $file1 = $this->CLUUFDATA_conexion . $this->CLUUFDATA_bd . "/" . $this->CLUUFDATA_token . ".json";
        $file  = fopen($file1, "w");
        
    }
    
    
    
    public function cluufdata_new($NODO, $PARAM)
    {
        
        $file   = $this->CLUUFDATA_conexion . $this->CLUUFDATA_bd . "/" . $this->CLUUFDATA_token . ".json";
        $datos_ = file_get_contents($file);
        
        $json_ = json_decode($datos_, true);
        
        array_push($json_[$NODO], $PARAM);
        $json_string = json_encode($json_);
        file_put_contents($file, $json_string);
        
    }
    
    
    
    
    
    
    
    
    public function cluufdata_insert($NODO, $PARAM)
    {
        
        $file   = $this->CLUUFDATA_conexion . $this->CLUUFDATA_bd . "/" . $this->CLUUFDATA_token . ".json";
        $datos_ = file_get_contents($file);
        
        $json_ = json_decode($datos_, true);
        
        
        
        if ($json_[$NODO][0]) {
            
            array_push($json_[$NODO], $PARAM);
            //$json_string = json_encode($json_);
            //file_put_contents($file, $json_string);
        } else {
            array_push($json_[$NODO][0], $PARAM);
            array_push($json_[$NODO], $PARAM);
            //$json_string = json_encode($json_);
            //file_put_contents($file, $json_string);
        }
        
        
        print_r($json_);
        
        
    }
    
    
    public function cluufdata_all()
    {
        $file   = $this->CLUUFDATA_conexion . $this->CLUUFDATA_bd . "/" . $this->CLUUFDATA_token . ".json";
        $datos_ = file_get_contents($file);
        $json_  = json_decode($datos_, true);
        $json_  = $this->cluufdata_clear($json_);
        
        $json_ = $this->cluufdata_clear($json_);
        
        print_r($json_);
        
    }
    
    
    
    
    
    
    public function cluufdata_search($PADRE, $NODO, $PARAM, $ACCION = "")
    {
        
        $file   = $this->CLUUFDATA_conexion . $this->CLUUFDATA_bd . "/" . $this->CLUUFDATA_token . ".json";
        $datos_ = file_get_contents($file);
        $data   = json_decode($datos_, true);
        
        foreach ($data[$PADRE] as $dato) {
            
            if ($dato[$NODO] == $PARAM) {
                
                if ($ACCION == "DELETE") {
                    unset($dato);
                } else {
                    return $dato;
                    exit;
                }
            } else {
                
            }
            $dato__[] = $dato;
        }
        $dato__ = $this->cluufdata_clear($dato__);
        return false;
        exit;
    }
    
    
    
    public function cluufdata_clear($ARREGLO)
    {
        
        
        
    }
    
    
    public function test()
    {
        echo "Hola padreModelo";
    }
    
    
    
    
    
    
    
    
    
    
    
}

$objeto = new padreModelo();
#$objeto->cargos_automaticos_reservaciones();
?>