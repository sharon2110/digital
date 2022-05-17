$(document).ready(function() {
    recargarLista1();
    recargarLista2();
    recargarLista3();
    recargarLista4();
    recargarLista5();
    recargarLista6();
    recargarLista7();
    recargarLista8();
    recargarLista9();
    recargarLista10();
    recargarLista11();
    recargarLista12();

    $('#select_banco_cfolder1').change(function() {
        recargarLista1();
    });

    $('#select_banco_cfolder2').change(function() {
        recargarLista2();
    });

    $('#select_banco_cfolder3').change(function() {
        recargarLista3();
    });

    $('#select_banco_gfolder1').change(function() {
        recargarLista4();
    });

    $('#select_banco_gfolder2').change(function() {
        recargarLista5();
    });

    $('#select_banco_gfolder3').change(function() {
        recargarLista6();
    });

    $('#selec_deuda_lcliente1').change(function() {
        recargarLista7();
    });
    $('#selec_deuda_lcliente2').change(function() {
        recargarLista8();
    });
    $('#selec_deuda_lcliente3').change(function() {
        recargarLista9();
    });

    $('#selec_deuda_lgarante1').change(function() {
        recargarLista10();
    });
    $('#selec_deuda_lgarante2').change(function() {
        recargarLista11();
    });
    $('#selec_deuda_lgarante3').change(function() {
        recargarLista12();
    });

    function recargarLista1() {
        if ($('#select_banco_cfolder1').val() != "0") {
            $.ajax({
                type: "POST",
                url: "../scripts/selectBancos.php",
                data: "banco1=" + $('#select_banco_cfolder1').val(),
                success: function(r) {
                    $('#select_banco_cfolder2').html(r);
                }
            });
        }
    };

    function recargarLista2() {
        if ($('#select_banco_cfolder2').val() != "0") {
            $.ajax({
                type: "POST",
                url: "../scripts/selectBancos.php",
                data: {
                    "banco1": $('#select_banco_cfolder1').val(),
                    "banco2": $('#select_banco_cfolder2').val(),
                },
                async: false,
                success: function(r) {
                    $('#select_banco_cfolder3').html(r);
                }
            });
        }
    };

    function recargarLista3() {
        if ($('#select_banco_cfolder3').val() != "0") {
            $.ajax({
                type: "POST",
                url: "../scripts/selectBancos.php",
                data: {
                    "banco1": $('#select_banco_cfolder1').val(),
                    "banco2": $('#select_banco_cfolder2').val(),
                    "banco3": $('#select_banco_cfolder3').val(),
                },
                async: false,
                success: function(r) {
                    $('#select_banco_cfolder4').html(r);
                }
            });
        }
    };

    function recargarLista4() {
        if ($('#select_banco_gfolder1').val() != "0") {
            $.ajax({
                type: "POST",
                url: "../scripts/selectBancos.php",
                data: "banco1=" + $('#select_banco_gfolder1').val(),
                async: false,
                success: function(r) {
                    $('#select_banco_gfolder2').html(r);
                }
            });
        }
    };

    function recargarLista5() {
        if ($('#select_banco_gfolder2').val() != "0") {
            $.ajax({
                type: "POST",
                url: "../scripts/selectBancos.php",
                data: {
                    "banco1": $('#select_banco_gfolder1').val(),
                    "banco2": $('#select_banco_gfolder2').val(),
                },
                async: false,
                success: function(r) {
                    $('#select_banco_gfolder3').html(r);
                }
            });
        }
    };

    function recargarLista6() {
        if ($('#select_banco_gfolder3').val() !== "0") {
            $.ajax({
                type: "POST",
                url: "../scripts/selectBancos.php",
                data: {
                    "banco1": $('#select_banco_gfolder1').val(),
                    "banco2": $('#select_banco_gfolder2').val(),
                    "banco3": $('#select_banco_gfolder3').val(),
                },
                async: false,
                success: function(r) {
                    $('#select_banco_gfolder4').html(r);
                }
            });
        }
    };

    function recargarLista7() {
        if ($('#selec_deuda_lcliente1').val() !== "0") {
            $.ajax({
                type: "POST",
                url: "../scripts/selectBancos.php",
                data: {
                    "banco1": $('#selec_deuda_lcliente1').val(),
                },
                async: false,
                success: function(r) {
                    $('#selec_deuda_lcliente2').html(r);
                }
            });
        }
    };

    function recargarLista8() {
        if ($('#selec_deuda_lcliente2').val() !== "0") {
            $.ajax({
                type: "POST",
                url: "../scripts/selectBancos.php",
                data: {
                    "banco1": $('#selec_deuda_lcliente1').val(),
                    "banco2": $('#selec_deuda_lcliente2').val(),
                },
                async: false,
                success: function(r) {
                    $('#selec_deuda_lcliente3').html(r);
                }
            });
        }
    };

    function recargarLista9() {
        if ($('#selec_deuda_lcliente3').val() != "0") {
            $.ajax({
                type: "POST",
                url: "../scripts/selectBancos.php",
                data: {
                    "banco1": $('#selec_deuda_lcliente1').val(),
                    "banco2": $('#selec_deuda_lcliente2').val(),
                    "banco3": $('#selec_deuda_lcliente3').val(),
                },
                async: false,
                success: function(r) {
                    $('#selec_deuda_lcliente4').html(r);
                }
            });
        }
    };

    function recargarLista10() {
        if ($('#selec_deuda_lgarante1').val() != "0") {
            console.log("AQ");
            $.ajax({
                type: "POST",
                url: "../scripts/selectBancos.php",
                data: {
                    "banco1": $('#selec_deuda_lgarante1').val(),
                },
                async: false,
                success: function(r) {
                    $('#selec_deuda_lgarante2').html(r);
                }
            });
        }
        console.log($('#selec_deuda_lgarante1').val());
    };

    function recargarLista11() {
        if ($('#selec_deuda_lgarante2').val() != "0") {
            $.ajax({
                type: "POST",
                url: "../scripts/selectBancos.php",
                data: {
                    "banco1": $('#selec_deuda_lgarante1').val(),
                    "banco2": $('#selec_deuda_lgarante2').val(),
                },
                async: false,
                success: function(r) {
                    $('#selec_deuda_lgarante3').html(r);
                }
            });
        }
    };

    function recargarLista12() {
        if ($('#selec_deuda_lgarante3').val() != "0") {
            $.ajax({
                type: "POST",
                url: "../scripts/selectBancos.php",
                data: {
                    "banco1": $('#selec_deuda_lgarante1').val(),
                    "banco2": $('#selec_deuda_lgarante2').val(),
                    "banco3": $('#selec_deuda_lgarante3').val(),
                },
                async: false,
                success: function(r) {
                    $('#selec_deuda_lgarante4').html(r);
                }
            });
        }
    }

})