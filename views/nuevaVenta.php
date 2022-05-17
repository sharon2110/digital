<?php
session_start();
$usuario = $_SESSION['usuario'];
$tusu = $_SESSION['tipo'];
$idusu = $_SESSION['idusuario'];
$estado = $_SESSION['estado'];
if ($usuario == null || $usuario == "" || $estado != "Activo") {
    header("Location: ../scripts/cerrarSesion.php");
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/all.css">
    <link rel="stylesheet" href="./css/sweetalert2.min.css">
    <link rel="stylesheet" href="./css/estiloHome.css">
    <link rel="stylesheet" href="./css/estiloVentas.css">
    <title>Nueva_Venta</title>
</head>

<body>
    <main class="contenedorPrincipal">
        <section class="contenedorMenu">
            <?php include "./inc/navlateral.php" ?>
        </section>


        <section class="navbar aside">
            <?php include "./inc/navbar.php" ?>

            <!-- OPCIONES RAPIDAS-->
            <div class="container-fluid">
                <ul class="opciones">
                    <li>
                        <a class="active" href="nuevaVenta.php"style="font-size:15.5px!important;"><i
                                class="fas fa-plus fa-fw"></i> &nbsp; REGISTRAR
                            VENTA</a>
                    </li>
                    <li>
                        <a href="listaVenta.php" style="font-size:15.5px!important;"><i class="fas fa-clipboard-list fa-fw"></i>
                            &nbsp; LISTA DE VENTAS</a>
                    </li>
                    <li>
                        <a href="buscaVenta.php" style="font-size:15.5px!important;"><i class="fas fa-search fa-fw"></i>&nbsp;
                            BUSCA VENTA</a>
                    </li>
                </ul>
            </div>
            <div class="container-fluid">
                <form class="formularioVenta" action="" autocomplete="off" method="POST" id="formVenta">
                    <fieldset>
                        <legend> &nbsp; <i class="fas fa-cart-plus"></i> Registro de Nueva
                            Venta</legend>

                        <div class="container-fluid ">
                            <input type="text" name="id" id="id_cliente" maxlength="16" value="" hidden>
                            <div class="col-12 col-md-2" style="margin-left:10px;">
                                <br>
                                <button class="btn btn-danger fa-sm" data-bs-toggle="modal"
                                    data-bs-target="#modalCliente" type="button" name="btnAdCliente" id="idbtnAdCliente"
                                    style="width:95%; padding:10px;margin-bottom:10px; margin:auto;"> <i
                                        class="fas fa-user-plus"></i></button>
                            </div>
                            <div class="modal fade" id="modalCliente" tabindex="-1" aria-labelledby="modelTitleId"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-body" style="text-align:center;">
                                            <div class="row" style="margin:auto;">
                                                <div class="col-12 col-md-12">
                                                    <div class="form-group">
                                                        <label for="inputSearch" class="bmd-label-floating" id="labelCi"
                                                            style="display:block; margin:5px;font-size:14px; font-weight:bold;">
                                                            Cliente</label>
                                                        <input type="text" class="form-control" pattern="[0-9]{5,20}"
                                                            name="busquedaCI" style="display:block;" id="inputCi"
                                                            maxlength="10">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12 col-md-12">
                                                    <div class="form-group" style="text-align:center;">
                                                        <p class="text-center"
                                                            style="margin-top: 20px; font-size:15px;">
                                                            <button type="button" style="font-size:15px;"
                                                                class="btn btn-success" name="buscaC"
                                                                style="display:block; width:40%; margin:0px auto;"
                                                                id="idbuscaCi"> <i class="fas fa-search"></i>
                                                                BUSCAR</button>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive contenedorTablaBus tablaresbusCI col-12 col-md-12"
                                id="idtablabusCI" style="display:none;">
                                <table class=" table table-sm tablaBus" id="tablaCliente" style="font-size:15px;">
                                    <thead>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                            <div class="col-12 col-md-2" style="margin-left:8px;margin-top:10px;" id="btnModalAuto"
                                hidden>
                                <button type="button" class="btn btn-danger fa-sm" data-bs-toggle="modal"
                                    data-bs-target="#modalAutos" style="width:95%; padding:10px;margin:auto;"><i
                                        class="fas fa-car"></i>&nbsp;<i class="fas fa-plus fa-xs"></i></button>
                            </div>
                            <div class="modal fade" id="modalAutos" tabindex="-1" aria-labelledby="modelTitleId"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" style="font-size:16px;">Características y documentos
                                                del vehiculo</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body" style="text-align:center;">
                                            <div class="row" style="text-align:center; margin-top:0px;">
                                                <br>
                                                <div class="row">
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-group">
                                                            <label for="inputSearch"
                                                                class="bmd-label-floating labelBusqueda"
                                                                id="idLabelBusMarca">Marca</label>
                                                            <select name="tipoMarca" class="form-select"
                                                                id="marca_selec" style="font-size:14px;">
                                                                <option value="" selected>Seleccionar</option>
                                                                <?php
                                                                require_once '../scripts/conexion.php';
                                                                $sql = "SELECT distinct marca from vehiculo order by marca";
                                                                $sentencia = $con->prepare($sql);
                                                                $sentencia->execute();
                                                                $resultado = $sentencia->fetchAll();
                                                                foreach ($resultado as $marcas) : ?>
                                                                <option value="<?php echo $marcas["marca"]; ?>">
                                                                    <?php echo $marcas["marca"]; ?>
                                                                </option>
                                                                <?php endforeach; ?>

                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-group">
                                                            <label for="inputSearch"
                                                                class="bmd-label-floating labelBusqueda"
                                                                id="idLabelBusModelo">Modelo</label>
                                                            <select name="modelo" class="form-select" id="modelo_selec"
                                                                style="font-size:14px;">
                                                                <option value="" selected>Seleccionar</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-group">
                                                            <label for="modelo_otro"
                                                                class="bmd-label-floating labelBusqueda">Otro</label>
                                                            <input type="text" pattern="[a-zA-Z0-9\s]{3,50}"
                                                                class="form-control" required name="modelo_otro"
                                                                id="modelo_autoOtro" maxlength="50" disabled
                                                                style="font-size:14px;">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12 col-md-3">
                                                        <div class="form-group">
                                                            <label for="inputSearch"
                                                                class="bmd-label-floating labelBusqueda"
                                                                id="idLabelBusModelo">Tipo</label>
                                                            <select name="tipo" class="form-select" id="tipo_selec"
                                                                style="font-size:14px;">
                                                                <option value="" selected>Seleccionar</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-3">
                                                        <div class="form-group">
                                                            <label for="tipo_otro"
                                                                class="bmd-label-floating labelBusqueda">Otro</label>
                                                            <input type="text" pattern="[a-zA-Z\s]{3,50}"
                                                                class="form-control" required name="tipo_otro"
                                                                id="tipo_autoOtro" maxlength="50" disabled
                                                                style="font-size:14px;">
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-3">
                                                        <div class="form-group">
                                                            <label for="inputSearch"
                                                                class="bmd-label-floating labelBusqueda"
                                                                id="idLabelBusColor">Color</label>
                                                            <select name="color" class="form-select" id="color_selec"
                                                                style="font-size:14px;">
                                                                <option value="" selected>Seleccionar</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-3">
                                                        <div class="form-group">
                                                            <label for="color_otro"
                                                                class="bmd-label-floating labelBusqueda">Otro</label>
                                                            <input type="text" pattern="[a-zA-Z\s]{4,50}"
                                                                class="form-control" required name="color_otro"
                                                                id="color_autoOtro" maxlength="50" disabled
                                                                style="font-size:14px;">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12 col-md-3">
                                                        <div class="form-group">
                                                            <label for="inputSearch"
                                                                class="bmd-label-floating labelBusqueda"
                                                                id="idLabelBusPas">#Pas</label>
                                                            <select name="numpas" class="form-select" id="numpas_selec"
                                                                style="font-size:14px;">
                                                                <option value="" selected>Seleccionar</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-3">
                                                        <div class="form-group">
                                                            <label for="modelo_otro"
                                                                class="bmd-label-floating labelBusqueda">Otro</label>
                                                            <input type="text" pattern="[0-9]{1,2}" class="form-control"
                                                                required name="num_otro" id="num_autoOtro" maxlength="2"
                                                                disabled style="font-size:15px;">
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-3">
                                                        <div class="form-group">
                                                            <label for="inputSearch"
                                                                class="bmd-label-floating labelBusqueda"
                                                                id="idLabelBusCilindrada">Cil.</label>
                                                            <select name="cilindrada" class="form-select"
                                                                id="cilindrada_selec" style="font-size:14px;">
                                                                <option value="" selected>Seleccionar</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-3">
                                                        <div class="form-group">
                                                            <label for="cilindrada_otro"
                                                                class="bmd-label-floating labelBusqueda">Otro</label>
                                                            <input type="text" pattern="[a-zA-Z0-9/.s]{4,8}"
                                                                class="form-control" name="cilindrada_otro"
                                                                id="cilindrada_autoOtro" maxlength="8" disabled
                                                                style="font-size:14px;">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12 col-md-3">
                                                        <div class="form-group">
                                                            <label for="inputSearch"
                                                                class="bmd-label-floating labelBusqueda"
                                                                id="idLabelBusPrecio">Precio</label>
                                                            <select name="precio" class="form-select" id="precio_selec"
                                                                style="font-size:14px;">
                                                                <option value="" selected>Seleccionar</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-3">
                                                        <div class="form-group">
                                                            <label for="precio_otro"
                                                                class="bmd-label-floating labelBusqueda">Otro</label>
                                                            <input type="text" pattern="[0-9]{5,6}" class="form-control"
                                                                name="precio_otro" id="precio_autoOtro" maxlength="6"
                                                                disabled style="font-size:14px;">
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-3">
                                                        <div class="form-group">
                                                            <label for="inputSearch"
                                                                class="bmd-label-floating labelBusqueda"
                                                                id="idLabelBusTippVenta">Tipo Venta</label>
                                                            <select name="tipoVenta" class="form-select"
                                                                id="tipoVenta_selec" style="font-size:14px;">
                                                                <option value="" selected>Seleccionar</option>
                                                                <option value="Al contado">Al contado</option>
                                                                <option value="Con crédito">Con crédito</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-md-3">
                                                        <div class="form-group">
                                                            <label for="contacto"
                                                                class="bmd-label-floating labelBusqueda">Conyuge</label>
                                                            <input type="text" pattern="[a-zA-Z]{10,150}"
                                                                class="form-control" name="contacto" id="idContacto"
                                                                maxlength="150" disabled style="font-size:14px;">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row" style="margin-top:15px;">
                                                    <div class="col-6 col-md-3">
                                                        <div class="form-check">
                                                            <label style="font-size:13px;"><b>
                                                                    Ruat</b>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-6 col-md-1" style="margin-top:10px;">
                                                        <div class="form-check">
                                                            <input class="form-check-input"
                                                                style="border: 1px solid rgb(51, 49, 49);"
                                                                type="checkbox" value="" id="idCheckRuat"
                                                                name="checkRuat">
                                                        </div>
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <div class="form-check">
                                                            <label style="font-size:13px;"><b>
                                                                    Poliza de importación</b>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-6 col-md-1" style="margin-top:10px;">
                                                        <div class="form-check">
                                                            <input class="form-check-input"
                                                                style="border: 1px solid rgb(51, 49, 49);"
                                                                type="checkbox" value="" id="idCheckPoliza"
                                                                name="checkPoliza">
                                                        </div>
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <div class="form-check">
                                                            <label style="font-size:13px;"><b>
                                                                    Soat
                                                            </label></b>
                                                        </div>
                                                    </div>
                                                    <div class="col-6 col-md-1" style="margin-top:10px;">
                                                        <div class="form-check">
                                                            <input class="form-check-input"
                                                                style="border: 1px solid rgb(51, 49, 49);"
                                                                type="checkbox" value="" id="idCheckSoat"
                                                                name="checkSoat">
                                                        </div>
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <div class="form-check">
                                                            <label style="font-size:13px;"><b>
                                                                    Placa</b>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-6 col-md-1" style="margin-top:10px;">
                                                        <div class="form-check">
                                                            <input class="form-check-input"
                                                                style="border: 1px solid rgb(51, 49, 49);"
                                                                type="checkbox" value="" id="idCheckPlaca"
                                                                name="checkPlaca">
                                                        </div>
                                                    </div>
                                                    <div class="col-6 col-md-3">
                                                        <div class="form-check">
                                                            <label style="font-size:13px;"><b>
                                                                    Resolución de tránsito</b>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-6 col-md-1" style="margin-top:10px;">
                                                        <div class="form-check">
                                                            <input class="form-check-input"
                                                                style="border: 1px solid rgb(51, 49, 49);"
                                                                type="checkbox" value="" id="idCheckTransito"
                                                                name="checkTransito">
                                                        </div>
                                                    </div>
                                                </div>
                                                <p class="text-center" style="margin-top: 40px; text-align:center;">
                                                    <button type="button" class="btn btn-danger" name="addAuto"
                                                        id="idAddAuto" style="margin:auto;font-size:15px;"><i
                                                            class="fas fa-car"></i>&nbsp;<i
                                                            class="fas fa-plus fa-xs"></i></button>
                                                </p>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive contenedorTablaBus tablaresbusM datosCliente col-12 col-md-12"
                                id="idtablabusM" style="display:none; margin-top:20px;">
                                <table class="table table-sm tablaBus" id="tablaVehiculo">
                                    <thead>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>

                            <div class="col-12" style="margin-top:20px; margin-left:10px; width:95%;">
                                <textarea class="form-control" aria-label="With textarea" id="idObservacion"
                                    name="observacion" placeholder="Escriba las observaciones"></textarea>
                            </div>


                        </div>
                        <br>


                        <br>
                        <div class="col-12 col-md-3" style="text-align:center; margin:auto;">
                            <button class="btn btn-success" type="submit" name="btnRegistrarV" id="idbtnRegistrarV"
                                style="width:90%; margin:auto;font-size:15px;"><i class="far fa-save"></i>
                                GUARDAR</button>
                        </div>
                    </fieldset>
                </form>
            </div>

        </section>
    </main>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/sweetalert2.min.js"></script>
    <script src="js/home.js"></script>
    <script src="js/buscaClienteVenta-Tramite.js"></script>
    <script src="js/selectsNuevaVenta.js"></script>

    <script>
    var matrizVehiculos = [];
    form = $("#formVenta");
    form.submit(registraVenta);

    function registraVenta(evento) {
        evento.preventDefault();
        var idC = document.getElementById("id_cliente").value;
        var idU = <?php echo $idusu ?>;
        var obs = document.getElementById("idObservacion").value;
        var venta = new FormData($(form)[0]);
        if (idC !== "" && matrizVehiculos.length > 0 && obs !== "") {
            $.ajax({
                url: '../scripts/registrarVenta.php',
                type: 'POST',
                data: {
                    "cliente": idC,
                    "vehiculos": matrizVehiculos,
                    "idUsuario": idU,
                    "obs": obs,
                },
                async: false,
            }).done(function(res) {
                console.log(res);
                if (res.trim() == "Registrado") {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Venta Registrada',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    form[0].reset();
                    $("#idObservacion").val($("#idObservacion").data(""));
                }

            });
            matrizVehiculos = [];
            $("#tablaCliente tr").remove();
            $("#tablaVehiculo tr").remove();
            document.getElementById('idbtnAdCliente').style.display = 'inline';
            document.getElementById('inputCi').style.display = 'inline';
            document.getElementById('id_cliente').value = "";
            document.getElementById('idtablabusM').style.display = 'none';
            document.getElementById('idtablabusCI').style.display = 'none';
            document.getElementById('idtablabusCI').style.display = 'none';
            document.getElementById('btnModalAuto').hidden = true;
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Agregue un cliente, vehiculo y observacion!',

            })

        }
    }
    </script>
    <script src="js/nuevaVentaBuscaM.js"></script>
    <script>
    $('#modelo_selec').change(function(e) {
        if (($(this).val()).trim() === "Otro") {
            $('#modelo_autoOtro').prop('disabled', false);
        } else {
            $('#modelo_autoOtro').prop('disabled', true);
        }
    });
    $('#color_selec').change(function(e) {
        if (($(this).val()).trim() === "Otro") {
            $('#color_autoOtro').prop('disabled', false);
        } else {
            $('#color_autoOtro').prop('disabled', true);
        }
    });
    $('#numpas_selec').change(function(e) {
        if (($(this).val()).trim() === "Otro") {
            $('#num_autoOtro').prop('disabled', false);
        } else {
            $('#num_autoOtro').prop('disabled', true);
        }
    });
    $('#precio_selec').change(function(e) {
        if (($(this).val()).trim() === "Otro") {
            $('#precio_autoOtro').prop('disabled', false);
        } else {
            $('#precio_autoOtro').prop('disabled', true);
        }
    });
    $('#tipoVenta_selec').change(function(e) {
        if (($(this).val()).trim() === "Con crédito") {
            $('#idContacto').prop('disabled', false);
        } else {
            $('#idContacto').prop('disabled', true);
        }
    });
    </script>
</body>

</html>