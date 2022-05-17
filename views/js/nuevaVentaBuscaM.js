$(document).ready(function() {
    var indice = 0;
    var vehiculo = [];
    var botonaddAuto = document.getElementById('idAddAuto');
    botonaddAuto.addEventListener('click', insertarFila, true);
    var verificadorPrecio = 0;
    var indiceT = 0; // contador de vehiculos agregados con tramite
    var i = 0; //contador de vehiculos en el tramite

    function insertarFila() {

        var marca = document.getElementById('marca_selec').value;
        var modelo = document.getElementById('modelo_selec').value;
        var tipo = document.getElementById('tipo_selec').value;
        var color = document.getElementById('color_selec').value;
        var numpas = document.getElementById('numpas_selec').value;
        var cilindrada = document.getElementById('cilindrada_selec').value;
        var precio = document.getElementById('precio_selec').value;
        var tventa = document.getElementById('tipoVenta_selec').value;
        var contacto = document.getElementById('idContacto').value;
        var ruat = document.getElementById('idCheckRuat').checked;
        var poliza = document.getElementById('idCheckPoliza').checked;
        var soat = document.getElementById('idCheckSoat').checked;
        var placa = document.getElementById('idCheckPlaca').checked;
        var transito = document.getElementById('idCheckTransito').checked;
        if (modelo.trim() == "Otro") {
            modelo = document.getElementById('modelo_autoOtro').value;

        }
        if (tipo.trim() == "Otro") {
            tipo = document.getElementById('tipo_autoOtro').value;

        }
        if (color.trim() == "Otro") {
            color = document.getElementById('color_autoOtro').value;

        }
        if (numpas.trim() == "Otro") {
            numpas = document.getElementById('num_autoOtro').value;

        }
        if (cilindrada.trim() == "Otro") {
            cilindrada = document.getElementById('cilindrada_autoOtro').value;

        }
        if (precio.trim() == "Otro") {
            precio = document.getElementById('precio_autoOtro').value;

        }
        if (tventa.trim() == "Al contado") {
            contacto = "No necesario";

        }
        if (matrizVehiculos.length > 0) {
            if (marca != "" && modelo != "" && color != "" && numpas != "" && precio != "" && tventa != "" && contacto != "") {
                if (verificaEnMatriz()) {
                    Swal.fire({
                        title: 'Esta segur@ de agregar?',
                        text: "La marca,modelo y color ya estan en la lista",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Si,agregar!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            if (tventa.trim() == "Con crédito") {
                                verificaContrato();
                            } else {
                                agregaMovi();
                            }
                        }

                    })

                } else {
                    if (tventa.trim() == "Con crédito") {
                        verificaContrato();
                    } else {
                        agregaMovi();
                    }

                }

            } else {
                Swal.fire({
                    icon: 'question',
                    text: 'Por favor complete los datos',

                })
            }



        } else {

            if (marca != "" && modelo != "" && color != "" && numpas != "" && precio != "" && tventa != "" && contacto != "") {
                if (tventa.trim() == "Con crédito") {
                    verificaContrato();
                } else {
                    agregaMovi();
                }

            } else {
                Swal.fire({
                    icon: 'question',
                    text: 'Por favor complete los datos',
                    customClass: 'swal-wide',
                })
            }

        }

        function agregaMovi() {
            indiceT++;
            document.getElementById('idtablabusM').style.display = 'block';
            // document.getElementById('tablaVehiculo').style.display='block';
            var tabla = document.getElementById("tablaVehiculo");
            var rowCount = $('#tablaVehiculo tr').length;
            console.log(rowCount);
            var row = tabla.insertRow(rowCount);
            //this adds row in 0 index i.e. first place
            var col = row.insertCell(0);
            if (tventa.trim() == "Con crédito") {
                col.innerHTML = marca + " - " + modelo + " color " + color + " #pas. " +
                    numpas + " a " + precio + " $" + " " + "<br>" + "-" + tventa + "" + " - Conyuge: " + contacto +
                    '&nbsp;&nbsp;<button type="button" class="btn botonElimina" id="idquitaV" name="quitaV"><i class="far fa-trash-alt"></i></button>';

            } else {
                col.innerHTML = marca + " - " + modelo + " color " + color + " con cap. " +
                    numpas + " a " + precio + " $" + " " + "<br>" + "-" + tventa +
                    '&nbsp;&nbsp;<button type="button" class="btn botonElimina" id="idquitaV" name="quitaV" ><i class="far fa-trash-alt"></i></button>';
            }
            vehiculo.push(marca);
            vehiculo.push(modelo);
            vehiculo.push(tipo);
            vehiculo.push(color);
            vehiculo.push(numpas);
            vehiculo.push(cilindrada);
            vehiculo.push(precio);
            vehiculo.push(tventa);
            vehiculo.push(contacto);
            vehiculo.push(ruat);
            vehiculo.push(poliza);
            vehiculo.push(soat);
            vehiculo.push(placa);
            vehiculo.push(transito);
            matrizVehiculos.splice(indice++, 0, { vehiculo });
            vehiculo = [];
            console.log(matrizVehiculos);
            $("#marca_selec").val($("#marca_selec").data("Seleccionar"));
            $("#modelo_selec").val($("#modelo_selec").data("Seleccionar"));
            $("#color_selec").val($("#color_selec").data("Seleccionar"));
            $("#numpas_selec").val($("#numpas_selec").data("Seleccionar"));
            $("#cilindrada_selec").val($("#cilindrada_selec").data("Seleccionar"));
            $("#precio_selec").val($("#precio_selec").data("Seleccionar"));
            $("#tipoVenta_selec").val($("#tipoVenta_selec").data("Seleccionar"));
            $("#precio_autoOtro").val($("#precio_autoOtro").data(""));
            $("#cilindrada_autoOtro").val($("#cilindrada_autoOtro").data(""));
            $('#precio_autoOtro').prop('disabled', true);
            $("#idContacto").val($("#idContacto").data(""));
            $('#idContacto').prop('disabled', true);
            $('#idCheckRuat').prop('checked', false);
            $('#idCheckPoliza').prop('checked', false);
            $('#idCheckSoat').prop('checked', false);
            $('#idCheckPlaca').prop('checked', false);
            $('#idCheckTransito').prop('checked', false);

        }

        function verificaEnMatriz() {
            for (let i = 0; i < matrizVehiculos.length; i++) {
                var rev = Object.values(matrizVehiculos[i]);
                var arr = Object.values(rev[0]);
                if (arr[0] === marca && arr[1] === modelo && arr[2] === color) {
                    return true;
                }

            }
            return false;
        }

        function verificaContrato() {
            var idC = document.getElementById("id_cliente").value;
            $.ajax({
                url: '../scripts/verificaContrato.php',
                type: 'POST',
                data: {
                    "cliente": idC
                },
                dataType: "JSON",
                async: false,
            }).done(function(res) {
                if (Object.keys(res).length > 0) {
                    for (x of res) {
                        i++;
                    }
                    console.log(i);
                    console.log(indiceT);
                    if (indiceT < i) {
                        let arrayPrecios = [];
                        for (x of res) {
                            var precioT = x.precio;
                            arrayPrecios.push(precioT);
                        }
                        for (x of res) {
                            if (precio.trim() == x.precio) {
                                verificadorPrecio = 1;
                            }
                        }
                        console.log(arrayPrecios);
                        console.log(verificadorPrecio);
                        if (verificadorPrecio == 0) {
                            Swal.fire({
                                title: 'Esta segur@?',
                                text: "El precio no corresponde al (los) del trámite, debe ser " + arrayPrecios,
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Si, segur@!'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    agregaMovi();
                                }
                            })
                        } else {
                            agregaMovi();
                            i = 0;
                        }
                    } else {
                        alert("No puede agregar más ventas de tipo con trámite");
                    }
                } else {
                    Swal.fire({
                        title: 'Error',
                        text: "El cliente no tiene un trámite o no firmó el contrato!",
                        icon: 'error',
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ok!'
                    }).then((result) => {
                        if (result.isConfirmed) {}
                    })

                }
            });
        }



        $(document).on('click', '#idquitaV', function(event) {
            event.preventDefault();
            var index = $(this).closest("tr").index();
            $(this).closest("tr").remove();
            matrizVehiculos.splice(index, 1);
            console.log(index);
            console.log(matrizVehiculos);
            indiceT--;
        });



    }
});