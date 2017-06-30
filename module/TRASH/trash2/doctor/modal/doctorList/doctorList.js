

                  /*



                  "<a onclick="openModalDatatabledoctorList(0)"
                  data-toggle="modal"  href="#modal-doctorList">

                  ENLACE
                  </a>" );

                  */

                   function openModalDatatabledoctorList(x) {
                     goto_lsdajax_doctorList('openModalDatatabledoctorList', [x], 'content-modal-doctorList','module/doctor/modal/doctorList/doctorList_AJAX.php');

                    }



                  var doctorList = {
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

                              datatable_doctorList();

                              }
                          }
                      }


                  };




                  function goto_lsdajax_doctorList(motivo, parametro, salida,url) {
                      var x = doctorList;
                      x.parametro = parametro;
                      x.motivo = motivo;
                      x.salida = salida;
                      x.url_neta = url;
                      x.ejecutar();
                  }




                   function datatable_doctorList() {

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
                                    $('#conidx').val($('#conidx').val()+' | '+myTable.cell( this ).data());
                                } );

                         }




                    function verdoctorList(x){
                      medicamento = '#'+x+'campo0';
                      posologia   = '#'+x+'campo2';
                      var xxx   = $(medicamento).val()+' '+$(posologia).val();
                      $('#jqte-conpos').val($('#jqte-conpos').val()+'  '+xxx);

                  var yyy   = $(medicamento).val();
                      $('#jqte-conind').val($('#jqte-conind').val()+' '+yyy);

                    }


                    function adddoctorList(x,y,zzz){
                      fecha       = '#'+x+'campo6';
                      plan        = '#'+x+'campo11';
                      diagnostico   = '#'+x+'campo13';
                      var xxx = 'FECHA :'+$(fecha).val()+' PLAN :'+$(plan).val()+' DIX : '+$(diagnostico).val();
                      $('#element-form-rmcadj').val($('#element-form-rmcadj').val()+'  '+xxx);
                    }










                    