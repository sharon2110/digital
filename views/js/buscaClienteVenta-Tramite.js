$(document).ready(function() {
    document.getElementById("idbuscaCi").addEventListener('click', function() {
        var cliente = document.getElementById("inputCi").value;
        if (cliente == "") {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'No hay datos para la búsqueda!',
            })
            $("#modalCliente").modal("hide");
            document.getElementById('idtablabusCI').style.display = 'none';
            document.getElementById('id_cliente').value = "";
            document.getElementById('inputCi').style.display = 'block';
            document.getElementById('inputCi').value = "";
            document.getElementById('idbtnAdCliente').style.display = 'inline-block';
        } else {
            $.ajax({
                url: '../scripts/buscaClienteVenta-Tramite.php',
                type: 'GET',
                data: {
                    "cliente": cliente
                },
                dataType: "JSON"

            }).done(function(res) {
                var lon = 0;
                res.forEach(function(value, index) {
                    lon++;
                });

                var tablaC = document.getElementById("tablaCliente");
                $("#tablaCliente tr").remove();

                var row = tablaC.insertRow(0);
                //this adds row in 0 index i.e. first place
                var colC = row.insertCell(0);

                if (lon > 0) {
                    res.forEach(function(value, index) {
                        var idcliente = res[index]['idcliente'];
                        var nombre = res[index]['paterno'] + " " + res[index]['materno'] + " " + res[index]['nombre'];
                        document.getElementById('idtablabusCI').style.display = 'block';
                        document.getElementById('idbtnAdCliente').style.display = 'none';
                        document.getElementById('inputCi').style.display = 'none';
                        document.getElementById('inputCi').value = "";
                        colC.innerHTML = "&nbsp;" + nombre + " " + " " + "&nbsp;" +
                            '   <button type="button" class="btn botonElimina" id="idquitaCI" name="quitaV"><i class="far fa-trash-alt fa-xs"></i></button>';
                        $("#inputCi").val($("#inputCi_selec").data(""));
                        document.getElementById('id_cliente').value = res[index]['idcliente'];
                        $("#modalCliente").modal("hide");
                        document.getElementById("btnModalAuto").removeAttribute("hidden");
                        document.getElementById('btnModalAuto').style.display = 'block';
                    });

                } else {
                    document.getElementById('idtablabusCI').style.display = 'none';
                    $("#modalCliente").modal("hide");
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'No se encontró al cliente!',
                    })
                    document.getElementById('id_cliente').value = "";
                    document.getElementById('inputCi').style.display = 'block';
                    document.getElementById('inputCi').value = "";
                    document.getElementById('idbtnAdCliente').style.display = 'inline-block';
                }

            });
        }



    }, true);

    $(document).on('click', '#idquitaCI', function(event) {
        event.preventDefault();
        $(this).closest('tr').remove();
        document.getElementById("idbtnAdCliente").removeAttribute("hidden");
        document.getElementById('idtablabusCI').style.display = 'none';
        document.getElementById('idbtnAdCliente').style.display = 'inline';
        document.getElementById('inputCi').style.display = 'block';
        document.getElementById('inputCi').value = "";
        document.getElementById('id_cliente').value = "";
        $("#btnModalAuto").hide(); //Ocultar DIV
        document.getElementById('idtablabusM').style.display = 'none';
        matrizVehiculos = [];
        $("#tablaVehiculo tr").remove();
    });



});