

                  /*



                  "<a onclick="openModalDatatableconsultaDashboardPaciente(0)" 
                  data-toggle="modal"  href="#modal-consultaDashboardPaciente">

                  ENLACE 
                  </a>" );

                  */

                   function openModalDatatableconsultaDashboardPaciente(x) {
                     goto_lsdajax_consultaDashboardPaciente('openModalDatatableconsultaDashboardPaciente', [x], 'visor','module/consulta/modal/consultaDashboardPaciente/consultaDashboardPaciente_AJAX.php');
                      
                    }





                  var consultaDashboardPaciente = {
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

                             datatable_consultaDashboardPaciente();

                              }
                          }
                      }


                  };




                  function goto_lsdajax_consultaDashboardPaciente(motivo, parametro, salida,url) {
                      var x = consultaDashboardPaciente;
                      x.parametro = parametro;
                      x.motivo = motivo;
                      x.salida = salida;
                      x.url_neta = url;
                      x.ejecutar();
                  }




                    function datatable_consultaDashboardPaciente() {

                           var myTable = $('#table').DataTable({
                               bAutoWidth: true,
                               "aaSorting": [],
                               "iDisplayLength": 7,
                                "lengthMenu": [7]
                           });


                          $( ".dataTables_length" ).append( "<div class='titulo_datatable'><i class='fa fa-user'></i> Listado de  Pacientes </div>" );


      
                         }










                    