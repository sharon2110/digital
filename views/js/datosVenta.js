$(document).ready(function() {
    var indice = 0;
    var index;
    var idventa = document.getElementById("id_venta").value;
    var matrizVehiculos = [];
    var vehiculo = [];
    var verificadorPrecio = 0;
    var indiceT = 0; // contador de vehiculos agregados con tramite
    var i = 0; //contador de vehiculos en el tramite
    datosVenta();

    function datosVenta() {
        $.ajax({
            url: '../scripts/datosVenta.php',
            type: 'POST',
            data: { "idventa": idventa },
            dataType: "JSON",

        }).done(function(res) {
            console.log(res);
            // DATOS CLIENTE
            var tablaC = document.getElementById("tablaCliente");
            $("#tablaCliente tr").remove();
            var row = tablaC.insertRow(0);
            //this adds row in 0 index i.e. first place
            var colC = row.insertCell(0);
            var nombre = res[0]['paterno'] + " " + res[0]['materno'] + " " + res[0]['nombre'];
            document.getElementById('idtablabusCI').style.display = 'block';
            colC.innerHTML = nombre + " " + '&nbsp;&nbsp;<button type="button" class="btn botonElimina" id="idquitaCI" name="quitaCI"><i class="far fa-trash-alt fa-xs"></i></button>';
            document.getElementById('id_cliente').value = res[0]['idcliente'];
            //$("#info_banco").val(res[0]["banco"]);
            //$("#monto_pres").val(res[0]["monto_prestamo"]);
            var i;
            // DATOS VEHICULOS
            for (i = 1; i <= res.length - 1; i++) {
                vehiculo.push(res[i]["marca"]);
                vehiculo.push(res[i]["modelo"]);
                vehiculo.push(res[i]["tipo"]);
                vehiculo.push(res[i]["color"]);
                vehiculo.push(res[i]["nump"]);
                vehiculo.push(res[i]["cilindrada"]);
                vehiculo.push(res[i]["precio"]);
                vehiculo.push(res[i]["tipo_venta"]);
                vehiculo.push(res[i]["contacto"]);
                vehiculo.push(res[i]["ruat"]);
                vehiculo.push(res[i]["poliza"]);
                vehiculo.push(res[i]["soat"]);
                vehiculo.push(res[i]["placa"]);
                vehiculo.push(res[i]["resolucion"]);
                matrizVehiculos.splice(indice, 0, { vehiculo });
                indice++;
                vehiculo = [];
                document.getElementById('idtablabusM').style.display = 'block';
                var tabla = document.getElementById("tablaVehiculo");
                var rowCount = $('#tablaVehiculo tr').length;
                console.log(rowCount);
                var row = tabla.insertRow(rowCount);
                //this adds row in 0 index i.e. first place
                var col = row.insertCell(0);
                col.style.textAlign = "center";
                col.innerHTML = "" + res[i]["marca"] + " - " + res[i]["modelo"] + " color " +
                    res[i]["color"] + " con cap. " +
                    res[i]["nump"] + " a " + res[i]["precio"] + " $" +
                    '&nbsp;&nbsp;<button type="button" class="btn botonElimina" id="idquitaV" name="quitaV" ><i class="far fa-trash-alt"></i></button>' +
                    '&nbsp;&nbsp;<button type="button" class="btn botonEdita btn-secondary" id="ideditaV" name="editaV" ><i class="fas fa-edit "></i></button>';

            }
            //DATOS ASESOR
            $('#asesorid').val(res[0][2]);
            $('#observacionid').val(res[0]["observaciones"]);
        });
    }
    //OPCIONES VEHICULO
    $(document).on('click', '#idquitaV', function(event) {
        index = $(this).closest("tr").index();
        console.log(index);
        $(this).closest("tr").remove();
        matrizVehiculos.splice(index, 1);
        console.log(matrizVehiculos);
        actualizarVenta();

    });
    $(document).on('click', '#ideditaV', function(event) {
        index = $(this).closest("tr").index();
        $('#modalV').modal('hide');
        $('#modalVE').modal('show'); // abrir
        var auxi = Object.values(matrizVehiculos[index]);
        $('#marcaid').val(auxi[0][0]);
        $('#modeloid').val(auxi[0][1]);
        $('#tipoid').val(auxi[0][2]);
        $('#colorid').val(auxi[0][3]);
        $('#numpasid').val(auxi[0][4]);
        $('#cilid').val(auxi[0][5]);
        $('#precioid').val(auxi[0][6]);
        $('#tipoVenta_selecid').val(auxi[0][7]);
        if (auxi[0][6] !== "Al contado") {
            $('#contactoid').prop('disabled', false);
            $('#contactoid').val(auxi[0][7]);
        }
        if (auxi[0][8] == "si") {
            $('#CheckRuatid').prop("checked", true);
        }
        if (auxi[0][9] == "si") {
            $('#CheckPolizaid').prop("checked", true);
        }
        if (auxi[0][10] == "si") {
            $('#CheckSoatid').prop("checked", true);
        }
        if (auxi[0][11] == "si") {
            $('#CheckPlacaid').prop("checked", true);
        }
        if (auxi[0][12] == "si") {
            $('#CheckTransitoid').prop("checked", true);
        }
        var botonaddAuto = document.getElementById('idEditVe');
        botonaddAuto.addEventListener('click', editarVehiculo, true);

        function editarVehiculo() {
            if (auxi[0][5] !== "Al contado") {
                indiceT--;
            }
            var marcan = document.getElementById("marcaid").value;
            var modelon = document.getElementById("modeloid").value;
            var tipon = document.getElementById("tipoid").value;
            var colorn = document.getElementById("colorid").value;
            var numpasn = document.getElementById("numpasid").value;
            var ciln = document.getElementById("cilid").value;
            var precion = document.getElementById("precioid").value;
            var tventan = document.getElementById("tipoVenta_selecid").value;
            if (tventan !== "Al contado") {
                var contacton = document.getElementById("contactoid").value;
            } else {
                var contacton = "No necesario";
            }
            var ruatn = document.getElementById("CheckRuatid").checked;
            var polizan = document.getElementById("CheckPolizaid").checked;
            var soatn = document.getElementById("CheckSoatid").checked;
            var placan = document.getElementById("CheckPlacaid").checked;
            var resolucionn = document.getElementById("CheckTransitoid").checked;
            vehiculo = [];
            vehiculo.push(marcan);
            vehiculo.push(modelon);
            vehiculo.push(tipon);
            vehiculo.push(colorn);
            vehiculo.push(numpasn);
            vehiculo.push(ciln);
            vehiculo.push(precion);
            vehiculo.push(tventan);
            vehiculo.push(contacton);
            vehiculo.push(ruatn);
            vehiculo.push(polizan);
            vehiculo.push(soatn);
            vehiculo.push(placan);
            vehiculo.push(resolucionn);
            console.log(index);
            //$(this).closest("tr").remove();
            //matrizVehiculos.splice(index, 1);
            matrizVehiculos.splice(index, 1, { vehiculo });
            console.log(matrizVehiculos);
            vehiculo = [];
            if (tventan !== "Al contado") {
                verificaContratoEdita();
            } else {
                actualizarVenta();
            }



        }
    });
    $('#tipoVenta_selecid').change(function(e) {

        if (($(this).val()).trim() === "Con crédito") {
            $('#contactoid').prop('disabled', false);
        } else {
            $('#contactoid').prop('disabled', true);
        }
    });
    $('#tipoVenta_selec').change(function(e) {

        if (($(this).val()).trim() === "Con crédito") {
            $('#idContacto').prop('disabled', false);
        } else {
            $('#idContacto').prop('disabled', true);
        }
    });

    var botonaddAuto = document.getElementById('idAddAuto');
    botonaddAuto.addEventListener('click', insertarFila, true);

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
                console.log(marca);
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
            document.getElementById('idtablabusM').style.display = 'block';
            // document.getElementById('tablaVehiculo').style.display='block';
            var tabla = document.getElementById("tablaVehiculo");
            var rowCount = $('#tablaVehiculo tr').length;
            var row = tabla.insertRow(rowCount);
            //this adds row in 0 index i.e. first place
            var col = row.insertCell(0);
            col.style.textAlign = "center";
            col.innerHTML = "Vehiculo: " + marca + " - " + modelo + " color " + color + " con cap. " +
                numpas + " a " + precio + " $" +
                '&nbsp;&nbsp;<button type="button" class="btn botonElimina" id="idquitaV" name="quitaV" ><i class="far fa-trash-alt"></i></button>';
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
            actualizarVenta();

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

    }
    // EDITAR VEHICULO

    function verificaContratoEdita() {
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
                                actualizarVenta();
                            }
                        })
                    } else {
                        actualizarVenta();
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
                    setTimeout(function() {
                        location.reload();
                    }, 1600);
                    if (result.isConfirmed) {}
                })

            }
        });
    }


    function actualizarVenta(evento) {
        var cliente = document.getElementById("id_cliente").value;
        var asesor = document.getElementById("asesorid").value;
        var obs = document.getElementById("observacionid").value;
        var venta = document.getElementById("id_venta").value;
        if (cliente !== "" && matrizVehiculos.length > 0 && obs !== "") {
            $.ajax({
                url: '../scripts/editarVenta.php',
                type: 'POST',
                data: {
                    "cliente": cliente,
                    "vehiculos": matrizVehiculos,
                    "asesor": asesor,
                    "obs": obs,
                    "venta": venta,
                },
                async: false,
            }).done(function(res) {
                console.log(res);
                if (res.trim() == "Registrado") {
                    Swal.fire({

                        position: 'center',
                        icon: 'success',
                        title: 'Cambios guardados',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    setTimeout(function() {
                        location.reload();
                    }, 1600);
                }

            });
        } else {
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'Falta el cliente, vehiculo u observacion',
                showConfirmButton: false,
                timer: 1500
            });
        }

    }

    document.getElementById("idbuscaCi").addEventListener('click', function() {
        var cliente = document.getElementById("inputCi").value;
        if (cliente == "") {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'No hay datos para la búsqueda!',
            })
            $("#modalCliente").modal("hide");
            document.getElementById('idtablabusCI').style.display = 'none';
            document.getElementById('inputCi').style.display = 'block';
            document.getElementById('inputCi').value = "";
            document.getElementById('idbtnAdCliente').style.display = 'inline-block';
        } else {
            $.ajax({
                url: '../scripts/buscaClienteVenta-Tramite.php',
                type: 'GET',
                data: {
                    "cliente": cliente
                },
                dataType: "JSON"

            }).done(function(res) {
                var lon = 0;
                res.forEach(function(value, index) {
                    lon++;
                });

                var tablaC = document.getElementById("tablaCliente");
                $("#tablaCliente tr").remove();

                var row = tablaC.insertRow(0);
                //this adds row in 0 index i.e. first place
                var colC = row.insertCell(0);

                if (lon > 0) {
                    res.forEach(function(value, index) {
                        var idcliente = res[index]['idcliente'];
                        var nombre = res[index]['paterno'] + " " + res[index]['materno'] + " " + res[index]['nombre'];
                        document.getElementById('idtablabusCI').style.display = 'block';
                        document.getElementById('idbtnAdCliente').style.display = 'none';
                        document.getElementById('inputCi').style.display = 'none';
                        document.getElementById('inputCi').value = "";
                        colC.innerHTML = "&nbsp;" + nombre + " " + " " + "&nbsp;" +
                            '   <button type="button" class="btn botonElimina" id="idquitaCI" name="quitaV"><i class="far fa-trash-alt fa-xs"></i></button>';
                        $("#inputCi").val($("#inputCi_selec").data(""));
                        $("#modalCliente").modal("hide");
                        document.getElementById('id_cliente').value = res[index]['idcliente'];
                    });

                } else {
                    document.getElementById('idtablabusCI').style.display = 'none';
                    $("#modalCliente").modal("hide");
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'No se encontró al cliente!',
                    })
                    document.getElementById('id_cliente').value = "";
                    document.getElementById('inputCi').style.display = 'block';
                    document.getElementById('inputCi').value = "";
                    document.getElementById('idbtnAdCliente').style.display = 'inline-block';
                }

            });
        }



    }, true);

    $(document).on('click', '#idquitaCI', function(event) {
        event.preventDefault();
        $(this).closest('tr').remove();
        document.getElementById("idbtnAdCliente").removeAttribute("hidden");
        document.getElementById('idtablabusCI').style.display = 'none';
        document.getElementById('idbtnAdCliente').style.display = 'inline';
        document.getElementById('inputCi').style.display = 'block';
        document.getElementById('inputCi').value = "";
        $("#btnModalAuto").hide(); //Ocultar DIV
        //document.getElementById('idtablabusM').style.display = 'none';
        //matrizVehiculos = [];
        //$("#tablaVehiculo tr").remove();
        document.getElementById('id_cliente').value = "";
    });
    $(document).on('click', '#boton_guardar_id', function(event) {
        event.preventDefault();
        actualizarVenta();
    });


})