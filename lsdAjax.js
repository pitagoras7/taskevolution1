
function Lsd_load_u(x) {
    $("#" + x).css('display', 'block');
}

function Lsd_close_u(x) {
    $("#" + x).css('display', 'none');
}

function Lsd_val_u(x) {
    return $('#' + x).val();
}


function ajax(code,x,view) {
  goto_lsdajax001(code,[x],view,'module/ajax/ajax.php');
}


function ajax_url(code,x,view,url) {
  goto_lsdajax002(code,[x],view,url);
}


function filter_cards_(x,view,url) {
  goto_lsdajax001('filter_cards_',[x],view,url);
}


function filter_cards_002(x,view,url) {
  goto_lsdajax002('filter_cards_',[x],view,url);

 /*$('#visor1').removeClass('col-md-12');
  $('#visor1').addClass('col-md-8');
  $('#visor2').addClass('col-md-4');
*/
}



function ajax_new_cnd(x) {
  goto_lsdajax001('add_cnd',[x],'visor2','module/consultaDetail/cnd_AJAX.php');
}


function ajax_new_con(x) {
  goto_lsdajax001('add_con',[x],'visor2','module/consulta/con_AJAX.php');
}




function validar_submit(x, y) {
    $(x).css('display', 'none');
    $(y).css('display', 'block');
}

function get_lsd(id) {
    return document.getElementById(id).value;
}

function limpiar_lsd(obj) {
    document.getElementById(obj).value = "";
}

function objetoAjax() {
    var xmlhttp = false;
    try {
        xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
    } catch (e) {
        try {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        } catch (E) {
            xmlhttp = false;
        }
    }

    if (!xmlhttp && typeof XMLHttpRequest != 'undefined') {
        xmlhttp = new XMLHttpRequest();
    }
    return xmlhttp;
}

function validarPass_lsd(v1, v2) {

    var p1 = v1;
    var p2 = v2;
    var espacios = false;
    var cont = 0;

    // Este bucle recorre la cadena para comprobar
    // que no todo son espacios
    while (!espacios && (cont < p1.length)) {
        if (p1.charAt(cont) == " ")
            espacios = true;
        cont++;
    }

    if (espacios) {
        alert("La contrase�a no puede contener espacios en blanco");
        return false;
    }

    if (p1.length == 0 || p2.length == 0) {
        alert("Los campos del password no pueden quedar vacios");
        return false;
    }

    if (p1 != p2) {
        alert("Las passwords deben de coincidir");
        return false;
    } else {
        return true;
    }
}



function habilitar_lsd(obj) {
    document.getElementById(obj).disabled = false;
}

function inhabilitar_lsd(obj) {
    document.getElementById(obj).disabled = true;
}

function soloNumero_lsd(evt) {
    var nav4 = window.Event ? true : false;
    var key = nav4 ? evt.which : evt.keyCode;
    return (key <= 13 || (key >= 48 && key <= 57) || key == 46);
}

function imprimir_lsd(div, msj) {
    document.getElementById(div).innerHTML = msj;
}
function focus_lsd(obj) {
    document.getElementById(obj).focus();
}

function mostrar_lsd(div) {
    document.getElementById(div).style.display = "block";
}

function ocultar_lsd(div) {
    document.getElementById(div).style.display = "none";
}

function set_lsd(obj, valor) {
    document.getElementById(obj).value = valor;
}

function espacios_lsd(valor) {
    return trim(valor);
}

function espacios_lsd(valor) {
    return trim(valor);
}

function mayus_lsd(valor) {
    return  toUpperCase(valor);
}

function minus_lsd(valor) {
    return  toLowerCase(valor);
}






