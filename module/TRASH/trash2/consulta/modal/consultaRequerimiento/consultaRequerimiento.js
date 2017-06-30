

                  /*



                  "<a onclick="openModalDatatableconsultaRequerimiento(0)" 
                  data-toggle="modal"  href="#modal-consultaRequerimiento">

                  ENLACE 
                  </a>" );

                  */

                   function openModalDatatableconsultaRequerimiento(x) {
                     goto_lsdajax_consultaRequerimiento('openModalDatatableconsultaRequerimiento', [x], 'content-modal-consultaRequerimiento','module/consulta/modal/consultaRequerimiento/consultaRequerimiento_AJAX.php');
                      
                    }



                  var consultaRequerimiento = {
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

                              datatable_consultaRequerimiento();

                              }
                          }
                      }


                  };




                  function goto_lsdajax_consultaRequerimiento(motivo, parametro, salida,url) {
                      var x = consultaRequerimiento;
                      x.parametro = parametro;
                      x.motivo = motivo;
                      x.salida = salida;
                      x.url_neta = url;
                      x.ejecutar();
                  }




                   function datatable_consultaRequerimiento() {

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

                        /* importante revisar el id del campo donde se pasara la data en este caso es #conidx */

                                $('#table tbody').on( 'click', 'td', function () {
                                    $('#jqte-conreq').val('- '+myTable.cell( this ).data()+'\n\n'+$('#jqte-conreq').val());
                                } );

                         }










                    