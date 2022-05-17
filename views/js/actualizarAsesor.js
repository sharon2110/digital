$(document).ready(function() {
    var verificaCroquis;
    datosAsesor();
    fotoCroquis();
    curriculum();
    actualizarAsesor();


    function curriculum() {
        $(function() {
            $('.inputFile').on('change', function() {
                var n = $(this)[0].files[0].name;
                var extension = n.split(".").slice(-1);
                extension = extension[0];
                let extensiones = ["pdf"];

                if (extensiones.indexOf(extension) === -1) {
                    alert("Extensión NO permitida");
                } else {
                    $(this).prev().text($(this)[0].files[0].name);
                }

            })
        });
    }

    function fotoCroquis() {
        let perfil = document.getElementById("perfil");
        let icono = document.getElementById("icono");
        let imgSubida = document.querySelector(".foto");


        perfil.onclick = function() {
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
                            document.getElementById("quitaCroquis").disabled = false;
                            document.getElementById("quitaCroquis").hidden = false;
                        }
                    }
                }

            }
            subirImg.click();
        };
        let quitaF = document.getElementById("quitaCroquis");
        quitaF.onclick = function() {
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
                    document.getElementById("quitaCroquis").hidden = true;
                    document.getElementById("quitaCroquis").disabled = true;
                    verificaCroquis = "";
                }
            })
        }
    }

    function datosAsesor() {
        var usuario = document.getElementById("id_usuario").value;
        $.ajax({
            url: '../scripts/datosUsu.php',
            type: 'GET',
            data: {
                "usuario": usuario
            },
            dataType: "JSON",
            async: false,
        }).done(function(res) {
            console.log(res);
            $('#ci_asesorinput').val(res[1]);
            $('#ci_extasesorinput').val(res[2]);
            $('#apP_asesor').val(res[3]);
            $('#apM_asesor').val(res[4]);
            $('#nom_asesor').val(res[5]);
            $('#cel_asesor').val(res[6]);
            $('#dir_asesor').val(res[7]);
            $('#usuario_asesor').val(res[8]);
            $('#tipoUsuario').val(res[9]);
            $('#estado').val(res[10]);
            if (res[13] !== null) {
                let perfil = document.getElementById("perfil");
                let icono = document.getElementById("icono");
                let imgSubida = document.querySelector(".foto");
                icono.style.display = "none";
                perfil.style.border = "none";
                imgSubida.style.display = "block";
                $('.foto').attr("src", res[13]);
                document.getElementById("quitaCroquis").disabled = false;
                document.getElementById("quitaCroquis").hidden = false;
                verificaCroquis = "croquis";
            } else {

            }

        });
    }

    function actualizarAsesor() {
        formact = $("#act_asesor");
        formact.submit(actualizarAsesor);
        var men1 = "Actualizacion exitosa";
        var men2 = "No se pudo actualizar";
        var men3 = "Archivos con formato no permitido";

        function actualizarAsesor(evento) {
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
                    window.location = "listaAsesores.php";
                } else {
                    if (result.isConfirmed) {
                        var idUsuario = document.getElementById("id_usuario").value;
                        formact = $("#act_asesor");
                        var usuario = new FormData($(formact)[0]);
                        usuario.append("idUsu", idUsuario);
                        usuario.append("verificaCroquis", verificaCroquis);
                        $.ajax({
                            url: '../scripts/actualizarAsesor.php',
                            type: 'POST',
                            data: usuario,
                            contentType: false,
                            processData: false,

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
                                        window.location.href = "listaAsesores.php";

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
            });

        }
    }


})