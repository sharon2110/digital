$(document).ready(function() {


    /*  Ver y Ocultar los submenus */
    $('.item-menu').on('click', function(e) {
        var SubMenu = $(this).next('.sub-menu');
        var iconBtn = $(this).children('.fa-chevron-down');
        if (SubMenu.hasClass('mostrarSub')) {
            $(this).removeClass('active');
            iconBtn.removeClass('fa-rotate-180');
            SubMenu.removeClass('mostrarSub');

        } else {
            $('.contenedorMenu').css("overflow-y", "scroll");
            $(this).addClass('active');
            iconBtn.addClass('fa-rotate-180');
            SubMenu.addClass('mostrarSub');
        }
    });

    /*  Ver y Ocultar menu lateral */
    $('.mostrarBar').on('click', function(e) {
        e.preventDefault();
        var NavLateral = $('.contenedorMenu');
        var PageConten = $('.navbar');
        if (NavLateral.hasClass('active')) {
            NavLateral.removeClass('active');

            PageConten.removeClass('active');
        } else {
            NavLateral.addClass('active');
            PageConten.addClass('active');
        }
    });



    /*  Exit system buttom */
    $('.botonSalir').on('click', function(e) {
        e.preventDefault();
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: true
        })

        swalWithBootstrapButtons.fire({
            title: 'Esta seguro?',
            text: "Esta a punto de cerrar sesión!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Salir  ',
            cancelButtonText: 'Cancelar  ',
            confirmButtonColor: '#008000',
            cancelButtonColor: '#d33',

        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "../scripts/cerrarSesion.php";
            }

        })
    });

    formact = $("#confU");
    formact.submit(configurarU);

    function configurarU(evento) {
        evento.preventDefault();
        formact = $("#confU");
        var datos = new FormData($(formact)[0]);
        $.ajax({
            url: '../scripts/configU.php',
            type: 'POST',
            data: datos,
            contentType: false,
            processData: false,
            async: false,
        }).done(function(res) {
            console.log(res);
            if (res.trim() === "ACTUALIZADO") {
                window.location.href = "../scripts/cerrarSesion.php";
            } else {
                if (res.trim() !== "SIN MODIFICAR") {
                    alert("Las contraseñas no coinciden");
                }

            }

        })
    };

    let perfil = document.getElementById("perfil1");
    let icono = document.getElementById("icono1");
    let imgSubida = document.querySelector(".foto1");
    perfil.onclick = function(evento) {
        let subirImg = document.getElementById("subirImg1");
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
                    }
                }
            }

        };
        subirImg.click();

    }



});


$(function() {
    $('[data-toggle="popover"]').popover()
});