var accion = {
    "url": null,
    "salida": null,
    "motivo": null,
    "v1": null,
    "v2": null,
    "v3": null,
    "v4": null,
    "v5": null,
    "v6": null,
    "v7": null,
    "v8": null,
    "v9": null,
    "v10": null,
    "v11": null,
    "cantidad": 11,
    "url_neta": "/234",
    "error": function (msj) {
        document.getElementById('error').innerHTML = msj;
    },
    "vacio": function (x) {


        if (x.length > 0) {
            return true;
        } else {
            return false;
        }


    },
    "ejecutar": function () {

        url_x = this.url_neta + this.url;
        div = this.salida;
        var ajax = objetoAjax();

        ajax.open("POST", "ajax.php", true);
        ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        if (this.cantidad == 1) {
            ajax.send("accion=" + this.motivo + "&v1=" + this.v1);
        } else if (this.cantidad == 2) {
            ajax.send("accion=" + this.motivo + "&v1=" + this.v1 + "&v2=" + this.v2);
        } else if (this.cantidad == 3) {
            ajax.send("accion=" + this.motivo + "&v1=" + this.v1 + "&v2=" + this.v2 + "&v3=" + this.v3);
        } else if (this.cantidad == 4) {
            ajax.send("accion=" + this.motivo + "&v1=" + this.v1 + "&v2=" + this.v2 + "&v3=" + this.v3 + "&v4=" + this.v4);
        } else if (this.cantidad == 5) {
            ajax.send("accion=" + this.motivo + "&v1=" + this.v1 + "&v2=" + this.v2 + "&v3=" + this.v3 + "&v4=" + this.v4 + "&v5=" + this.v5);
        } else if (this.cantidad == 6) {
            ajax.send("accion=" + this.motivo + "&v1=" + this.v1 + "&v2=" + this.v2 + "&v3=" + this.v3 + "&v4=" + this.v4 + "&v5=" + this.v5 + "&v6=" + this.v6);
        } else if (this.cantidad == 7) {
            ajax.send("accion=" + this.motivo + "&v1=" + this.v1 + "&v2=" + this.v2 + "&v3=" + this.v3 + "&v4=" + this.v4 + "&v5=" + this.v5 + "&v6=" + this.v6 + "&v7=" + this.v7);
        } else if (this.cantidad == 8) {
            ajax.send("accion=" + this.motivo + "&v1=" + this.v1 + "&v2=" + this.v2 + "&v3=" + this.v3 + "&v4=" + this.v4 + "&v5=" + this.v5 + "&v6=" + this.v6 + "&v7=" + this.v7 + "&v8=" + this.v8);
        } else if (this.cantidad == 9) {
            ajax.send("accion=" + this.motivo + "&v1=" + this.v1 + "&v2=" + this.v2 + "&v3=" + this.v3 + "&v4=" + this.v4 + "&v5=" + this.v5 + "&v6=" + this.v6 + "&v7=" + this.v7 + "&v8=" + this.v8 + "&v9=" + this.v9);
        } else if (this.cantidad == 10) {
            ajax.send("accion=" + this.motivo + "&v1=" + this.v1 + "&v2=" + this.v2 + "&v3=" + this.v3 + "&v4=" + this.v4 + "&v5=" + this.v5 + "&v6=" + this.v6 + "&v7=" + this.v7 + "&v8=" + this.v8 + "&v9=" + this.v9 + "&v10=" + this.v10);
        } else if (this.cantidad == 11) {
            ajax.send("accion=" + this.motivo + "&v1=" + this.v1 + "&v2=" + this.v2 + "&v3=" + this.v3 + "&v4=" + this.v4 + "&v5=" + this.v5 + "&v6=" + this.v6 + "&v7=" + this.v7 + "&v8=" + this.v8 + "&v9=" + this.v9 + "&v10=" + this.v10 + "&v11=" + this.v11);
        }


        ajax.onreadystatechange = function () {

            if (ajax.readyState < 4) {
                document.getElementById(div).innerHTML = "Cargando ...";
            }

            if (ajax.readyState == 4) {

                if (div !== null) {
                    document.getElementById(div).innerHTML = ajax.responseText;
                }

                endAjax();

            }
        }
    }


};


