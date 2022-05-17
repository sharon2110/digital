$(document).ready(function() {
    $('#marca_selec').val();
    recargarLista();

    $('#marca_selec').change(function() {
        recargarLista();
    });
    $('#modelo_selec').val();
    recargarListaModelos();

    $('#modelo_selec').val();
    recargarListaTipos();

    $('#modelo_selec').change(function() {
        recargarListaModelos();
    });
    $('#modelo_selec').change(function() {
        recargarListaTipos();
    });
    $('#modelo_selec').val();
    recargarListaColores();

    $('#modelo_selec').change(function() {
        recargarListaColores();
    });
    $('#modelo_selec').change(function() {
        recargarListaCilindrada();
    });
    $('#modelo_selec').val();
    recargarListaColores();

    $('#modelo_selec').val();
    recargarListaCilindrada();

    $('#modelo_selec').change(function() {
        recargarListaPrecios();
    });
    $('#precio_selec').change(function(e) {
        if (($(this).val()).trim() === "Otro") {
            $('#precio_autoOtro').prop('disabled', false);
        } else {
            $('#precio_autoOtro').prop('disabled', true);
        }
    })
    $('#modelo_selec').change(function(e) {
        if (($(this).val()).trim() === "Otro") {
            $('#modelo_autoOtro').prop('disabled', false);
        } else {
            $('#modelo_autoOtro').prop('disabled', true);
        }
    })
    $('#tipo_selec').change(function(e) {
        if (($(this).val()).trim() === "Otro") {
            $('#tipo_autoOtro').prop('disabled', false);
        } else {
            $('#tipo_autoOtro').prop('disabled', true);
        }
    })
    $('#color_selec').change(function(e) {
        if (($(this).val()).trim() === "Otro") {
            $('#color_autoOtro').prop('disabled', false);
        } else {
            $('#color_autoOtro').prop('disabled', true);
        }
    })
    $('#numpas_selec').change(function(e) {
        if (($(this).val()).trim() === "Otro") {
            $('#num_autoOtro').prop('disabled', false);
        } else {
            $('#num_autoOtro').prop('disabled', true);
        }
    })
    $('#cilindrada_selec').change(function(e) {
        if (($(this).val()).trim() === "Otro") {
            $('#cilindrada_autoOtro').prop('disabled', false);
        } else {
            $('#cilindrada_autoOtro').prop('disabled', true);
        }
    })

    function recargarLista() {
        $.ajax({
            type: "POST",
            url: "../scripts/selectModelos.php",
            data: "marca=" + $('#marca_selec').val(),
            async: false,
            success: function(r) {
                $('#modelo_selec').html(r);
            }
        });
    };

    function recargarListaModelos() {
        $.ajax({
            type: "POST",
            url: "../scripts/selectNumPas.php",
            data: {
                "modelo": $('#modelo_selec').val(),
                "marca": $('#marca_selec').val()
            },
            async: false,
            success: function(r) {
                $('#numpas_selec').html(r);
            }
        });
    };

    function recargarListaColores() {
        $.ajax({
            type: "POST",
            url: "../scripts/selectColores.php",
            data: {
                "modelo": $('#modelo_selec').val(),
                "marca": $('#marca_selec').val()
            },
            async: false,
            success: function(r) {
                $('#color_selec').html(r);
            }
        });
    };

    function recargarListaPrecios() {
        $.ajax({
            type: "POST",
            url: "../scripts/selectPrecios.php",
            data: {
                "modelo": $('#modelo_selec').val(),
                "marca": $('#marca_selec').val()
            },
            async: false,
            success: function(r) {
                $('#precio_selec').html(r);
            }
        });
    };

    function recargarListaTipos() {
        $.ajax({
            type: "POST",
            url: "../scripts/selectTipos.php",
            data: {
                "modelo": $('#modelo_selec').val(),
                "marca": $('#marca_selec').val()
            },
            async: false,
            success: function(r) {
                //console.log(r);
                $('#tipo_selec').html(r);
            }
        });
    };

    function recargarListaCilindrada() {
        $.ajax({
            type: "POST",
            url: "../scripts/selectCilindrada.php",
            data: {
                "modelo": $('#modelo_selec').val(),
                "marca": $('#marca_selec').val()
            },
            async: false,
            success: function(r) {
                //console.log(r);
                $('#cilindrada_selec').html(r);
            }
        });
    };



});