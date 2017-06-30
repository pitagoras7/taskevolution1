

                  /*



                  "<a onclick="openModalDatatablepacienteCita(0)" 
                  data-toggle="modal"  href="#modal-pacienteCita">

                  ENLACE 
                  </a>" );

                  */

                   function openModalDatatablepacienteCita(x) {
                     goto_lsdajax_pacienteCita('openModalDatatablepacienteCita', [x], 'content-modal-pacienteCita','module/paciente/modal/pacienteCita/pacienteCita_AJAX.php');
                      
                    }



                  var pacienteCita = {
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

                              datatable_pacienteCita();

                              }
                          }
                      }


                  };




                  function goto_lsdajax_pacienteCita(motivo, parametro, salida,url) {
                      var x = pacienteCita;
                      x.parametro = parametro;
                      x.motivo = motivo;
                      x.salida = salida;
                      x.url_neta = url;
                      x.ejecutar();
                  }




                   function datatable_pacienteCita() {

                           var myTable = $('#table2').DataTable({
                               bAutoWidth: false,
                               "aaSorting": [],
                               "iDisplayLength": 7
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

                         }




                    function verpacienteCita(x){
                      medicamento = '#'+x+'campo0';
                      posologia   = '#'+x+'campo2';
                      var xxx   = $(medicamento).val()+' '+$(posologia).val();
                      $('#jqte-conpos').val($('#jqte-conpos').val()+'  '+xxx);

                  var yyy   = $(medicamento).val();
                      $('#jqte-conind').val($('#jqte-conind').val()+' '+yyy);

                    }


                    function addpacienteCita(x,y,zzz){
                      fecha       = '#'+x+'campo6';
                      plan        = '#'+x+'campo11';
                      diagnostico   = '#'+x+'campo13';
                      var xxx = 'FECHA :'+$(fecha).val()+' PLAN :'+$(plan).val()+' DIX : '+$(diagnostico).val();
                      $('#element-form-rmcadj').val($('#element-form-rmcadj').val()+'  '+xxx);
                    }










                    