var accion_a = {
    "url": null,
    "salida": null,
    "motivo": null,
    "v1": null,
    "v2": null,
    "v3": null,
    "v4": null,
    "v5": null,
    "v6": null,
    "v7": null,
    "v8": null,
    "v9": null,
    "v10": null,
    "v11": null,
    "cantidad": 11,
    "url_neta": "/234",
    "error": function (msj) {
        document.getElementById('error').innerHTML = msj;
    },
    "vacio": function (x) {


        if (x.length > 0) {
            return true;
        } else {
            return false;
        }


    },
    "ejecutar": function () {

        url_x = this.url_neta + this.url;
        div = this.salida;
        var ajax = objetoAjax();

        ajax.open("POST", "ajax.php", true);
        ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        if (this.cantidad == 1) {
            ajax.send("accion=" + this.motivo + "&v1=" + this.v1);
        } else if (this.cantidad == 2) {
            ajax.send("accion=" + this.motivo + "&v1=" + this.v1 + "&v2=" + this.v2);
        } else if (this.cantidad == 3) {
            ajax.send("accion=" + this.motivo + "&v1=" + this.v1 + "&v2=" + this.v2 + "&v3=" + this.v3);
        } else if (this.cantidad == 4) {
            ajax.send("accion=" + this.motivo + "&v1=" + this.v1 + "&v2=" + this.v2 + "&v3=" + this.v3 + "&v4=" + this.v4);
        } else if (this.cantidad == 5) {
            ajax.send("accion=" + this.motivo + "&v1=" + this.v1 + "&v2=" + this.v2 + "&v3=" + this.v3 + "&v4=" + this.v4 + "&v5=" + this.v5);
        } else if (this.cantidad == 6) {
            ajax.send("accion=" + this.motivo + "&v1=" + this.v1 + "&v2=" + this.v2 + "&v3=" + this.v3 + "&v4=" + this.v4 + "&v5=" + this.v5 + "&v6=" + this.v6);
        } else if (this.cantidad == 7) {
            ajax.send("accion=" + this.motivo + "&v1=" + this.v1 + "&v2=" + this.v2 + "&v3=" + this.v3 + "&v4=" + this.v4 + "&v5=" + this.v5 + "&v6=" + this.v6 + "&v7=" + this.v7);
        } else if (this.cantidad == 8) {
            ajax.send("accion=" + this.motivo + "&v1=" + this.v1 + "&v2=" + this.v2 + "&v3=" + this.v3 + "&v4=" + this.v4 + "&v5=" + this.v5 + "&v6=" + this.v6 + "&v7=" + this.v7 + "&v8=" + this.v8);
        } else if (this.cantidad == 9) {
            ajax.send("accion=" + this.motivo + "&v1=" + this.v1 + "&v2=" + this.v2 + "&v3=" + this.v3 + "&v4=" + this.v4 + "&v5=" + this.v5 + "&v6=" + this.v6 + "&v7=" + this.v7 + "&v8=" + this.v8 + "&v9=" + this.v9);
        } else if (this.cantidad == 10) {
            ajax.send("accion=" + this.motivo + "&v1=" + this.v1 + "&v2=" + this.v2 + "&v3=" + this.v3 + "&v4=" + this.v4 + "&v5=" + this.v5 + "&v6=" + this.v6 + "&v7=" + this.v7 + "&v8=" + this.v8 + "&v9=" + this.v9 + "&v10=" + this.v10);
        } else if (this.cantidad == 11) {
            ajax.send("accion=" + this.motivo + "&v1=" + this.v1 + "&v2=" + this.v2 + "&v3=" + this.v3 + "&v4=" + this.v4 + "&v5=" + this.v5 + "&v6=" + this.v6 + "&v7=" + this.v7 + "&v8=" + this.v8 + "&v9=" + this.v9 + "&v10=" + this.v10 + "&v11=" + this.v11);
        }


        ajax.onreadystatechange = function () {

            if (ajax.readyState < 4) {
                document.getElementById(div).innerHTML = "Cargando ...";
            }

            if (ajax.readyState == 4) {

                if (div !== null) {
                    document.getElementById(div).innerHTML = ajax.responseText;
                }

                endAjax_a();

            }
        }
    }


};




var accion_JQ = {
    "url": null,
    "salida": null,
    "motivo": null,
    "parametro": [],
    "url_neta": "/234",
    "ejecutar": function () {

        url_x = this.url_neta + this.url;
        div = this.salida;
        var ajax = objetoAjax();



        ajax.open("POST", "ajax.php", true);
        ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        ajax.send("accion=" + this.motivo + "&parametro=" + this.parametro);


        ajax.onreadystatechange = function () {

            if (ajax.readyState < 4) {
                document.getElementById(div).innerHTML = "";
            }

            if (ajax.readyState == 4) {


                if (div !== null) {

                    document.getElementById(div).innerHTML = ajax.responseText;
                }

                endAjaxJQ();
            }
        }
    }


};



