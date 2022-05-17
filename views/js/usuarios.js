$(document).ready(function() {
    fotoCroquis();
    registrar();


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
                }
            })
        }
    }

    function registrar() {
        form = $("#registrar_usuario");
        form.submit(registraUsuario);

        function registraUsuario(evento) {
            evento.preventDefault();
            var usuario = new FormData($(form)[0]);
            let imgSubida = document.querySelector(".foto");
            let perfil = document.getElementById("perfil");
            let icono = document.getElementById("icono");
            var men1 = "Registro exitoso";
            var men2 = "El usuario ya esta registrado";
            var men3 = "Elija archivos";
            $.ajax({
                url: '../scripts/registrarUsuario.php',
                type: 'POST',
                data: usuario,
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
                            title: 'Usuario Registrado',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        form[0].reset();
                        imgSubida.src = "";
                        imgSubida.style.display = "none";
                        icono.style.display = "block";
                        document.getElementById('fileEnt').innerHTML = '';


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
                            title: 'Usuario ya registrado',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    default:
                        break;
                }

            })
        };
        //Previsualizacion de la foto

    }

    function limpiar() {
        let limpia = document.getElementById("limpiarFormUsuario");
        limpia.onclick = function() {
            imgSubida.src = "";
            imgSubida.style.display = "none";
            icono.style.display = "block";
            document.getElementById('fileEnt').innerHTML = '';
        };
    }


});