$(document).ready(function() {
    var indice = 0;
    var vehiculo = [];
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
                '&nbsp;&nbsp;<button type="button" class="btn botonElimina" id="idquitaV" name="quitaV" ><i class="far fa-trash-alt fa-xs"></i></button>';
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

    $(document).on('click', '#idquitaV', function(event) {
        event.preventDefault();
        var index = $(this).closest("tr").index();
        $(this).closest("tr").remove();
        matrizVehiculos.splice(index, 1);
        console.log(index);
        console.log(matrizVehiculos);
    });



});