$(document).ready(function() {

    $('.botonEliminaMovilidad').on('click', function(e) {
        e.preventDefault();
        Swal.fire({
            title: '¿Está seguro de realizar la acción?',
            text: "No podrá recuperar los datos",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Eliminar'
        }).then((result) => {
            if (result.isConfirmed) {
                var idv = $(this).attr('idv');
                $.ajax({
                    url: '../scripts/eliminarMovi.php',
                    type: 'GET',
                    data: {
                        "idmovi": idv
                    },
                }).done(function(res) {
                    if (res.trim() == "Vehiculo Eliminado") {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Vehiculo eliminado',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        window.setTimeout(function() {

                            // Move to a new location or you can do something else
                            window.location.href = "listaMovilidad.php";

                        }, 1600);

                    }



                })

            } else {



            }
        });

    });


})