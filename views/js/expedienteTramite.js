$(document).ready(function() {
    imagenes();
    var indice = 0;
    var index;
    var idcliente = document.getElementById("id_cliente").value;
    var idusuario = document.getElementById("id_usuario").value;
    var matrizVehiculos = [];
    var botonaddAuto = document.getElementById('idAddAuto');
    botonaddAuto.addEventListener('click', insertarFila, true);
    var vehiculo = [];



    function insertarFila() {
        var marca = document.getElementById('marca_selec').value;
        var modelo = document.getElementById('modelo_selec').value;
        var tipo = document.getElementById('tipo_selec').value;
        var color = document.getElementById('color_selec').value;
        var numpas = document.getElementById('numpas_selec').value;
        var cilindrada = document.getElementById('cilindrada_selec').value;
        var precio = document.getElementById('precio_selec').value;

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

        function agregaMovi() {
            document.getElementById('idtablabusM').style.display = 'block';
            // document.getElementById('tablaVehiculo').style.display='block';
            var tabla = document.getElementById("tablaVehiculo");
            var rowCount = $('#tablaVehiculo tr').length;
            var row = tabla.insertRow(rowCount);
            //this adds row in 0 index i.e. first place
            var col = row.insertCell(0);
            col.style.textAlign = "center";
            col.innerHTML = marca + " - " + modelo + " color " + color + " con cap. " +
                numpas + " a " + precio + " $" +
                '&nbsp;&nbsp;<button type="button" class="btn botonElimina" id="idquitaV" name="quitaV" ><i class="far fa-trash-alt fa-xs"></i></button>';
            vehiculo.push(marca);
            vehiculo.push(modelo);
            vehiculo.push(tipo);
            vehiculo.push(color);
            vehiculo.push(numpas);
            vehiculo.push(cilindrada);
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
                        $("#modelo_selec").val($("#modelo_selec").data("Seleccionar"));
                        $("#modelo_autoOtro").val($("#modelo_autoOtro").data(""));
                        $("#tipo_selec").val($("#tipo_selec").data("Seleccionar"));
                        $("#tipo_autoOtro").val($("#tipo_autoOtro").data(""));
                        $("#color_selec").val($("#color_selec").data("Seleccionar"));
                        $("#color_autoOtro").val($("#color_autoOtro").data(""));
                        $("#cilindrada_selec").val($("#cilindrada_selec").data("Seleccionar"));
                        $("#cilindrada_autoOtro").val($("#cilindrada_autoOtro").data(""));
                        $('#precio_autoOtro').prop('disabled', true);
                        $('#modelo_autoOtro').prop('disabled', true);
                        $('#color_autoOtro').prop('disabled', true);
                        $('#cilindrada_autoOtro').prop('disabled', true);
                    })

                } else {
                    agregaMovi();
                    $("#marca_selec").val($("#marca_selec").data("Seleccionar"));
                    $("#modelo_selec").val($("#modelo_selec").data("Seleccionar"));
                    $("#color_selec").val($("#color_selec").data("Seleccionar"));
                    $("#numpas_selec").val($("#numpas_selec").data("Seleccionar"));
                    $("#precio_selec").val($("#precio_selec").data("Seleccionar"));
                    $("#precio_autoOtro").val($("#precio_autoOtro").data(""));
                    $("#modelo_selec").val($("#modelo_selec").data("Seleccionar"));
                    $("#modelo_autoOtro").val($("#modelo_autoOtro").data(""));
                    $("#tipo_selec").val($("#tipo_selec").data("Seleccionar"));
                    $("#tipo_autoOtro").val($("#tipo_autoOtro").data(""));
                    $("#color_selec").val($("#color_selec").data("Seleccionar"));
                    $("#color_autoOtro").val($("#color_autoOtro").data(""));
                    $("#cilindrada_selec").val($("#cilindrada_selec").data("Seleccionar"));
                    $("#cilindrada_autoOtro").val($("#cilindrada_autoOtro").data(""));
                    $('#precio_autoOtro').prop('disabled', true);
                    $('#modelo_autoOtro').prop('disabled', true);
                    $('#color_autoOtro').prop('disabled', true);
                    $('#cilindrada_autoOtro').prop('disabled', true);
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
                $("#modelo_selec").val($("#modelo_selec").data("Seleccionar"));
                $("#modelo_autoOtro").val($("#modelo_autoOtro").data(""));
                $("#tipo_selec").val($("#tipo_selec").data("Seleccionar"));
                $("#tipo_autoOtro").val($("#tipo_autoOtro").data(""));
                $("#color_selec").val($("#color_selec").data("Seleccionar"));
                $("#color_autoOtro").val($("#color_autoOtro").data(""));
                $("#cilindrada_selec").val($("#cilindrada_selec").data("Seleccionar"));
                $("#cilindrada_autoOtro").val($("#cilindrada_autoOtro").data(""));
                $('#precio_autoOtro').prop('disabled', true);
                $('#modelo_autoOtro').prop('disabled', true);
                $('#color_autoOtro').prop('disabled', true);
                $('#cilindrada_autoOtro').prop('disabled', true);

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
        index = $(this).closest("tr").index();
        $(this).closest("tr").remove();
        matrizVehiculos.splice(index, 1);
        console.log(matrizVehiculos);
        registrarTramite();
    });

    function imagenes() {
        //VISUALIZACION DE IMAGENES DE CLIENTE
        let perfilC1 = document.getElementById("perfilCCarnet");
        let iconoC1 = document.getElementById("iconoCCarnet");
        let imgSubidaC1 = document.querySelector(".fotoCCarnet");
        perfilC1.onclick = function() {
            let subirImgC1 = document.getElementById("subirImgCCarnet");

            subirImgC1.onchange = function(evento) {

                //Creamos un objeto con la clase FileReader
                let reader = new FileReader();

                //Leemos el archivo subido y se lo pasamos a nuestro filereader

                reader.readAsDataURL(evento.target.files[0]);
                if (evento.target.files[0]['type'] != "image/png" &&
                    evento.target.files[0]['type'] != "image/jpg" &&
                    evento.target.files[0]['type'] != "image/jpeg") {
                    alert("Elija una imagen");

                } else {
                    if (evento.target.files[0]['size'] > 3000000) {
                        alert("El peso debe ser hasta 3MB ");
                    } else {
                        reader.onload = function() {

                            iconoC1.style.display = "none";
                            perfilC1.style.border = "none";

                            //Asignamos la foto cargada
                            imgSubidaC1.style.display = "block";

                            imgSubidaC1.src = reader.result;
                            document.getElementById("quitaCCarnet").disabled = false;

                        }
                    }
                    //Cuando este listo ejecute lo siguiente

                }

            }
            subirImgC1.click();

        };
        let quitaC2 = document.getElementById("quitaCCarnet");
        quitaC2.onclick = function() {
            Swal.fire({
                title: 'Esta segur@?',
                text: "Se quitará la imagen",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si,quitar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    imgSubidaC1.src = null;
                    imgSubidaC1.style.display = "none";
                    iconoC1.style.display = "block";
                    document.getElementById("quitaCCarnet").disabled = true;
                    if (estaEnImagenes(vectorImaC, "carnet")) {
                        var auxi = [];
                        for (var i = 0; i < vectorImaC.length; i++) {
                            if (vectorImaC[i] !== "carnet") {
                                auxi.splice(i, 0, vectorImaC[i]);
                            }
                        }
                        vectorImaC = auxi;
                        indiceVecImaC = indiceVecImaC++;
                    }
                }
            })

        }
        let perfilC2 = document.getElementById("perfilCFacLuz");
        let iconoC2 = document.getElementById("iconoCFacLuz");
        let imgSubidaC2 = document.querySelector(".fotoCFacLuz");
        perfilC2.onclick = function() {
            let subirImgC2 = document.getElementById("subirImgCFacLuz");
            subirImgC2.onchange = function(evento) {
                //Creamos un objeto con la clase FileReader
                let reader = new FileReader();

                //Leemos el archivo subido y se lo pasamos a nuestro filereader
                reader.readAsDataURL(evento.target.files[0]);
                //Cuando este listo ejecute lo siguiente
                if (evento.target.files[0]['type'] != "image/png" &&
                    evento.target.files[0]['type'] != "image/jpg" &&
                    evento.target.files[0]['type'] != "image/jpeg") {
                    alert("Elija una imagen");

                } else {
                    if (evento.target.files[0]['size'] > 3000000) {
                        alert("El peso debe ser hasta 3MB ");
                    } else {
                        reader.onload = function() {

                            iconoC2.style.display = "none";
                            perfilC2.style.border = "none";
                            //Asignamos la foto cargada
                            imgSubidaC2.style.display = "block";
                            imgSubidaC2.src = reader.result;
                            document.getElementById("quitaCFacLuz").disabled = false;

                        }
                    }
                    //Cuando este listo ejecute lo siguiente

                }
            }
            subirImgC2.click();
        };
        let quitaC3 = document.getElementById("quitaCFacLuz");
        quitaC3.onclick = function() {
            Swal.fire({
                title: 'Esta segur@?',
                text: "Se quitará la imagen",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si,quitar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    imgSubidaC2.src = null;
                    imgSubidaC2.style.display = "none";
                    iconoC2.style.display = "block";
                    document.getElementById("quitaCFacLuz").disabled = true;
                    if (estaEnImagenes(vectorImaC, "luz")) {
                        var auxi = [];
                        for (var i = 0; i < vectorImaC.length; i++) {
                            if (vectorImaC[i] !== "luz") {
                                auxi.splice(i, 0, vectorImaC[i]);
                            }
                        }
                        vectorImaC = auxi;
                        indiceVecImaC = indiceVecImaC++;
                    }
                }
            })
        }
        let perfilC3 = document.getElementById("perfilCFacAgua");
        let iconoC3 = document.getElementById("iconoCFacAgua");
        let imgSubidaC3 = document.querySelector(".fotoCFacAgua");
        perfilC3.onclick = function() {
            let subirImgC3 = document.getElementById("subirImgCFacAgua");
            subirImgC3.onchange = function(evento) {
                //Creamos un objeto con la clase FileReader
                let reader = new FileReader();

                //Leemos el archivo subido y se lo pasamos a nuestro filereader
                reader.readAsDataURL(evento.target.files[0]);
                //Cuando este listo ejecute lo siguiente
                if (evento.target.files[0]['type'] != "image/png" &&
                    evento.target.files[0]['type'] != "image/jpg" &&
                    evento.target.files[0]['type'] != "image/jpeg") {
                    alert("Elija una imagen");

                } else {
                    if (evento.target.files[0]['size'] > 3000000) {
                        alert("El peso debe ser hasta 3MB ");
                    } else {
                        reader.onload = function() {

                            iconoC3.style.display = "none";
                            perfilC3.style.border = "none";
                            //Asignamos la foto cargada
                            imgSubidaC3.style.display = "block";
                            imgSubidaC3.src = reader.result;
                            document.getElementById("quitaCFacAgua").disabled = false;

                        }
                    }
                    //Cuando este listo ejecute lo siguiente

                }
            }
            subirImgC3.click();
        };
        let quitaC4 = document.getElementById("quitaCFacAgua");
        quitaC4.onclick = function() {
            Swal.fire({
                title: 'Esta segur@?',
                text: "Se quitará la imagen",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si,quitar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    imgSubidaC3.src = null;
                    imgSubidaC3.style.display = "none";
                    iconoC3.style.display = "block";
                    document.getElementById("quitaCFacAgua").disabled = true;
                    if (estaEnImagenes(vectorImaC, "agua")) {
                        var auxi = [];
                        for (var i = 0; i < vectorImaC.length; i++) {
                            if (vectorImaC[i] !== "agua") {
                                auxi.splice(i, 0, vectorImaC[i]);
                            }
                        }
                        vectorImaC = auxi;
                        indiceVecImaC = indiceVecImaC++;
                    }
                }
            })
        }
        let perfilC4 = document.getElementById("perfilCCroquis");
        let iconoC4 = document.getElementById("iconoCCroquis");
        let imgSubidaC4 = document.querySelector(".fotoCCroquis");
        perfilC4.onclick = function() {
            let subirImgC4 = document.getElementById("subirImgCCroquis");
            subirImgC4.onchange = function(evento) {
                //Creamos un objeto con la clase FileReader
                let reader = new FileReader();

                //Leemos el archivo subido y se lo pasamos a nuestro filereader
                reader.readAsDataURL(evento.target.files[0]);
                //Cuando este listo ejecute lo siguiente
                if (evento.target.files[0]['type'] != "image/png" &&
                    evento.target.files[0]['type'] != "image/jpg" &&
                    evento.target.files[0]['type'] != "image/jpeg") {
                    alert("Elija una imagen");

                } else {
                    if (evento.target.files[0]['size'] > 3000000) {
                        alert("El peso debe ser hasta 3MB ");
                    } else {
                        reader.onload = function() {

                            iconoC4.style.display = "none";
                            perfilC4.style.border = "none";
                            //Asignamos la foto cargada
                            imgSubidaC4.style.display = "block";
                            imgSubidaC4.src = reader.result;
                            document.getElementById("quitaCCroquis").disabled = false;

                        }
                    }
                    //Cuando este listo ejecute lo siguiente
                }
            }
            subirImgC4.click();
        };
        let quitaC5 = document.getElementById("quitaCCroquis");
        quitaC5.onclick = function() {
            Swal.fire({
                title: 'Esta segur@?',
                text: "Se quitará la imagen",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si,quitar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    imgSubidaC4.src = null;
                    imgSubidaC4.style.display = "none";
                    iconoC4.style.display = "block";
                    document.getElementById("quitaCCroquis").disabled = true;
                    if (estaEnImagenes(vectorImaC, "croquis")) {
                        var auxi = [];
                        for (var i = 0; i < vectorImaC.length; i++) {
                            if (vectorImaC[i] !== "croquis") {
                                auxi.splice(i, 0, vectorImaC[i]);
                            }
                        }
                        vectorImaC = auxi;
                        indiceVecImaC = indiceVecImaC++;
                    }
                }
            })
        }
        let perfilC5 = document.getElementById("perfilCFolioReal");
        let iconoC5 = document.getElementById("iconoCFolioReal");
        let imgSubidaC5 = document.querySelector(".fotoCFolioReal");
        perfilC5.onclick = function() {
            let subirImgC5 = document.getElementById("subirImgCFolioReal");
            subirImgC5.onchange = function(evento) {
                //Creamos un objeto con la clase FileReader
                let reader = new FileReader();

                //Leemos el archivo subido y se lo pasamos a nuestro filereader
                reader.readAsDataURL(evento.target.files[0]);
                //Cuando este listo ejecute lo siguiente
                if (evento.target.files[0]['type'] != "image/png" &&
                    evento.target.files[0]['type'] != "image/jpg" &&
                    evento.target.files[0]['type'] != "image/jpeg") {
                    alert("Elija una imagen");

                } else {
                    if (evento.target.files[0]['size'] > 3000000) {
                        alert("El peso debe ser hasta 3MB ");
                    } else {
                        reader.onload = function() {
                            iconoC5.style.display = "none";
                            perfilC5.style.border = "none";
                            //Asignamos la foto cargada
                            imgSubidaC5.style.display = "block";
                            imgSubidaC5.src = reader.result;
                            document.getElementById("quitaCFolio").disabled = false;
                        }
                    }
                    //Cuando este listo ejecute lo siguiente
                }
            }
            subirImgC5.click();
        };
        let quitaC6 = document.getElementById("quitaCFolio");
        quitaC6.onclick = function() {
            Swal.fire({
                title: 'Esta segur@?',
                text: "Se quitará la imagen",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si,quitar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    console.log("HA")
                    imgSubidaC5.src = null;
                    imgSubidaC5.style.display = "none";
                    iconoC5.style.display = "block";
                    document.getElementById("quitaCFolio").disabled = true;
                    if (estaEnImagenes(vectorImaC, "folio")) {
                        var auxi = [];
                        for (var i = 0; i < vectorImaC.length; i++) {
                            if (vectorImaC[i].trim() !== "folio") {
                                auxi.splice(i, 0, vectorImaC[i]);
                            }
                        }
                        vectorImaC = auxi;
                        indiceVecImaC = indiceVecImaC++;
                    }
                }
            })
        }

        let perfilC6 = document.getElementById("perfilCTestimonio");
        let iconoC6 = document.getElementById("iconoCTestimonio");
        let imgSubidaC6 = document.querySelector(".fotoCTestimonio");
        perfilC6.onclick = function() {
            let subirImgC6 = document.getElementById("subirImgCTestimonio");
            subirImgC6.onchange = function(evento) {
                //Creamos un objeto con la clase FileReader
                let reader = new FileReader();

                //Leemos el archivo subido y se lo pasamos a nuestro filereader
                reader.readAsDataURL(evento.target.files[0]);
                //Cuando este listo ejecute lo siguiente
                if (evento.target.files[0]['type'] != "image/png" &&
                    evento.target.files[0]['type'] != "image/jpg" &&
                    evento.target.files[0]['type'] != "image/jpeg") {
                    alert("Elija una imagen");

                } else {
                    if (evento.target.files[0]['size'] > 3000000) {
                        alert("El peso debe ser hasta 3MB ");
                    } else {
                        reader.onload = function() {

                            iconoC6.style.display = "none";
                            perfilC6.style.border = "none";
                            //Asignamos la foto cargada
                            imgSubidaC6.style.display = "block";
                            imgSubidaC6.src = reader.result;
                            document.getElementById("quitaCTestimonio").disabled = false;

                        }
                    }
                    //Cuando este listo ejecute lo siguiente

                }
            }
            subirImgC6.click();
        };
        let quitaC7 = document.getElementById("quitaCTestimonio");
        quitaC7.onclick = function() {
            Swal.fire({
                title: 'Esta segur@?',
                text: "Se quitará la imagen",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si,quitar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    imgSubidaC6.src = null;
                    imgSubidaC6.style.display = "none";
                    iconoC6.style.display = "block";
                    document.getElementById("quitaCTestimonio").disabled = true;
                    if (estaEnImagenes(vectorImaC, "testimonio")) {
                        var auxi = [];
                        for (var i = 0; i < vectorImaC.length; i++) {
                            if (vectorImaC[i] !== "testimonio") {
                                auxi.splice(i, 0, vectorImaC[i]);
                            }
                        }
                        vectorImaC = auxi;
                        indiceVecImaC = indiceVecImaC++;
                    }
                }
            })
        }
        let perfilC8 = document.getElementById("perfilCImpuesto");
        let iconoC8 = document.getElementById("iconoCImpuesto");
        let imgSubidaC8 = document.querySelector(".fotoCImpuesto");
        perfilC8.onclick = function() {
            let subirImgC8 = document.getElementById("subirImgCImpuesto");
            subirImgC8.onchange = function(evento) {
                //Creamos un objeto con la clase FileReader
                let reader = new FileReader();

                //Leemos el archivo subido y se lo pasamos a nuestro filereader
                reader.readAsDataURL(evento.target.files[0]);
                //Cuando este listo ejecute lo siguiente
                if (evento.target.files[0]['type'] != "image/png" &&
                    evento.target.files[0]['type'] != "image/jpg" &&
                    evento.target.files[0]['type'] != "image/jpeg") {
                    alert("Elija una imagen");

                } else {
                    if (evento.target.files[0]['size'] > 3000000) {
                        alert("El peso debe ser hasta 3MB ");
                    } else {
                        reader.onload = function() {

                            iconoC8.style.display = "none";
                            perfilC8.style.border = "none";
                            //Asignamos la foto cargada
                            imgSubidaC8.style.display = "block";
                            imgSubidaC8.src = reader.result;
                            document.getElementById("quitaCImpuesto").disabled = false;
                        }
                    }
                    //Cuando este listo ejecute lo siguiente

                }
            }
            subirImgC8.click();
        };
        let quitaC8 = document.getElementById("quitaCImpuesto");
        quitaC8.onclick = function() {
            Swal.fire({
                title: 'Esta segur@?',
                text: "Se quitará la imagen",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si,quitar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    imgSubidaC8.src = null;
                    imgSubidaC8.style.display = "none";
                    iconoC8.style.display = "block";
                    document.getElementById("quitaCImpuesto").disabled = true;
                    if (estaEnImagenes(vectorImaC, "impuesto")) {
                        var auxi = [];
                        for (var i = 0; i < vectorImaC.length; i++) {
                            if (vectorImaC[i] !== "impuesto") {
                                auxi.splice(i, 0, vectorImaC[i]);
                            }
                        }
                        vectorImaC = auxi;
                        indiceVecImaC = indiceVecImaC++;
                    }
                }
            })
        }
        let perfilC9 = document.getElementById("perfilCRuat");
        let iconoC9 = document.getElementById("iconoCRuat");
        let imgSubidaC9 = document.querySelector(".fotoCRuat");
        perfilC9.onclick = function() {
            let subirImgC9 = document.getElementById("subirImgCRuat");
            subirImgC9.onchange = function(evento) {
                //Creamos un objeto con la clase FileReader
                let reader = new FileReader();

                //Leemos el archivo subido y se lo pasamos a nuestro filereader
                reader.readAsDataURL(evento.target.files[0]);
                //Cuando este listo ejecute lo siguiente
                if (evento.target.files[0]['type'] != "image/png" &&
                    evento.target.files[0]['type'] != "image/jpg" &&
                    evento.target.files[0]['type'] != "image/jpeg") {
                    alert("Elija una imagen");

                } else {
                    if (evento.target.files[0]['size'] > 3000000) {
                        alert("El peso debe ser hasta 3MB ");
                    } else {
                        reader.onload = function() {
                            iconoC9.style.display = "none";
                            perfilC9.style.border = "none";
                            //Asignamos la foto cargada
                            imgSubidaC9.style.display = "block";
                            imgSubidaC9.src = reader.result;
                            document.getElementById("quitaCRuat").disabled = false;

                        }
                    }
                    //Cuando este listo ejecute lo siguiente

                }
            }
            subirImgC9.click();
        };
        let quitaC9 = document.getElementById("quitaCRuat");
        quitaC9.onclick = function() {
            Swal.fire({
                title: 'Esta segur@?',
                text: "Se quitará la imagen",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si,quitar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    imgSubidaC9.src = null;
                    imgSubidaC9.style.display = "none";
                    iconoC9.style.display = "block";
                    document.getElementById("quitaCRuat").disabled = true;
                    if (estaEnImagenes(vectorImaC, "ruat")) {
                        var auxi = [];
                        for (var i = 0; i < vectorImaC.length; i++) {
                            if (vectorImaC[i] !== "ruat") {
                                auxi.splice(i, 0, vectorImaC[i]);
                            }
                        }
                        vectorImaC = auxi;
                        indiceVecImaC = indiceVecImaC++;
                    }
                }
            })
        }
        let perfilC10 = document.getElementById("perfilCSoat");
        let iconoC10 = document.getElementById("iconoCSoat");
        let imgSubidaC10 = document.querySelector(".fotoCSoat");
        perfilC10.onclick = function() {
            let subirImgC10 = document.getElementById("subirImgCSoat");
            subirImgC10.onchange = function(evento) {
                //Creamos un objeto con la clase FileReader
                let reader = new FileReader();

                //Leemos el archivo subido y se lo pasamos a nuestro filereader
                reader.readAsDataURL(evento.target.files[0]);
                //Cuando este listo ejecute lo siguiente
                if (evento.target.files[0]['type'] != "image/png" &&
                    evento.target.files[0]['type'] != "image/jpg" &&
                    evento.target.files[0]['type'] != "image/jpeg") {
                    alert("Elija una imagen");

                } else {
                    if (evento.target.files[0]['size'] > 3000000) {
                        alert("El peso debe ser hasta 3MB ");
                    } else {
                        reader.onload = function() {
                            iconoC10.style.display = "none";
                            perfilC10.style.border = "none";
                            //Asignamos la foto cargada
                            imgSubidaC10.style.display = "block";
                            imgSubidaC10.src = reader.result;
                            document.getElementById("quitaCSoat").disabled = false;


                        }
                    }
                    //Cuando este listo ejecute lo siguiente

                }
            }
            subirImgC10.click();
        };
        let quitaC10 = document.getElementById("quitaCSoat");
        quitaC10.onclick = function() {
            Swal.fire({
                title: 'Esta segur@?',
                text: "Se quitará la imagen",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si,quitar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    imgSubidaC10.src = null;
                    imgSubidaC10.style.display = "none";
                    iconoC10.style.display = "block";
                    document.getElementById("quitaCSoat").disabled = true;
                    if (estaEnImagenes(vectorImaC, "soat")) {
                        var auxi = [];
                        for (var i = 0; i < vectorImaC.length; i++) {
                            if (vectorImaC[i] !== "soat") {
                                auxi.splice(i, 0, vectorImaC[i]);
                            }
                        }
                        vectorImaC = auxi;
                        indiceVecImaC = indiceVecImaC++;
                    }
                }
            })
        }
        let perfilC11 = document.getElementById("perfilCNit");
        let iconoC11 = document.getElementById("iconoCNit");
        let imgSubidaC11 = document.querySelector(".fotoCNit");
        perfilC11.onclick = function() {
            let subirImgC11 = document.getElementById("subirImgCNit");
            subirImgC11.onchange = function(evento) {
                //Creamos un objeto con la clase FileReader
                let reader = new FileReader();

                //Leemos el archivo subido y se lo pasamos a nuestro filereader
                reader.readAsDataURL(evento.target.files[0]);
                //Cuando este listo ejecute lo siguiente
                if (evento.target.files[0]['type'] != "image/png" &&
                    evento.target.files[0]['type'] != "image/jpg" &&
                    evento.target.files[0]['type'] != "image/jpeg") {
                    alert("Elija una imagen");

                } else {
                    if (evento.target.files[0]['size'] > 3000000) {
                        alert("El peso debe ser hasta 3MB ");
                    } else {
                        reader.onload = function() {
                            iconoC11.style.display = "none";
                            perfilC11.style.border = "none";
                            //Asignamos la foto cargada
                            imgSubidaC11.style.display = "block";
                            imgSubidaC11.src = reader.result;
                            document.getElementById("quitaCNit").disabled = false;
                        }
                    }
                    //Cuando este listo ejecute lo siguiente

                }
            }
            subirImgC11.click();
        };
        let quitaC11 = document.getElementById("quitaCNit");
        quitaC11.onclick = function() {
            Swal.fire({
                title: 'Esta segur@?',
                text: "Se quitará la imagen",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si,quitar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    imgSubidaC11.src = null;
                    imgSubidaC11.style.display = "none";
                    iconoC11.style.display = "block";
                    document.getElementById("quitaCNit").disabled = true;
                    if (estaEnImagenes(vectorImaC, "nit")) {
                        var auxi = [];
                        for (var i = 0; i < vectorImaC.length; i++) {
                            if (vectorImaC[i] !== "nit") {
                                auxi.splice(i, 0, vectorImaC[i]);
                            }
                        }
                        vectorImaC = auxi;
                        indiceVecImaC = indiceVecImaC++;
                    }
                }
            })
        }
        let perfilC12 = document.getElementById("perfilCPatente");
        let iconoC12 = document.getElementById("iconoCPatente");
        let imgSubidaC12 = document.querySelector(".fotoCPatente");
        perfilC12.onclick = function() {
            let subirImgC12 = document.getElementById("subirImgCPatente");
            subirImgC12.onchange = function(evento) {
                //Creamos un objeto con la clase FileReader
                let reader = new FileReader();

                //Leemos el archivo subido y se lo pasamos a nuestro filereader
                reader.readAsDataURL(evento.target.files[0]);
                //Cuando este listo ejecute lo siguiente
                if (evento.target.files[0]['type'] != "image/png" &&
                    evento.target.files[0]['type'] != "image/jpg" &&
                    evento.target.files[0]['type'] != "image/jpeg") {
                    alert("Elija una imagen");

                } else {
                    if (evento.target.files[0]['size'] > 3000000) {
                        alert("El peso debe ser hasta 3MB ");
                    } else {
                        reader.onload = function() {
                            iconoC12.style.display = "none";
                            perfilC12.style.border = "none";
                            //Asignamos la foto cargada
                            imgSubidaC12.style.display = "block";
                            imgSubidaC12.src = reader.result;
                            document.getElementById("quitaCPatente").disabled = false;
                        }
                    }
                    //Cuando este listo ejecute lo siguiente

                }
            }
            subirImgC12.click();
        };
        let quitaC12 = document.getElementById("quitaCPatente");
        quitaC12.onclick = function() {
            Swal.fire({
                title: 'Esta segur@?',
                text: "Se quitará la imagen",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si,quitar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    imgSubidaC12.src = null;
                    imgSubidaC12.style.display = "none";
                    iconoC12.style.display = "block";
                    document.getElementById("quitaCPatente").disabled = true;
                    if (estaEnImagenes(vectorImaC, "patente")) {
                        var auxi = [];
                        for (var i = 0; i < vectorImaC.length; i++) {
                            if (vectorImaC[i] !== "patente") {
                                auxi.splice(i, 0, vectorImaC[i]);
                            }
                        }
                        vectorImaC = auxi;
                        indiceVecImaC = indiceVecImaC++;
                    }
                }
            })
        }
        let perfilC13 = document.getElementById("perfilCBoletaPago");
        let iconoC13 = document.getElementById("iconoCBoletaPago");
        let imgSubidaC13 = document.querySelector(".fotoCBoletaPago");
        perfilC13.onclick = function() {
            let subirImgC13 = document.getElementById("subirImgCBoletaPago");
            subirImgC13.onchange = function(evento) {
                //Creamos un objeto con la clase FileReader
                let reader = new FileReader();

                //Leemos el archivo subido y se lo pasamos a nuestro filereader
                reader.readAsDataURL(evento.target.files[0]);
                //Cuando este listo ejecute lo siguiente
                if (evento.target.files[0]['type'] != "image/png" &&
                    evento.target.files[0]['type'] != "image/jpg" &&
                    evento.target.files[0]['type'] != "image/jpeg") {
                    alert("Elija una imagen");

                } else {
                    if (evento.target.files[0]['size'] > 3000000) {
                        alert("El peso debe ser hasta 3MB ");
                    } else {
                        reader.onload = function() {
                            iconoC13.style.display = "none";
                            perfilC13.style.border = "none";
                            //Asignamos la foto cargada
                            imgSubidaC13.style.display = "block";
                            imgSubidaC13.src = reader.result;
                            document.getElementById("quitaCBoletaPago").disabled = true;

                        }
                    }
                    //Cuando este listo ejecute lo siguiente

                }
            }
            subirImgC13.click();
        };
        let quitaC13 = document.getElementById("quitaCBoletaPago");
        quitaC13.onclick = function() {
            Swal.fire({
                title: 'Esta segur@?',
                text: "Se quitará la imagen",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si,quitar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    imgSubidaC13.src = null;
                    imgSubidaC13.style.display = "none";
                    iconoC13.style.display = "block";
                    document.getElementById("quitaCBoletaPago").disabled = true;
                    if (estaEnImagenes(vectorImaC, "boletapago")) {
                        var auxi = [];
                        for (var i = 0; i < vectorImaC.length; i++) {
                            if (vectorImaC[i] !== "boletapago") {
                                auxi.splice(i, 0, vectorImaC[i]);
                            }
                        }
                        vectorImaC = auxi;
                        indiceVecImaC = indiceVecImaC++;
                    }
                }
            })
        }
        let perfilC14 = document.getElementById("perfilCAfp");
        let iconoC14 = document.getElementById("iconoCAfp");
        let imgSubidaC14 = document.querySelector(".fotoCAfp");

        perfilC14.onclick = function() {
            let subirImgC14 = document.getElementById("subirImgCAfp");
            subirImgC14.onchange = function(evento) {
                //Creamos un objeto con la clase FileReader
                let reader = new FileReader();

                //Leemos el archivo subido y se lo pasamos a nuestro filereader
                reader.readAsDataURL(evento.target.files[0]);
                //Cuando este listo ejecute lo siguiente
                if (evento.target.files[0]['type'] != "image/png" &&
                    evento.target.files[0]['type'] != "image/jpg" &&
                    evento.target.files[0]['type'] != "image/jpeg") {
                    alert("Elija una imagen");

                } else {
                    if (evento.target.files[0]['size'] > 3000000) {
                        alert("El peso debe ser hasta 3MB ");
                    } else {
                        reader.onload = function() {

                            iconoC14.style.display = "none";
                            perfilC14.style.border = "none";
                            //Asignamos la foto cargada
                            imgSubidaC14.style.display = "block";
                            imgSubidaC14.src = reader.result;
                            document.getElementById("quitaCAfp").disabled = false;
                        }
                    }
                    //Cuando este listo ejecute lo siguiente

                }
            }
            subirImgC14.click();
        };
        let quitaC14 = document.getElementById("quitaCAfp");
        quitaC14.onclick = function() {
            Swal.fire({
                title: 'Esta segur@?',
                text: "Se quitará la imagen",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si,quitar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    imgSubidaC14.src = null;
                    imgSubidaC14.style.display = "none";
                    iconoC14.style.display = "block";
                    document.getElementById("quitaCAfp").disabled = true;
                    if (estaEnImagenes(vectorImaC, "afp")) {
                        var auxi = [];
                        for (var i = 0; i < vectorImaC.length; i++) {
                            if (vectorImaC[i] !== "afp") {
                                auxi.splice(i, 0, vectorImaC[i]);
                            }
                        }
                        vectorImaC = auxi;
                        indiceVecImaC = indiceVecImaC++;
                    }
                }
            })
        }
        let perfilC15 = document.getElementById("perfilCPlanPago1");
        let iconoC15 = document.getElementById("iconoCPlanPago1");
        let imgSubidaC15 = document.querySelector(".fotoCPlanPago1");
        perfilC15.onclick = function() {
            let subirImgC15 = document.getElementById("subirImgCPlanPago1");
            subirImgC15.onchange = function(evento) {
                //Creamos un objeto con la clase FileReader
                let reader = new FileReader();

                //Leemos el archivo subido y se lo pasamos a nuestro filereader
                reader.readAsDataURL(evento.target.files[0]);
                //Cuando este listo ejecute lo siguiente
                if (evento.target.files[0]['type'] != "image/png" &&
                    evento.target.files[0]['type'] != "image/jpg" &&
                    evento.target.files[0]['type'] != "image/jpeg") {
                    alert("Elija una imagen");

                } else {
                    if (evento.target.files[0]['size'] > 3000000) {
                        alert("El peso debe ser hasta 3MB ");
                    } else {
                        reader.onload = function() {

                            iconoC15.style.display = "none";
                            perfilC15.style.border = "none";
                            //Asignamos la foto cargada
                            imgSubidaC15.style.display = "block";
                            imgSubidaC15.src = reader.result;
                            document.getElementById("quitaCPlanPago1").disabled = false;
                        }
                    }
                    //Cuando este listo ejecute lo siguiente

                }
            }
            subirImgC15.click();
        };
        let quitaC15 = document.getElementById("quitaCPlanPago1");
        quitaC15.onclick = function() {
            Swal.fire({
                title: 'Esta segur@?',
                text: "Se quitará la imagen",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si,quitar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    imgSubidaC15.src = null;
                    imgSubidaC15.style.display = "none";
                    iconoC15.style.display = "block";
                    document.getElementById("quitaCPlanPago1").disabled = true;
                    if (estaEnImagenes(vectorImaC, "planpago1")) {
                        var auxi = [];
                        for (var i = 0; i < vectorImaC.length; i++) {
                            if (vectorImaC[i] !== "planpago1") {
                                auxi.splice(i, 0, vectorImaC[i]);
                            }
                        }
                        vectorImaC = auxi;
                        indiceVecImaC = indiceVecImaC++;
                    }
                }
            })
        }
        let perfilC16 = document.getElementById("perfilCBoletaCancelacion1");
        let iconoC16 = document.getElementById("iconoCBoletaCancelacion1");
        let imgSubidaC16 = document.querySelector(".fotoCBoletaCancelacion1");
        perfilC16.onclick = function() {
            let subirImgC16 = document.getElementById("subirImgCBoletaCancelacion1");
            subirImgC16.onchange = function(evento) {
                //Creamos un objeto con la clase FileReader
                let reader = new FileReader();

                //Leemos el archivo subido y se lo pasamos a nuestro filereader
                reader.readAsDataURL(evento.target.files[0]);
                //Cuando este listo ejecute lo siguiente
                if (evento.target.files[0]['type'] != "image/png" &&
                    evento.target.files[0]['type'] != "image/jpg" &&
                    evento.target.files[0]['type'] != "image/jpeg") {
                    alert("Elija una imagen");

                } else {
                    if (evento.target.files[0]['size'] > 3000000) {
                        alert("El peso debe ser hasta 3MB ");
                    } else {
                        reader.onload = function() {

                            iconoC16.style.display = "none";
                            perfilC16.style.border = "none";
                            //Asignamos la foto cargada
                            imgSubidaC16.style.display = "block";
                            imgSubidaC16.src = reader.result;
                            document.getElementById("quitaCBoletaCancelacion1").disabled = false;

                        }
                    }
                    //Cuando este listo ejecute lo siguiente

                }
            }
            subirImgC16.click();
        };
        let quitaC16 = document.getElementById("quitaCBoletaCancelacion1");
        quitaC16.onclick = function() {
            Swal.fire({
                title: 'Esta segur@?',
                text: "Se quitará la imagen",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si,quitar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    imgSubidaC16.src = null;
                    imgSubidaC16.style.display = "none";
                    iconoC16.style.display = "block";
                    document.getElementById("quitaCBoletaCancelacion1").disabled = true;
                    if (estaEnImagenes(vectorImaC, "ultimaboleta1")) {
                        var auxi = [];
                        for (var i = 0; i < vectorImaC.length; i++) {
                            if (vectorImaC[i] !== "ultimaboleta1") {
                                auxi.splice(i, 0, vectorImaC[i]);
                            }
                        }
                        vectorImaC = auxi;
                        indiceVecImaC = indiceVecImaC++;
                    }
                }
            })
        }
        let perfilC17 = document.getElementById("perfilCPlanPago2");
        let iconoC17 = document.getElementById("iconoCPlanPago2");
        let imgSubidaC17 = document.querySelector(".fotoCPlanPago2");
        perfilC17.onclick = function() {
            let subirImgC17 = document.getElementById("subirImgCPlanPago2");
            subirImgC17.onchange = function(evento) {
                //Creamos un objeto con la clase FileReader
                let reader = new FileReader();

                //Leemos el archivo subido y se lo pasamos a nuestro filereader
                reader.readAsDataURL(evento.target.files[0]);
                //Cuando este listo ejecute lo siguiente
                if (evento.target.files[0]['type'] != "image/png" &&
                    evento.target.files[0]['type'] != "image/jpg" &&
                    evento.target.files[0]['type'] != "image/jpeg") {
                    alert("Elija una imagen");

                } else {
                    if (evento.target.files[0]['size'] > 3000000) {
                        alert("El peso debe ser hasta 3MB ");
                    } else {
                        reader.onload = function() {

                            iconoC17.style.display = "none";
                            perfilC17.style.border = "none";
                            //Asignamos la foto cargada
                            imgSubidaC17.style.display = "block";
                            imgSubidaC17.src = reader.result;
                            document.getElementById("quitaCPlanPago2").disabled = false;
                        }
                    }
                    //Cuando este listo ejecute lo siguiente

                }
            }
            subirImgC17.click();
        };
        let quitaC17 = document.getElementById("quitaCPlanPago2");
        quitaC17.onclick = function() {
            Swal.fire({
                title: 'Esta segur@?',
                text: "Se quitará la imagen",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si,quitar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    imgSubidaC17.src = null;
                    imgSubidaC17.style.display = "none";
                    iconoC17.style.display = "block";
                    document.getElementById("quitaCPlanPago2").disabled = true;
                    if (estaEnImagenes(vectorImaC, "planpago2")) {
                        var auxi = [];
                        for (var i = 0; i < vectorImaC.length; i++) {
                            if (vectorImaC[i] !== "planpago2") {
                                auxi.splice(i, 0, vectorImaC[i]);
                            }
                        }
                        vectorImaC = auxi;
                        indiceVecImaC = indiceVecImaC++;
                    }

                }
            })
        }
        let perfilC18 = document.getElementById("perfilCBoletaCancelacion2");
        let iconoC18 = document.getElementById("iconoCBoletaCancelacion2");
        let imgSubidaC18 = document.querySelector(".fotoCBoletaCancelacion2");
        perfilC18.onclick = function() {
            let subirImgC18 = document.getElementById("subirImgCBoletaCancelacion2");
            subirImgC18.onchange = function(evento) {
                //Creamos un objeto con la clase FileReader
                let reader = new FileReader();

                //Leemos el archivo subido y se lo pasamos a nuestro filereader
                reader.readAsDataURL(evento.target.files[0]);
                //Cuando este listo ejecute lo siguiente
                if (evento.target.files[0]['type'] != "image/png" &&
                    evento.target.files[0]['type'] != "image/jpg" &&
                    evento.target.files[0]['type'] != "image/jpeg") {
                    alert("Elija una imagen");

                } else {
                    if (evento.target.files[0]['size'] > 3000000) {
                        alert("El peso debe ser hasta 3MB ");
                    } else {
                        reader.onload = function() {
                            iconoC18.style.display = "none";
                            perfilC18.style.border = "none";
                            //Asignamos la foto cargada
                            imgSubidaC18.style.display = "block";
                            imgSubidaC18.src = reader.result;
                            document.getElementById("quitaCBoletaCancelacion2").disabled = false;
                        }
                    }
                    //Cuando este listo ejecute lo siguiente

                }
            }
            subirImgC18.click();
        };
        let quitaC18 = document.getElementById("quitaCBoletaCancelacion2");
        quitaC18.onclick = function() {
            Swal.fire({
                title: 'Esta segur@?',
                text: "Se quitará la imagen",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si,quitar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    imgSubidaC18.src = null;
                    imgSubidaC18.style.display = "none";
                    iconoC18.style.display = "block";
                    document.getElementById("quitaCBoletaCancelacion2").disabled = true;
                    if (estaEnImagenes(vectorImaC, "ultimaboleta2")) {
                        var auxi = [];
                        for (var i = 0; i < vectorImaC.length; i++) {
                            if (vectorImaC[i] !== "ultimaboleta2") {
                                auxi.splice(i, 0, vectorImaC[i]);
                            }
                        }
                        vectorImaC = auxi;
                        indiceVecImaC = indiceVecImaC++;
                    }
                }
            })
        }
        let perfilC19 = document.getElementById("perfilCPlanPago3");
        let iconoC19 = document.getElementById("iconoCPlanPago3");
        let imgSubidaC19 = document.querySelector(".fotoCPlanPago3");
        perfilC19.onclick = function() {
            let subirImgC19 = document.getElementById("subirImgCPlanPago3");
            subirImgC19.onchange = function(evento) {
                //Creamos un objeto con la clase FileReader
                let reader = new FileReader();

                //Leemos el archivo subido y se lo pasamos a nuestro filereader
                reader.readAsDataURL(evento.target.files[0]);
                //Cuando este listo ejecute lo siguiente
                if (evento.target.files[0]['type'] != "image/png" &&
                    evento.target.files[0]['type'] != "image/jpg" &&
                    evento.target.files[0]['type'] != "image/jpeg") {
                    alert("Elija una imagen");

                } else {
                    if (evento.target.files[0]['size'] > 3000000) {
                        alert("El peso debe ser hasta 3MB ");
                    } else {
                        reader.onload = function() {
                            iconoC19.style.display = "none";
                            perfilC19.style.border = "none";
                            //Asignamos la foto cargada
                            imgSubidaC19.style.display = "block";
                            imgSubidaC19.src = reader.result;
                            document.getElementById("quitaCPlanPago3").disabled = false;
                        }
                    }
                    //Cuando este listo ejecute lo siguiente

                }
            }
            subirImgC19.click();
        };
        let quitaC19 = document.getElementById("quitaCPlanPago3");
        quitaC19.onclick = function() {
            Swal.fire({
                title: 'Esta segur@?',
                text: "Se quitará la imagen",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si,quitar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    imgSubidaC19.src = null;
                    imgSubidaC19.style.display = "none";
                    iconoC19.style.display = "block";
                    document.getElementById("quitaCPlanPago3").disabled = true;
                    if (estaEnImagenes(vectorImaC, "planpago3")) {
                        var auxi = [];
                        for (var i = 0; i < vectorImaC.length; i++) {
                            if (vectorImaC[i] !== "planpago3") {
                                auxi.splice(i, 0, vectorImaC[i]);
                            }
                        }
                        vectorImaC = auxi;
                        indiceVecImaC = indiceVecImaC++;
                    }
                }
            })
        }
        let perfilC20 = document.getElementById("perfilCBoletaCancelacion3");
        let iconoC20 = document.getElementById("iconoCBoletaCancelacion3");
        let imgSubidaC20 = document.querySelector(".fotoCBoletaCancelacion3");
        perfilC20.onclick = function() {
            let subirImgC20 = document.getElementById("subirImgCBoletaCancelacion3");
            subirImgC20.onchange = function(evento) {
                //Creamos un objeto con la clase FileReader
                let reader = new FileReader();

                //Leemos el archivo subido y se lo pasamos a nuestro filereader
                reader.readAsDataURL(evento.target.files[0]);
                //Cuando este listo ejecute lo siguiente
                if (evento.target.files[0]['type'] != "image/png" &&
                    evento.target.files[0]['type'] != "image/jpg" &&
                    evento.target.files[0]['type'] != "image/jpeg") {
                    alert("Elija una imagen");

                } else {
                    if (evento.target.files[0]['size'] > 3000000) {
                        alert("El peso debe ser hasta 3MB ");
                    } else {
                        reader.onload = function() {
                            iconoC20.style.display = "none";
                            perfilC20.style.border = "none";
                            //Asignamos la foto cargada
                            imgSubidaC20.style.display = "block";
                            imgSubidaC20.src = reader.result;
                            document.getElementById("quitaCBoletaCancelacion3").disabled = false;
                        }
                    }
                    //Cuando este listo ejecute lo siguiente

                }
            }
            subirImgC20.click();
        };

        let quitaC20 = document.getElementById("quitaCBoletaCancelacion3");
        quitaC20.onclick = function() {
            Swal.fire({
                title: 'Esta segur@?',
                text: "Se quitará la imagen",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si,quitar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    imgSubidaC20.src = null;
                    imgSubidaC20.style.display = "none";
                    iconoC20.style.display = "block";
                    document.getElementById("quitaCBoletaCancelacion3").disabled = true;
                    if (estaEnImagenes(vectorImaC, "ultimaboleta3")) {
                        var auxi = [];
                        for (var i = 0; i < vectorImaC.length; i++) {
                            if (vectorImaC[i] !== "ultimaboleta3") {
                                auxi.splice(i, 0, vectorImaC[i]);
                            }
                        }
                        vectorImaC = auxi;
                        indiceVecImaC = indiceVecImaC++;
                    }
                }
            })
        }

        let perfilC21 = document.getElementById("perfilCPlanPago4");
        let iconoC21 = document.getElementById("iconoCPlanPago4");
        let imgSubidaC21 = document.querySelector(".fotoCPlanPago4");
        perfilC21.onclick = function() {
            let subirImgC21 = document.getElementById("subirImgCPlanPago4");
            subirImgC21.onchange = function(evento) {
                //Creamos un objeto con la clase FileReader
                let reader = new FileReader();

                //Leemos el archivo subido y se lo pasamos a nuestro filereader
                reader.readAsDataURL(evento.target.files[0]);
                //Cuando este listo ejecute lo siguiente
                if (evento.target.files[0]['type'] != "image/png" &&
                    evento.target.files[0]['type'] != "image/jpg" &&
                    evento.target.files[0]['type'] != "image/jpeg") {
                    alert("Elija una imagen");

                } else {
                    if (evento.target.files[0]['size'] > 3000000) {
                        alert("El peso debe ser hasta 3MB ");
                    } else {
                        reader.onload = function() {
                            iconoC21.style.display = "none";
                            perfilC21.style.border = "none";
                            //Asignamos la foto cargada
                            imgSubidaC21.style.display = "block";
                            imgSubidaC21.src = reader.result;
                            document.getElementById("quitaCPlanPago4").disabled = false;
                        }
                    }
                    //Cuando este listo ejecute lo siguiente

                }
            }
            subirImgC21.click();
        };
        let quitaC21 = document.getElementById("quitaCPlanPago4");
        quitaC21.onclick = function() {
            Swal.fire({
                title: 'Esta segur@?',
                text: "Se quitará la imagen",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si,quitar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    imgSubidaC21.src = null;
                    imgSubidaC21.style.display = "none";
                    iconoC21.style.display = "block";
                    document.getElementById("quitaCPlanPago4").disabled = true;
                    if (estaEnImagenes(vectorImaC, "planpago4")) {
                        var auxi = [];
                        for (var i = 0; i < vectorImaC.length; i++) {
                            if (vectorImaC[i] !== "planpago4") {
                                auxi.splice(i, 0, vectorImaC[i]);
                            }
                        }
                        vectorImaC = auxi;
                        indiceVecImaC = indiceVecImaC++;
                    }
                }
            })
        }

        let perfilC22 = document.getElementById("perfilCBoletaCancelacion4");
        let iconoC22 = document.getElementById("iconoCBoletaCancelacion4");
        let imgSubidaC22 = document.querySelector(".fotoCBoletaCancelacion4");
        perfilC22.onclick = function() {
            let subirImgC22 = document.getElementById("subirImgCBoletaCancelacion4");
            subirImgC22.onchange = function(evento) {
                //Creamos un objeto con la clase FileReader
                let reader = new FileReader();

                //Leemos el archivo subido y se lo pasamos a nuestro filereader
                reader.readAsDataURL(evento.target.files[0]);
                //Cuando este listo ejecute lo siguiente
                if (evento.target.files[0]['type'] != "image/png" &&
                    evento.target.files[0]['type'] != "image/jpg" &&
                    evento.target.files[0]['type'] != "image/jpeg") {
                    alert("Elija una imagen");

                } else {
                    if (evento.target.files[0]['size'] > 3000000) {
                        alert("El peso debe ser hasta 3MB ");
                    } else {
                        reader.onload = function() {
                            iconoC22.style.display = "none";
                            perfilC22.style.border = "none";
                            //Asignamos la foto cargada
                            imgSubidaC22.style.display = "block";
                            imgSubidaC22.src = reader.result;
                            document.getElementById("quitaCBoletaCancelacion4").disabled = false;
                        }
                    }
                    //Cuando este listo ejecute lo siguiente

                }
            }
            subirImgC22.click();
        };
        let quitaC22 = document.getElementById("quitaCBoletaCancelacion4");
        quitaC22.onclick = function() {
            Swal.fire({
                title: 'Esta segur@?',
                text: "Se quitará la imagen",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si,quitar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    imgSubidaC22.src = null;
                    imgSubidaC22.style.display = "none";
                    iconoC22.style.display = "block";
                    document.getElementById("quitaCBoletaCancelacion4").disabled = true;
                    if (estaEnImagenes(vectorImaC, "ultimaboleta4")) {
                        var auxi = [];
                        for (var i = 0; i < vectorImaC.length; i++) {
                            if (vectorImaC[i] !== "ultimaboleta1") {
                                auxi.splice(i, 0, vectorImaC[i]);
                            }
                        }
                        vectorImaC = auxi;
                        indiceVecImaC = indiceVecImaC++;
                    }
                }
            })
        }
        let perfilC23 = document.getElementById("perfilCContrato");
        let iconoC23 = document.getElementById("iconoCContrato");
        let imgSubidaC23 = document.querySelector(".fotoCContrato");
        perfilC23.onclick = function() {
            let subirImgC23 = document.getElementById("subirImgCContrato");
            subirImgC23.onchange = function(evento) {
                //Creamos un objeto con la clase FileReader
                let reader = new FileReader();

                //Leemos el archivo subido y se lo pasamos a nuestro filereader
                reader.readAsDataURL(evento.target.files[0]);
                //Cuando este listo ejecute lo siguiente

                if (evento.target.files[0]['type'] != "image/png" &&
                    evento.target.files[0]['type'] != "image/jpg" &&
                    evento.target.files[0]['type'] != "image/jpeg") {
                    alert("Elija una imagen");

                } else {
                    if (evento.target.files[0]['size'] > 3000000) {
                        alert("El peso debe ser hasta 3MB ");
                    } else {
                        reader.onload = function() {
                            iconoC23.style.display = "none";
                            perfilC23.style.border = "none";
                            //Asignamos la foto cargada
                            imgSubidaC23.style.display = "block";
                            imgSubidaC23.src = reader.result;
                            document.getElementById("quitaCContrato").disabled = false;

                        }
                    }
                    //Cuando este listo ejecute lo siguiente

                }
            }
            subirImgC23.click();
        };
        let quitaC1 = document.getElementById("quitaCContrato");
        quitaC1.onclick = function() {
                Swal.fire({
                    title: 'Esta segur@?',
                    text: "Se quitará la imagen",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si,quitar!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        imgSubidaC23.src = null;
                        imgSubidaC23.style.display = "none";
                        iconoC23.style.display = "block";
                        document.getElementById("quitaCContrato").disabled = true;
                        if (estaEnImagenes(vectorImaC, "contrato")) {
                            var auxi = [];
                            for (var i = 0; i < vectorImaC.length; i++) {
                                if (vectorImaC[i] !== "contrato") {
                                    auxi.splice(i, 0, vectorImaC[i]);
                                }
                            }
                            vectorImaC = auxi;
                            indiceVecImaC = indiceVecImaC++;
                        }
                    }
                })


            }
            //VISUALIZACION DE IMAGENES DE GARANTE
        let perfilG1 = document.getElementById("perfilGCarnet");
        let iconoG1 = document.getElementById("iconoGCarnet");
        let imgSubidaG1 = document.querySelector(".fotoGCarnet");
        perfilG1.onclick = function() {
            let subirImgG1 = document.getElementById("subirImgGCarnet");
            subirImgG1.onchange = function(evento) {
                //Creamos un objeto con la clase FileReader
                let reader = new FileReader();

                //Leemos el archivo subido y se lo pasamos a nuestro filereader
                reader.readAsDataURL(evento.target.files[0]);
                //Cuando este listo ejecute lo siguiente
                if (evento.target.files[0]['type'] != "image/png" &&
                    evento.target.files[0]['type'] != "image/jpg" &&
                    evento.target.files[0]['type'] != "image/jpeg") {
                    alert("Elija una imagen");

                } else {
                    if (evento.target.files[0]['size'] > 3000000) {
                        alert("El peso debe ser hasta 3MB ");
                    } else {
                        reader.onload = function() {
                            iconoG1.style.display = "none";
                            perfilG1.style.border = "none";
                            //Asignamos la foto cargada
                            imgSubidaG1.style.display = "block";
                            imgSubidaG1.src = reader.result;
                            document.getElementById("quitaGCarnet").disabled = false;
                        }
                    }
                    //Cuando este listo ejecute lo siguiente

                }
            }
            subirImgG1.click();
        };
        let quitaG1 = document.getElementById("quitaGCarnet");
        quitaG1.onclick = function() {
            Swal.fire({
                title: 'Esta segur@?',
                text: "Se quitará la imagen",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si,quitar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    imgSubidaG1.src = null;
                    imgSubidaG1.style.display = "none";
                    iconoG1.style.display = "block";
                    document.getElementById("subirImgGCarnet").value = "";
                    document.getElementById("quitaGCarnet").disabled = true;
                    if (estaEnImagenes(vectorImaG, "carnet")) {
                        var auxi = [];
                        for (var i = 0; i < vectorImaG.length; i++) {
                            if (vectorImaG[i] !== "carnet") {
                                auxi.splice(i, 0, vectorImaG[i]);
                            }
                        }
                        vectorImaG = auxi;
                        indiceVecImaG = indiceVecImaG++;
                    }
                }
            })
        }
        let perfilG2 = document.getElementById("perfilGFacLuz");
        let iconoG2 = document.getElementById("iconoGFacLuz");
        let imgSubidaG2 = document.querySelector(".fotoGFacLuz");
        perfilG2.onclick = function() {
            let subirImgG2 = document.getElementById("subirImgGFacLuz");
            subirImgG2.onchange = function(evento) {
                //Creamos un objeto con la clase FileReader
                let reader = new FileReader();

                //Leemos el archivo subido y se lo pasamos a nuestro filereader
                reader.readAsDataURL(evento.target.files[0]);
                //Cuando este listo ejecute lo siguiente
                if (evento.target.files[0]['type'] != "image/png" &&
                    evento.target.files[0]['type'] != "image/jpg" &&
                    evento.target.files[0]['type'] != "image/jpeg") {
                    alert("Elija una imagen");

                } else {
                    if (evento.target.files[0]['size'] > 3000000) {
                        alert("El peso debe ser hasta 3MB ");
                    } else {
                        reader.onload = function() {
                            iconoG2.style.display = "none";
                            perfilG2.style.border = "none";
                            //Asignamos la foto cargada
                            imgSubidaG2.style.display = "block";
                            imgSubidaG2.src = reader.result;
                            document.getElementById("quitaGFacLuz").disabled = false;
                        }
                    }
                    //Cuando este listo ejecute lo siguiente

                }
            }
            subirImgG2.click();
        };
        let quitaG2 = document.getElementById("quitaGFacLuz");
        quitaG2.onclick = function() {
            Swal.fire({
                title: 'Esta segur@?',
                text: "Se quitará la imagen",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si,quitar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    imgSubidaG2.src = null;
                    imgSubidaG2.style.display = "none";
                    iconoG2.style.display = "block";
                    document.getElementById("subirImgCFacLuz").value = "";
                    document.getElementById("quitaGFacLuz").disabled = true;
                    if (estaEnImagenes(vectorImaG, "luz")) {
                        var auxi = [];
                        for (var i = 0; i < vectorImaG.length; i++) {
                            if (vectorImaG[i] !== "luz") {
                                auxi.splice(i, 0, vectorImaG[i]);
                            }
                        }
                        vectorImaG = auxi;
                        indiceVecImaG = indiceVecImaG++;
                    }
                }
            })
        }
        let perfilG3 = document.getElementById("perfilGFacAgua");
        let iconoG3 = document.getElementById("iconoGFacAgua");
        let imgSubidaG3 = document.querySelector(".fotoGFacAgua");
        perfilG3.onclick = function() {
            let subirImgG3 = document.getElementById("subirImgGFacAgua");
            subirImgG3.onchange = function(evento) {
                //Creamos un objeto con la clase FileReader
                let reader = new FileReader();

                //Leemos el archivo subido y se lo pasamos a nuestro filereader
                reader.readAsDataURL(evento.target.files[0]);
                //Cuando este listo ejecute lo siguiente
                if (evento.target.files[0]['type'] != "image/png" &&
                    evento.target.files[0]['type'] != "image/jpg" &&
                    evento.target.files[0]['type'] != "image/jpeg") {
                    alert("Elija una imagen");

                } else {
                    if (evento.target.files[0]['size'] > 3000000) {
                        alert("El peso debe ser hasta 3MB ");
                    } else {
                        reader.onload = function() {
                            iconoG3.style.display = "none";
                            perfilG3.style.border = "none";
                            //Asignamos la foto cargada
                            imgSubidaG3.style.display = "block";
                            imgSubidaG3.src = reader.result;
                            document.getElementById("quitaGFacAgua").disabled = false;
                        }
                    }
                    //Cuando este listo ejecute lo siguiente

                }
            }
            subirImgG3.click();
        };
        let quitaG3 = document.getElementById("quitaGFacAgua");
        quitaG3.onclick = function() {
            Swal.fire({
                title: 'Esta segur@?',
                text: "Se quitará la imagen",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si,quitar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    imgSubidaG3.src = null;
                    imgSubidaG3.style.display = "none";
                    iconoG3.style.display = "block";
                    document.getElementById("subirImgGFacAgua").value = "";
                    document.getElementById("quitaGFacAgua").disabled = true;
                    if (estaEnImagenes(vectorImaG, "agua")) {
                        var auxi = [];
                        for (var i = 0; i < vectorImaG.length; i++) {
                            if (vectorImaG[i] !== "agua") {
                                auxi.splice(i, 0, vectorImaG[i]);
                            }
                        }
                        vectorImaG = auxi;
                        indiceVecImaG = indiceVecImaG++;
                    }
                }
            })
        }
        let perfilG4 = document.getElementById("perfilGCroquis");
        let iconoG4 = document.getElementById("iconoGCroquis");
        let imgSubidaG4 = document.querySelector(".fotoGCroquis");
        if (document.getElementById("subirImgGCroquis").value = "") {
            document.getElementById("quitaGCroquis").disabled = true;
        }

        perfilG4.onclick = function() {
            let subirImgG4 = document.getElementById("subirImgGCroquis");
            subirImgG4.onchange = function(evento) {
                //Creamos un objeto con la clase FileReader
                let reader = new FileReader();

                //Leemos el archivo subido y se lo pasamos a nuestro filereader
                reader.readAsDataURL(evento.target.files[0]);
                //Cuando este listo ejecute lo siguiente
                if (evento.target.files[0]['type'] != "image/png" &&
                    evento.target.files[0]['type'] != "image/jpg" &&
                    evento.target.files[0]['type'] != "image/jpeg") {
                    alert("Elija una imagen");

                } else {
                    if (evento.target.files[0]['size'] > 3000000) {
                        alert("El peso debe ser hasta 3MB ");
                    } else {
                        reader.onload = function() {
                            iconoG4.style.display = "none";
                            perfilG4.style.border = "none";
                            //Asignamos la foto cargada
                            imgSubidaG4.style.display = "block";
                            imgSubidaG4.src = reader.result;
                            document.getElementById("quitaGCroquis").disabled = false;
                        }
                    }
                    //Cuando este listo ejecute lo siguiente

                }
            }
            subirImgG4.click();
        };
        let quitaG4 = document.getElementById("quitaGCroquis");
        quitaG4.onclick = function() {
            Swal.fire({
                title: 'Esta segur@?',
                text: "Se quitará la imagen",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si,quitar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    imgSubidaG4.src = null;
                    imgSubidaG4.style.display = "none";
                    iconoG4.style.display = "block";
                    document.getElementById("subirImgGCroquis").value = "";
                    document.getElementById("quitaGCroquis").disabled = true;
                    if (estaEnImagenes(vectorImaG, "croquis")) {
                        var auxi = [];
                        for (var i = 0; i < vectorImaG.length; i++) {
                            if (vectorImaG[i] !== "croquis") {
                                auxi.splice(i, 0, vectorImaG[i]);
                            }
                        }
                        vectorImaG = auxi;
                        indiceVecImaG = indiceVecImaG++;
                    }
                }
            })
        }
        let perfilG5 = document.getElementById("perfilGFolioReal");
        let iconoG5 = document.getElementById("iconoGFolioReal");
        let imgSubidaG5 = document.querySelector(".fotoGFolioReal");
        perfilG5.onclick = function() {
            let subirImgG5 = document.getElementById("subirImgGFolioReal");
            subirImgG5.onchange = function(evento) {
                //Creamos un objeto con la clase FileReader
                let reader = new FileReader();

                //Leemos el archivo subido y se lo pasamos a nuestro filereader
                reader.readAsDataURL(evento.target.files[0]);
                //Cuando este listo ejecute lo siguiente
                if (evento.target.files[0]['type'] != "image/png" &&
                    evento.target.files[0]['type'] != "image/jpg" &&
                    evento.target.files[0]['type'] != "image/jpeg") {
                    alert("Elija una imagen");

                } else {
                    if (evento.target.files[0]['size'] > 3000000) {
                        alert("El peso debe ser hasta 3MB ");
                    } else {
                        reader.onload = function() {
                            iconoG5.style.display = "none";
                            perfilG5.style.border = "none";
                            //Asignamos la foto cargada
                            imgSubidaG5.style.display = "block";
                            imgSubidaG5.src = reader.result;
                            document.getElementById("quitaGFolio").disabled = false;
                        }
                    }
                    //Cuando este listo ejecute lo siguiente

                }
            }
            subirImgG5.click();
        };
        let quitaG5 = document.getElementById("quitaGFolio");
        quitaG5.onclick = function() {
            Swal.fire({
                title: 'Esta segur@?',
                text: "Se quitará la imagen",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si,quitar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    imgSubidaG5.src = null;
                    imgSubidaG5.style.display = "none";
                    iconoG5.style.display = "block";
                    document.getElementById("subirImgGFolio").value = "";
                    document.getElementById("quitaGFolio").disabled = true;
                    if (estaEnImagenes(vectorImaG, "folio")) {
                        var auxi = [];
                        for (var i = 0; i < vectorImaG.length; i++) {
                            if (vectorImaG[i] !== "folio") {
                                auxi.splice(i, 0, vectorImaG[i]);
                            }
                        }
                        vectorImaG = auxi;
                        indiceVecImaG = indiceVecImaG++;
                    }
                }
            })
        }
        let perfilG6 = document.getElementById("perfilGTestimonio");
        let iconoG6 = document.getElementById("iconoGTestimonio");
        let imgSubidaG6 = document.querySelector(".fotoGTestimonio");
        perfilG6.onclick = function() {
            let subirImgG6 = document.getElementById("subirImgGTestimonio");
            subirImgG6.onchange = function(evento) {
                //Creamos un objeto con la clase FileReader
                let reader = new FileReader();

                //Leemos el archivo subido y se lo pasamos a nuestro filereader
                reader.readAsDataURL(evento.target.files[0]);
                //Cuando este listo ejecute lo siguiente
                if (evento.target.files[0]['type'] != "image/png" &&
                    evento.target.files[0]['type'] != "image/jpg" &&
                    evento.target.files[0]['type'] != "image/jpeg") {
                    alert("Elija una imagen");

                } else {
                    if (evento.target.files[0]['size'] > 3000000) {
                        alert("El peso debe ser hasta 3MB ");
                    } else {
                        reader.onload = function() {
                            iconoG6.style.display = "none";
                            perfilG6.style.border = "none";
                            //Asignamos la foto cargada
                            imgSubidaG6.style.display = "block";
                            imgSubidaG6.src = reader.result;
                            document.getElementById("quitaGTestimonio").disabled = false;
                        }
                    }
                    //Cuando este listo ejecute lo siguiente

                }
            }
            subirImgG6.click();
        };
        let quitaG6 = document.getElementById("quitaGTestimonio");
        quitaG6.onclick = function() {
            Swal.fire({
                title: 'Esta segur@?',
                text: "Se quitará la imagen",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si,quitar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    imgSubidaG6.src = null;
                    imgSubidaG6.style.display = "none";
                    iconoG6.style.display = "block";
                    document.getElementById("subirImgGTestimonio").value = "";
                    document.getElementById("quitaGTestimonio").disabled = true;
                    if (estaEnImagenes(vectorImaG, "testimonio")) {
                        var auxi = [];
                        for (var i = 0; i < vectorImaG.length; i++) {
                            if (vectorImaG[i] !== "testimonio") {
                                auxi.splice(i, 0, vectorImaG[i]);
                            }
                        }
                        vectorImaG = auxi;
                        indiceVecImaG = indiceVecImaG++;
                    }
                }
            })
        }
        let perfilG8 = document.getElementById("perfilGImpuesto");
        let iconoG8 = document.getElementById("iconoGImpuesto");
        let imgSubidaG8 = document.querySelector(".fotoGImpuesto");
        perfilG8.onclick = function() {
            let subirImgG8 = document.getElementById("subirImgGImpuesto");
            subirImgG8.onchange = function(evento) {
                //Creamos un objeto con la clase FileReader
                let reader = new FileReader();

                //Leemos el archivo subido y se lo pasamos a nuestro filereader
                reader.readAsDataURL(evento.target.files[0]);
                //Cuando este listo ejecute lo siguiente
                if (evento.target.files[0]['type'] != "image/png" &&
                    evento.target.files[0]['type'] != "image/jpg" &&
                    evento.target.files[0]['type'] != "image/jpeg") {
                    alert("Elija una imagen");

                } else {
                    if (evento.target.files[0]['size'] > 3000000) {
                        alert("El peso debe ser hasta 3MB ");
                    } else {
                        reader.onload = function() {
                            iconoG8.style.display = "none";
                            perfilG8.style.border = "none";
                            //Asignamos la foto cargada
                            imgSubidaG8.style.display = "block";
                            imgSubidaG8.src = reader.result;
                            document.getElementById("quitaGImpuesto").disabled = false;
                        }
                    }
                    //Cuando este listo ejecute lo siguiente

                }
            }
            subirImgG8.click();
        };
        let quitaG8 = document.getElementById("quitaGImpuesto");
        quitaG8.onclick = function() {
            Swal.fire({
                title: 'Esta segur@?',
                text: "Se quitará la imagen",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si,quitar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    imgSubidaG8.src = null;
                    imgSubidaG8.style.display = "none";
                    iconoG8.style.display = "block";
                    document.getElementById("subirImgGImpuesto").value = "";
                    document.getElementById("quitaGImpuesto").disabled = true;
                    if (estaEnImagenes(vectorImaG, "impuesto")) {
                        var auxi = [];
                        for (var i = 0; i < vectorImaG.length; i++) {
                            if (vectorImaG[i] !== "impuesto") {
                                auxi.splice(i, 0, vectorImaG[i]);
                            }
                        }
                        vectorImaG = auxi;
                        indiceVecImaG = indiceVecImaG++;
                    }
                }
            })
        }
        let perfilG9 = document.getElementById("perfilGRuat");
        let iconoG9 = document.getElementById("iconoGRuat");
        let imgSubidaG9 = document.querySelector(".fotoGRuat");
        perfilG9.onclick = function() {
            let subirImgG9 = document.getElementById("subirImgGRuat");
            subirImgG9.onchange = function(evento) {
                //Creamos un objeto con la clase FileReader
                let reader = new FileReader();

                //Leemos el archivo subido y se lo pasamos a nuestro filereader
                reader.readAsDataURL(evento.target.files[0]);
                //Cuando este listo ejecute lo siguiente
                if (evento.target.files[0]['type'] != "image/png" &&
                    evento.target.files[0]['type'] != "image/jpg" &&
                    evento.target.files[0]['type'] != "image/jpeg") {
                    alert("Elija una imagen");

                } else {
                    if (evento.target.files[0]['size'] > 3000000) {
                        alert("El peso debe ser hasta 3MB ");
                    } else {
                        reader.onload = function() {
                            iconoG9.style.display = "none";
                            perfilG9.style.border = "none";
                            //Asignamos la foto cargada
                            imgSubidaG9.style.display = "block";
                            imgSubidaG9.src = reader.result;
                            document.getElementById("quitaGRuat").disabled = false;
                        }
                    }
                    //Cuando este listo ejecute lo siguiente

                }
            }
            subirImgG9.click();
        };
        let quitaG9 = document.getElementById("quitaGRuat");
        quitaG9.onclick = function() {
            Swal.fire({
                title: 'Esta segur@?',
                text: "Se quitará la imagen",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si,quitar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    imgSubidaG9.src = null;
                    imgSubidaG9.style.display = "none";
                    iconoG9.style.display = "block";
                    document.getElementById("subirImgGRuat").value = "";
                    document.getElementById("quitaGRuat").disabled = true;
                    if (estaEnImagenes(vectorImaG, "ruat")) {
                        var auxi = [];
                        for (var i = 0; i < vectorImaG.length; i++) {
                            if (vectorImaG[i] !== "ruat") {
                                auxi.splice(i, 0, vectorImaG[i]);
                            }
                        }
                        vectorImaG = auxi;
                        indiceVecImaG = indiceVecImaG++;
                    }
                }
            })
        }
        let perfilG10 = document.getElementById("perfilGSoat");
        let iconoG10 = document.getElementById("iconoGSoat");
        let imgSubidaG10 = document.querySelector(".fotoGSoat");
        perfilG10.onclick = function() {
            let subirImgG10 = document.getElementById("subirImgGSoat");
            subirImgG10.onchange = function(evento) {
                //Creamos un objeto con la clase FileReader
                let reader = new FileReader();

                //Leemos el archivo subido y se lo pasamos a nuestro filereader
                reader.readAsDataURL(evento.target.files[0]);
                //Cuando este listo ejecute lo siguiente
                if (evento.target.files[0]['type'] != "image/png" &&
                    evento.target.files[0]['type'] != "image/jpg" &&
                    evento.target.files[0]['type'] != "image/jpeg") {
                    alert("Elija una imagen");

                } else {
                    if (evento.target.files[0]['size'] > 3000000) {
                        alert("El peso debe ser hasta 3MB ");
                    } else {
                        reader.onload = function() {
                            iconoG10.style.display = "none";
                            perfilG10.style.border = "none";
                            //Asignamos la foto cargada
                            imgSubidaG10.style.display = "block";
                            imgSubidaG10.src = reader.result;
                            document.getElementById("quitaGSoat").disabled = false;
                        }
                    }
                    //Cuando este listo ejecute lo siguiente

                }
            }
            subirImgG10.click();
        };
        let quitaG10 = document.getElementById("quitaGSoat");
        quitaG10.onclick = function() {
            Swal.fire({
                title: 'Esta segur@?',
                text: "Se quitará la imagen",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si,quitar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    imgSubidaG10.src = null;
                    imgSubidaG10.style.display = "none";
                    iconoG10.style.display = "block";
                    document.getElementById("subirImgGSoat").value = "";
                    document.getElementById("quitaGSoat").disabled = true;
                    if (estaEnImagenes(vectorImaG, "soat")) {
                        var auxi = [];
                        for (var i = 0; i < vectorImaG.length; i++) {
                            if (vectorImaG[i] !== "soat") {
                                auxi.splice(i, 0, vectorImaG[i]);
                            }
                        }
                        vectorImaG = auxi;
                        indiceVecImaG = indiceVecImaG++;
                    }
                }
            })
        }
        let perfilG11 = document.getElementById("perfilGNit");
        let iconoG11 = document.getElementById("iconoGNit");
        let imgSubidaG11 = document.querySelector(".fotoGNit");
        perfilG11.onclick = function() {
            let subirImgG11 = document.getElementById("subirImgGNit");
            subirImgG11.onchange = function(evento) {
                //Creamos un objeto con la clase FileReader
                let reader = new FileReader();

                //Leemos el archivo subido y se lo pasamos a nuestro filereader
                reader.readAsDataURL(evento.target.files[0]);
                //Cuando este listo ejecute lo siguiente
                if (evento.target.files[0]['type'] != "image/png" &&
                    evento.target.files[0]['type'] != "image/jpg" &&
                    evento.target.files[0]['type'] != "image/jpeg") {
                    alert("Elija una imagen");

                } else {
                    if (evento.target.files[0]['size'] > 3000000) {
                        alert("El peso debe ser hasta 3MB ");
                    } else {
                        reader.onload = function() {
                            iconoG11.style.display = "none";
                            perfilG11.style.border = "none";
                            //Asignamos la foto cargada
                            imgSubidaG11.style.display = "block";
                            imgSubidaG11.src = reader.result;
                            document.getElementById("quitaGNit").disabled = false;
                        }
                    }
                    //Cuando este listo ejecute lo siguiente

                }
            }
            subirImgG11.click();
        };
        let quitaG11 = document.getElementById("quitaGNit");
        quitaG11.onclick = function() {
            Swal.fire({
                title: 'Esta segur@?',
                text: "Se quitará la imagen",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si,quitar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    imgSubidaG11.src = null;
                    imgSubidaG11.style.display = "none";
                    iconoG11.style.display = "block";
                    document.getElementById("subirImgGNit").value = "";
                    document.getElementById("quitaGNit").disabled = true;
                    if (estaEnImagenes(vectorImaG, "nit")) {
                        var auxi = [];
                        for (var i = 0; i < vectorImaG.length; i++) {
                            if (vectorImaG[i] !== "nit") {
                                auxi.splice(i, 0, vectorImaG[i]);
                            }
                        }
                        vectorImaG = auxi;
                        indiceVecImaG = indiceVecImaG++;
                    }
                }
            })
        }
        let perfilG12 = document.getElementById("perfilGPatente");
        let iconoG12 = document.getElementById("iconoGPatente");
        let imgSubidaG12 = document.querySelector(".fotoGPatente");
        perfilG12.onclick = function() {
            let subirImgG12 = document.getElementById("subirImgGPatente");
            subirImgG12.onchange = function(evento) {
                //Creamos un objeto con la clase FileReader
                let reader = new FileReader();

                //Leemos el archivo subido y se lo pasamos a nuestro filereader
                reader.readAsDataURL(evento.target.files[0]);
                if (evento.target.files[0]['type'] != "image/png" &&
                    evento.target.files[0]['type'] != "image/jpg" &&
                    evento.target.files[0]['type'] != "image/jpeg") {
                    alert("Elija una imagen");

                } else {
                    if (evento.target.files[0]['size'] > 3000000) {
                        alert("El peso debe ser hasta 3MB ");
                    } else {
                        reader.onload = function() {
                            iconoG12.style.display = "none";
                            perfilG12.style.border = "none";
                            //Asignamos la foto cargada
                            imgSubidaG12.style.display = "block";
                            imgSubidaG12.src = reader.result;
                            document.getElementById("quitaGPatente").disabled = false;
                        }
                    }
                    //Cuando este listo ejecute lo siguiente

                }
            }
            subirImgG12.click();
        };
        let quitaG12 = document.getElementById("quitaGPatente");
        quitaG12.onclick = function() {
            Swal.fire({
                title: 'Esta segur@?',
                text: "Se quitará la imagen",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si,quitar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    imgSubidaG12.src = null;
                    imgSubidaG12.style.display = "none";
                    iconoG12.style.display = "block";
                    document.getElementById("subirImgGPatente").value = "";
                    document.getElementById("quitaGPatente").disabled = true;
                    if (estaEnImagenes(vectorImaG, "patente")) {
                        var auxi = [];
                        for (var i = 0; i < vectorImaG.length; i++) {
                            if (vectorImaG[i] !== "patente") {
                                auxi.splice(i, 0, vectorImaG[i]);
                            }
                        }
                        vectorImaG = auxi;
                        indiceVecImaG = indiceVecImaG++;
                    }
                }
            })
        }
        let perfilG13 = document.getElementById("perfilGBoletaPago");
        let iconoG13 = document.getElementById("iconoGBoletaPago");
        let imgSubidaG13 = document.querySelector(".fotoGBoletaPago");
        perfilG13.onclick = function() {
            let subirImgG13 = document.getElementById("subirImgGBoletaPago");
            subirImgG13.onchange = function(evento) {
                //Creamos un objeto con la clase FileReader
                let reader = new FileReader();

                //Leemos el archivo subido y se lo pasamos a nuestro filereader
                reader.readAsDataURL(evento.target.files[0]);
                //Cuando este listo ejecute lo siguiente
                if (evento.target.files[0]['type'] != "image/png" &&
                    evento.target.files[0]['type'] != "image/jpg" &&
                    evento.target.files[0]['type'] != "image/jpeg") {
                    alert("Elija una imagen");

                } else {
                    if (evento.target.files[0]['size'] > 3000000) {
                        alert("El peso debe ser hasta 3MB ");
                    } else {
                        reader.onload = function() {
                            iconoG13.style.display = "none";
                            perfilG13.style.border = "none";
                            //Asignamos la foto cargada
                            imgSubidaG13.style.display = "block";
                            imgSubidaG13.src = reader.result;
                            document.getElementById("quitaGBoletaPago").disabled = false;
                        }
                    }
                    //Cuando este listo ejecute lo siguiente

                }
            }
            subirImgG13.click();
        };
        let quitaG13 = document.getElementById("quitaGBoletaPago");
        quitaG13.onclick = function() {
            Swal.fire({
                title: 'Esta segur@?',
                text: "Se quitará la imagen",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si,quitar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    imgSubidaC13.src = null;
                    imgSubidaC13.style.display = "none";
                    iconoG13.style.display = "block";
                    document.getElementById("subirImgGBoletaPago").value = "";
                    document.getElementById("quitaGBoletaPago").disabled = true;
                    if (estaEnImagenes(vectorImaG, "boletapago")) {
                        var auxi = [];
                        for (var i = 0; i < vectorImaG.length; i++) {
                            if (vectorImaG[i] !== "boletapago") {
                                auxi.splice(i, 0, vectorImaG[i]);
                            }
                        }
                        vectorImaG = auxi;
                        indiceVecImaG = indiceVecImaG++;
                    }
                }
            })
        }
        let perfilG14 = document.getElementById("perfilGAfp");
        let iconoG14 = document.getElementById("iconoGAfp");
        let imgSubidaG14 = document.querySelector(".fotoGAfp");
        perfilG14.onclick = function() {
            let subirImgG14 = document.getElementById("subirImgGAfp");
            subirImgG14.onchange = function(evento) {
                //Creamos un objeto con la clase FileReader
                let reader = new FileReader();

                //Leemos el archivo subido y se lo pasamos a nuestro filereader
                reader.readAsDataURL(evento.target.files[0]);
                //Cuando este listo ejecute lo siguiente
                if (evento.target.files[0]['type'] != "image/png" &&
                    evento.target.files[0]['type'] != "image/jpg" &&
                    evento.target.files[0]['type'] != "image/jpeg") {
                    alert("Elija una imagen");

                } else {
                    if (evento.target.files[0]['size'] > 3000000) {
                        alert("El peso debe ser hasta 3MB ");
                    } else {
                        reader.onload = function() {
                            iconoG14.style.display = "none";
                            perfilG14.style.border = "none";
                            //Asignamos la foto cargada
                            imgSubidaG14.style.display = "block";
                            imgSubidaG14.src = reader.result;
                            document.getElementById("quitaGAfp").disabled = false;
                        }
                    }
                    //Cuando este listo ejecute lo siguiente

                }
            }
            subirImgG14.click();
        };
        let quitaG14 = document.getElementById("quitaGAfp");
        quitaG14.onclick = function() {
            Swal.fire({
                title: 'Esta segur@?',
                text: "Se quitará la imagen",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si,quitar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    imgSubidaG14.src = null;
                    imgSubidaG14.style.display = "none";
                    iconoG14.style.display = "block";
                    document.getElementById("subirImgGAfp").value = "";
                    document.getElementById("quitaGAfp").disabled = true;
                    if (estaEnImagenes(vectorImaG, "afp")) {
                        var auxi = [];
                        for (var i = 0; i < vectorImaG.length; i++) {
                            if (vectorImaG[i] !== "afp") {
                                auxi.splice(i, 0, vectorImaG[i]);
                            }
                        }
                        vectorImaG = auxi;
                        indiceVecImaG = indiceVecImaG++;
                    }
                }
            })
        }
        let perfilG15 = document.getElementById("perfilGPlanPago1");
        let iconoG15 = document.getElementById("iconoGPlanPago1");
        let imgSubidaG15 = document.querySelector(".fotoGPlanPago1");

        perfilG15.onclick = function() {
            let subirImgG15 = document.getElementById("subirImgGPlanPago1");
            subirImgG15.onchange = function(evento) {
                //Creamos un objeto con la clase FileReader
                let reader = new FileReader();

                //Leemos el archivo subido y se lo pasamos a nuestro filereader
                reader.readAsDataURL(evento.target.files[0]);
                //Cuando este listo ejecute lo siguiente
                if (evento.target.files[0]['type'] != "image/png" &&
                    evento.target.files[0]['type'] != "image/jpg" &&
                    evento.target.files[0]['type'] != "image/jpeg") {
                    alert("Elija una imagen");

                } else {
                    if (evento.target.files[0]['size'] > 3000000) {
                        alert("El peso debe ser hasta 3MB ");
                    } else {
                        reader.onload = function() {
                            iconoG15.style.display = "none";
                            perfilG15.style.border = "none";
                            //Asignamos la foto cargada
                            imgSubidaG15.style.display = "block";
                            imgSubidaG15.src = reader.result;
                            document.getElementById("quitaGPlanPago1").disabled = false;
                        }

                    }
                    //Cuando este listo ejecute lo siguiente

                }
            }
            subirImgG15.click();
        };
        let quitaG15 = document.getElementById("quitaGPlanPago1");
        quitaG15.onclick = function() {
            Swal.fire({
                title: 'Esta segur@?',
                text: "Se quitará la imagen",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si,quitar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    imgSubidaG15.src = null;
                    imgSubidaG15.style.display = "none";
                    iconoG15.style.display = "block";
                    document.getElementById("subirImgGPlanPago1").value = "";
                    document.getElementById("quitaGPlanPago1").disabled = true;
                    if (estaEnImagenes(vectorImaG, "planpago1")) {
                        var auxi = [];
                        for (var i = 0; i < vectorImaG.length; i++) {
                            if (vectorImaG[i] !== "planpago1") {
                                auxi.splice(i, 0, vectorImaG[i]);
                            }
                        }
                        vectorImaG = auxi;
                        indiceVecImaG = indiceVecImaG++;
                    }
                }
            })
        }
        let perfilG16 = document.getElementById("perfilGBoletaCancelacion1");
        let iconoG16 = document.getElementById("iconoGBoletaCancelacion1");
        let imgSubidaG16 = document.querySelector(".fotoGBoletaCancelacion1");
        perfilG16.onclick = function() {
            let subirImgG16 = document.getElementById("subirImgGBoletaCancelacion1");
            subirImgG16.onchange = function(evento) {
                //Creamos un objeto con la clase FileReader
                let reader = new FileReader();

                //Leemos el archivo subido y se lo pasamos a nuestro filereader
                reader.readAsDataURL(evento.target.files[0]);
                //Cuando este listo ejecute lo siguiente
                if (evento.target.files[0]['type'] != "image/png" &&
                    evento.target.files[0]['type'] != "image/jpg" &&
                    evento.target.files[0]['type'] != "image/jpeg") {
                    alert("Elija una imagen");

                } else {
                    if (evento.target.files[0]['size'] > 3000000) {
                        alert("El peso debe ser hasta 3MB ");
                    } else {
                        reader.onload = function() {
                            iconoG16.style.display = "none";
                            perfilG16.style.border = "none";
                            //Asignamos la foto cargada
                            imgSubidaG16.style.display = "block";
                            imgSubidaG16.src = reader.result;
                            document.getElementById("quitaGBoletaCancelacion1").disabled = false;
                        }
                    }
                    //Cuando este listo ejecute lo siguiente

                }
            }
            subirImgG16.click();
        };
        let quitaG16 = document.getElementById("quitaGBoletaCancelacion1");
        quitaG16.onclick = function() {
            Swal.fire({
                title: 'Esta segur@?',
                text: "Se quitará la imagen",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si,quitar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    imgSubidaG16.src = null;
                    imgSubidaG16.style.display = "none";
                    iconoG16.style.display = "block";
                    document.getElementById("subirImgGBoletaCancelacion1").value = "";
                    document.getElementById("quitaGBoletaCancelacion1").disabled = true;
                    if (estaEnImagenes(vectorImaG, "ultimaboleta1")) {
                        var auxi = [];
                        for (var i = 0; i < vectorImaG.length; i++) {
                            if (vectorImaG[i] !== "ultimaboleta1") {
                                auxi.splice(i, 0, vectorImaG[i]);
                            }
                        }
                        vectorImaG = auxi;
                        indiceVecImaG = indiceVecImaG++;
                    }
                }
            })
        }
        let perfilG17 = document.getElementById("perfilGPlanPago2");
        let iconoG17 = document.getElementById("iconoGPlanPago2");
        let imgSubidaG17 = document.querySelector(".fotoGPlanPago2");
        perfilG17.onclick = function() {
            let subirImgG17 = document.getElementById("subirImgGPlanPago2");
            subirImgG17.onchange = function(evento) {
                //Creamos un objeto con la clase FileReader
                let reader = new FileReader();

                //Leemos el archivo subido y se lo pasamos a nuestro filereader
                reader.readAsDataURL(evento.target.files[0]);
                //Cuando este listo ejecute lo siguiente
                if (evento.target.files[0]['type'] != "image/png" &&
                    evento.target.files[0]['type'] != "image/jpg" &&
                    evento.target.files[0]['type'] != "image/jpeg") {
                    alert("Elija una imagen");

                } else {
                    if (evento.target.files[0]['size'] > 3000000) {
                        alert("El peso debe ser hasta 3MB ");
                    } else {
                        reader.onload = function() {
                            iconoG17.style.display = "none";
                            perfilG17.style.border = "none";
                            //Asignamos la foto cargada
                            imgSubidaG17.style.display = "block";
                            imgSubidaG17.src = reader.result;
                            document.getElementById("quitaGPlanPago2").disabled = false;
                        }
                    }
                    //Cuando este listo ejecute lo siguiente

                }
            }
            subirImgG17.click();
        };
        let quitaG17 = document.getElementById("quitaGPlanPago2");
        quitaG17.onclick = function() {
            Swal.fire({
                title: 'Esta segur@?',
                text: "Se quitará la imagen",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si,quitar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    imgSubidaG17.src = null;
                    imgSubidaG17.style.display = "none";
                    iconoG17.style.display = "block";
                    document.getElementById("subirImgGPlanPago2").value = "";
                    document.getElementById("quitaGPlanPago2").disabled = true;
                    if (estaEnImagenes(vectorImaG, "planpago2")) {
                        var auxi = [];
                        for (var i = 0; i < vectorImaG.length; i++) {
                            if (vectorImaG[i] !== "planpago2") {
                                auxi.splice(i, 0, vectorImaG[i]);
                            }
                        }
                        vectorImaG = auxi;
                        indiceVecImaG = indiceVecImaG++;
                    }

                }
            })

        }

        let perfilG18 = document.getElementById("perfilGBoletaCancelacion2");
        let iconoG18 = document.getElementById("iconoGBoletaCancelacion2");
        let imgSubidaG18 = document.querySelector(".fotoGBoletaCancelacion2");
        perfilG18.onclick = function() {
            let subirImgG18 = document.getElementById("subirImgGBoletaCancelacion2");
            subirImgG18.onchange = function(evento) {
                //Creamos un objeto con la clase FileReader
                let reader = new FileReader();

                //Leemos el archivo subido y se lo pasamos a nuestro filereader
                reader.readAsDataURL(evento.target.files[0]);
                //Cuando este listo ejecute lo siguiente
                if (evento.target.files[0]['type'] != "image/png" &&
                    evento.target.files[0]['type'] != "image/jpg" &&
                    evento.target.files[0]['type'] != "image/jpeg") {
                    alert("Elija una imagen");

                } else {
                    if (evento.target.files[0]['size'] > 3000000) {
                        alert("El peso debe ser hasta 3MB ");
                    } else {
                        reader.onload = function() {
                            iconoG18.style.display = "none";
                            perfilG18.style.border = "none";
                            //Asignamos la foto cargada
                            imgSubidaG18.style.display = "block";
                            imgSubidaG18.src = reader.result;
                            document.getElementById("quitaGBoletaCancelacion2").disabled = false;
                        }
                    }
                    //Cuando este listo ejecute lo siguiente

                }
            }
            subirImgG18.click();
        };
        let quitaG18 = document.getElementById("quitaGBoletaCancelacion2");
        quitaG18.onclick = function() {
            Swal.fire({
                title: 'Esta segur@?',
                text: "Se quitará la imagen",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si,quitar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    imgSubidaG18.src = null;
                    imgSubidaG18.style.display = "none";
                    iconoG18.style.display = "block";
                    document.getElementById("subirImgGBoletaCancelacion2").value = "";
                    document.getElementById("quitaGBoletaCancelacion2").disabled = true;
                    if (estaEnImagenes(vectorImaG, "ultimaboleta2")) {
                        var auxi = [];
                        for (var i = 0; i < vectorImaG.length; i++) {
                            if (vectorImaG[i] !== "ultimaboleta2") {
                                auxi.splice(i, 0, vectorImaG[i]);
                            }
                        }
                        vectorImaG = auxi;
                        indiceVecImaG = indiceVecImaG++;
                    }
                }
            })
        }
        let perfilG19 = document.getElementById("perfilGPlanPago3");
        let iconoG19 = document.getElementById("iconoGPlanPago3");
        let imgSubidaG19 = document.querySelector(".fotoGPlanPago3");
        perfilG19.onclick = function() {
            let subirImgG19 = document.getElementById("subirImgGPlanPago3");
            subirImgG19.onchange = function(evento) {
                //Creamos un objeto con la clase FileReader
                let reader = new FileReader();

                //Leemos el archivo subido y se lo pasamos a nuestro filereader
                reader.readAsDataURL(evento.target.files[0]);
                //Cuando este listo ejecute lo siguiente
                if (evento.target.files[0]['type'] != "image/png" &&
                    evento.target.files[0]['type'] != "image/jpg" &&
                    evento.target.files[0]['type'] != "image/jpeg") {
                    alert("Elija una imagen");

                } else {
                    if (evento.target.files[0]['size'] > 3000000) {
                        alert("El peso debe ser hasta 3MB ");
                    } else {
                        reader.onload = function() {
                            iconoG19.style.display = "none";
                            perfilG19.style.border = "none";
                            //Asignamos la foto cargada
                            imgSubidaG19.style.display = "block";
                            imgSubidaG19.src = reader.result;
                            document.getElementById("quitaGPlanPago3").disabled = false;
                        }
                    }
                    //Cuando este listo ejecute lo siguiente

                }
            }
            subirImgG19.click();
        };
        let quitaG19 = document.getElementById("quitaGPlanPago3");
        quitaG19.onclick = function() {
            Swal.fire({
                title: 'Esta segur@?',
                text: "Se quitará la imagen",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si,quitar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    imgSubidaG19.src = null;
                    imgSubidaG19.style.display = "none";
                    iconoG19.style.display = "block";
                    document.getElementById("subirImgGPlanPago3").value = "";
                    document.getElementById("quitaGPlanPago3").disabled = true;
                    if (estaEnImagenes(vectorImaG, "planpago3")) {
                        var auxi = [];
                        for (var i = 0; i < vectorImaG.length; i++) {
                            if (vectorImaG[i] !== "planpago3") {
                                auxi.splice(i, 0, vectorImaG[i]);
                            }
                        }
                        vectorImaG = auxi;
                        indiceVecImaG = indiceVecImaG++;
                    }
                }
            })
        }
        let perfilG20 = document.getElementById("perfilGBoletaCancelacion3");
        let iconoG20 = document.getElementById("iconoGBoletaCancelacion3");
        let imgSubidaG20 = document.querySelector(".fotoGBoletaCancelacion3");
        perfilG20.onclick = function() {
            let subirImgG20 = document.getElementById("subirImgGBoletaCancelacion3");
            subirImgG20.onchange = function(evento) {
                //Creamos un objeto con la clase FileReader
                let reader = new FileReader();

                //Leemos el archivo subido y se lo pasamos a nuestro filereader
                reader.readAsDataURL(evento.target.files[0]);
                //Cuando este listo ejecute lo siguiente
                if (evento.target.files[0]['type'] != "image/png" &&
                    evento.target.files[0]['type'] != "image/jpg" &&
                    evento.target.files[0]['type'] != "image/jpeg") {
                    alert("Elija una imagen");

                } else {
                    if (evento.target.files[0]['size'] > 3000000) {
                        alert("El peso debe ser hasta 3MB ");
                    } else {
                        reader.onload = function() {
                            iconoG20.style.display = "none";
                            perfilG20.style.border = "none";
                            //Asignamos la foto cargada
                            imgSubidaG20.style.display = "block";
                            imgSubidaG20.src = reader.result;
                            document.getElementById("quitaGBoletaCancelacion3").disabled = false;
                        }
                    }
                    //Cuando este listo ejecute lo siguiente

                }
            }
            subirImgG20.click();
        };
        let quitaG20 = document.getElementById("quitaGBoletaCancelacion3");
        quitaG20.onclick = function() {
            Swal.fire({
                title: 'Esta segur@?',
                text: "Se quitará la imagen",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si,quitar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    imgSubidaG20.src = null;
                    imgSubidaG20.style.display = "none";
                    iconoG20.style.display = "block";
                    document.getElementById("subirImgGBoletaCancelacion3").value = "";
                    document.getElementById("quitaGBoletaCancelacion3").disabled = true;
                    if (estaEnImagenes(vectorImaG, "ultimaboleta3")) {
                        var auxi = [];
                        for (var i = 0; i < vectorImaG.length; i++) {
                            if (vectorImaG[i] !== "ultimaboleta3") {
                                auxi.splice(i, 0, vectorImaG[i]);
                            }
                        }
                        vectorImaG = auxi;
                        indiceVecImaG = indiceVecImaG++;
                    }
                }
            })
        }
        let perfilG21 = document.getElementById("perfilGPlanPago4");
        let iconoG21 = document.getElementById("iconoGPlanPago4");
        let imgSubidaG21 = document.querySelector(".fotoGPlanPago4");
        perfilG21.onclick = function() {
            let subirImgG21 = document.getElementById("subirImgGPlanPago4");
            subirImgG21.onchange = function(evento) {
                //Creamos un objeto con la clase FileReader
                let reader = new FileReader();

                //Leemos el archivo subido y se lo pasamos a nuestro filereader
                reader.readAsDataURL(evento.target.files[0]);
                //Cuando este listo ejecute lo siguiente
                if (evento.target.files[0]['type'] != "image/png" &&
                    evento.target.files[0]['type'] != "image/jpg" &&
                    evento.target.files[0]['type'] != "image/jpeg") {
                    alert("Elija una imagen");

                } else {
                    if (evento.target.files[0]['size'] > 3000000) {
                        alert("El peso debe ser hasta 3MB ");
                    } else {
                        reader.onload = function() {
                            iconoG21.style.display = "none";
                            perfilG21.style.border = "none";
                            //Asignamos la foto cargada
                            imgSubidaG21.style.display = "block";
                            imgSubidaG21.src = reader.result;
                            document.getElementById("quitaGPlanPago4").disabled = false;
                        }
                    }
                    //Cuando este listo ejecute lo siguiente

                }
            }
            subirImgG21.click();
        };
        let quitaG21 = document.getElementById("quitaGPlanPago4");
        quitaG21.onclick = function() {
            Swal.fire({
                title: 'Esta segur@?',
                text: "Se quitará la imagen",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si,quitar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    imgSubidaG21.src = null;
                    imgSubidaG21.style.display = "none";
                    iconoG21.style.display = "block";
                    document.getElementById("subirImgGPlanPago4").value = "";
                    document.getElementById("quitaGPlanPago4").disabled = true;
                    if (estaEnImagenes(vectorImaG, "planpago4")) {
                        var auxi = [];
                        for (var i = 0; i < vectorImaG.length; i++) {
                            if (vectorImaG[i] !== "planpago4") {
                                auxi.splice(i, 0, vectorImaG[i]);
                            }
                        }
                        vectorImaG = auxi;
                        indiceVecImaG = indiceVecImaG++;
                    }
                }
            })
        }
        let perfilG22 = document.getElementById("perfilGBoletaCancelacion4");
        let iconoG22 = document.getElementById("iconoGBoletaCancelacion4");
        let imgSubidaG22 = document.querySelector(".fotoGBoletaCancelacion4");
        perfilG22.onclick = function() {
            let subirImgG22 = document.getElementById("subirImgGBoletaCancelacion4");
            subirImgG22.onchange = function(evento) {
                //Creamos un objeto con la clase FileReader
                let reader = new FileReader();

                //Leemos el archivo subido y se lo pasamos a nuestro filereader
                reader.readAsDataURL(evento.target.files[0]);
                //Cuando este listo ejecute lo siguiente
                if (evento.target.files[0]['type'] != "image/png" &&
                    evento.target.files[0]['type'] != "image/jpg" &&
                    evento.target.files[0]['type'] != "image/jpeg") {
                    alert("Elija una imagen");

                } else {
                    if (evento.target.files[0]['size'] > 3000000) {
                        alert("El peso debe ser hasta 3MB ");
                    } else {
                        reader.onload = function() {
                            iconoG22.style.display = "none";
                            perfilG22.style.border = "none";
                            //Asignamos la foto cargada
                            imgSubidaG22.style.display = "block";
                            imgSubidaG22.src = reader.result;
                            document.getElementById("quitaGBoletaCancelacion4").disabled = false;
                        }
                    }
                    //Cuando este listo ejecute lo siguiente

                }
            }
            subirImgG22.click();
        };
        let quitaG22 = document.getElementById("quitaGBoletaCancelacion4");
        quitaG22.onclick = function() {
            Swal.fire({
                title: 'Esta segur@?',
                text: "Se quitará la imagen",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si,quitar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    imgSubidaG22.src = null;
                    imgSubidaG22.style.display = "none";
                    iconoG22.style.display = "block";
                    document.getElementById("subirImgGBoletaCancelacion4").value = "";
                    document.getElementById("quitaGBoletaCancelacion4").disabled = true;
                    if (estaEnImagenes(vectorImaG, "ultimaboleta4")) {
                        var auxi = [];
                        for (var i = 0; i < vectorImaG.length; i++) {
                            if (vectorImaG[i] !== "ultimaboleta4") {
                                auxi.splice(i, 0, vectorImaG[i]);
                            }
                        }
                        vectorImaG = auxi;
                        indiceVecImaG = indiceVecImaG++;
                    }
                }
            })
        }

    }

    function estaEnBancos(vector, banco) {
        var c = 0;
        if (banco != 0) {
            for (var i = 0; i <= vector.length; i++) {
                if (vector[i] == banco) {
                    c++;
                }
            }
            return c;
        }

    }

    function registrarTramite() {
        form = $("#id_reg_tramite");
        form.submit(registraTramite);

        function registraTramite(evento) {
            evento.preventDefault();
            var tramite = new FormData($(form)[0]);
            var idcliente = document.getElementById("id_cliente").value;
            var idusuario = document.getElementById("id_usuario").value;
            var banco = document.getElementById("selec_banco").value;
            var bancosDCliente = [];
            var bancosDGarante = [];
            var listaBancosCliente = [];
            var listaBancosGarante = [];
            bancosDCliente.push($('#select_banco_cfolder1').val());
            bancosDCliente.push($('#select_banco_cfolder2').val());
            bancosDCliente.push($('#select_banco_cfolder3').val());
            bancosDCliente.push($('#select_banco_cfolder4').val());

            bancosDGarante.push($('#select_banco_gfolder1').val());
            bancosDGarante.push($('#select_banco_gfolder2').val());
            bancosDGarante.push($('#select_banco_gfolder3').val());
            bancosDGarante.push($('#select_banco_gfolder4').val());

            listaBancosCliente.push($('#bancod1').val());
            listaBancosCliente.push($('#bancod2').val());
            listaBancosCliente.push($('#bancod3').val());
            listaBancosCliente.push($('#bancod4').val());

            listaBancosGarante.push($('#selec_deuda_lgarante1').val());
            listaBancosGarante.push($('#selec_deuda_lgarante2').val());
            listaBancosGarante.push($('#selec_deuda_lgarante3').val());
            listaBancosGarante.push($('#selec_deuda_lgarante4').val());
            if (estaEnBancos(bancosDCliente, $('#select_banco_cfolder1').val()) >= 2 ||
                estaEnBancos(bancosDCliente, $('#select_banco_cfolder2').val()) >= 2 ||
                estaEnBancos(bancosDCliente, $('#select_banco_cfolder3').val()) >= 2 ||
                estaEnBancos(bancosDCliente, $('#select_banco_cfolder4').val()) >= 2) {
                alert("ERROR, BANCO REPETIDO EN OTRAS DEUDAS DE CLIENTE");

            } else {
                if (estaEnBancos(listaBancosCliente, $('#bancod1').val()) >= 2 ||
                    estaEnBancos(listaBancosCliente, $('#bancod2').val()) >= 2 ||
                    estaEnBancos(listaBancosCliente, $('#bancod3').val()) >= 2 ||
                    estaEnBancos(listaBancosCliente, $('#bancod4').val()) >= 2) {
                    alert("ERROR, BANCO REPETIDO EN LISTA DE DEUDAS DE CLIENTE");
                } else {
                    if (estaEnBancos(bancosDGarante, $('#select_banco_gfolder1').val()) >= 2 ||
                        estaEnBancos(bancosDGarante, $('#select_banco_gfolder2').val()) >= 2 ||
                        estaEnBancos(bancosDGarante, $('#select_banco_gfolder3').val()) >= 2 ||
                        estaEnBancos(bancosDGarante, $('#select_banco_gfolder4').val()) >= 2) {
                        alert("ERROR, BANCO REPETIDO EN OTRAS DEUDAS DE GARANTE");
                    } else {
                        if (estaEnBancos(listaBancosGarante, $('#selec_deuda_lgarante1').val()) >= 2 ||
                            estaEnBancos(listaBancosGarante, $('#selec_deuda_lgarante2').val()) >= 2 ||
                            estaEnBancos(listaBancosGarante, $('#selec_deuda_lgarante3').val()) >= 2 ||
                            estaEnBancos(listaBancosGarante, $('#selec_deuda_lgarante1').val()) >= 2) {
                            alert("ERROR, BANCO REPETIDO EN LISTA DE DEUDAS DE GARANTE");
                        } else {

                            if (idcliente !== "" && matrizVehiculos.length > 0) {
                                $.ajax({
                                    url: '../scripts/verificaTramite.php',
                                    type: 'POST',
                                    data: {
                                        "cliente": idcliente,
                                        "banco": banco
                                    },
                                    async: false,
                                }).done(function(res) {
                                    if (res > 0) {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Error',
                                            text: 'El cliente ya tiene un tramite con el banco',
                                        })
                                    } else {
                                        var monto = document.getElementById("monto_pres").value;
                                        var total = 0;
                                        for (var i = 0; i < matrizVehiculos.length; i++) {
                                            var rev = Object.values(matrizVehiculos[i]);
                                            var arr = Object.values(rev[0]);
                                            total = total + parseInt(arr[6], 10);
                                        }
                                        if (monto >= total) {
                                            var idusuario = document.getElementById("id_usuario").value;
                                            var obs = document.getElementById("id_observacion").value;
                                            if (obs == "") {
                                                obs = "Ninguna";
                                            }
                                            tramite.append('observacionT', obs);
                                            tramite.append('cliente', idcliente);
                                            tramite.append('usuario', idusuario);
                                            for (var i = 0; i < matrizVehiculos.length; i++) {
                                                tramite.append('vehiculos[]', Object.values(matrizVehiculos[i]));
                                            }
                                            $.ajax({
                                                url: '../scripts/registrarTramite.php',
                                                type: 'POST',
                                                data: tramite,
                                                contentType: false,
                                                processData: false,
                                            }).done(function(res) {
                                                console.log(res);
                                                Swal.fire({
                                                    position: 'center',
                                                    icon: 'success',
                                                    title: 'Trámite Registrado',
                                                    showConfirmButton: false,
                                                    timer: 1500
                                                });
                                                form[0].reset();
                                                limpiarIma();
                                            });
                                            matrizVehiculos = [];
                                            $("#tablaCliente tr").remove();
                                            $("#tablaVehiculo tr").remove();
                                            document.getElementById('inputCi').style.display = 'inline';
                                            document.getElementById('idbtnAdCliente').style.display = 'inline';
                                            document.getElementById('id_cliente').value = "";
                                            document.getElementById('idtablabusM').style.display = 'none';
                                            document.getElementById('idtablabusCI').style.display = 'none';
                                            $("#selec_banco").val($("#selec_banco").data("Seleccionar"));
                                            $("#monto_pres").val($("#monto_pres").data(""));
                                        } else {
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'Error',
                                                text: 'Monto de prestamo menor al precio de la(s) movilidad(es)',

                                            })
                                        }
                                    }

                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: 'Debe elegir un cliente y el vehiculo!',

                                })
                            }
                        }
                    }
                }
            }
        }
    }
})