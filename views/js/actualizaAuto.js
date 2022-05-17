$(document).ready(function() {
    foto();

    function foto() {
        let perfil = document.getElementById("perfil");
        let icono = document.getElementById("icono");
        let imgSubida = document.querySelector(".foto");
        perfil.onclick = function(evento) {
            let subirImg = document.getElementById("subirImg");
            subirImg.onchange = function(evento) {
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
                            icono.style.display = "none";
                            perfil.style.border = "none";
                            //Asignamos la foto cargada
                            imgSubida.style.display = "block";
                            imgSubida.src = reader.result;
                            document.getElementById("quitaFotoV").disabled = false;
                            document.getElementById("quitaFotoV").hidden = false;
                        }
                    }
                }

            };
            subirImg.click();

        }
        let quitaF = document.getElementById("quitaFotoV");
        quitaF.onclick = function() {
            let icono = document.getElementById("icono");
            let imgSubida = document.querySelector(".foto");
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
                    imgSubida.src = null;
                    imgSubida.style.display = "none";
                    icono.style.display = "block";
                    console.log(imgSubida.src);
                    document.getElementById("quitaFotoV").hidden = true;
                    document.getElementById("quitaFotoV").disabled = true;
                }
            })
        }
    }

    var idmovi = document.getElementById("id_movilidad").value;
    $.ajax({
        url: '../scripts/datosMovilidad.php',
        type: 'GET',
        data: {
            "movilidad": idmovi,
        },
        async: false,

    }).done(function(res) {
        var array = JSON.parse(res);
        var arrayl = array.length;
        $("#idselproveedor").val(array[0]["proveedor"]);
        $("#idpreciocompra").val(array[0]["precioproveedor"]);
        $("#idpreciominventa").val(array[0]["preciominimo"]);
        $("#idprecioventa").val(array[0]["precioventa"]);
        $("#idselmarca").val(array[0]["marca"]);
        $("#idseltipo").val(array[0]["tipo"]);
        $("#idmodelo").val(array[0]["modelo"]);
        $("#idnumpas").val(array[0]["numpas"]);
        $("#idcilindrada").val(array[0]["cilindrada"]);
        let perfil = document.getElementById("perfil");
        let icono = document.getElementById("icono");
        let imgSubida = document.querySelector(".foto");
        icono.style.display = "none";
        perfil.style.border = "none";
        imgSubida.style.display = "block";
        $('.foto').attr("src", array[0]["fotovehiculo"]);
        document.getElementById("quitaFotoV").disabled = false;
        document.getElementById("quitaFotoV").hidden = false;
        for (var i = 1; i <= arrayl - 1; i++) {
            switch (array[i]["idcolor"]) {
                case 1:
                    $("#color_uno_id").prop('checked', true);
                    break;
                case 2:
                    $("#color_dos_id").prop('checked', true);
                    break;
                case 3:
                    $("#color_tres_id").prop('checked', true);
                    break;
                case 4:
                    $("#color_cuatro_id").prop('checked', true);
                    break;
                case 5:
                    $("#color_cinco_id").prop('checked', true);
                    break;
                case 6:
                    $("#color_seis_id").prop('checked', true);
                    break;
                case 7:
                    $("#color_siete_id").prop('checked', true);
                    break;
                case 8:
                    $("#color_ocho_id").prop('checked', true);
                    break;
                case 9:
                    $("#color_nueve_id").prop('checked', true);
                    break;
                case 10:
                    $("#color_diez_id").prop('checked', true);
                    break;
                default:
                    break;

            }


        }
    });

    formact = $("#actualizaAuto");
    formact.submit(actualizarAuto);

    function actualizarAuto(evento) {
        evento.preventDefault();
        Swal.fire({
            title: '¿Está seguro de realizar la acción?',
            text: "Se modificaran los datos del usuario",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si,modificar!'
        }).then((result) => {
            if (!result.isConfirmed) {
                window.location = "listaMovilidad.php";
            } else {
                if (result.isConfirmed) {
                    let color = [];
                    if (document.getElementById('color_uno_id').checked) {
                        color.push('1');
                    }
                    if (document.getElementById('color_dos_id').checked) {
                        color.push('2');
                    }
                    if (document.getElementById('color_tres_id').checked) {
                        color.push('3');
                    }
                    if (document.getElementById('color_cuatro_id').checked) {
                        color.push('4');
                    }
                    if (document.getElementById('color_cinco_id').checked) {
                        color.push('5');
                    }
                    if (document.getElementById('color_seis_id').checked) {
                        color.push('6');
                    }
                    if (document.getElementById('color_siete_id').checked) {
                        color.push('7');
                    }
                    if (document.getElementById('color_ocho_id').checked) {
                        color.push('8');
                    }
                    if (document.getElementById('color_nueve_id').checked) {
                        color.push('9');
                    }
                    if (document.getElementById('color_diez_id').checked) {
                        color.push('10');
                    }
                    if (color.length == 0) {
                        Swal.fire({
                            title: 'Elija un color',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ok!'
                        })
                    }
                    if (color.length != 0) {
                        var men1 = "Actualizacion exitosa";
                        var men2 = "No se pudo actualizar";
                        var men3 = "Archivos con formato no permitido";
                        var idMovi = document.getElementById("id_movilidad").value;
                        var prov = document.getElementById("idselproveedor").value;
                        if (prov.trim() == "XIAMEN KING LONG UNITED AUTOMOTIVE") {
                            prov = 1;
                        } else {
                            if (prov.trim() == "FUJIAN NEW LONGMA AUTOMOTIVE CO.,LT.") {
                                prov = 2;
                            }

                        }
                        var vehiculo = new FormData($(formact)[0]);
                        vehiculo.append("idMovi", idMovi);
                        vehiculo.append("idProv", prov);
                        for (var i = 0; i < color.length; i++) {
                            vehiculo.append('color[]', color[i]);
                        }
                        $.ajax({
                            url: '../scripts/actualizarAutomovil.php',
                            type: 'POST',
                            data: vehiculo,
                            contentType: false,
                            processData: false,
                            async: false,

                        }).done(function(res) {
                            console.log(res);
                            switch (res.trim()) {
                                case men1:
                                    Swal.fire({
                                        position: 'center',
                                        icon: 'success',
                                        title: 'Datos Actualizados',
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                    window.setTimeout(function() {

                                        // Move to a new location or you can do something else
                                        window.location.href = "listaMovilidad.php";

                                    }, 2000);
                                    break;
                                case men3:
                                    Swal.fire({
                                        position: 'center',
                                        icon: 'warning',
                                        title: 'Elija una imagen jpg y un archivo pdf',
                                        showConfirmButton: false,
                                        timer: 1500
                                    })
                                    break;
                                case men2:
                                    Swal.fire({
                                        position: 'center',
                                        icon: 'error',
                                        title: 'Hubo un error,intente de nuevo',
                                        showConfirmButton: false,
                                        timer: 1500
                                    })
                                default:
                                    break;
                            }
                        });

                    }
                }
            }
        });

    }

})