var accion_twig = {
    "url": null,
    "salida": null,
    "motivo": null,
    "v1": null,
    "v2": null,
    "v3": null,
    "v4": null,
    "v5": null,
    "v6": null,
    "v7": null,
    "v8": null,
    "v9": null,
    "v10": null,
    "v11": null,
    "cantidad": 11,
    "url_neta": "controlador.php",
    "error": function (msj) {
        document.getElementById('error').innerHTML = msj;
    },
    "vacio": function (x) {


        if (x.length > 0) {
            return true;
        } else {
            return false;
        }


    },
    "ejecutar": function () {

        url_x = this.url_neta + this.url;
        div = this.salida;
        var ajax = objetoAjax();

        ajax.open("POST", "../" + this.url + "/controlador.php", true);
        ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        if (this.cantidad == 1) {
            ajax.send("accion=" + this.motivo + "&v1=" + this.v1);
        } else if (this.cantidad == 2) {
            ajax.send("accion=" + this.motivo + "&v1=" + this.v1 + "&v2=" + this.v2);
        } else if (this.cantidad == 3) {
            ajax.send("accion=" + this.motivo + "&v1=" + this.v1 + "&v2=" + this.v2 + "&v3=" + this.v3);
        } else if (this.cantidad == 4) {
            ajax.send("accion=" + this.motivo + "&v1=" + this.v1 + "&v2=" + this.v2 + "&v3=" + this.v3 + "&v4=" + this.v4);
        } else if (this.cantidad == 5) {
            ajax.send("accion=" + this.motivo + "&v1=" + this.v1 + "&v2=" + this.v2 + "&v3=" + this.v3 + "&v4=" + this.v4 + "&v5=" + this.v5);
        } else if (this.cantidad == 6) {
            ajax.send("accion=" + this.motivo + "&v1=" + this.v1 + "&v2=" + this.v2 + "&v3=" + this.v3 + "&v4=" + this.v4 + "&v5=" + this.v5 + "&v6=" + this.v6);
        } else if (this.cantidad == 7) {
            ajax.send("accion=" + this.motivo + "&v1=" + this.v1 + "&v2=" + this.v2 + "&v3=" + this.v3 + "&v4=" + this.v4 + "&v5=" + this.v5 + "&v6=" + this.v6 + "&v7=" + this.v7);
        } else if (this.cantidad == 8) {
            ajax.send("accion=" + this.motivo + "&v1=" + this.v1 + "&v2=" + this.v2 + "&v3=" + this.v3 + "&v4=" + this.v4 + "&v5=" + this.v5 + "&v6=" + this.v6 + "&v7=" + this.v7 + "&v8=" + this.v8);
        } else if (this.cantidad == 9) {
            ajax.send("accion=" + this.motivo + "&v1=" + this.v1 + "&v2=" + this.v2 + "&v3=" + this.v3 + "&v4=" + this.v4 + "&v5=" + this.v5 + "&v6=" + this.v6 + "&v7=" + this.v7 + "&v8=" + this.v8 + "&v9=" + this.v9);
        } else if (this.cantidad == 10) {
            ajax.send("accion=" + this.motivo + "&v1=" + this.v1 + "&v2=" + this.v2 + "&v3=" + this.v3 + "&v4=" + this.v4 + "&v5=" + this.v5 + "&v6=" + this.v6 + "&v7=" + this.v7 + "&v8=" + this.v8 + "&v9=" + this.v9 + "&v10=" + this.v10);
        } else if (this.cantidad == 11) {
            ajax.send("accion=" + this.motivo + "&v1=" + this.v1 + "&v2=" + this.v2 + "&v3=" + this.v3 + "&v4=" + this.v4 + "&v5=" + this.v5 + "&v6=" + this.v6 + "&v7=" + this.v7 + "&v8=" + this.v8 + "&v9=" + this.v9 + "&v10=" + this.v10 + "&v11=" + this.v11);
        }


        ajax.onreadystatechange = function () {

            if (ajax.readyState < 4) {
                document.getElementById(div).innerHTML = "Cargando ...";
            }

            if (ajax.readyState == 4) {

                if (div !== null) {
                    document.getElementById(div).innerHTML = ajax.responseText;
                }

            }
        }
    }



};






