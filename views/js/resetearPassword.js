$(document).ready(function() {
    $(document).on('click', '#botonReset', function(event) {
        var index = $(this).closest("tr").index();
        index = index + 1;
        var idUsuario = document.getElementById("tablaResId").rows[index].cells[1].innerText;
        $.ajax({
            url: '../scripts/resetearPassword.php',
            type: 'POST',
            data: {
                "usuario": idUsuario
            },

        }).done(function(res) {

            if (res.trim() == "Reseteado") {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Contraseña reseteada',
                    showConfirmButton: false,
                    timer: 1500
                });
            }

        })
    });
})