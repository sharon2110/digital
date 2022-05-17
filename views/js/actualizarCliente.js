    $(document).ready(function() {
        var verificaFoto;
        datosCliente();
        fotoCliente();
        actualizaCliente();

        function datosCliente() {
            var cliente = document.getElementById("id_cliente").value;
            $.ajax({
                url: '../scripts/datosCliente.php',
                type: 'GET',
                data: {
                    "cliente": cliente
                },
                dataType: "JSON"

            }).done(function(res) {
                console.log(res);
                $('#ci_cliente').val(res[2]);
                $('#ci_cliente_ext').val(res[3]);
                $('#apP_cliente').val(res[4]);
                $('#apM_cliente').val(res[5]);
                $('#nom_cliente').val(res[6]);
                $('#cel_cliente').val(res[7]);
                $('#dir_cliente').val(res[8]);
                if (res[9] == 'Comerciante') {
                    document.getElementById("empleo").value = 2;
                } else {
                    document.getElementById("empleo").value = 1;
                }

                if (res[10] !== null) {
                    let perfil = document.getElementById("perfil");
                    let icono = document.getElementById("icono");
                    let imgSubida = document.querySelector(".foto");
                    icono.style.display = "none";
                    perfil.style.border = "none";
                    imgSubida.style.display = "block";
                    $('.foto').attr("src", res[10]);
                    document.getElementById("quitaFotoCliente").disabled = false;
                    document.getElementById("quitaFotoCliente").hidden = false;
                    verificaFoto = "foto";

                }
                $('#asesor').val(res[1]);


            });
        }

        function fotoCliente() {
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
                                document.getElementById("quitaFotoCliente").disabled = false;
                                document.getElementById("quitaFotoCliente").hidden = false;
                            }
                        }
                    }

                }
                subirImg.click();
            };
            let quitaF = document.getElementById("quitaFotoCliente");
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
                        document.getElementById("quitaFotoCliente").hidden = true;
                        document.getElementById("quitaFotoCliente").disabled = true;
                        verificaFoto = "";
                    }
                })
            }
        }

        function actualizaCliente() {
            formact = $("#actualizar_cliente");
            formact.submit(actualizarCliente);
            var men1 = "Actualizacion exitosa";
            var men2 = "No se pudo actualizar";
            var men3 = "Elija una imagen";

            function actualizarCliente(evento) {
                evento.preventDefault();
                Swal.fire({
                    title: '¿Está seguro de realizar la acción?',
                    text: "Se modificaran los datos del cliente",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si,modificar!'
                }).then((result) => {
                    if (!result.isConfirmed) {
                        window.location = "listaClientes.php";
                    } else {
                        if (result.isConfirmed) {
                            var idcliente = document.getElementById("id_cliente").value;
                            formact = $("#actualizar_cliente");
                            var cliente = new FormData($(formact)[0]);
                            cliente.append("idcli", idcliente);
                            cliente.append("verificaFoto", verificaFoto);
                            $.ajax({
                                url: '../scripts/actualizarCliente.php',
                                type: 'POST',
                                data: cliente,
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
                                            window.location.href = "listaClientes.php";

                                        }, 2000);
                                        break;
                                    case men3:
                                        Swal.fire({
                                            position: 'center',
                                            icon: 'warning',
                                            title: 'Elija una imagen',
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

        function estaEnImagenes(vector, cadena) {
            for (var i = 0; i <= vector.length; i++) {
                if (vector[i] == cadena) {
                    return true;
                }
            }
            return false;
        }

    })