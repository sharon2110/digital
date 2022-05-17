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
<?php

$proceso = $_GET['id'];

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
    <link rel="stylesheet" href="./css/estiloTramites.css">
    <title>Actualizar_Tramite</title>
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
                        <a href="nuevoCredito.php" style="font-size:15.5px!important;"><i class="fas fa-plus fa-fw"></i> &nbsp;
                            NUEVO TRÁMITE</a>
                    </li>
                    <li>
                        <a href="listaTramites.php" style="font-size:15.5px!important;"><i
                                class="fas fa-clipboard-list fa-fw"></i>&nbsp;LISTA TRÁMITES
                        </a>
                    </li>
                    <li>
                        <a href="buscaTramite.php" style="font-size:15.5px!important;"><i
                                class="fas fa-search fa-fw"></i>&nbsp;&nbsp;&nbsp;BUSCAR TRÁMITE
                        </a>
                    </li>
                </ul>
            </div>

            <!-- TABLA REGISTRO-->
            <div class="container-fluid">

                <form action="" class="formularioActualizaT" id="ac_reg_tramite" autocomplete="off" method="POST"
                    enctype="multipart/form-data">
                    <fieldset>
                        <legend><i class="fas fa-user-plus"></i> &nbsp; Actualizar Trámite
                        </legend>
                        <div class="container-fluid">
                        <input type="text" name="id" id="id_cliente" maxlength="16" value="" hidden>
                            <div class="row" style="text-align:center;">
                                <input type="text" name="id" id="id_tramite" maxlength="16"
                                    value="<?php echo base64_decode($proceso)?>" hidden>
                                <div class="col-12 col-md-2">
                                    <br>
                                    <button class="btn btn-danger fa-sm" data-bs-toggle="modal"
                                        data-bs-target="#modalCliente" type="button" name="btnAdCliente"
                                        id="idbtnAdCliente" style="width:55%; padding:7px;margin-bottom:10px;" hidden>
                                        <i class="fas fa-user-plus"></i></button>
                                </div>
                                <div class="modal fade" id="modalCliente" tabindex="-1" aria-labelledby="modelTitleId"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-body" style="text-align:center;">
                                                <div class="row" style="margin:auto;">
                                                    <div class="col-12 col-md-12">
                                                        <div class="form-group">
                                                            <label for="inputSearch" class="bmd-label-floating"
                                                                id="labelCi"
                                                                style="display:block; margin:5px;font-size:14px; font-weight:bold;">
                                                                Cliente</label>
                                                            <input type="text" class="form-control"
                                                                pattern="[0-9]{5,20}" name="busquedaCI"
                                                                style="display:block;" id="inputCi" maxlength="10">
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
                                    <table class=" table table-sm tablaBus" id="tablaCliente">
                                        <thead>
                                        </thead>
                                        <tbody>


                                        </tbody>
                                    </table>
                                </div>
                                <br>
                            </div>
                            <div class="row datosBanco">
                                <div class="col-12 col-md-3">
                                    <div class="form-group">
                                        <label for="monto_prestamo" class="bmd-label-floating titulo">Banco</label>
                                        <input type="text" class="form-control" name="banco" id="info_banco"
                                            maxlength="6" disabled style="font-size:14px;">

                                    </div>
                                </div>
                                <div class="col-12 col-md-3">
                                    <div class="form-group">
                                        <label for="monto_prestamo" class="bmd-label-floating titulo">Monto
                                            préstamo</label>
                                        <input type="text" pattern="[0-9]{5,6}" class="form-control"
                                            name="monto_prestamo" id="monto_pres" maxlength="6" required
                                            style="font-size:14px;">

                                    </div>

                                </div>
                                <div class="col-12 col-md-3">
                                    <div class="form-group">
                                        <label for="moneda" class="bmd-label-floating titulo">Moneda</label>
                                        <input type="text" class="form-control" required name="moneda" id="moneda"
                                            disabled value="$">
                                    </div>
                                </div>
                                <div class="col-12 col-md-3">
                                    <div class="form-group">
                                        <label for="estado" class="bmd-label-floating titulo">Estado</label>
                                        <select name="estado" class="form-select" id="estado_selec" required
                                            style="font-size:14px;">
                                            <option value="" selected>Seleccionar</option>
                                            <?php
                                            require_once '../scripts/conexion.php';
                                            $sql = $con->prepare("SELECT * from estado e order by e.idestado");
                                            $sql->execute();
                                            $resultado = $sql->fetchAll();
                                            foreach ($resultado as $estado) : ?>
                                            <option value="<?php echo $estado["idestado"]; ?>">
                                                <?php echo $estado["estado"]; ?>
                                            </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-md-3">
                                    <div class="form-group">
                                        <label for="moneda" class="bmd-label-floating titulo">Asesor crédito</label>
                                        <input type="text" class="form-control" required name="asesor_credito"
                                            id="asesor_credito_id" style="font-size:14px;">
                                    </div>
                                </div>
                                <div class="col-12 col-md-3">
                                    <div class="form-group">
                                        <label for="moneda" class="bmd-label-floating titulo">Sucursal</label>
                                        <input type="text" class="form-control" required name="sucursal_banco"
                                            id="sucursal_banco_id" style="font-size:14px;">
                                    </div>
                                </div>
                                <div class="col-12 col-md-3">
                                    <div class="form-group">
                                        <label for="moneda" class="bmd-label-floating titulo">Observación</label>
                                        <input type="text" class="form-control" required name="observacion"
                                            id="observacion_id" style="font-size:14px;">
                                    </div>
                                </div>

                            </div>

                            <div class="justify-content-center table-responsive" style="padding:10px;">
                                <table class="table tablaOpciones">
                                    <thead>
                                        <tr class="text-center"  style="font-size:13px;border:0;">
                                            <th><label>Ver Vehiculos</label></th>
                                            <th><label>Añadir Vehiculos</label></th>
                                            <th><label>Exp.Cliente</label></th>
                                            <th><label>Lis.Cliente</label></th>
                                            <th><label>Exp.Garante</label></th>
                                            <th><label>Lis.Garante</label></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-center"><button class="btn btn-danger botonOpciones"
                                                    type="button" data-bs-toggle="modal" data-bs-target="#modalV"><i
                                                        class="fas fa-car fa-xs"></i></button></td>
                                            <td class="text-center"><button class="btn btn-warning botonOpciones"
                                                    type="button" data-bs-toggle="modal" data-bs-target="#modalVadd"><i
                                                        class="fas fa-plus fa-xs"></i></button></td>
                                            <td class="text-center"><button class="btn btn-success botonOpciones"
                                                    type="button" data-bs-toggle="modal" data-bs-target="#modalCExp"><i
                                                        class="fas fa-folder-open fa-xs"></i></button></td>
                                            <td class="text-center"><button class="btn btn-secondary botonOpciones"
                                                    type="button" data-bs-toggle="modal" data-bs-target="#modalCLis"><i
                                                        class="fas fa-clipboard-list fa-xs"></i></button></td>
                                            <td class="text-center"><button class="btn btn-success botonOpciones"
                                                    type="button" data-bs-toggle="modal" data-bs-target="#modalGExp"><i
                                                        class="fas fa-folder-open fa-xs"></i></button></td>
                                            <td class="text-center"><button class="btn btn-secondary botonOpciones"
                                                    type="button" data-bs-toggle="modal" data-bs-target="#modalGLis"><i
                                                        class="fas fa-clipboard-list fa-xs"></i></button></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="modal fade" id="modalV" tabindex="-1" aria-labelledby="modelTitleId"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" style="font-size:16px;">Lista de vehículos</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="table-responsive justify-content-center contenedorTablaBus tablaresbusM col-12 col-md-12"
                                                    id="idtablabusM" style="display:none;">
                                                    <table class="table table-sm tablaBus" id="tablaVehiculo">
                                                        <thead>
                                                        </thead>
                                                        <tbody>


                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="modalVE" tabindex="-1" aria-labelledby="modelTitleId"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" style="font-size:16px;">Características y
                                                    documentos del vehiculo</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body" style="text-align:center;">
                                                <div class="row" style="text-align:center; margin-top:0px;">
                                                    <input type="text" name="id" id="id_cliente" maxlength="16" value=""
                                                        hidden>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-12 col-md-4">
                                                            <div class="form-group">
                                                                <label for="inputSearch"
                                                                    class="bmd-label-floating labelBusqueda"
                                                                    id="idLabelBusMarca">Marca</label>
                                                                <input type="text" pattern="[a-zA-Z\s]{3,50}"
                                                                    class="form-control" name="marca" id="marcaid"
                                                                    maxlength="50" style="font-size:15px;">
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-md-4">
                                                            <div class="form-group">
                                                                <label for="inputSearch"
                                                                    class="bmd-label-floating labelBusqueda"
                                                                    id="idLabelBusModelo">Modelo</label>
                                                                <input type="text" pattern="[a-zA-Z\s]{3,50}"
                                                                    class="form-control" name="modelo" id="modeloid"
                                                                    maxlength="50" style="font-size:15px;">
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-md-4">
                                                            <div class="form-group">
                                                                <label for="inputSearch"
                                                                    class="bmd-label-floating labelBusqueda"
                                                                    id="idLabelBusModelo">Tipo</label>
                                                                <input type="text" pattern="[a-zA-Z\s]{3,50}"
                                                                    class="form-control" name="tipo" id="tipoid"
                                                                    maxlength="50" style="font-size:15px;">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12 col-md-4">
                                                            <div class="form-group">
                                                                <label for="inputSearch"
                                                                    class="bmd-label-floating labelBusqueda"
                                                                    id="idLabelBusColor">Color</label>
                                                                <input type="text" pattern="[a-zA-Z\s]{3,50}"
                                                                    class="form-control" name="color" id="colorid"
                                                                    maxlength="50" style="font-size:15px;">
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-md-4">
                                                            <div class="form-group">
                                                                <label for="inputSearch"
                                                                    class="bmd-label-floating labelBusqueda"
                                                                    id="idLabelBusPas">#Pas</label>
                                                                <input type="text" pattern="[0-9]{1,2}" required
                                                                    class="form-control" name="numpas" id="numpasid"
                                                                    maxlength="2" style="font-size:15px;">
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-md-4">
                                                            <div class="form-group">
                                                                <label for="inputSearch"
                                                                    class="bmd-label-floating labelBusqueda"
                                                                    id="idLabelBusPas">Cil.</label>
                                                                <input type="text" pattern="[a-zA-Z0-9]{5,8}" required
                                                                    class="form-control" name="cil" id="cilid"
                                                                    maxlength="8" style="font-size:15px;">
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-md-4">
                                                            <div class="form-group">
                                                                <label for="inputSearch"
                                                                    class="bmd-label-floating labelBusqueda"
                                                                    id="idLabelBusPrecio">Precio</label>
                                                                <input type="text" pattern="[0-9]{5,7}"
                                                                    class="form-control" name="precio" id="precioid"
                                                                    maxlength="7" style="font-size:15px;">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <p class="text-center" style="margin-top: 40px; text-align:center;">
                                                    <button type="button" class="btn btn-success" name="editV"
                                                        id="idEditVe"
                                                        style="margin:auto;font-size:15px;padding: 5px;">Guardar
                                                    </button>
                                                </p>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="modalVadd" tabindex="-1" aria-labelledby="modelTitleId"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" style="font-size:16px;">Características y
                                                documentos del vehiculo</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body" style="text-align:center;">
                                            <div class="row" style="text-align:center; margin-top:0px;">
                                                <input type="text" name="id" id="id_cliente" maxlength="16" value=""
                                                    hidden>
                                                <br>
                                                <div class="row">
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-group">
                                                            <label for="inputSearch"
                                                                class="bmd-label-floating labelBusqueda"
                                                                id="idLabelBusMarca">Marca</label>
                                                            <select name="tipoMarca" class="form-select"
                                                                id="marca_selec" style="font-size:15px;">
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
                                                                style="font-size:15px;">
                                                                <option value="" selected>Seleccionar</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-4">
                                                        <div class="form-group">
                                                            <label for="modelo_otro"
                                                                class="bmd-label-floating labelBusqueda">Otro</label>
                                                            <input type="text" pattern="[a-zA-Z\s]{3,50}"
                                                                class="form-control" name="modelo_otro"
                                                                id="modelo_autoOtro" maxlength="50" disabled
                                                                style="font-size:15px;">
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
                                                                style="font-size:15px;">
                                                                <option value="" selected>Seleccionar</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-3">
                                                        <div class="form-group">
                                                            <label for="modelo_otro"
                                                                class="bmd-label-floating labelBusqueda">Otro</label>
                                                            <input type="text" pattern="[a-zA-Z\s]{3,50}"
                                                                class="form-control" name="tipo_otro" id="tipo_autoOtro"
                                                                maxlength="50" disabled style="font-size:15px;">
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-3">
                                                        <div class="form-group">
                                                            <label for="inputSearch"
                                                                class="bmd-label-floating labelBusqueda"
                                                                id="idLabelBusColor">Color</label>
                                                            <select name="color" class="form-select" id="color_selec"
                                                                style="font-size:15px;">
                                                                <option value="" selected>Seleccionar</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-3">
                                                        <div class="form-group">
                                                            <label for="color_otro"
                                                                class="bmd-label-floating labelBusqueda">Otro</label>
                                                            <input type="text" pattern="[a-zA-Z\s]{4,50}"
                                                                class="form-control" name="color_otro"
                                                                id="color_autoOtro" maxlength="50" disabled
                                                                style="font-size:15px;">
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
                                                                style="font-size:15px;">
                                                                <option value="" selected>Seleccionar</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-3">
                                                        <div class="form-group">
                                                            <label for="modelo_otro"
                                                                class="bmd-label-floating labelBusqueda">Otro</label>
                                                            <input type="text" pattern="[0-9]{1,2}" class="form-control"
                                                                name="num_otro" id="num_autoOtro" maxlength="2" disabled
                                                                style="font-size:15px;">
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
                                                    <div class="row">
                                                        <div class="col-12 col-md-3">
                                                            <div class="form-group">
                                                                <label for="inputSearch"
                                                                    class="bmd-label-floating labelBusqueda"
                                                                    id="idLabelBusPrecio">Precio</label>
                                                                <select name="precio" class="form-select"
                                                                    id="precio_selec" style="font-size:15px;">
                                                                    <option value="" selected>Seleccionar</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-md-3">
                                                            <div class="form-group">
                                                                <label for="precio_otro"
                                                                    class="bmd-label-floating labelBusqueda">Otro</label>
                                                                <input type="text" pattern="[0-9]{5,6}"
                                                                    class="form-control" name="precio_otro"
                                                                    id="precio_autoOtro" maxlength="6" disabled
                                                                    style="font-size:15px;">
                                                            </div>
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
                            <div class="modal fade" id="modalCExp" tabindex="-1" aria-labelledby="modelTitleId"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" style="font-size:16px;">Documentos Cliente</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row justify-content-center">
                                                <div class="col-12" style="margin:30px; width:200px;">
                                                    <div class="container card col-12 col-md-3" id="perfilCContrato">
                                                        <i id="iconoCContrato" class="fa fa-upload"></i>
                                                        <img alt="perfil" class="fotoCContrato" name="fotoC">
                                                        <input type="file" id="subirImgCContrato"
                                                            accept="image/jpg,image/jpeg" name="clienteContrato">
                                                        <div class="card-footer">
                                                            <span>Contrato de Tramite</span>
                                                        </div>

                                                    </div>
                                                    <button type="button" class="col-2 btn btn-danger center-block"
                                                        style="display:inline-block; position:absolute; height:30px; margin-left:30px; padding:2px;"
                                                        id="quitaCContrato">Quitar</button>
                                                </div>

                                                <div class="col-12" style="margin:30px;width:200px;">
                                                    <div class="container card col-12 col-md-3" id="perfilCCarnet">
                                                        <i id="iconoCCarnet" class="fa fa-upload"></i>
                                                        <img alt="perfil" class="fotoCCarnet">
                                                        <input type="file" id="subirImgCCarnet"
                                                            accept="image/jpg,image/jpeg" name="clienteCarnet">
                                                        <div class="card-footer">
                                                            <span>Fotocopia Carnet</span>
                                                        </div>
                                                    </div>
                                                    <button type="button" class="col-2 btn btn-danger center-block"
                                                        style="display:inline-block; position:absolute; height:30px; margin-left:30px; padding:2px;"
                                                        id="quitaCCarnet">Quitar</button>
                                                </div>
                                            </div>

                                            <div class="row justify-content-center">
                                                <div class="col-12" style="margin:30px;width:200px;">
                                                    <div class="container card col-md-3 " id="perfilCFacLuz">
                                                        <i id="iconoCFacLuz" class="fa fa-upload"></i>
                                                        <img alt="perfil" class="fotoCFacLuz">
                                                        <input type="file" id="subirImgCFacLuz"
                                                            accept="image/jpg,image/jpeg" name="clienteFacLuz">
                                                        <div class="card-footer">
                                                            <span>Factura de Luz</span>
                                                        </div>
                                                    </div>
                                                    <button type="button" class="col-md-2 btn btn-danger"
                                                        style="display:inline-block; position:absolute; height:30px; margin-left:30px; padding:2px;"
                                                        id="quitaCFacLuz">Quitar</button>
                                                </div>
                                                <div class="col-12" style="margin:30px;width:200px;">
                                                    <div class="container card col-md-3 " id="perfilCFacAgua">
                                                        <i id="iconoCFacAgua" class="fa fa-upload"></i>
                                                        <img alt="perfil" class="fotoCFacAgua">
                                                        <input type="file" id="subirImgCFacAgua"
                                                            accept="image/jpg,image/jpeg,image/png"
                                                            name="clienteFacAgua">
                                                        <div class="card-footer">
                                                            <span>Factura de Agua</span>
                                                        </div>
                                                    </div>
                                                    <button type="button" class="col-md-2 btn btn-danger"
                                                        style="display:inline-block; position:absolute; height:30px; margin-left:30px; padding:2px;"
                                                        id="quitaCFacAgua">Quitar</button>
                                                </div>
                                                <div class="col-12" style="margin:30px;width:200px;">
                                                    <div class="container card col-md-3 " id="perfilCCroquis">
                                                        <i id="iconoCCroquis" class="fa fa-upload"></i>
                                                        <img alt="perfil" class="fotoCCroquis">
                                                        <input type="file" id="subirImgCCroquis"
                                                            accept="image/jpg,image/jpeg,image/png"
                                                            name="clienteCroquis">
                                                        <div class="card-footer">
                                                            <span>Croquis</span>
                                                        </div>
                                                    </div>
                                                    <button type="button" class="col-md-2 btn btn-danger"
                                                        style="display:inline-block; position:absolute; height:30px; margin-left:50px; padding:2px;"
                                                        id="quitaCCroquis">Quitar</button>
                                                </div>
                                                <div class="col-12" style="margin:30px;width:200px;">
                                                    <div class="container card col-md-3 " id="perfilCFolioReal">
                                                        <i id="iconoCFolioReal" class="fa fa-upload"></i>
                                                        <img alt="perfil" class="fotoCFolioReal">
                                                        <input type="file" id="subirImgCFolioReal"
                                                            accept="image/jpg,image/jpeg,image/png"
                                                            name="clienteFolioReal">
                                                        <div class="card-footer">
                                                            <span>Folio Real</span>
                                                        </div>
                                                    </div>
                                                    <button type="button" class="col-md-2 btn btn-danger"
                                                        style="display:inline-block; position:absolute; height:30px; margin-left:30px; padding:2px;"
                                                        id="quitaCFolio">Quitar</button>
                                                </div>
                                                <div class="col-12" style="margin:30px;width:200px;">
                                                    <div class="container card col-md-3 " id="perfilCTestimonio">
                                                        <i id="iconoCTestimonio" class="fa fa-upload"></i>
                                                        <img alt="perfil" class="fotoCTestimonio">
                                                        <input type="file" id="subirImgCTestimonio"
                                                            accept="image/jpg,image/jpeg,image/png"
                                                            name="clienteTestimonio">
                                                        <div class="card-footer">
                                                            <span>Testimonio</span>
                                                        </div>
                                                    </div>
                                                    <button type="button" class="col-md-2 btn btn-danger"
                                                        style="display:inline-block; position:absolute; height:30px; margin-left:30px; padding:2px;"
                                                        id="quitaCTestimonio">Quitar</button>
                                                </div>
                                                <div class="col-12" style="margin:30px;width:200px;">
                                                    <div class="container card col-md-3 " id="perfilCImpuesto">
                                                        <i id="iconoCImpuesto" class="fa fa-upload"></i>
                                                        <img alt="perfil" class="fotoCImpuesto">
                                                        <input type="file" id="subirImgCImpuesto"
                                                            accept="image/jpg,image/jpeg,image/png"
                                                            name="clienteImpuesto">
                                                        <div class="card-footer">
                                                            <span>Ultimo Impuesto</span>
                                                        </div>
                                                    </div>
                                                    <button type="button" class="col-md-2 btn btn-danger"
                                                        style="display:inline-block; position:absolute; height:30px; margin-left:30px; padding:2px;"
                                                        id="quitaCImpuesto">Quitar</button>
                                                </div>

                                            </div>

                                            <div class="row justify-content-center">
                                                <div class="col-12" style="margin:30px;width:200px;">
                                                    <div class="container card col-md-3 " id="perfilCRuat">
                                                        <i id="iconoCRuat" class="fa fa-upload"></i>
                                                        <img alt="perfil" class="fotoCRuat">
                                                        <input type="file" id="subirImgCRuat"
                                                            accept="image/jpg,image/jpeg,image/png" name="clienteRuat">
                                                        <div class="card-footer">
                                                            <span>RUAT</span>
                                                        </div>
                                                    </div>
                                                    <button type="button" class="col-md-2 btn btn-danger"
                                                        style="display:inline-block; position:absolute; height:30px; margin-left:30px; padding:2px;"
                                                        id="quitaCRuat">Quitar</button>
                                                </div>

                                                <div class="col-12" style="margin:30px;width:200px;">
                                                    <div class="container card col-md-3 " id="perfilCSoat">
                                                        <i id="iconoCSoat" class="fa fa-upload"></i>
                                                        <img alt="perfil" class="fotoCSoat">
                                                        <input type="file" id="subirImgCSoat"
                                                            accept="image/jpg,image/jpeg,image/png" name="clienteSoat">
                                                        <div class="card-footer">
                                                            <span>SOAT</span>
                                                        </div>
                                                    </div>
                                                    <button type="button" class="col-md-2 btn btn-danger"
                                                        style="display:inline-block; position:absolute; height:30px; margin-left:30px; padding:2px;"
                                                        id="quitaCSoat">Quitar</button>
                                                </div>
                                                <div class="col-12" style="margin:30px;width:200px;">
                                                    <div class="container card col-md-3 " id="perfilCNit">
                                                        <i id="iconoCNit" class="fa fa-upload"></i>
                                                        <img alt="perfil" class="fotoCNit">
                                                        <input type="file" id="subirImgCNit"
                                                            accept="image/jpg,image/jpeg,image/png" name="clienteNit">
                                                        <div class="card-footer">
                                                            <span>NIT</span>
                                                        </div>
                                                    </div>
                                                    <button type="button" class="col-md-2 btn btn-danger"
                                                        style="display:inline-block; position:absolute; height:30px; margin-left:30px; padding:2px;"
                                                        id="quitaCNit">Quitar</button>
                                                </div>
                                                <div class="col-12" style="margin:30px;width:200px;">
                                                    <div class="container card col-md-3 " id="perfilCPatente">
                                                        <i id="iconoCPatente" class="fa fa-upload"></i>
                                                        <img alt="perfil" class="fotoCPatente">
                                                        <input type="file" id="subirImgCPatente"
                                                            accept="image/jpg,image/jpeg,image/png"
                                                            name="clientePatente">
                                                        <div class="card-footer">
                                                            <span>Patente</span>
                                                        </div>
                                                    </div>
                                                    <button type="button" class="col-md-2 btn btn-danger"
                                                        style="display:inline-block; position:absolute; height:30px; margin-left:30px; padding:2px;"
                                                        id="quitaCPatente">Quitar</button>
                                                </div>
                                                <div class="col-12" style="margin:30px;width:200px;">
                                                    <div class="container card col-md-3 " id="perfilCBoletaPago">
                                                        <i id="iconoCBoletaPago" class="fa fa-upload"></i>
                                                        <img alt="perfil" class="fotoCBoletaPago">
                                                        <input type="file" id="subirImgCBoletaPago"
                                                            accept="image/jpg,image/jpeg,image/png"
                                                            name="clienteBoletaPago">
                                                        <div class="card-footer">
                                                            <span>Boleta de Pago</span>
                                                        </div>
                                                    </div>
                                                    <button type="button" class="col-md-2 btn btn-danger"
                                                        style="display:inline-block; position:absolute; height:30px; margin-left:30px; padding:2px;"
                                                        id="quitaCBoletaPago">Quitar</button>
                                                </div>
                                                <div class="col-12" style="margin:30px;width:200px;">
                                                    <div class="container card col-md-3 " id="perfilCAfp">
                                                        <i id="iconoCAfp" class="fa fa-upload"></i>
                                                        <img alt="perfil" class="fotoCAfp">
                                                        <input type="file" id="subirImgCAfp"
                                                            accept="image/jpg,image/jpeg,image/png" name="clienteAfp">
                                                        <div class="card-footer">
                                                            <span>AFP's</span>
                                                        </div>
                                                    </div>
                                                    <button type="button" class="col-md-2 btn btn-danger"
                                                        style="display:inline-block; position:absolute; height:30px; margin-left:30px; padding:2px;"
                                                        id="quitaCAfp">Quitar</button>
                                                </div>

                                                <div class="col-12"
                                                    style="background-color:brown; color:white; margin:10px;font-size:15px; padding:8px;">
                                                    Deudas Con Otros Bancos</div>
                                                <div class="col-12 col-md-8">
                                                    <div class="form-group">
                                                        <label for="nom_banco"
                                                            class="bmd-label-floating titulo">Banco</label>
                                                        <select class="form-select" aria-label="Default select example"
                                                            name="selec_banco_cliente1" id="select_banco_cfolder1"
                                                            style="font-size:15px;">
                                                            <option value="0">Seleccionar</option>
                                                            <?php
                                                                require_once '../scripts/conexion.php';
                                                                $sentencia = $con->prepare("SELECT * from banco order by banco;");
                                                                $sentencia->execute(); # Pasar en el mismo orden de los ?
                                                                $resultado = $sentencia->fetchAll();
                                                                foreach ($resultado as $banco) : ?>
                                                            <option value="<?php echo $banco["idbanco"]; ?>">
                                                                <?php echo $banco["banco"]; ?>
                                                            </option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row justify-content-center">
                                                    <div class="col-12" style="margin:30px;width:200px;">
                                                        <div class="container card col-md-3 " id="perfilCPlanPago1">
                                                            <i id="iconoCPlanPago1" class="fa fa-upload"></i>
                                                            <img alt="perfil" class="fotoCPlanPago1">
                                                            <input type="file" id="subirImgCPlanPago1"
                                                                accept="image/jpg,image/jpeg,image/png"
                                                                name="clientePlan1">
                                                            <div class="card-footer">
                                                                <span>Plan de pagos</span>
                                                            </div>
                                                        </div>
                                                        <button type="button" class="col-md-2 btn btn-danger"
                                                            style="display:inline-block; position:absolute; height:30px; margin-left:30px; padding:2px;"
                                                            id="quitaCPlanPago1">Quitar</button>
                                                    </div>
                                                    <div class="col-12" style="margin:30px;width:200px;">
                                                        <div class="container card col-md-3 "
                                                            id="perfilCBoletaCancelacion1">
                                                            <i id="iconoCBoletaCancelacion1" class="fa fa-upload"></i>
                                                            <img alt="perfil" class="fotoCBoletaCancelacion1">
                                                            <input type="file" id="subirImgCBoletaCancelacion1"
                                                                accept="image/jpg,image/jpeg,image/png"
                                                                name="clienteCancelacion1">
                                                            <div class="card-footer">
                                                                <span>Boleta de Cancelacion</span>
                                                            </div>
                                                        </div>
                                                        <button type="button" class="col-md-2 btn btn-danger"
                                                            style="display:inline-block; position:absolute; height:30px; margin-left:30px; padding:2px;"
                                                            id="quitaCBoletaCancelacion1">Quitar</button>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-8">
                                                    <div class="form-group">
                                                        <label for="nom_banco"
                                                            class="bmd-label-floating titulo">Banco</label>
                                                        <select class="form-select" aria-label="Default select example"
                                                            name="selec_banco_cliente2" id="select_banco_cfolder2"
                                                            style="font-size:15px;">
                                                            <option value="0">Seleccionar</option>
                                                            <?php
                                                                require_once '../scripts/conexion.php';
                                                                $sentencia = $con->prepare("SELECT * from banco order by banco;");
                                                                $sentencia->execute(); # Pasar en el mismo orden de los ?
                                                                $resultado = $sentencia->fetchAll();
                                                                foreach ($resultado as $banco) : ?>
                                                            <option value="<?php echo $banco["idbanco"]; ?>">
                                                                <?php echo $banco["banco"]; ?>
                                                            </option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row justify-content-center">
                                                    <div class="col-12" style="margin:30px;width:200px;">
                                                        <div class="container card col-md-3 " id="perfilCPlanPago2">
                                                            <i id="iconoCPlanPago2" class="fa fa-upload"></i>
                                                            <img alt="perfil" class="fotoCPlanPago2">
                                                            <input type="file" id="subirImgCPlanPago2"
                                                                accept="image/jpg,image/jpeg,image/png"
                                                                name="clientePlan2">
                                                            <div class="card-footer">
                                                                <span>Plan de pagos</span>
                                                            </div>
                                                        </div>
                                                        <button type="button" class="col-md-2 btn btn-danger"
                                                            style="display:inline-block; position:absolute; height:30px; margin-left:30px; padding:2px;"
                                                            id="quitaCPlanPago2">Quitar</button>
                                                    </div>
                                                    <div class="col-12" style="margin:30px;width:200px;">
                                                        <div class="container card col-md-3 "
                                                            id="perfilCBoletaCancelacion2">
                                                            <i id="iconoCBoletaCancelacion2" class="fa fa-upload"></i>
                                                            <img alt="perfil" class="fotoCBoletaCancelacion2">
                                                            <input type="file" id="subirImgCBoletaCancelacion2"
                                                                accept="image/jpg,image/jpeg,image/png"
                                                                name="clienteCancelacion2">
                                                            <div class="card-footer">
                                                                <span>Boleta de Cancelacion</span>
                                                            </div>
                                                        </div>
                                                        <button type="button" class="col-md-2 btn btn-danger"
                                                            style="display:inline-block; position:absolute; height:30px; margin-left:30px; padding:2px;"
                                                            id="quitaCBoletaCancelacion2">Quitar</button>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-8">
                                                    <div class="form-group">
                                                        <label for="nom_banco"
                                                            class="bmd-label-floating titulo">Banco</label>
                                                        <select class="form-select" aria-label="Default select example"
                                                            name="selec_banco_cliente3" id="select_banco_cfolder3"
                                                            style="font-size:15px;">
                                                            <option value="0">Seleccionar</option>
                                                            <?php
                                                                require_once '../scripts/conexion.php';
                                                                $sentencia = $con->prepare("SELECT * from banco order by banco;");
                                                                $sentencia->execute(); # Pasar en el mismo orden de los ?
                                                                $resultado = $sentencia->fetchAll();
                                                                foreach ($resultado as $banco) : ?>
                                                            <option value="<?php echo $banco["idbanco"]; ?>">
                                                                <?php echo $banco["banco"]; ?>
                                                            </option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row justify-content-center">
                                                    <div class="col-12" style="margin:30px;width:200px;">
                                                        <div class="container card col-md-3 " id="perfilCPlanPago3">
                                                            <i id="iconoCPlanPago3" class="fa fa-upload"></i>
                                                            <img alt="perfil" class="fotoCPlanPago3">
                                                            <input type="file" id="subirImgCPlanPago3"
                                                                accept="image/jpg,image/jpeg,image/png"
                                                                name="clientePlan3">
                                                            <div class="card-footer">
                                                                <span>Plan de pagos</span>
                                                            </div>
                                                        </div>
                                                        <button type="button" class="col-md-2 btn btn-danger"
                                                            style="display:inline-block; position:absolute; height:30px; margin-left:30px; padding:2px;"
                                                            id="quitaCPlanPago3">Quitar</button>
                                                    </div>
                                                    <div class="col-12" style="margin:30px;width:200px;">
                                                        <div class="container card col-md-3 "
                                                            id="perfilCBoletaCancelacion3">
                                                            <i id="iconoCBoletaCancelacion3" class="fa fa-upload"></i>
                                                            <img alt="perfil" class="fotoCBoletaCancelacion3">
                                                            <input type="file" id="subirImgCBoletaCancelacion3"
                                                                accept="image/jpg,image/jpeg,image/png"
                                                                name="clienteCancelacion3">
                                                            <div class="card-footer">
                                                                <span>Boleta de Cancelacion</span>
                                                            </div>
                                                        </div>
                                                        <button type="button" class="col-md-2 btn btn-danger"
                                                            style="display:inline-block; position:absolute; height:30px; margin-left:30px; padding:2px;"
                                                            id="quitaCBoletaCancelacion3">Quitar</button>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-8">
                                                    <div class="form-group">
                                                        <label for="nom_banco"
                                                            class="bmd-label-floating titulo">Banco</label>
                                                        <select class="form-select" aria-label="Default select example"
                                                            name="selec_banco_cliente4" id="select_banco_cfolder4"
                                                            style="font-size:15px;">
                                                            <option value="0">Seleccionar</option>
                                                            <?php
                                                                require_once '../scripts/conexion.php';
                                                                $sentencia = $con->prepare("SELECT * from banco order by banco;");
                                                                $sentencia->execute(); # Pasar en el mismo orden de los ?
                                                                $resultado = $sentencia->fetchAll();
                                                                foreach ($resultado as $banco) : ?>
                                                            <option value="<?php echo $banco["idbanco"]; ?>">
                                                                <?php echo $banco["banco"]; ?>
                                                            </option>
                                                            <?php endforeach; ?>

                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row justify-content-center">
                                                    <div class="col-12" style="margin:30px;width:200px;">
                                                        <div class="container card col-md-3 " id="perfilCPlanPago4">
                                                            <i id="iconoCPlanPago4" class="fa fa-upload"></i>
                                                            <img alt="perfil" class="fotoCPlanPago4">
                                                            <input type="file" id="subirImgCPlanPago4"
                                                                accept="image/jpg,image/jpeg,image/png"
                                                                name="clientePlan4">
                                                            <div class="card-footer">
                                                                <span>Plan de pagos</span>
                                                            </div>
                                                        </div>
                                                        <button type="button" class="col-md-2 btn btn-danger"
                                                            style="display:inline-block; position:absolute; height:30px; margin-left:30px; padding:2px;"
                                                            id="quitaCPlanPago4">Quitar</button>
                                                    </div>
                                                    <div class="col-12" style="margin:30px;width:200px;">
                                                        <div class="container card col-md-3 "
                                                            id="perfilCBoletaCancelacion4">
                                                            <i id="iconoCBoletaCancelacion4" class="fa fa-upload"></i>
                                                            <img alt="perfil" class="fotoCBoletaCancelacion4">
                                                            <input type="file" id="subirImgCBoletaCancelacion4"
                                                                accept="image/jpg,image/jpeg,image/png"
                                                                name="clienteCancelacion4">
                                                            <div class="card-footer">
                                                                <span>Boleta de Cancelacion</span>
                                                            </div>
                                                        </div>
                                                        <button type="button" class="col-md-2 btn btn-danger"
                                                            style="display:inline-block; position:absolute; height:30px; margin-left:30px; padding:2px;"
                                                            id="quitaCBoletaCancelacion4">Quitar</button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="modal fade" id="modalGExp" tabindex="-1" aria-labelledby="modelTitleId"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" style="font-size:16px;">Documentos Garante</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row justify-content-center">
                                                <div class="col-12" style="margin:30px;width:200px;">
                                                    <div class="container card col-md-3" id="perfilGCarnet">
                                                        <i id="iconoGCarnet" class="fa fa-upload"></i>
                                                        <img alt="perfil" class="fotoGCarnet">
                                                        <input type="file" id="subirImgGCarnet"
                                                            accept="image/jpg,image/jpeg" name="garanteCarnet">
                                                        <div class="card-footer">
                                                            <span>Fotocopia Carnet</span>
                                                        </div>
                                                    </div>
                                                    <button type="button" class="col-2 btn btn-danger center-block"
                                                        style="display:inline-block; position:absolute; height:30px; margin-left:30px; padding:2px;"
                                                        id="quitaGCarnet">Quitar</button>
                                                </div>
                                                <div class="col-12" style="margin:30px;width:200px;">
                                                    <div class="container card col-md-3 " id="perfilGFacLuz">
                                                        <i id="iconoGFacLuz" class="fa fa-upload"></i>
                                                        <img alt="perfil" class="fotoGFacLuz">
                                                        <input type="file" id="subirImgGFacLuz"
                                                            accept="image/jpg,image/jpeg" name="garanteFacLuz">
                                                        <div class="card-footer">
                                                            <span>Factura de Luz</span>
                                                        </div>
                                                    </div>
                                                    <button type="button" class="col-2 btn btn-danger center-block"
                                                        style="display:inline-block; position:absolute; height:30px; margin-left:30px; padding:2px;"
                                                        id="quitaGFacLuz">Quitar</button>
                                                </div>
                                            </div>

                                            <div class="row justify-content-center">
                                                <div class="col-12" style="margin:30px;width:200px;">
                                                    <div class="container card col-md-3 " id="perfilGFacAgua">
                                                        <i id="iconoGFacAgua" class="fa fa-upload"></i>
                                                        <img alt="perfil" class="fotoGFacAgua">
                                                        <input type="file" id="subirImgGFacAgua"
                                                            accept="image/jpg,image/jpeg" name="garanteFacAgua">
                                                        <div class="card-footer">
                                                            <span>Factura de Agua</span>
                                                        </div>
                                                    </div>
                                                    <button type="button" class="col-2 btn btn-danger center-block"
                                                        style="display:inline-block; position:absolute; height:30px; margin-left:30px; padding:2px;"
                                                        id="quitaGFacAgua">Quitar</button>
                                                </div>
                                                <div class="col-12" style="margin:30px;width:200px;">
                                                    <div class="container card col-md-3 " id="perfilGCroquis">
                                                        <i id="iconoGCroquis" class="fa fa-upload"></i>
                                                        <img alt="perfil" class="fotoGCroquis">
                                                        <input type="file" id="subirImgGCroquis"
                                                            accept="image/jpg,image/jpeg" name="garanteCroquis">
                                                        <div class="card-footer">
                                                            <span>Croquis</span>
                                                        </div>
                                                    </div>
                                                    <button type="button" class="col-2 btn btn-danger center-block"
                                                        style="display:inline-block; position:absolute; height:30px; margin-left:30px; padding:2px;"
                                                        id="quitaGCroquis">Quitar</button>
                                                </div>
                                                <div class="col-12" style="margin:30px;width:200px;">
                                                    <div class="container card col-md-3 " id="perfilGFolioReal">
                                                        <i id="iconoGFolioReal" class="fa fa-upload"></i>
                                                        <img alt="perfil" class="fotoGFolioReal">
                                                        <input type="file" id="subirImgGFolioReal"
                                                            accept="image/jpg,image/jpeg" name="garanteFolioReal">
                                                        <div class="card-footer">
                                                            <span>Folio Real</span>
                                                        </div>
                                                    </div>
                                                    <button type="button" class="col-2 btn btn-danger center-block"
                                                        style="display:inline-block; position:absolute; height:30px; margin-left:30px; padding:2px;"
                                                        id="quitaGFolio">Quitar</button>
                                                </div>
                                                <div class="col-12" style="margin:30px;width:200px;">
                                                    <div class="container card col-md-3 " id="perfilGTestimonio">
                                                        <i id="iconoGTestimonio" class="fa fa-upload"></i>
                                                        <img alt="perfil" class="fotoGTestimonio">
                                                        <input type="file" id="subirImgGTestimonio"
                                                            accept="image/jpg,image/jpeg" name="garanteTestimonio">
                                                        <div class="card-footer">
                                                            <span>Testimonio</span>
                                                        </div>
                                                    </div>
                                                    <button type="button" class="col-2 btn btn-danger center-block"
                                                        style="display:inline-block; position:absolute; height:30px; margin-left:30px; padding:2px;"
                                                        id="quitaGTestimonio">Quitar</button>
                                                </div>
                                                <div class="col-12" style="margin:30px;width:200px;">
                                                    <div class="container card col-md-3 " id="perfilGImpuesto">
                                                        <i id="iconoGImpuesto" class="fa fa-upload"></i>
                                                        <img alt="perfil" class="fotoGImpuesto">
                                                        <input type="file" id="subirImgGImpuesto"
                                                            accept="image/jpg,image/jpeg" name="garanteImpuesto">
                                                        <div class="card-footer">
                                                            <span>Ultimo Impuesto</span>
                                                        </div>
                                                    </div>
                                                    <button type="button" class="col-2 btn btn-danger center-block"
                                                        style="display:inline-block; position:absolute; height:30px; margin-left:30px; padding:2px;"
                                                        id="quitaGImpuesto">Quitar</button>
                                                </div>
                                                <div class="col-12" style="margin:30px;width:200px;">
                                                    <div class="container card col-md-3 " id="perfilGRuat">
                                                        <i id="iconoGRuat" class="fa fa-upload"></i>
                                                        <img alt="perfil" class="fotoGRuat">
                                                        <input type="file" id="subirImgGRuat"
                                                            accept="image/jpg,image/jpeg" name="garanteRuat">
                                                        <div class="card-footer">
                                                            <span>RUAT</span>
                                                        </div>
                                                    </div>
                                                    <button type="button" class="col-2 btn btn-danger center-block"
                                                        style="display:inline-block; position:absolute; height:30px; margin-left:30px; padding:2px;"
                                                        id="quitaGRuat">Quitar</button>
                                                </div>
                                            </div>

                                            <div class="row justify-content-center">
                                                <div class="col-12" style="margin:30px;width:200px;">
                                                    <div class="container card col-md-3 " id="perfilGSoat">
                                                        <i id="iconoGSoat" class="fa fa-upload"></i>
                                                        <img alt="perfil" class="fotoGSoat">
                                                        <input type="file" id="subirImgGSoat"
                                                            accept="image/jpg,image/jpeg" name="garanteSoat">
                                                        <div class="card-footer">
                                                            <span>SOAT</span>
                                                        </div>
                                                    </div>
                                                    <button type="button" class="col-2 btn btn-danger center-block"
                                                        style="display:inline-block; position:absolute; height:30px; margin-left:30px; padding:2px;"
                                                        id="quitaGSoat">Quitar</button>
                                                </div>
                                                <div class="col-12" style="margin:30px;width:200px;;">
                                                    <div class="container card col-md-3 " id="perfilGNit">
                                                        <i id="iconoGNit" class="fa fa-upload"></i>
                                                        <img alt="perfil" class="fotoGNit">
                                                        <input type="file" id="subirImgGNit"
                                                            accept="image/jpg,image/jpeg" name="garanteNit">
                                                        <div class="card-footer">
                                                            <span>NIT</span>
                                                        </div>
                                                    </div>
                                                    <button type="button" class="col-2 btn btn-danger center-block"
                                                        style="display:inline-block; position:absolute; height:30px; margin-left:30px; padding:2px;"
                                                        id="quitaGNit">Quitar</button>
                                                </div>
                                                <div class="col-12" style="margin:30px;width:200px;">
                                                    <div class="container card col-md-3 " id="perfilGPatente">
                                                        <i id="iconoGPatente" class="fa fa-upload"></i>
                                                        <img alt="perfil" class="fotoGPatente">
                                                        <input type="file" id="subirImgGPatente"
                                                            accept="image/jpg,image/jpeg" name="garantePatente">
                                                        <div class="card-footer">
                                                            <span>Patente</span>
                                                        </div>
                                                    </div>
                                                    <button type="button" class="col-2 btn btn-danger center-block"
                                                        style="display:inline-block; position:absolute; height:30px; margin-left:30px; padding:2px;"
                                                        id="quitaGPatente">Quitar</button>
                                                </div>
                                                <div class="col-12" style="margin:30px;width:200px;">
                                                    <div class="container card col-md-3 " id="perfilGBoletaPago">
                                                        <i id="iconoGBoletaPago" class="fa fa-upload"></i>
                                                        <img alt="perfil" class="fotoGBoletaPago">
                                                        <input type="file" id="subirImgGBoletaPago"
                                                            accept="image/jpg,image/jpeg" name="garanteBoletaPago">
                                                        <div class="card-footer">
                                                            <span>Boleta de Pago</span>
                                                        </div>
                                                    </div>
                                                    <button type="button" class="col-2 btn btn-danger center-block"
                                                        style="display:inline-block; position:absolute; height:30px; margin-left:30px; padding:2px;"
                                                        id="quitaGBoletaPago">Quitar</button>
                                                </div>
                                                <div class="col-12" style="margin:30px;width:200px;">
                                                    <div class="container card col-md-3 " id="perfilGAfp">
                                                        <i id="iconoGAfp" class="fa fa-upload"></i>
                                                        <img alt="perfil" class="fotoGAfp">
                                                        <input type="file" id="subirImgGAfp"
                                                            accept="image/jpg,image/jpeg" name="garanteAfp">
                                                        <div class="card-footer">
                                                            <span>AFP's</span>
                                                        </div>
                                                    </div>
                                                    <button type="button" class="col-2 btn btn-danger center-block"
                                                        style="display:inline-block; position:absolute; height:30px; margin-left:30px; padding:2px;"
                                                        id="quitaGAfp">Quitar</button>
                                                </div>
                                                <div class="col-12"
                                                    style="background-color:brown; margin:10px;color:white; font-size:16px; padding:8px; ">
                                                    Deudas Con Otros Bancos</div>
                                                <div class="col-12 col-md-8">
                                                    <div class="form-group">
                                                        <label for="nom_banco"
                                                            class="bmd-label-floating titulo">Banco</label>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="select_banco_gfolder1" name="selec_banco_garante1"
                                                            style="font-size:15px;">
                                                            <option value="0">Seleccionar</option>
                                                            <?php
                                                                require_once '../scripts/conexion.php';
                                                                $sentencia = $con->prepare("SELECT * from banco order by banco;");
                                                                $sentencia->execute(); # Pasar en el mismo orden de los ?
                                                                $resultado = $sentencia->fetchAll();
                                                                foreach ($resultado as $banco) : ?>
                                                            <option value="<?php echo $banco["idbanco"]; ?>">
                                                                <?php echo $banco["banco"]; ?>
                                                            </option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row justify-content-center">
                                                    <div class="col-12" style="margin:30px;width:200px;">
                                                        <div class="container card col-md-3 " id="perfilGPlanPago1">
                                                            <i id="iconoGPlanPago1" class="fa fa-upload"></i>
                                                            <img alt="perfil" class="fotoGPlanPago1">
                                                            <input type="file" id="subirImgGPlanPago1"
                                                                accept="image/jpg,image/jpeg" name="garantePlan1">
                                                            <div class="card-footer">
                                                                <span>Plan de pagos</span>
                                                            </div>
                                                        </div>
                                                        <button type="button" class="col-2 btn btn-danger center-block"
                                                            style="display:inline-block; position:absolute; height:30px; margin-left:30px; padding:2px;"
                                                            id="quitaGPlanPago1">Quitar</button>
                                                    </div>
                                                    <div class="col-12" style="margin:30px;width:200px;">
                                                        <div class="container card col-md-3 "
                                                            id="perfilGBoletaCancelacion1">
                                                            <i id="iconoGBoletaCancelacion1" class="fa fa-upload"></i>
                                                            <img alt="perfil" class="fotoGBoletaCancelacion1">
                                                            <input type="file" id="subirImgGBoletaCancelacion1"
                                                                accept="image/jpg,image/jpeg"
                                                                name="garanteCancelacion1">
                                                            <div class="card-footer">
                                                                <span>Boleta de Cancelacion</span>
                                                            </div>
                                                        </div>
                                                        <button type="button" class="col-2 btn btn-danger center-block"
                                                            style="display:inline-block; position:absolute; height:30px; margin-left:30px; padding:2px;"
                                                            id="quitaGBoletaCancelacion1">Quitar</button>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-8">
                                                    <div class="form-group">
                                                        <label for="nom_banco"
                                                            class="bmd-label-floating titulo">Banco</label>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="select_banco_gfolder2" name="selec_banco_garante2"
                                                            style="font-size:15px;">
                                                            <option value="0">Seleccionar</option>
                                                            <?php
                                                                require_once '../scripts/conexion.php';
                                                                $sentencia = $con->prepare("SELECT * from banco order by banco;");
                                                                $sentencia->execute(); # Pasar en el mismo orden de los ?
                                                                $resultado = $sentencia->fetchAll();
                                                                foreach ($resultado as $banco) : ?>
                                                            <option value="<?php echo $banco["idbanco"]; ?>">
                                                                <?php echo $banco["banco"]; ?>
                                                            </option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row justify-content-center">
                                                    <div class="col-12" style="margin:30px;width:200px;">
                                                        <div class="container card col-md-3 " id="perfilGPlanPago2">
                                                            <i id="iconoGPlanPago2" class="fa fa-upload"></i>
                                                            <img alt="perfil" class="fotoGPlanPago2">
                                                            <input type="file" id="subirImgGPlanPago2"
                                                                accept="image/jpg,image/jpeg" name="garantePlan2">
                                                            <div class="card-footer">
                                                                <span>Plan de pagos</span>
                                                            </div>
                                                        </div>
                                                        <button type="button" class="col-2 btn btn-danger center-block"
                                                            style="display:inline-block; position:absolute; height:30px; margin-left:30px; padding:2px;"
                                                            id="quitaGPlanPago2">Quitar</button>
                                                    </div>
                                                    <div class="col-12" style="margin:30px;width:200px;">
                                                        <div class="container card col-md-3 "
                                                            id="perfilGBoletaCancelacion2">
                                                            <i id="iconoGBoletaCancelacion2" class="fa fa-upload"></i>
                                                            <img alt="perfil" class="fotoGBoletaCancelacion2">
                                                            <input type="file" id="subirImgGBoletaCancelacion2"
                                                                accept="image/jpg,image/jpeg"
                                                                name="garanteCancelacion2">
                                                            <div class="card-footer">
                                                                <span>Boleta de Cancelacion</span>
                                                            </div>
                                                        </div>
                                                        <button type="button" class="col-2 btn btn-danger center-block"
                                                            style="display:inline-block; position:absolute; height:30px; margin-left:30px; padding:2px;"
                                                            id="quitaGBoletaCancelacion2">Quitar</button>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-8">
                                                    <div class="form-group">
                                                        <label for="nom_banco"
                                                            class="bmd-label-floating titulo">Banco</label>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="select_banco_gfolder3" name="selec_banco_garante3"
                                                            style="font-size:15px;">
                                                            <option value="0">Seleccionar</option>
                                                            <?php
                                                                require_once '../scripts/conexion.php';
                                                                $sentencia = $con->prepare("SELECT * from banco order by banco;");
                                                                $sentencia->execute(); # Pasar en el mismo orden de los ?
                                                                $resultado = $sentencia->fetchAll();
                                                                foreach ($resultado as $banco) : ?>
                                                            <option value="<?php echo $banco["idbanco"]; ?>">
                                                                <?php echo $banco["banco"]; ?>
                                                            </option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row justify-content-center">
                                                    <div class="col-12" style="margin:30px;width:200px;">
                                                        <div class="container card col-md-3 " id="perfilGPlanPago3">
                                                            <i id="iconoGPlanPago3" class="fa fa-upload"></i>
                                                            <img alt="perfil" class="fotoGPlanPago3">
                                                            <input type="file" id="subirImgGPlanPago3"
                                                                accept="image/jpg,image/jpeg" name="garantePlan3">
                                                            <div class="card-footer">
                                                                <span>Plan de pagos</span>
                                                            </div>
                                                        </div>
                                                        <button type="button" class="col-2 btn btn-danger center-block"
                                                            style="display:inline-block; position:absolute; height:30px; margin-left:30px; padding:2px;"
                                                            id="quitaGPlanPago3">Quitar</button>
                                                    </div>
                                                    <div class="col-12" style="margin:30px;width:200px;">

                                                        <div class="container card col-md-3 "
                                                            id="perfilGBoletaCancelacion3">
                                                            <i id="iconoGBoletaCancelacion3" class="fa fa-upload"></i>
                                                            <img alt="perfil" class="fotoGBoletaCancelacion3">
                                                            <input type="file" id="subirImgGBoletaCancelacion3"
                                                                accept="image/jpg,image/jpeg"
                                                                name="garanteCancelacion3">
                                                            <div class="card-footer">
                                                                <span>Boleta de Cancelacion</span>
                                                            </div>
                                                        </div>
                                                        <button type="button" class="col-2 btn btn-danger center-block"
                                                            style="display:inline-block; position:absolute; height:30px; margin-left:30px; padding:2px;"
                                                            id="quitaGBoletaCancelacion3">Quitar</button>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-8">
                                                    <div class="form-group">
                                                        <label for="nom_banco"
                                                            class="bmd-label-floating titulo">Banco</label>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="select_banco_gfolder4" name="selec_banco_garante4"
                                                            style="font-size:15px;">
                                                            <option value="0">Seleccionar</option>
                                                            <?php
                                                                require_once '../scripts/conexion.php';
                                                                $sentencia = $con->prepare("SELECT * from banco order by banco;");
                                                                $sentencia->execute(); # Pasar en el mismo orden de los ?
                                                                $resultado = $sentencia->fetchAll();
                                                                foreach ($resultado as $banco) : ?>
                                                            <option value="<?php echo $banco["idbanco"]; ?>">
                                                                <?php echo $banco["banco"]; ?>
                                                            </option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row justify-content-center">
                                                    <div class="col-12" style="margin:30px;width:200px;">
                                                        <div class="container card col-md-3 " id="perfilGPlanPago4">
                                                            <i id="iconoGPlanPago4" class="fa fa-upload"></i>
                                                            <img alt="perfil" class="fotoGPlanPago4">
                                                            <input type="file" id="subirImgGPlanPago4"
                                                                accept="image/jpg,image/jpeg" name="garantePlan4">
                                                            <div class="card-footer">
                                                                <span>Plan de pagos</span>
                                                            </div>
                                                        </div>
                                                        <button type="button" class="col-2 btn btn-danger center-block"
                                                            style="display:inline-block; position:absolute; height:30px; margin-left:30px; padding:2px;"
                                                            id="quitaGPlanPago4">Quitar</button>
                                                    </div>
                                                    <div class="col-12" style="margin:30px;width:200px;">

                                                        <div class="container card col-md-3 "
                                                            id="perfilGBoletaCancelacion4">
                                                            <i id="iconoGBoletaCancelacion4" class="fa fa-upload"></i>
                                                            <img alt="perfil" class="fotoGBoletaCancelacion4">
                                                            <input type="file" id="subirImgGBoletaCancelacion4"
                                                                accept="image/jpg,image/jpeg"
                                                                name="garanteCancelacion4">
                                                            <div class="card-footer">
                                                                <span>Boleta de Cancelacion</span>
                                                            </div>
                                                        </div>
                                                        <button type="button" class="col-2 btn btn-danger center-block"
                                                            style="display:inline-block; position:absolute; height:30px; margin-left:30px; padding:2px;"
                                                            id="quitaGBoletaCancelacion4">Quitar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="modal fade listaDoc" id="modalCLis" tabindex="-1" aria-labelledby="modelTitleId"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" style="font-size:16px;">Lista de Documentos
                                                Entregados - Cliente</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body" style="margin-top: 20px;">
                                            <div class="row">
                                                <div class="col-6 col-md-3">
                                                    <div class="form-check">
                                                        <label style="color:rgb(0, 0, 0)!important;font-weight:normal;">
                                                            Contrato de Tramite
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-1">
                                                    <div class="form-check">
                                                        <input class="form-check-input"
                                                            style="border: 1px solid rgb(51, 49, 49);" type="checkbox"
                                                            value="" id="checkContratoCliente" name="checkCliente1">
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-3">
                                                    <div class="form-check">
                                                        <label style="color:rgb(0, 0, 0)!important;font-weight:normal;">
                                                            Fotocopia de Carnet
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-1">
                                                    <div class="form-check">
                                                        <input class="form-check-input"
                                                            style="border: 1px solid rgb(51, 49, 49);" type="checkbox"
                                                            value="" id="checkCarnetCliente" name="checkCliente2">
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-3">
                                                    <div class="form-check">
                                                        <label style="color:rgb(0, 0, 0)!important;font-weight:normal;">
                                                            Factura de Luz
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-1">
                                                    <div class="form-check">
                                                        <input class="form-check-input"
                                                            style="border: 1px solid rgb(51, 49, 49);" type="checkbox"
                                                            value="" id="checkFacturaLuzCliente" name="checkCliente3">
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-3">
                                                    <div class="form-check">
                                                        <label style="color:rgb(0, 0, 0)!important;font-weight:normal;">
                                                            Factura de Agua
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-1">
                                                    <div class="form-check">
                                                        <input class="form-check-input"
                                                            style="border: 1px solid rgb(51, 49, 49);" type="checkbox"
                                                            value="" id="checkFacturaAguaCliente" name="checkCliente4">
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-3">
                                                    <div class="form-check">
                                                        <label style="color:rgb(0, 0, 0)!important;font-weight:normal;">
                                                            Croquis
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-1">
                                                    <div class="form-check">
                                                        <input class="form-check-input"
                                                            style="border: 1px solid rgb(51, 49, 49);" type="checkbox"
                                                            value="" id="checkCroquisCliente" name="checkCliente5">
                                                    </div>
                                                </div>


                                                <div class="col-6 col-md-3">
                                                    <div class="form-check">
                                                        <label style="color:rgb(0, 0, 0)!important;font-weight:normal;">
                                                            Folio Real
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-1">
                                                    <div class="form-check">
                                                        <input class="form-check-input"
                                                            style="border: 1px solid rgb(51, 49, 49);" type="checkbox"
                                                            value="" id="checkFolioRealCliente" name="checkCliente6">
                                                    </div>
                                                </div>

                                                <div class="col-6 col-md-3">
                                                    <div class="form-check">
                                                        <label style="color:rgb(0, 0, 0)!important;font-weight:normal;">
                                                            Testimonio
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-1">
                                                    <div class="form-check">
                                                        <input class="form-check-input"
                                                            style="border: 1px solid rgb(51, 49, 49);" type="checkbox"
                                                            value="" id="checkTestimonioCliente" name="checkCliente7">
                                                    </div>
                                                </div>

                                                <div class="col-6 col-md-3">
                                                    <div class="form-check">
                                                        <label style="color:rgb(0, 0, 0)!important;font-weight:normal;">
                                                            Ultimo Impuesto
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-1">
                                                    <div class="form-check">
                                                        <input class="form-check-input"
                                                            style="border: 1px solid rgb(51, 49, 49);" type="checkbox"
                                                            value="" id="checkImpuestoCliente" name="checkCliente8">
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-3">
                                                    <div class="form-check">
                                                        <label style="color:rgb(0, 0, 0)!important;font-weight:normal;">
                                                            RUAT
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-1">
                                                    <div class="form-check">
                                                        <input class="form-check-input"
                                                            style="border: 1px solid rgb(51, 49, 49);" type="checkbox"
                                                            value="" id="checkRuatCliente" name="checkCliente9">
                                                    </div>
                                                </div>

                                                <div class="col-6 col-md-3">
                                                    <div class="form-check">
                                                        <label style="color:rgb(0, 0, 0)!important;font-weight:normal;">
                                                            SOAT
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-1">
                                                    <div class="form-check">
                                                        <input class="form-check-input"
                                                            style="border: 1px solid rgb(51, 49, 49);" type="checkbox"
                                                            value="" id="checkSoatCliente" name="checkCliente10">
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-3">
                                                    <div class="form-check">
                                                        <label style="color:rgb(0, 0, 0)!important;font-weight:normal;">
                                                            NIT
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-1">
                                                    <div class="form-check">
                                                        <input class="form-check-input"
                                                            style="border: 1px solid rgb(51, 49, 49);" type="checkbox"
                                                            value="" id="checkNitCliente" name="checkCliente11">
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-3">
                                                    <div class="form-check">
                                                        <label style="color:rgb(0, 0, 0)!important;font-weight:normal;">
                                                            Patente
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-1">
                                                    <div class="form-check">
                                                        <input class="form-check-input"
                                                            style="border: 1px solid rgb(51, 49, 49);" type="checkbox"
                                                            value="" id="checkPatenteCliente" name="checkCliente12">
                                                    </div>
                                                </div>

                                                <div class="col-6 col-md-3">
                                                    <div class="form-check">
                                                        <label style="color:rgb(0, 0, 0)!important;font-weight:normal;">
                                                            Boleta de Pago
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-1">
                                                    <div class="form-check">
                                                        <input class="form-check-input"
                                                            style="border: 1px solid rgb(51, 49, 49);" type="checkbox"
                                                            value="" id="checkBoletaPagoCliente" name="checkCliente13">
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-3">
                                                    <div class="form-check">
                                                        <label style="color:rgb(0, 0, 0)!important;font-weight:normal;">
                                                            Aporte AFP's
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-1">
                                                    <div class="form-check">
                                                        <input class="form-check-input"
                                                            style="border: 1px solid rgb(51, 49, 49);" type="checkbox"
                                                            value="" id="checkAfpCliente" name="checkCliente14">
                                                    </div>
                                                </div>
                                                <br>
                                                <!-- TABLA DEUDAS-->
                                                <div class="col-12"
                                                    style="background-color:brown; color:white; font-size:16px; padding:8px;">
                                                    Deudas con otros bancos</div>
                                                <br>
                                                <div class="table-responsive contenedorTabla" style="margin-top: 10px;">
                                                    <table class="table table-sm tabla">
                                                        <thead>
                                                            <tr class="text-center">
                                                                <th>#</th>
                                                                <th>Banco</th>
                                                                <th>Plan de pagos</th>
                                                                <th>Boleta de cancelación</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr class="text-center">
                                                                <td class="col-1">1</td>
                                                                <td>
                                                                    <div class="form-group col-10">
                                                                        <select class="form-select"
                                                                            aria-label="Default select example"
                                                                            name="selec_deuda_lcliente1" id="bancod1"
                                                                            style="font-size:15px;">
                                                                            <option value="0">Seleccionar</option>
                                                                            <?php
                                                                                require_once '../scripts/conexion.php';
                                                                                $sentencia = $con->prepare("SELECT * from banco order by banco;");
                                                                                $sentencia->execute(); # Pasar en el mismo orden de los ?
                                                                                $resultado = $sentencia->fetchAll();
                                                                                foreach ($resultado as $banco) : ?>
                                                                            <option
                                                                                value="<?php echo $banco["idbanco"]; ?>">
                                                                                <?php echo $banco["banco"]; ?>
                                                                            </option>
                                                                            <?php endforeach; ?>
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="col-3 col-md-4">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input"
                                                                                style="border: 1px solid rgb(51, 49, 49); margin-left:10px;"
                                                                                type="checkbox" value=""
                                                                                id="checkPlanPagoCliente1"
                                                                                name="checkCliente15">
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="col-3 col-md-4">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input"
                                                                                style="border: 1px solid rgb(51, 49, 49); margin-left:25px;"
                                                                                type="checkbox" value=""
                                                                                id="checkUltimaBoletaCliente1"
                                                                                name="checkCliente16">
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                            <tr class="text-center">
                                                                <td>2</td>
                                                                <td>
                                                                    <div class="form-group col-10">
                                                                        <select class="form-select"
                                                                            aria-label="Default select example"
                                                                            name="selec_deuda_lcliente2" id="bancod2"
                                                                            style="font-size:15px;">
                                                                            <option value="0">Seleccionar</option>
                                                                            <?php
                                                                                require_once '../scripts/conexion.php';
                                                                                $sentencia = $con->prepare("SELECT * from banco order by banco;");
                                                                                $sentencia->execute(); # Pasar en el mismo orden de los ?
                                                                                $resultado = $sentencia->fetchAll();
                                                                                foreach ($resultado as $banco) : ?>
                                                                            <option
                                                                                value="<?php echo $banco["idbanco"]; ?>">
                                                                                <?php echo $banco["banco"]; ?>
                                                                            </option>
                                                                            <?php endforeach; ?>
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="col-3 col-md-4">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input"
                                                                                style="border: 1px solid rgb(51, 49, 49); margin-left:10px;"
                                                                                type="checkbox" value=""
                                                                                id="checkPlanPagoCliente2"
                                                                                name="checkCliente17">
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="col-3 col-md-4">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input"
                                                                                style="border: 1px solid rgb(51, 49, 49); margin-left:25px;"
                                                                                type="checkbox" value=""
                                                                                id="checkUltimaBoletaCliente2"
                                                                                name="checkCliente18">
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr class="text-center">
                                                                <td>3</td>
                                                                <td>
                                                                    <div class="form-group col-10">
                                                                        <select class="form-select"
                                                                            aria-label="Default select example"
                                                                            name="selec_deuda_lcliente3" id="bancod3"
                                                                            style="font-size:15px;">
                                                                            <option value="0">Seleccionar</option>
                                                                            <?php
                                                                                require_once '../scripts/conexion.php';
                                                                                $sentencia = $con->prepare("SELECT * from banco order by banco;");
                                                                                $sentencia->execute(); # Pasar en el mismo orden de los ?
                                                                                $resultado = $sentencia->fetchAll();
                                                                                foreach ($resultado as $banco) : ?>
                                                                            <option
                                                                                value="<?php echo $banco["idbanco"]; ?>">
                                                                                <?php echo $banco["banco"]; ?>
                                                                            </option>
                                                                            <?php endforeach; ?>
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="col-3 col-md-6">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input"
                                                                                style="border: 1px solid rgb(51, 49, 49); margin-left:10px;"
                                                                                type="checkbox" value=""
                                                                                id="checkPlanPagoCliente3"
                                                                                name="checkCliente19">
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="col-3 col-md-6">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input"
                                                                                style="border: 1px solid rgb(51, 49, 49); margin-left:25px;"
                                                                                type="checkbox" value=""
                                                                                id="checkUltimaBoletaCliente3"
                                                                                name="checkCliente20">
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr class="text-center">
                                                                <td>4</td>
                                                                <td>
                                                                    <div class="form-group col-10">
                                                                        <select class="form-select"
                                                                            aria-label="Default select example"
                                                                            name="selec_deuda_lcliente4" id="bancod4"
                                                                            style="font-size:15px;">
                                                                            <option value="0">Seleccionar</option>
                                                                            <?php
                                                                                require_once '../scripts/conexion.php';
                                                                                $sentencia = $con->prepare("SELECT * from banco order by banco;");
                                                                                $sentencia->execute(); # Pasar en el mismo orden de los ?
                                                                                $resultado = $sentencia->fetchAll();
                                                                                foreach ($resultado as $banco) : ?>
                                                                            <option
                                                                                value="<?php echo $banco["idbanco"]; ?>">
                                                                                <?php echo $banco["banco"]; ?>
                                                                            </option>
                                                                            <?php endforeach; ?>
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="col-3 col-md-6">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input"
                                                                                style="border: 1px solid rgb(51, 49, 49); margin-left:10px;"
                                                                                type="checkbox" value=""
                                                                                id="checkPlanPagoCliente4"
                                                                                name="checkCliente21">
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="col-3 col-md-6">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input"
                                                                                style="border: 1px solid rgb(51, 49, 49); margin-left:25px;"
                                                                                type="checkbox" value=""
                                                                                id="checkUltimaBoletaCliente4"
                                                                                name="checkCliente22">
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade listaDoc" id="modalGLis" tabindex="-1" aria-labelledby="modelTitleId"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" style="font-size:16px;">Lista de Documentos
                                                Entregados - Garante</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body" style="margin-top: 20px;">
                                            <div class="row">
                                                <div class="col-6 col-md-3">
                                                    <div class="form-check">
                                                        <label style="color:rgb(0, 0, 0)!important;font-weight:normal;">
                                                            Fotocopia de Carnet
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-1">
                                                    <div class="form-check">
                                                        <input class="form-check-input"
                                                            style="border: 1px solid rgb(51, 49, 49);" type="checkbox"
                                                            value="" id="checkGaranteCliente" name="checkGarante1">
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-3">
                                                    <div class="form-check">
                                                        <label style="color:rgb(0, 0, 0)!important;font-weight:normal;">
                                                            Factura de Luz
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-1">
                                                    <div class="form-check">
                                                        <input class="form-check-input"
                                                            style="border: 1px solid rgb(51, 49, 49);" type="checkbox"
                                                            value="" id="checkFacturaLuzGarante" name="checkGarante2">
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-3">
                                                    <div class="form-check">
                                                        <label style="color:rgb(0, 0, 0)!important;font-weight:normal;">
                                                            Factura de Agua
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-1">
                                                    <div class="form-check">
                                                        <input class="form-check-input"
                                                            style="border: 1px solid rgb(51, 49, 49);" type="checkbox"
                                                            value="" id="checkFacturaAguaGarante" name="checkGarante3">
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-3">
                                                    <div class="form-check">
                                                        <label style="color:rgb(0, 0, 0)!important;font-weight:normal;">
                                                            Croquis
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-1">
                                                    <div class="form-check">
                                                        <input class="form-check-input"
                                                            style="border: 1px solid rgb(51, 49, 49);" type="checkbox"
                                                            value="" id="checkCroquisGarante" name="checkGarante4">
                                                    </div>
                                                </div>


                                                <div class="col-6 col-md-3">
                                                    <div class="form-check">
                                                        <label style="color:rgb(0, 0, 0)!important;font-weight:normal;">
                                                            Folio Real
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-1">
                                                    <div class="form-check">
                                                        <input class="form-check-input"
                                                            style="border: 1px solid rgb(51, 49, 49);" type="checkbox"
                                                            value="" id="checkFolioRealGarante" name="checkGarante5">
                                                    </div>
                                                </div>

                                                <div class="col-6 col-md-3">
                                                    <div class="form-check">
                                                        <label style="color:rgb(0, 0, 0)!important;font-weight:normal;">
                                                            Testimonio
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-1">
                                                    <div class="form-check">
                                                        <input class="form-check-input"
                                                            style="border: 1px solid rgb(51, 49, 49);" type="checkbox"
                                                            value="" id="checkTestimonioGarante" name="checkGarante6">
                                                    </div>
                                                </div>

                                                <div class="col-6 col-md-3">
                                                    <div class="form-check">
                                                        <label style="color:rgb(0, 0, 0)!important;font-weight:normal;">
                                                            Ultimo Impuesto
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-1">
                                                    <div class="form-check">
                                                        <input class="form-check-input"
                                                            style="border: 1px solid rgb(51, 49, 49);" type="checkbox"
                                                            value="" id="checkImpuestoGarante" name="checkGarante7">
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-3">
                                                    <div class="form-check">
                                                        <label style="color:rgb(0, 0, 0)!important;font-weight:normal;">
                                                            RUAT
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-1">
                                                    <div class="form-check">
                                                        <input class="form-check-input"
                                                            style="border: 1px solid rgb(51, 49, 49);" type="checkbox"
                                                            value="" id="checkRuaGarante" name="checkGarante8">
                                                    </div>
                                                </div>

                                                <div class="col-6 col-md-3">
                                                    <div class="form-check">
                                                        <label style="color:rgb(0, 0, 0)!important;font-weight:normal;">
                                                            SOAT
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-1">
                                                    <div class="form-check">
                                                        <input class="form-check-input"
                                                            style="border: 1px solid rgb(51, 49, 49);" type="checkbox"
                                                            value="" id="checkSoatGarante" name="checkGarante9">
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-3">
                                                    <div class="form-check">
                                                        <label style="color:rgb(0, 0, 0)!important;font-weight:normal;">
                                                            NIT
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-1">
                                                    <div class="form-check">
                                                        <input class="form-check-input"
                                                            style="border: 1px solid rgb(51, 49, 49);" type="checkbox"
                                                            value="" id="checkNitGarante" name="checkGarante10">
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-3">
                                                    <div class="form-check">
                                                        <label style="color:rgb(0, 0, 0)!important;font-weight:normal;">
                                                            Patente
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-1">
                                                    <div class="form-check">
                                                        <input class="form-check-input"
                                                            style="border: 1px solid rgb(51, 49, 49);" type="checkbox"
                                                            value="" id="checkPatenteGarante" name="checkGarante11">
                                                    </div>
                                                </div>

                                                <div class="col-6 col-md-3">
                                                    <div class="form-check">
                                                        <label style="color:rgb(0, 0, 0)!important;font-weight:normal;">
                                                            Boleta de Pago
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-1">
                                                    <div class="form-check">
                                                        <input class="form-check-input"
                                                            style="border: 1px solid rgb(51, 49, 49);" type="checkbox"
                                                            value="" id="checkBoletaPagoGarante" name="checkGarante12">
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-3">
                                                    <div class="form-check">
                                                        <label style="color:rgb(0, 0, 0)!important;font-weight:normal;">
                                                            Aporte AFP's
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-1">
                                                    <div class="form-check">
                                                        <input class="form-check-input"
                                                            style="border: 1px solid rgb(51, 49, 49);" type="checkbox"
                                                            value="" id="checkAfpGarante" name="checkGarante13">
                                                    </div>
                                                </div>
                                                <br>
                                                <!-- TABLA DEUDAS-->
                                                <div class="col-12"
                                                    style="background-color:brown; color:white; font-size:17px; padding:8px;">
                                                    Deudas con otros bancos</div>
                                                <br>
                                                <div class="table-responsive contenedorTabla" style="margin-top: 20px;">
                                                    <table class="table table-sm tabla">
                                                        <thead>
                                                            <tr class="text-center">
                                                                <th>#</th>
                                                                <th>Banco</th>
                                                                <th>Plan de Pagos</th>
                                                                <th>Boleta de Cancelación</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr class="text-center">
                                                                <td class="col-1">1</td>
                                                                <td>
                                                                    <div class="form-group col-10">

                                                                        <select class="form-select"
                                                                            aria-label="Default select example"
                                                                            name="selec_deuda_garante1"
                                                                            id="selec_deuda_lgarante1"
                                                                            style="font-size:15px;">
                                                                            <option value="0">Seleccionar</option>
                                                                            <?php
                                                                                require_once '../scripts/conexion.php';
                                                                                $sentencia = $con->prepare("SELECT * from banco;");
                                                                                $sentencia->execute(); # Pasar en el mismo orden de los ?
                                                                                $resultado = $sentencia->fetchAll();
                                                                                foreach ($resultado as $banco) : ?>
                                                                            <option
                                                                                value="<?php echo $banco["idbanco"]; ?>">
                                                                                <?php echo $banco["banco"]; ?>
                                                                            </option>
                                                                            <?php endforeach; ?>
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="col-3 col-md-4">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input"
                                                                                style="border: 1px solid rgb(51, 49, 49); margin-left:10px;"
                                                                                type="checkbox" value=""
                                                                                id="checkPlanPagoGarante1"
                                                                                name="checkGarante14">
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="col-3 col-md-4">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input"
                                                                                style="border: 1px solid rgb(51, 49, 49); margin-left:25px;"
                                                                                type="checkbox" value=""
                                                                                id="checkUltimaBoletaGarante1"
                                                                                name="checkGarante15">
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                            <tr class="text-center">
                                                                <td>2</td>
                                                                <td>
                                                                    <div class="form-group col-10">

                                                                        <select class="form-select"
                                                                            aria-label="Default select example"
                                                                            name="selec_deuda_garante2"
                                                                            id="selec_deuda_lgarante2"
                                                                            style="font-size:15px;">
                                                                            <option value="0">Seleccionar</option>
                                                                            <?php
                                                                                require_once '../scripts/conexion.php';
                                                                                $sentencia = $con->prepare("SELECT * from banco;");
                                                                                $sentencia->execute(); # Pasar en el mismo orden de los ?
                                                                                $resultado = $sentencia->fetchAll();
                                                                                foreach ($resultado as $banco) : ?>
                                                                            <option
                                                                                value="<?php echo $banco["idbanco"]; ?>">
                                                                                <?php echo $banco["banco"]; ?>
                                                                            </option>
                                                                            <?php endforeach; ?>
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="col-3 col-md-4">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input"
                                                                                style="border: 1px solid rgb(51, 49, 49); margin-left:10px;"
                                                                                type="checkbox" value=""
                                                                                id="checkPlanPagoGarante2"
                                                                                name="checkGarante16">
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="col-3 col-md-4">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input"
                                                                                style="border: 1px solid rgb(51, 49, 49); margin-left:25px;"
                                                                                type="checkbox" value=""
                                                                                id="checkUltimaBoletaGarante2"
                                                                                name="checkGarante17">
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr class="text-center">
                                                                <td>3</td>
                                                                <td>
                                                                    <div class="form-group col-10">

                                                                        <select class="form-select"
                                                                            aria-label="Default select example"
                                                                            name="selec_deuda_garante3"
                                                                            id="selec_deuda_lgarante3"
                                                                            style="font-size:15px;">
                                                                            <option value="0">Seleccionar</option>
                                                                            <?php
                                                                                require_once '../scripts/conexion.php';
                                                                                $sentencia = $con->prepare("SELECT * from banco;");
                                                                                $sentencia->execute(); # Pasar en el mismo orden de los ?
                                                                                $resultado = $sentencia->fetchAll();
                                                                                foreach ($resultado as $banco) : ?>
                                                                            <option
                                                                                value="<?php echo $banco["idbanco"]; ?>">
                                                                                <?php echo $banco["banco"]; ?>
                                                                            </option>
                                                                            <?php endforeach; ?>
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="col-3 col-md-4">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input"
                                                                                style="border: 1px solid rgb(51, 49, 49); margin-left:10px;"
                                                                                type="checkbox" value=""
                                                                                id="checkPlanPagoGarante3"
                                                                                name="checkGarante18">
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="col-3 col-md-4">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input"
                                                                                style="border: 1px solid rgb(51, 49, 49); margin-left:25px;"
                                                                                type="checkbox" value=""
                                                                                id="checkUltimaBoletaGarante3"
                                                                                name="checkGarante19">
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr class="text-center">
                                                                <td>4</td>
                                                                <td>
                                                                    <div class="form-group col-10">

                                                                        <select class="form-select"
                                                                            aria-label="Default select example"
                                                                            name="selec_deuda_garante4"
                                                                            id="selec_deuda_lgarante4"
                                                                            style="font-size:15px;">
                                                                            <option value="0">Seleccionar</option>
                                                                            <?php
                                                                                require_once '../scripts/conexion.php';
                                                                                $sentencia = $con->prepare("SELECT * from banco;");
                                                                                $sentencia->execute(); # Pasar en el mismo orden de los ?
                                                                                $resultado = $sentencia->fetchAll();
                                                                                foreach ($resultado as $banco) : ?>
                                                                            <option
                                                                                value="<?php echo $banco["idbanco"]; ?>">
                                                                                <?php echo $banco["banco"]; ?>
                                                                            </option>
                                                                            <?php endforeach; ?>
                                                                        </select>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="col-3 col-md-4">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input"
                                                                                style="border: 1px solid rgb(51, 49, 49); margin-left:10px;"
                                                                                type="checkbox" value=""
                                                                                id="checkPlanPagoGarante4"
                                                                                name="checkGarante20">
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="col-3 col-md-4">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input"
                                                                                style="border: 1px solid rgb(51, 49, 49); margin-left:25px;"
                                                                                type="checkbox" value=""
                                                                                id="checkUltimaBoletaGarante4"
                                                                                name="checkGarante21">
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <p class="text-center" style="margin-top: 20px;">
                            <button type="button" id="boton_guardar_id" class="btn btn-success"
                                style="padding:7px;font-size:14px;"><i class="far fa-save"></i> &nbsp;
                                GUARDAR</button>
                        </p>
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
    <script src="js/selectsNuevaVenta.js"></script>
    <script src="js/datosTramite.js"></script>
</body>

</html>