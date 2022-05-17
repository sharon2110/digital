$(document).ready(function() {

    $('.botonEliminaTramite').on('click', function(e) {
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
                var idt = $(this).attr('id');
                $.ajax({
                    url: '../scripts/eliminarTramite.php',
                    type: 'POST',
                    data: {
                        "idtramite": idt
                    },
                }).done(function(res) {
                    console.log(res);
                    if (res.trim() == "Eliminado") {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Trámite eliminado',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        window.setTimeout(function() {

                            // Move to a new location or you can do something else
                            window.location.href = "listaTramites.php";

                        }, 1600);

                    } else {
                        if (res.trim() == "No se puede eliminar") {
                            Swal.fire({
                                position: 'center',
                                icon: 'error',
                                title: 'El trámite no esta cancelado',
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