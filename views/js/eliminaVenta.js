$(document).ready(function() {

    $('.botonElimina').on('click', function(e) {
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
                var idv = $(this).attr('id');
                $.ajax({
                    url: '../scripts/eliminaVenta.php',
                    type: 'POST',
                    data: {
                        "idventa": idv
                    },
                }).done(function(res) {
                    console.log(res);
                    if (res.trim() == "Eliminado") {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Venta eliminada',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        window.setTimeout(function() {

                            // Move to a new location or you can do something else
                            window.location.href = "listaVenta.php";

                        }, 1600);

                    } else {
                        if (res.trim() == "No eliminado") {
                            Swal.fire({
                                position: 'center',
                                icon: 'error',
                                title: 'Fecha de eliminación expiró',
                                showConfirmButton: false,
                                timer: 1500
                            });

                        }

                    }



                })

            } else {



            }
        });

    });


})