$(document).ready(function() {

    $('.botonBuscar').on('click', function(e) {
        e.preventDefault();
        var idc = document.getElementById("inputCI").value;
        var nom = document.getElementById("inputNom").value;
        $.ajax({
            url: '../scripts/buscarTramite.php',
            type: 'POST',
            data: {
                "carnet": idc,
                "nombre": nom
            },
            dataType: "JSON",
            async: false,

        }).done(function(res) {
            var lon = 0;
            res.forEach(function(value, index) {
                lon++;
            });
            var tablaC = document.getElementById("idTab");
            var cont = 1;
            if (lon > 0) {
                document.getElementById("idtablabusT").style.display = "block";
                res.forEach(function(value, index) {
                    var tabla = document.getElementById("idTab");
                    var rowCount = $('#idTab tr').length;
                    var row = tabla.insertRow(rowCount);

                    //this adds row in 0 index i.e. first place
                    var colC = row.insertCell(0);
                    colC.innerHTML = cont;
                    colC = row.insertCell(1);
                    var cicliente = res[index]["cicliente"];
                    colC.innerHTML = cicliente;

                    colC = row.insertCell(2);
                    var paterno = res[index]["paterno"];
                    colC.innerHTML = paterno;

                    colC = row.insertCell(3);
                    var materno = res[index]["materno"];
                    colC.innerHTML = materno;

                    colC = row.insertCell(4);
                    var nombre = res[index]["nombre"];
                    colC.innerHTML = nombre;

                    colC = row.insertCell(5);
                    var banco = res[index]["banco"];
                    colC.innerHTML = banco;

                    colC = row.insertCell(6);
                    var monto = res[index]["monto_prestamo"];
                    colC.innerHTML = monto + " $";
                    cont++;

                    colC = row.insertCell(7);
                    var fecha = res[index]["fechaini"];
                    var inicio = fecha.split("-")[2] + " - " + fecha.split("-")[1] + " - " + fecha.split("-")[0];
                    colC.innerHTML = inicio;


                });

            }

        })

    });

});