function accion_lsd(motivo, parametro, salida) {
    var x = accion;
    x.motivo = motivo;
    x.v1 = parametro[0];
    x.v2 = parametro[1];
    x.v3 = parametro[2];
    x.v4 = parametro[3];
    x.v5 = parametro[4];
    x.v6 = parametro[5];
    x.v7 = parametro[6];
    x.v8 = parametro[7];
    x.v9 = parametro[8];
    x.salida = salida;
    x.ejecutar();

}

function accion_lsd_a(motivo, parametro, salida) {
    var x = accion_a;
    x.motivo = motivo;
    x.v1 = parametro[0];
    x.v2 = parametro[1];
    x.v3 = parametro[2];
    x.v4 = parametro[3];
    x.v5 = parametro[4];
    x.v6 = parametro[5];
    x.v7 = parametro[6];
    x.v8 = parametro[7];
    x.v9 = parametro[8];
    x.salida = salida;
    x.ejecutar();

}


function accion_lsd_JQ(motivo, parametro, salida) {
    var x = accion_JQ;
    x.parametro = parametro;
    x.motivo = motivo;
    x.salida = salida;
    x.ejecutar();
}










function ver_lsd(funcion, parametro) {
    var x = accion;
    x.motivo = 'url';
    x.v1 = funcion;
    x.v2 = parametro;
    x.salida = 'seccion';
    x.ejecutar();
}



function twig_lsd(modulo, motivo, parametro, salida) {
    var x = accion_twig;
    x.motivo = motivo;
    x.url = modulo;
    x.v1 = parametro[0];
    x.v2 = parametro[1];
    x.v3 = parametro[2];
    x.v4 = parametro[3];
    x.v5 = parametro[4];
    x.v6 = parametro[5];
    x.v7 = parametro[6];
    x.v8 = parametro[7];
    x.v9 = parametro[8];
    x.salida = salida;
    x.ejecutar();
}



function validarfecha(fecha) {
    var fechaf = fecha.split("/");
    var day = fechaf[0];
    var month = fechaf[1];
    var year = fechaf[2];
    var date = new Date(year, month, '0');
    if ((day - 0) > (date.getDate() - 0)) {
        return false;
    }
    return true;
}



