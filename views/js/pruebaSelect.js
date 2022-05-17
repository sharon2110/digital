$(document).ready(function() {
    var indice = 0;
    var idtramite = document.getElementById("id_tramite").value;
    var matrizVehiculos = [];
    var vehiculo = [];
    $.ajax({
        url: '../scripts/datosTramite.php',
        type: 'POST',
        data: { "idtramite": idtramite },
        dataType: "JSON"

    }).done(function(res) {
        var tablaC = document.getElementById("tablaCliente");
        $("#tablaCliente tr").remove();
        var row = tablaC.insertRow(0);
        //this adds row in 0 index i.e. first place
        var colC = row.insertCell(0);
        var nombre = res[0]['paterno'] + " " + res[0]['materno'] + " " + res[0]['nombre'];
        document.getElementById('idtablabusCI').style.display = 'block';
        colC.innerHTML = "Cliente: " + nombre + " ";
        $("#info_banco").val(res[0]["banco"]);
        $("#monto_pres").val(res[0]["monto_prestamo"]);
        $("#estado_selec").val(res[1]["idestado"]);
        var i;
        for (i = 2; i <= res.length - 1; i++) {
            vehiculo.push(res[i]["marca"]);
            vehiculo.push(res[i]["modelo"]);
            vehiculo.push(res[i]["color"]);
            vehiculo.push(res[i]["nump"]);
            vehiculo.push(res[i]["precio"]);
            matrizVehiculos.splice(indice, 0, { vehiculo });
            indice++;
            vehiculo = [];
            document.getElementById('idtablabusM').style.display = 'block';
            var tabla = document.getElementById("tablaVehiculo");
            var rowCount = $('#tablaVehiculo tr').length;
            var row = tabla.insertRow(rowCount);
            //this adds row in 0 index i.e. first place
            var col = row.insertCell(0);
            col.style.textAlign = "center";
            col.innerHTML = "Vehiculo: " + res[i]["marca"] + " - " + res[i]["modelo"] + " color " +
                res[i]["color"] + " con cap. " +
                res[i]["nump"] + " a " + res[i]["precio"] + " $" +
                '&nbsp;&nbsp;<button type="button" class="btn botonElimina" id="idquitaV" name="quitaV" ><i class="far fa-trash-alt"></i></button>';
        }
        $(document).on('click', '#idquitaV', function(event) {
            var index = $(this).closest("tr").index();
            $(this).closest("tr").remove();
            matrizVehiculos.splice(index, 1);
        });
        var botonaddAuto = document.getElementById('idAddAuto');
        botonaddAuto.addEventListener('click', insertarFila, true);

        function insertarFila() {
            var marca = document.getElementById('marca_selec').value;
            var modelo = document.getElementById('modelo_selec').value;
            var color = document.getElementById('color_selec').value;
            var numpas = document.getElementById('numpas_selec').value;
            var precio = document.getElementById('precio_selec').value;

            if (precio.trim() == "Otro") {
                precio = document.getElementById('precio_autoOtro').value;

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
                vehiculo.push(color);
                vehiculo.push(numpas);
                vehiculo.push(precio);
                matrizVehiculos.splice(indice++, 0, { vehiculo });
                vehiculo = [];
                console.log(matrizVehiculos);

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

            if (matrizVehiculos.length > 0) {
                if (marca != "" && modelo != "" && color != "" && numpas != "" && precio != "") {
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
                                agregaMovi();
                            }
                            $("#marca_selec").val($("#marca_selec").data("Seleccionar"));
                            $("#modelo_selec").val($("#modelo_selec").data("Seleccionar"));
                            $("#color_selec").val($("#color_selec").data("Seleccionar"));
                            $("#numpas_selec").val($("#numpas_selec").data("Seleccionar"));
                            $("#precio_selec").val($("#precio_selec").data("Seleccionar"));
                            $("#precio_autoOtro").val($("#precio_autoOtro").data(""));
                            $('#precio_autoOtro').prop('disabled', true);
                        })

                    } else {
                        agregaMovi();
                        $("#marca_selec").val($("#marca_selec").data("Seleccionar"));
                        $("#modelo_selec").val($("#modelo_selec").data("Seleccionar"));
                        $("#color_selec").val($("#color_selec").data("Seleccionar"));
                        $("#numpas_selec").val($("#numpas_selec").data("Seleccionar"));
                        $("#precio_selec").val($("#precio_selec").data("Seleccionar"));
                        $("#precio_autoOtro").val($("#precio_autoOtro").data(""));
                        $('#precio_autoOtro').prop('disabled', true);
                    }

                } else {
                    Swal.fire(
                        'Faltan datos',
                        'Por favor complete todos los campos',
                        'question'
                    )
                }



            } else {
                if (marca != "" && modelo != "" && color != "" && numpas != "" && precio != "") {

                    agregaMovi();
                    $("#marca_selec").val($("#marca_selec").data("Seleccionar"));
                    $("#modelo_selec").val($("#modelo_selec").data("Seleccionar"));
                    $("#color_selec").val($("#color_selec").data("Seleccionar"));
                    $("#numpas_selec").val($("#numpas_selec").data("Seleccionar"));
                    $("#precio_selec").val($("#precio_selec").data("Seleccionar"));
                    $("#precio_autoOtro").val($("#precio_autoOtro").data(""));
                    $('#precio_autoOtro').prop('disabled', true);

                } else {
                    Swal.fire(
                        'Faltan datos',
                        'Por favor complete todos los campos',
                        'question'
                    )
                }

            }
        }
        //------------------------------VISUALIZACION DE EXPEDIENTE------------------------------------------//
        $.ajax({
            url: '../scripts/datosFolderTramite.php',
            type: 'POST',
            data: { "idtramite": idtramite },
            dataType: "JSON"

        }).done(function(res) {
            if (res[0]["contrato"] != null) {
                document.getElementById("perfilCContrato").style.border = "none";
                document.getElementById("iconoCContrato").style.display = "none";
                document.querySelector(".fotoCContrato").style.display = "block";
                $('.fotoCContrato').attr("src", res[0]["contrato"]);
            } else {
                document.getElementById("quitaCContrato").disabled = true;
            }
            if (res[0]["fotcarnet"] != null) {
                document.getElementById("perfilCCarnet").style.border = "none";
                document.getElementById("iconoCCarnet").style.display = "none";
                document.querySelector(".fotoCCarnet").style.display = "block";
                $('.fotoCCarnet').attr("src", res[0]["fotcarnet"]);
            } else {
                document.getElementById("quitaCCarnet").disabled = true;
            }
            if (res[0]["facluz"] != null) {
                document.getElementById("perfilCFacLuz").style.border = "none";
                document.getElementById("iconoCFacLuz").style.display = "none";
                document.querySelector(".fotoCFacLuz").style.display = "block";
                $('.fotoCFacLuz').attr("src", res[0]["facluz"]);
            } else {
                document.getElementById("quitaCFacLuz").disabled = true;
            }
            if (res[0]["facagua"] != null) {
                document.getElementById("perfilCFacAgua").style.border = "none";
                document.getElementById("iconoCFacAgua").style.display = "none";
                document.querySelector(".fotoCFacAgua").style.display = "block";
                $('.fotoCFacAgua').attr("src", res[0]["facagua"]);
            } else {
                document.getElementById("quitaCFacAgua").disabled = true;
            }
            if (res[0]["croquis"] != null) {
                document.getElementById("perfilCCroquis").style.border = "none";
                document.getElementById("iconoCCroquis").style.display = "none";
                document.querySelector(".fotoCCroquis").style.display = "block";
                $('.fotoCCroquis').attr("src", res[0]["croquis"]);
            } else {
                document.getElementById("quitaCCroquis").disabled = true;
            }
            if (res[0]["folio"] != null) {
                document.getElementById("perfilCFolioReal").style.border = "none";
                document.getElementById("iconoCFolioReal").style.display = "none";
                document.querySelector(".fotoCFolioReal").style.display = "block";
                $('.fotoCFolioReal').attr("src", res[0]["folio"]);
            } else {
                document.getElementById("quitaCFolio").disabled = true;
            }
            if (res[0]["testimonio"] != null) {
                document.getElementById("perfilCTestimonio").style.border = "none";
                document.getElementById("iconoCTestimonio").style.display = "none";
                document.querySelector(".fotoCTestimonio").style.display = "block";
                $('.fotoCTestimonio').attr("src", res[0]["testimonio"]);
            } else {
                document.getElementById("quitaCTestimonio").disabled = true;
            }
            if (res[0]["impuesto"] != null) {
                document.getElementById("perfilCImpuesto").style.border = "none";
                document.getElementById("iconoCImpuesto").style.display = "none";
                document.querySelector(".fotoCImpuesto").style.display = "block";
                $('.fotoCImpuesto').attr("src", res[0]["impuesto"]);
            } else {
                document.getElementById("quitaCImpuesto").disabled = true;
            }
            if (res[0]["ruat"] != null) {
                document.getElementById("perfilCRuat").style.border = "none";
                document.getElementById("iconoCRuat").style.display = "none";
                document.querySelector(".fotoCRuat").style.display = "block";
                $('.fotoCRuat').attr("src", res[0]["ruat"]);
            } else {
                document.getElementById("quitaCRuat").disabled = true;
            }
            if (res[0]["soat"] != null) {
                document.getElementById("perfilCSoat").style.border = "none";
                document.getElementById("iconoCSoat").style.display = "none";
                document.querySelector(".fotoCSoat").style.display = "block";
                $('.fotoCSoat').attr("src", res[0]["soat"]);
            } else {
                document.getElementById("quitaCSoat").disabled = true;
            }
            if (res[0]["nit"] != null) {
                document.getElementById("perfilCNit").style.border = "none";
                document.getElementById("iconoCNit").style.display = "none";
                document.querySelector(".fotoCNit").style.display = "block";
                $('.fotoCNit').attr("src", res[0]["nit"]);
            } else {
                document.getElementById("quitaCNit").disabled = true;
            }
            if (res[0]["boletapago"] != null) {
                document.getElementById("perfilCBoletaPago").style.border = "none";
                document.getElementById("iconoCBoletaPago").style.display = "none";
                document.querySelector(".fotoCBoletaPago").style.display = "block";
                $('.fotoCBoletaPago').attr("src", res[0]["boletapago"]);
            } else {
                document.getElementById("quitaCBoletaPago").disabled = true;
            }
            if (res[0]["patente"] != null) {
                document.getElementById("perfilCPatente").style.border = "none";
                document.getElementById("iconoCPatente").style.display = "none";
                document.querySelector(".fotoCPatente").style.display = "block";
                $('.fotoCPatente').attr("src", res[0]["patente"]);
            } else {
                document.getElementById("quitaCPatente").disabled = true;
            }
            if (res[0]["afp"] != null) {
                document.getElementById("perfilCAfp").style.border = "none";
                document.getElementById("iconoCAfp").style.display = "none";
                document.querySelector(".fotoCAfp").style.display = "block";
                $('.fotoCAfp').attr("src", res[0]["afp"]);
            } else {
                document.getElementById("quitaCAfp").disabled = true;
            }
            //----------------------------VISUALIZACION DE LA LISTA DE DOC. CLIENTE-------------------------//

            //--------------------FOLDER GARANTE---------------------------------//

            //----------------------------VISUALIZACION DE LA LISTA DE DOC. GARANTE-------------------------//

            //---------------------FOLDER DEUDA CLIENTE--------------------------------////
            var idfolderC = res[0]["idfolder"];
            var idfolderG = res[1]["idfolder"];
            var p = "P";
            $.ajax({
                url: '../scripts/datosDeudaFolder.php',
                type: 'POST',
                data: { "idfolder": idfolderC },
                dataType: "JSON"

            }).done(function(res) {
                if (res.length > 0) {
                    $("#select_banco_cfolder1").val(res[0]["banco"]);
                    p = res[0]["banco"];
                }
                console.log(p);
            });
            console.log(p);
            //-------------------------FOLDER DEUDA GARANTE-------------------------//
            //------------------------LISTADO DEUDA CLIENTE--------------------------------//
            //------------------------LISTADO DEUDA GARANTE--------------------------------//

        })
    })

})