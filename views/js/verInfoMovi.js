$(document).ready(function() {
    $('.botonDetalleMovilidad').on('click', function(e) {
        e.preventDefault();
        var idv = $(this).attr('idv');
        $.ajax({
            url: '../scripts/verInfoMovi.php',
            type: 'GET',
            data: {
                "idMovi": idv,
            },
        }).done(function(res) {
            var array = JSON.parse(res);
            var arrayl = array.length;
            var color = "";

            document.getElementById("labelNro").innerHTML = array[0]["numpas"];
            document.getElementById("labelCil").innerHTML = array[0]["cilindrada"];
            for (var i = 1; i < arrayl - 1; i++) {
                if (i == arrayl - 2) {
                    color = color + array[i]["color"]
                } else {
                    color = color + array[i]["color"] + " * ";
                }

            }
            document.getElementById("imgFotoVehiculo").src = array[arrayl - 1]["fotovehiculo"];
            document.getElementById("labelColor").innerHTML = color;

        })

    });

})