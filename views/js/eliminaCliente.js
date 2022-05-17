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
                var idc = $(this).attr('id');
                $.ajax({
                    url: '../scripts/eliminarCliente.php',
                    type: 'POST',
                    data: {
                        "idcli": idc
                    },
                }).done(function(res) {
                    console.log(res);
                    if (res.trim() == "Cliente Eliminado") {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Cliente eliminado',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        window.setTimeout(function() {

                            // Move to a new location or you can do something else
                            window.location.href = "listaClientes.php";

                        }, 1600);

                    } else {
                        if (res.trim() == "No se puede eliminar") {
                            Swal.fire({
                                position: 'center',
                                icon: 'error',
                                title: 'No se puede eliminar',
                                text: 'Hay una venta o trámite registrado del cliente',
                                showConfirmButton: true,
                            });

                        }

                    }



                })

            } else {



            }
        });

    });


})