$(document).ready(

    setTimeout(function() {

        $('.content-form').css("opacity", "1");
    }, 100)
)

//USUARIO

$('#input-usuario').on('focus', function() {

    $('.label-usuario').css("margin-top", "0px");
    $('.label-usuario').css("font-size", "14px");
    $('.label-usuario').css("color", "green");
    $('.label-usuario').css("font-weight", "bold");
    $('.fas fa-user-secret').all(style = "color:green");


})

$('#input-usuario').on('focusout', function() {

    if ($('#input-usuario').val().length < 1) {
        $('.label-usuario').css("margin-top", "30px");
        $('.label-usuario').css("font-size", "16px");
        $('.label-usuario').css("color", "rgb(122, 129, 136)");
        $('.label-usuario').css("font-weight", "normal");
    } else {
        $('.label-usuario').css("margin-top", "0px");
        $('.label-usuario').css("font-size", "14px");
        $('.label-usuario').css("color", "green");
        $('.label-usuario').css("font-weight", "bold");
        $('.fas fa-user-secret').all(style = "color:green");
    }
})

//Contraseña
$('#input-password').on('focus', function() {

    $('.label-password').css("margin-top", "25px");
    $('.label-password').css("font-size", "14px");
    $('.label-password').css("color", "green");
    $('.label-password').css("font-weight", "bold");
    $('.fas fa-key').all(style = "color:green");
})

$('#input-password').on('focusout', function() {

    if ($('#input-password').val().length < 1) {
        $('.label-password').css("margin-top", "50px");
        $('.label-password').css("font-size", "16px");
        $('.label-password').css("color", "rgb(122, 129, 136)");
        $('.label-password').css("font-weight", "normal");

    } else {
        $('.label-password').css("margin-top", "25px");
        $('.label-password').css("font-size", "14px");
        $('.label-password').css("color", "green");
        $('.label-password').css("font-weight", "bold");
    }
})
formact = $("#formlogin");
formact.submit(inicio_sesion);

function inicio_sesion(evento) {
    evento.preventDefault();
    formact = $("#formlogin");
    var usuario = new FormData($(formact)[0]);
    $.ajax({
        url: 'scripts/inicio_sesion.php',
        type: 'POST',
        data: usuario,
        contentType: false,
        processData: false,
        async: false,

    }).done(function(res) {
        console.log(res);
        if (res.trim() == "SI") {
            window.location.href = "views/home.php";
        } else {
            alert("Datos incorrectos o estado inactivo");
            window.location.href = "index.php";
        }
    });
}