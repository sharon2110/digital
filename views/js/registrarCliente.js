$(document).ready(function() {
    fotoCliente();
    registrar();
    limpiar();

    function fotoCliente() {
        //Previsualizacion de la foto
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
                }
            })
        }
    }

    function registrar() {
        form = $("#registrar_cliente");
        form.submit(registraCliente);

        function registraCliente(evento) {
            evento.preventDefault();
            var cliente = new FormData($(form)[0]);
            let imgSubida = document.querySelector(".foto");
            let icono = document.getElementById("icono");
            var men1 = "Registro exitoso";
            var men2 = "El cliente ya esta registrado";
            var men3 = "Elija una imagen";
            $.ajax({
                url: '../scripts/registrarCliente.php',
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
                            title: 'Cliente Registrado',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        form[0].reset();
                        imgSubida.src = "";
                        imgSubida.style.display = "none";
                        icono.style.display = "block";
                        document.getElementById("quitaFotoCliente").disabled = true;
                        document.getElementById("quitaFotoCliente").hidden = true;

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
                            title: 'Cliente ya registrado',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    default:
                        break;
                }

            })
        };
    }

    function limpiar() {
        let perfil = document.getElementById("perfil");
        let icono = document.getElementById("icono");
        let imgSubida = document.querySelector(".foto");
        imgSubida.src = "";
        imgSubida.style.display = "none";
        icono.style.display = "block";


    }

});