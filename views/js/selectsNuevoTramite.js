$(document).ready(function() {
    $('#selec_banco').val();
    recargarListaBancos();

    $('#selec_banco').change(function() {
        recargarListaBancos();
    });



    function recargarListaBancos() {
        $.ajax({
            type: "POST",
            url: "../scripts/selectBanco.php",
            data: "",
            success: function(r) {
                $('#selec_banco').html(r);
            }
        });
    };
})