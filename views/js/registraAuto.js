$(document).ready(function() {
    foto();

    form = $("#registroAuto");
    form.submit(registraAuto);

    function registraAuto(evento) {
        evento.preventDefault();
        var auto = new FormData($(form)[0]);
        let color = [];
        var ima = document.getElementById("subirImg");
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
        if (ima.files.length == 0) {
            Swal.fire({
                title: 'Elija una imagen',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ok!'
            })

        }
        if (color.length != 0 && ima.files.length != 0) {
            var men1 = "Registro de Auto exitoso";
            var men2 = "El automovil ya existe";
            var men3 = "Elija una imagen";
            var men4 = "Error al registrar el auto";
            for (var i = 0; i < color.length; i++) {
                auto.append('color[]', color[i]);
            }
            $.ajax({
                url: '../scripts/registrarAutomovil.php',
                type: 'POST',
                data: auto,
                contentType: false,
                processData: false,
                async: false,

            }).done(function(res) {
                switch (res.trim()) {
                    case men1:
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Vehiculo Registrado',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        let icono = document.getElementById("icono");
                        let imgSubida = document.querySelector(".foto");
                        imgSubida.src = null;
                        imgSubida.style.display = "none";
                        icono.style.display = "block";
                        document.getElementById("quitaFotoV").hidden = true;
                        document.getElementById("quitaFotoV").disabled = true;
                        form[0].reset();
                        window.setTimeout(function() {
                            // Move to a new location or you can do something else
                            window.location.href = "listaMovilidad.php";

                        }, 1800);

                        break;
                    case men2:
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: 'Vehiculo ya registrado',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        icono = document.getElementById("icono");
                        imgSubida = document.querySelector(".foto");
                        imgSubida.src = null;
                        imgSubida.style.display = "none";
                        icono.style.display = "block";
                        document.getElementById("quitaFotoV").hidden = true;
                        document.getElementById("quitaFotoV").disabled = true;
                        form[0].reset();
                        break;
                    case men3:
                        Swal.fire({
                            position: 'center',
                            icon: 'warning',
                            title: 'Elija una imagen con formato jpg o jpeg',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        break;
                    case men4:
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: 'Error al registrar, intente de nuevo por favor',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        break;
                    default:

                }

            })

        }

    };

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


});