var accion_get = {
    "url": null,
    "salida": null,
    "motivo": null,
    "v1": null,
    "v2": null,
    "v3": null,
    "v4": null,
    "v5": null,
    "v6": null,
    "v7": null,
    "v8": null,
    "v9": null,
    "v10": null,
    "v11": null,
    "cantidad": 11,
    "url_neta": "/234",
    "error": function (msj) {
        document.getElementById('error').innerHTML = msj;
    },
    "vacio": function (x) {


        if (x.length > 0) {
            return true;
        } else {
            return false;
        }


    },
    "ejecutar": function () {

        url_x = this.url_neta + this.url;
        div = this.salida;
        var ajax = objetoAjax();

        ajax.open("GET", "http://securitymail-cluuf.rhcloud.com/mailer/send.php", true);
        ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        if (this.cantidad == 1) {
            ajax.send("accion=" + this.motivo + "&v1=" + this.v1);
        } else if (this.cantidad == 2) {
            ajax.send("accion=" + this.motivo + "&v1=" + this.v1 + "&v2=" + this.v2);
        } else if (this.cantidad == 3) {
            ajax.send("accion=" + this.motivo + "&v1=" + this.v1 + "&v2=" + this.v2 + "&v3=" + this.v3);
        } else if (this.cantidad == 4) {
            ajax.send("accion=" + this.motivo + "&v1=" + this.v1 + "&v2=" + this.v2 + "&v3=" + this.v3 + "&v4=" + this.v4);
        } else if (this.cantidad == 5) {
            ajax.send("accion=" + this.motivo + "&v1=" + this.v1 + "&v2=" + this.v2 + "&v3=" + this.v3 + "&v4=" + this.v4 + "&v5=" + this.v5);
        } else if (this.cantidad == 6) {
            ajax.send("accion=" + this.motivo + "&v1=" + this.v1 + "&v2=" + this.v2 + "&v3=" + this.v3 + "&v4=" + this.v4 + "&v5=" + this.v5 + "&v6=" + this.v6);
        } else if (this.cantidad == 7) {
            ajax.send("accion=" + this.motivo + "&v1=" + this.v1 + "&v2=" + this.v2 + "&v3=" + this.v3 + "&v4=" + this.v4 + "&v5=" + this.v5 + "&v6=" + this.v6 + "&v7=" + this.v7);
        } else if (this.cantidad == 8) {
            ajax.send("accion=" + this.motivo + "&v1=" + this.v1 + "&v2=" + this.v2 + "&v3=" + this.v3 + "&v4=" + this.v4 + "&v5=" + this.v5 + "&v6=" + this.v6 + "&v7=" + this.v7 + "&v8=" + this.v8);
        } else if (this.cantidad == 9) {
            ajax.send("accion=" + this.motivo + "&v1=" + this.v1 + "&v2=" + this.v2 + "&v3=" + this.v3 + "&v4=" + this.v4 + "&v5=" + this.v5 + "&v6=" + this.v6 + "&v7=" + this.v7 + "&v8=" + this.v8 + "&v9=" + this.v9);
        } else if (this.cantidad == 10) {
            ajax.send("accion=" + this.motivo + "&v1=" + this.v1 + "&v2=" + this.v2 + "&v3=" + this.v3 + "&v4=" + this.v4 + "&v5=" + this.v5 + "&v6=" + this.v6 + "&v7=" + this.v7 + "&v8=" + this.v8 + "&v9=" + this.v9 + "&v10=" + this.v10);
        } else if (this.cantidad == 11) {
            ajax.send("accion=" + this.motivo + "&v1=" + this.v1 + "&v2=" + this.v2 + "&v3=" + this.v3 + "&v4=" + this.v4 + "&v5=" + this.v5 + "&v6=" + this.v6 + "&v7=" + this.v7 + "&v8=" + this.v8 + "&v9=" + this.v9 + "&v10=" + this.v10 + "&v11=" + this.v11);
        }


        ajax.onreadystatechange = function () {

            if (ajax.readyState < 4) {
                document.getElementById(div).innerHTML = "Cargando ...";
            }

            if (ajax.readyState == 4) {

                if (div !== null) {
                    document.getElementById(div).innerHTML = ajax.responseText;
                }

            }
        }
    }


};

function accion_lsd_get(motivo, parametro, salida) {
    var x = accion_get;
    x.motivo = motivo;
    x.v1 = parametro[0];
    x.v2 = parametro[1];
    x.v3 = parametro[2];
    x.v4 = parametro[3];
    x.v5 = parametro[4];
    x.v6 = parametro[5];
    x.v7 = parametro[6];
    x.v8 = parametro[7];
    x.v9 = parametro[8];
    x.salida = salida;
    x.ejecutar();
}














/*  new version 01   */


