$(document).ready(function() {
    $('.botonVerCurriculum').on('click', function(e) {

        e.preventDefault();
        var idc = $(this).attr('id');
        $.ajax({
            url: '../scripts/buscaUsuario.php',
            type: 'GET',
            data: {
                "idUsu": idc,
                "doc": 12
            },
        }).done(function(res) {
            document.getElementById("frameCurriculum").src = res;

        })

    });


    $('.botonVerCroquis').on('click', function(e) {
        e.preventDefault();
        var idc = $(this).attr('id');
        $.ajax({
            url: '../scripts/buscaUsuario.php',
            type: 'GET',
            data: {
                "idUsu": idc,
                "doc": 13
            },
        }).done(function(res) {
            let c = document.getElementById("frameCro");
            c.src = res;

        })

    });



})