
  function submit_modal_medicamentoConsultaDetail_click(x) {
    goto_lsdajax001('edit_medicamentoConsultaDetail', [x], 'content-modal-medicamentoConsultaDetail','module/consultaDetail/modal/medicamentoConsultaDetail/medicamentoConsultaDetail_AJAX.php');
  }



  function submit_form_medicamentoConsultaDetail_click() {
    var vista = 'visor2';
    var data = $('#form_medicamentoConsultaDetail').serialize();
    goto_lsdajax002('save_medicamentoConsultaDetail', [data], vista,'module/consultaDetail/modal/medicamentoConsultaDetail/medicamentoConsultaDetail_AJAX.php');
  }
  



  function openModalDatatableMedicamentoConsultaDetail(x) {
   goto_lsdajax_enfermedadConsulta('openModalDatatableMedicamentoConsultaDetail', [x], 'content-modal-medicamentoConsultaDetail','module/consultaDetail/modal/medicamentoConsultaDetail/medicamentoConsultaDetail_AJAX.php');
  	

  }






var enfermedadConsulta = {
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

            datatable_enfermedadConsulta();

            }
        }
    }


};




function goto_lsdajax_enfermedadConsulta(motivo, parametro, salida,url) {
    var x = enfermedadConsulta;
    x.parametro = parametro;
    x.motivo = motivo;
    x.salida = salida;
    x.url_neta = url;
    x.ejecutar();
}




 function datatable_enfermedadConsulta() {

         var myTable = $('#table').DataTable({
             bAutoWidth: false,
             "aaSorting": [],
             "iDisplayLength": 200
         });


        $('#table tbody').on( 'click', 'td', function () {
            $('#conidx').val($('#conidx').val()+' | '+myTable.cell( this ).data());
        } );

 }