var lsdajax001 = {
    "url": null,
    "salida": null,
    "motivo": null,
    "v1": null,
    "v2": null,
    "v3": null,
    "v4": null,
    "v5": null,
    "v6": null,
    "v7": null,
    "v8": null,
    "v9": null,
    "v10": null,
    "v11": null,
    "cantidad": 11,
    "url_neta": null,
    "error": function (msj) {
        document.getElementById('error').innerHTML = msj;
    },
    "vacio": function (x) {


        if (x.length > 0) {
            return true;
        } else {
            return false;
        }


    },
    "ejecutar": function () {

        div = this.salida;
        var ajax = objetoAjax();

        ajax.open("POST",this.url_neta, true);
        ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        if (this.cantidad == 1) {
            ajax.send("accion=" + this.motivo + "&v1=" + this.v1);
        } else if (this.cantidad == 2) {
            ajax.send("accion=" + this.motivo + "&v1=" + this.v1 + "&v2=" + this.v2);
        } else if (this.cantidad == 3) {
            ajax.send("accion=" + this.motivo + "&v1=" + this.v1 + "&v2=" + this.v2 + "&v3=" + this.v3);
        } else if (this.cantidad == 4) {
            ajax.send("accion=" + this.motivo + "&v1=" + this.v1 + "&v2=" + this.v2 + "&v3=" + this.v3 + "&v4=" + this.v4);
        } else if (this.cantidad == 5) {
            ajax.send("accion=" + this.motivo + "&v1=" + this.v1 + "&v2=" + this.v2 + "&v3=" + this.v3 + "&v4=" + this.v4 + "&v5=" + this.v5);
        } else if (this.cantidad == 6) {
            ajax.send("accion=" + this.motivo + "&v1=" + this.v1 + "&v2=" + this.v2 + "&v3=" + this.v3 + "&v4=" + this.v4 + "&v5=" + this.v5 + "&v6=" + this.v6);
        } else if (this.cantidad == 7) {
            ajax.send("accion=" + this.motivo + "&v1=" + this.v1 + "&v2=" + this.v2 + "&v3=" + this.v3 + "&v4=" + this.v4 + "&v5=" + this.v5 + "&v6=" + this.v6 + "&v7=" + this.v7);
        } else if (this.cantidad == 8) {
            ajax.send("accion=" + this.motivo + "&v1=" + this.v1 + "&v2=" + this.v2 + "&v3=" + this.v3 + "&v4=" + this.v4 + "&v5=" + this.v5 + "&v6=" + this.v6 + "&v7=" + this.v7 + "&v8=" + this.v8);
        } else if (this.cantidad == 9) {
            ajax.send("accion=" + this.motivo + "&v1=" + this.v1 + "&v2=" + this.v2 + "&v3=" + this.v3 + "&v4=" + this.v4 + "&v5=" + this.v5 + "&v6=" + this.v6 + "&v7=" + this.v7 + "&v8=" + this.v8 + "&v9=" + this.v9);
        } else if (this.cantidad == 10) {
            ajax.send("accion=" + this.motivo + "&v1=" + this.v1 + "&v2=" + this.v2 + "&v3=" + this.v3 + "&v4=" + this.v4 + "&v5=" + this.v5 + "&v6=" + this.v6 + "&v7=" + this.v7 + "&v8=" + this.v8 + "&v9=" + this.v9 + "&v10=" + this.v10);
        } else if (this.cantidad == 11) {
            ajax.send("accion=" + this.motivo + "&v1=" + this.v1 + "&v2=" + this.v2 + "&v3=" + this.v3 + "&v4=" + this.v4 + "&v5=" + this.v5 + "&v6=" + this.v6 + "&v7=" + this.v7 + "&v8=" + this.v8 + "&v9=" + this.v9 + "&v10=" + this.v10 + "&v11=" + this.v11);
        }


        ajax.onreadystatechange = function () {

            if (ajax.readyState < 4) {
                document.getElementById(div).innerHTML = "Cargando ...";
            }

            if (ajax.readyState == 4) {

                if (div !== null) {
                    document.getElementById(div).innerHTML = ajax.responseText;
                }

                response_lsdajax001();

            }
        }
    }


};


function goto_lsdajax001(motivo, parametro, salida,url) {
    var x = lsdajax001;
    x.motivo = motivo;
    x.v1 = parametro[0];
    x.v2 = parametro[1];
    x.v3 = parametro[2];
    x.v4 = parametro[3];
    x.v5 = parametro[4];
    x.v6 = parametro[5];
    x.v7 = parametro[6];
    x.v8 = parametro[7];
    x.v9 = parametro[8];
    x.salida = salida;
    x.url_neta = url;
    x.ejecutar();

}







var lsdajax002 = {
    "url": null,
    "salida": null,
    "motivo": null,
    "parametro": [],
    "url_neta": null,
    "ejecutar": function () {

        div = this.salida;
        var ajax = objetoAjax();



        ajax.open("POST",this.url_neta, true);
        ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        ajax.send("accion=" + this.motivo + "&parametro=" + this.parametro);


        ajax.onreadystatechange = function () {

            if (ajax.readyState < 4) {
                document.getElementById(div).innerHTML = "";
            }

            if (ajax.readyState == 4) {


                if (div !== null) {

                    document.getElementById(div).innerHTML = ajax.responseText;
                }

            datatable_inicializar();

            }
        }
    }


};




