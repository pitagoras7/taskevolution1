

                  /*



                  "<a onclick="openModalDatatablecitaDashboard(0)" 
                  data-toggle="modal"  href="#modal-citaDashboard">

                  ENLACE 
                  </a>" );

                  */

                   function openModalDatatablecitaDashboard(x) {
                 
                          goto_lsdajax_citaDashboard('openModalDatatablecitaDashboard', [x], 'visor','module/cita/modal/citaDashboard/citaDashboard_AJAX.php');
                    }


                    function submit_modal_cit_click(x){
                          goto_lsdajax001('edit_citedo', [x], 'content-modal-consultaDashboardPaciente','module/cita/modal/citaDashboard/citaDashboard_AJAX.php'); 
                    }


                    function submit_form_cit_click() {
                          var vista = 'visor2';
                          var data = $('#form_cit').serialize();
                          goto_lsdajax_citaDashboard('save_citedo', [data], vista,'module/cita/modal/citaDashboard/citaDashboard_AJAX.php');
                    }



                  var citaDashboard = {
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

                              datatable_citaDashboard();

                              }
                          }
                      }


                  };




                  function goto_lsdajax_citaDashboard(motivo, parametro, salida,url) {
                      var x = citaDashboard;
                      x.parametro = parametro;
                      x.motivo = motivo;
                      x.salida = salida;
                      x.url_neta = url;
                      x.ejecutar();
                  }




                   function datatable_citaDashboard() {

                           var myTable = $('#table').DataTable({
                                bAutoWidth: false,
                               "aaSorting": [],
                               "iDisplayLength": 7,
                                "lengthMenu": [7]
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
                                    $('#conidx').val($('#conidx').val()+' | '+myTable.cell( this ).data());
                                } );


                              $( ".dataTables_length" ).append( "<div class='titulo_datatable'><i class='fa fa-calendar'></i> Listado de Citas </div>" );


                         }



                    function vercitaDashboard(x){
                      medicamento = '#'+x+'campo0';
                      posologia   = '#'+x+'campo2';
                      var xxx   = $(medicamento).val()+' '+$(posologia).val();
                      $('#jqte-conpos').val($('#jqte-conpos').val()+'  '+xxx);

                  var yyy   = $(medicamento).val();
                      $('#jqte-conind').val($('#jqte-conind').val()+' '+yyy);

                    }


                    function addcitaDashboard(x,y,zzz){
                      fecha       = '#'+x+'campo6';
                      plan        = '#'+x+'campo11';
                      diagnostico   = '#'+x+'campo13';
                      var xxx = 'FECHA :'+$(fecha).val()+' PLAN :'+$(plan).val()+' DIX : '+$(diagnostico).val();
                      $('#element-form-rmcadj').val($('#element-form-rmcadj').val()+'  '+xxx);
                    }










                    