function goto_lsdajax002(motivo, parametro, salida,url) {
    var x = lsdajax002;
    x.parametro = parametro;
    x.motivo = motivo;
    x.salida = salida;
    x.url_neta = url;
    x.ejecutar();
}




 function datatable_inicializar() {

     var myTable = $('#table').DataTable({
         bAutoWidth: false,
         "aaSorting": [],
         "iDisplayLength": 200
     });



        /* SOLO PASAR UNO

        $('#table tbody').on( 'click', 'td', function () {
            $('#conidx').val(myTable.cell( this ).data());
        } );


        */


        /* PASAR VARIOS


        $('#table tbody').on( 'click', 'td', function () {
            $('#conidx').val($('#conidx').val()+' | '+myTable.cell( this ).data());
        } );

        */


     $('.options-print-datatable').css("display", "none");


     $.fn.dataTable.Buttons.swfPath = "distXP/js/dataTables/extensions/buttons/swf/flashExport.swf"; //in Ace demo dist will be replaced by correct assets path
     $.fn.dataTable.Buttons.defaults.dom.container.className = 'dt-buttons btn-overlap btn-group btn-overlap';

     new $.fn.dataTable.Buttons(myTable, {
         buttons: [{
             "extend": "colvis",
             "text": "<i class='fa fa-search bigger-110 blue'></i> <span class='hidden'>Show/hide columns</span>",
             "className": "btn btn-white btn-primary btn-bold",
             columns: ':not(:first):not(:last)'
         }, {
             "extend": "copy",
             "text": "<i class='fa fa-copy bigger-110 pink'></i> <span class='hidden'>Copy to clipboard</span>",
             "className": "btn btn-white btn-primary btn-bold"
         }, {
             "extend": "csv",
             "text": "<i class='fa fa-database bigger-110 orange'></i> <span class='hidden'>Export to CSV</span>",
             "className": "btn btn-white btn-primary btn-bold"
         }, {
             "extend": "excel",
             "text": "<i class='fa fa-file-excel-o bigger-110 green'></i> <span class='hidden'>Export to Excel</span>",
             "className": "btn btn-white btn-primary btn-bold"
         }, {
             "extend": "pdf",
             "text": "<i class='fa fa-file-pdf-o bigger-110 red'></i> <span class='hidden'>Export to PDF</span>",
             "className": "btn btn-white btn-primary btn-bold"
         }, {
             "extend": "print",
             "text": "<i class='fa fa-print bigger-110 grey'></i> <span class='hidden'>Print</span>",
             "className": "btn btn-white btn-primary btn-bold",
             autoPrint: false,
             message: 'This print was produced using the Print button for DataTables'
         }]
     });


     myTable.buttons().container().appendTo($('.tableTools-container'));


     //style the message box
     var defaultCopyAction = myTable.button(1).action();
     myTable.button(1).action(function(e, dt, button, config) {
         defaultCopyAction(e, dt, button, config);
         $('.dt-button-info').addClass('gritter-item-wrapper gritter-info gritter-center white');
     });



     var defaultColvisAction = myTable.button(0).action();
     myTable.button(0).action(function(e, dt, button, config) {

         defaultColvisAction(e, dt, button, config);


         if ($('.dt-button-collection > .dropdown-menu').length == 0) {
             $('.dt-button-collection')
                 .wrapInner('<ul class="dropdown-menu dropdown-light dropdown-caret dropdown-caret" />')
                 .find('a').attr('href', '#').wrap("<li />")
         }
         $('.dt-button-collection').appendTo('.tableTools-container .dt-buttons')
     });

     ////


     setTimeout(function() {
         $($('.tableTools-container')).find('a.dt-button').each(function() {
             var div = $(this).find(' > div').first();
             if (div.length == 1)
                 div.tooltip({
                     container: 'body',
                     title: div.parent().text()
                 });
             else
                 $(this).tooltip({
                     container: 'body',
                     title: $(this).text()
                 });
         });
     }, 500);



     myTable.on('select', function(e, dt, type, index) {
         if (type === 'row') {
             $(myTable.row(index).node()).find('input:checkbox').prop('checked', true);
         }
     });



     myTable.on('deselect', function(e, dt, type, index) {
         if (type === 'row') {
             $(myTable.row(index).node()).find('input:checkbox').prop('checked', false);
         }
     });


 }
