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
                        <a href="nuevoCredito.php"><i class="fas fa-plus fa-fw"></i> &nbsp; NUEVO TRÁMITE</a>
                    </li>
                    <li>
                        <a href="listaTramites.php"><i class="fas fa-clipboard-list fa-fw"></i>&nbsp;LISTA TRÁMITES
                        </a>
                    </li>
                    <li>
                        <a href="buscaTramite.php"><i class="fas fa-search fa-fw"></i>&nbsp;&nbsp;&nbsp;BUSCAR TRÁMITE
                        </a>
                    </li>
                </ul>
            </div>

            <!-- TABLA REGISTRO-->
            <div class="container-fluid">
                <form action="" class="formularioActualizaT" id="ac_reg_tramite" autocomplete="off" method="POST" enctype="multipart/form-data">
                    <fieldset>
                        <legend><i class="fas fa-user-plus"></i> &nbsp; Actualizar Trámite</legend>
                        <div class="container-fluid">
                            <div class="row" style="text-align:center;">

                                <input type="text" name="id" id="id_tramite" maxlength="16" value="<?= $proceso ?>" hidden>
                                <div class="table-responsive contenedorTablaBus tablaresbusCI col-12 col-md-12" id="idtablabusCI" style="display:none;">
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
                                <div class="col-12 col-md-5">
                                    <div class="form-group">
                                        <label for="monto_prestamo" class="bmd-label-floating titulo">Banco</label>
                                        <input type="text" class="form-control" name="banco" id="info_banco" maxlength="6" disabled>

                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label for="monto_prestamo" class="bmd-label-floating titulo">Monto
                                            Préstamo</label>
                                        <input type="text" pattern="[0-9]{5,6}" class="form-control" name="monto_prestamo" id="monto_pres" maxlength="6" required>

                                    </div>

                                </div>
                                <div class="col-12 col-md-3">
                                    <div class="form-group">
                                        <label for="moneda" class="bmd-label-floating titulo">Moneda</label>
                                        <input type="text" class="form-control" required name="moneda" id="moneda" disabled value="$">
                                    </div>
                                </div>
                                <div class="col-12 col-md-5">
                                    <div class="form-group">
                                        <label for="estado" class="bmd-label-floating titulo">Estado</label>
                                        <select name="estado" class="form-select" id="estado_selec" required>
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

                            </div>

                            <div class="justify-content-center table-responsive" style="padding:10px;">
                                <table class="table tablaOpciones">
                                    <thead>
                                        <tr class="text-center">
                                            <th>Ver Vehiculos</th>
                                            <th>Añadir Vehiculos</th>
                                            <th>Exp.Cliente</th>
                                            <th>Lis.Cliente</th>
                                            <th>Exp.Garante</th>
                                            <th>Lis.Garante</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-center"><button class="btn btn-danger" type="button" data-bs-toggle="modal" data-bs-target="#modalV"><i class="fas fa-car"></i></button></td>
                                            <td class="text-center"><button class="btn btn-warning" type="button" data-bs-toggle="modal" data-bs-target="#modalVadd"><i class="fas fa-plus"></i></button></td>
                                            <td class="text-center"><button class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#modalCExp"><i class="fas fa-folder-open"></i></button></td>
                                            <td class="text-center"><button class="btn btn-secondary" type="button" data-bs-toggle="modal" data-bs-target="#modalCLis"><i class="fas fa-clipboard-list"></i></button></td>
                                            <td class="text-center"><button class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#modalGExp"><i class="fas fa-folder-open"></i></button></td>
                                            <td class="text-center"><button class="btn btn-secondary" type="button" data-bs-toggle="modal" data-bs-target="#modalGLis"><i class="fas fa-clipboard-list"></i></button></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="modal fade" id="modalV" tabindex="-1" aria-labelledby="modelTitleId" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Lista de Vehiculos</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="table-responsive justify-content-center contenedorTablaBus tablaresbusM col-12 col-md-12" id="idtablabusM" style="display:none;">
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
                                <div class="modal fade" id="modalVadd" tabindex="-1" aria-labelledby="modelTitleId" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Añadir Vehiculo</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-12 col-md-3">
                                                        <div class="form-group">
                                                            <label for="inputSearch" class="bmd-label-floating labelBusqueda" id="idLabelBusMarca">Marca</label>
                                                            <select name="tipoMarca" class="form-select" id="marca_selec">
                                                                <option value="" selected>Seleccionar</option>
                                                                <?php
                                                                require_once '../scripts/conexion.php';
                                                                $sql = "SELECT distinct marca from vehiculo";
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
                                                    <div class="col-12 col-md-3">
                                                        <div class="form-group">
                                                            <label for="inputSearch" class="bmd-label-floating labelBusqueda" id="idLabelBusModelo">Modelo</label>
                                                            <select name="modelo" class="form-select" id="modelo_selec">
                                                                <option value="" selected>Seleccionar</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-3">
                                                        <div class="form-group">
                                                            <label for="inputSearch" class="bmd-label-floating labelBusqueda" id="idLabelBusColor">Color</label>
                                                            <select name="color" class="form-select" id="color_selec">
                                                                <option value="" selected>Seleccionar</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-3">
                                                        <div class="form-group">
                                                            <label for="inputSearch" class="bmd-label-floating labelBusqueda" id="idLabelBusPas">#Pas</label>
                                                            <select name="numpas" class="form-select" id="numpas_selec">
                                                                <option value="" selected>Seleccionar</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12 col-md-3">
                                                            <div class="form-group">
                                                                <label for="inputSearch" class="bmd-label-floating labelBusqueda" id="idLabelBusPrecio">Precio</label>
                                                                <select name="precio" class="form-select" id="precio_selec">
                                                                    <option value="" selected>Seleccionar</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-md-3">
                                                            <div class="form-group">
                                                                <label for="precio_otro" class="bmd-label-floating">Otro</label>
                                                                <input type="number" pattern="[0-9]{5,7}" class="form-control" required name="precio_otro" id="precio_autoOtro" maxlength="50" disabled>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-md-3">
                                                            <div class="form-group">
                                                                <label for="precio_otro" class="bmd-label-floating">Moneda</label>
                                                                <input type="text" pattern="[a-zA-Z\s.-]{3,50}" class="form-control" required name="precio_otro" id="precio_autoOtro" maxlength="50" disabled value="$">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-12 col-md-12" style="text-align:center;">
                                                        <div class="form-group">
                                                            <p class="text-center" style="margin-top: 40px; text-align:center;">
                                                                <button type="button" class="btn btn-danger" name="addAuto" id="idAddAuto" style="margin:auto;">AÑADIR &nbsp;<i class="fas fa-plus"></i></button>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="modalCExp" tabindex="-1" aria-labelledby="modelTitleId" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Documentos Cliente</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row justify-content-center">
                                                    <div class="col-12" style="margin:30px; width:200px;">
                                                        <div class="container card col-12 col-md-3" id="perfilCContrato">
                                                            <i id="iconoCContrato" class="fa fa-upload"></i>
                                                            <img alt="perfil" class="fotoCContrato">
                                                            <input type="file" id="subirImgCContrato" accept="image/jpg,image/jpeg" name="clienteContrato">
                                                            <div class="card-footer">
                                                                <span>Contrato de Tramite</span>
                                                            </div>

                                                        </div>
                                                        <button type="button" class="col-2 btn btn-danger center-block" style="display:inline-block; position:absolute; height:30px; margin-left:30px; padding:2px;" id="quitaCContrato">Quitar</button>
                                                    </div>

                                                    <div class="col-12" style="margin:30px;width:200px;">
                                                        <div class="container card col-12 col-md-3" id="perfilCCarnet">
                                                            <i id="iconoCCarnet" class="fa fa-upload"></i>
                                                            <img alt="perfil" class="fotoCCarnet">
                                                            <input type="file" id="subirImgCCarnet" accept="image/jpg,image/jpeg" name="clienteCarnet">
                                                            <div class="card-footer">
                                                                <span>Fotocopia Carnet</span>
                                                            </div>
                                                        </div>
                                                        <button type="button" class="col-2 btn btn-danger center-block" style="display:inline-block; position:absolute; height:30px; margin-left:30px; padding:2px;" id="quitaCCarnet">Quitar</button>
                                                    </div>
                                                </div>

                                                <div class="row justify-content-center">
                                                    <div class="col-12" style="margin:30px;width:200px;">
                                                        <div class="container card col-md-3 " id="perfilCFacLuz">
                                                            <i id="iconoCFacLuz" class="fa fa-upload"></i>
                                                            <img alt="perfil" class="fotoCFacLuz">
                                                            <input type="file" id="subirImgCFacLuz" accept="image/jpg,image/jpeg" name="clienteFacLuz">
                                                            <div class="card-footer">
                                                                <span>Factura de Luz</span>
                                                            </div>
                                                        </div>
                                                        <button type="button" class="col-md-2 btn btn-danger" style="display:inline-block; position:absolute; height:30px; margin-left:30px; padding:2px;" id="quitaCFacLuz">Quitar</button>
                                                    </div>
                                                    <div class="col-12" style="margin:30px;width:200px;">
                                                        <div class="container card col-md-3 " id="perfilCFacAgua">
                                                            <i id="iconoCFacAgua" class="fa fa-upload"></i>
                                                            <img alt="perfil" class="fotoCFacAgua">
                                                            <input type="file" id="subirImgCFacAgua" accept="image/jpg,image/jpeg,image/png" name="clienteFacAgua">
                                                            <div class="card-footer">
                                                                <span>Factura de Agua</span>
                                                            </div>
                                                        </div>
                                                        <button type="button" class="col-md-2 btn btn-danger" style="display:inline-block; position:absolute; height:30px; margin-left:30px; padding:2px;" id="quitaCFacAgua">Quitar</button>
                                                    </div>
                                                    <div class="col-12" style="margin:30px;width:200px;">
                                                        <div class="container card col-md-3 " id="perfilCCroquis">
                                                            <i id="iconoCCroquis" class="fa fa-upload"></i>
                                                            <img alt="perfil" class="fotoCCroquis">
                                                            <input type="file" id="subirImgCCroquis" accept="image/jpg,image/jpeg,image/png" name="clienteCroquis">
                                                            <div class="card-footer">
                                                                <span>Croquis</span>
                                                            </div>
                                                        </div>
                                                        <button type="button" class="col-md-2 btn btn-danger" style="display:inline-block; position:absolute; height:30px; margin-left:50px; padding:2px;" id="quitaCCroquis">Quitar</button>
                                                    </div>
                                                    <div class="col-12" style="margin:30px;width:200px;">
                                                        <div class="container card col-md-3 " id="perfilCFolioReal">
                                                            <i id="iconoCFolioReal" class="fa fa-upload"></i>
                                                            <img alt="perfil" class="fotoCFolioReal">
                                                            <input type="file" id="subirImgCFolioReal" accept="image/jpg,image/jpeg,image/png" name="clienteFolioReal">
                                                            <div class="card-footer">
                                                                <span>Folio Real</span>
                                                            </div>
                                                        </div>
                                                        <button type="button" class="col-md-2 btn btn-danger" style="display:inline-block; position:absolute; height:30px; margin-left:30px; padding:2px;" id="quitaCFolio">Quitar</button>
                                                    </div>
                                                    <div class="col-12" style="margin:30px;width:200px;">
                                                        <div class="container card col-md-3 " id="perfilCTestimonio">
                                                            <i id="iconoCTestimonio" class="fa fa-upload"></i>
                                                            <img alt="perfil" class="fotoCTestimonio">
                                                            <input type="file" id="subirImgCTestimonio" accept="image/jpg,image/jpeg,image/png" name="clienteTestimonio">
                                                            <div class="card-footer">
                                                                <span>Testimonio</span>
                                                            </div>
                                                        </div>
                                                        <button type="button" class="col-md-2 btn btn-danger" style="display:inline-block; position:absolute; height:30px; margin-left:30px; padding:2px;" id="quitaCTestimonio">Quitar</button>
                                                    </div>
                                                    <div class="col-12" style="margin:30px;width:200px;">
                                                        <div class="container card col-md-3 " id="perfilCImpuesto">
                                                            <i id="iconoCImpuesto" class="fa fa-upload"></i>
                                                            <img alt="perfil" class="fotoCImpuesto">
                                                            <input type="file" id="subirImgCImpuesto" accept="image/jpg,image/jpeg,image/png" name="clienteImpuesto">
                                                            <div class="card-footer">
                                                                <span>Ultimo Impuesto</span>
                                                            </div>
                                                        </div>
                                                        <button type="button" class="col-md-2 btn btn-danger" style="display:inline-block; position:absolute; height:30px; margin-left:30px; padding:2px;" id="quitaCImpuesto">Quitar</button>
                                                    </div>

                                                </div>

                                                <div class="row justify-content-center">
                                                    <div class="col-12" style="margin:30px;width:200px;">
                                                        <div class="container card col-md-3 " id="perfilCRuat">
                                                            <i id="iconoCRuat" class="fa fa-upload"></i>
                                                            <img alt="perfil" class="fotoCRuat">
                                                            <input type="file" id="subirImgCRuat" accept="image/jpg,image/jpeg,image/png" name="clienteRuat">
                                                            <div class="card-footer">
                                                                <span>RUAT</span>
                                                            </div>
                                                        </div>
                                                        <button type="button" class="col-md-2 btn btn-danger" style="display:inline-block; position:absolute; height:30px; margin-left:30px; padding:2px;" id="quitaCRuat">Quitar</button>
                                                    </div>

                                                    <div class="col-12" style="margin:30px;width:200px;">
                                                        <div class="container card col-md-3 " id="perfilCSoat">
                                                            <i id="iconoCSoat" class="fa fa-upload"></i>
                                                            <img alt="perfil" class="fotoCSoat">
                                                            <input type="file" id="subirImgCSoat" accept="image/jpg,image/jpeg,image/png" name="clienteSoat">
                                                            <div class="card-footer">
                                                                <span>SOAT</span>
                                                            </div>
                                                        </div>
                                                        <button type="button" class="col-md-2 btn btn-danger" style="display:inline-block; position:absolute; height:30px; margin-left:30px; padding:2px;" id="quitaCSoat">Quitar</button>
                                                    </div>
                                                    <div class="col-12" style="margin:30px;width:200px;">
                                                        <div class="container card col-md-3 " id="perfilCNit">
                                                            <i id="iconoCNit" class="fa fa-upload"></i>
                                                            <img alt="perfil" class="fotoCNit">
                                                            <input type="file" id="subirImgCNit" accept="image/jpg,image/jpeg,image/png" name="clienteNit">
                                                            <div class="card-footer">
                                                                <span>NIT</span>
                                                            </div>
                                                        </div>
                                                        <button type="button" class="col-md-2 btn btn-danger" style="display:inline-block; position:absolute; height:30px; margin-left:30px; padding:2px;" id="quitaCNit">Quitar</button>
                                                    </div>
                                                    <div class="col-12" style="margin:30px;width:200px;">
                                                        <div class="container card col-md-3 " id="perfilCPatente">
                                                            <i id="iconoCPatente" class="fa fa-upload"></i>
                                                            <img alt="perfil" class="fotoCPatente">
                                                            <input type="file" id="subirImgCPatente" accept="image/jpg,image/jpeg,image/png" name="clientePatente">
                                                            <div class="card-footer">
                                                                <span>Patente</span>
                                                            </div>
                                                        </div>
                                                        <button type="button" class="col-md-2 btn btn-danger" style="display:inline-block; position:absolute; height:30px; margin-left:30px; padding:2px;" id="quitaCPatente">Quitar</button>
                                                    </div>
                                                    <div class="col-12" style="margin:30px;width:200px;">
                                                        <div class="container card col-md-3 " id="perfilCBoletaPago">
                                                            <i id="iconoCBoletaPago" class="fa fa-upload"></i>
                                                            <img alt="perfil" class="fotoCBoletaPago">
                                                            <input type="file" id="subirImgCBoletaPago" accept="image/jpg,image/jpeg,image/png" name="clienteBoletaPago">
                                                            <div class="card-footer">
                                                                <span>Boleta de Pago</span>
                                                            </div>
                                                        </div>
                                                        <button type="button" class="col-md-2 btn btn-danger" style="display:inline-block; position:absolute; height:30px; margin-left:30px; padding:2px;" id="quitaCBoletaPago">Quitar</button>
                                                    </div>
                                                    <div class="col-12" style="margin:30px;width:200px;">
                                                        <div class="container card col-md-3 " id="perfilCAfp">
                                                            <i id="iconoCAfp" class="fa fa-upload"></i>
                                                            <img alt="perfil" class="fotoCAfp">
                                                            <input type="file" id="subirImgCAfp" accept="image/jpg,image/jpeg,image/png" name="clienteAfp">
                                                            <div class="card-footer">
                                                                <span>AFP's</span>
                                                            </div>
                                                        </div>
                                                        <button type="button" class="col-md-2 btn btn-danger" style="display:inline-block; position:absolute; height:30px; margin-left:30px; padding:2px;" id="quitaCAfp">Quitar</button>
                                                    </div>

                                                    <div class="col-12" style="background-color:brown; color:white; margin:10px;font-size:17px; padding:12px;">
                                                        Deudas Con Otros Bancos</div>
                                                    <div class="col-12 col-md-8">
                                                        <div class="form-group">
                                                            <label for="nom_banco" class="bmd-label-floating titulo">Banco</label>
                                                            <select class="form-select" aria-label="Default select example" name="selec_banco_cliente1" id="select_banco_cfolder1">
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
                                                                <input type="file" id="subirImgCPlanPago1" accept="image/jpg,image/jpeg,image/png" name="clientePlan1">
                                                                <div class="card-footer">
                                                                    <span>Plan de pagos</span>
                                                                </div>
                                                            </div>
                                                            <button type="button" class="col-md-2 btn btn-danger" style="display:inline-block; position:absolute; height:30px; margin-left:30px; padding:2px;" id="quitaCPlanPago1">Quitar</button>
                                                        </div>
                                                        <div class="col-12" style="margin:30px;width:200px;">
                                                            <div class="container card col-md-3 " id="perfilCBoletaCancelacion1">
                                                                <i id="iconoCBoletaCancelacion1" class="fa fa-upload"></i>
                                                                <img alt="perfil" class="fotoCBoletaCancelacion1">
                                                                <input type="file" id="subirImgCBoletaCancelacion1" accept="image/jpg,image/jpeg,image/png" name="clienteCancelacion1">
                                                                <div class="card-footer">
                                                                    <span>Boleta de Cancelacion</span>
                                                                </div>
                                                            </div>
                                                            <button type="button" class="col-md-2 btn btn-danger" style="display:inline-block; position:absolute; height:30px; margin-left:30px; padding:2px;" id="quitaCBoletaCancelacion1">Quitar</button>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-8">
                                                        <div class="form-group">
                                                            <label for="nom_banco" class="bmd-label-floating titulo">Banco</label>
                                                            <select class="form-select" aria-label="Default select example" name="selec_banco_cliente2" id="select_banco_cfolder2">
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
                                                                <input type="file" id="subirImgCPlanPago2" accept="image/jpg,image/jpeg,image/png" name="clientePlan2">
                                                                <div class="card-footer">
                                                                    <span>Plan de pagos</span>
                                                                </div>
                                                            </div>
                                                            <button type="button" class="col-md-2 btn btn-danger" style="display:inline-block; position:absolute; height:30px; margin-left:30px; padding:2px;" id="quitaCPlanPago2">Quitar</button>
                                                        </div>
                                                        <div class="col-12" style="margin:30px;width:200px;">
                                                            <div class="container card col-md-3 " id="perfilCBoletaCancelacion2">
                                                                <i id="iconoCBoletaCancelacion2" class="fa fa-upload"></i>
                                                                <img alt="perfil" class="fotoCBoletaCancelacion2">
                                                                <input type="file" id="subirImgCBoletaCancelacion2" accept="image/jpg,image/jpeg,image/png" name="clienteCancelacion2">
                                                                <div class="card-footer">
                                                                    <span>Boleta de Cancelacion</span>
                                                                </div>
                                                            </div>
                                                            <button type="button" class="col-md-2 btn btn-danger" style="display:inline-block; position:absolute; height:30px; margin-left:30px; padding:2px;" id="quitaCBoletaCancelacion2">Quitar</button>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-8">
                                                        <div class="form-group">
                                                            <label for="nom_banco" class="bmd-label-floating titulo">Banco</label>
                                                            <select class="form-select" aria-label="Default select example" name="selec_banco_cliente3" id="select_banco_cfolder3">
                                                                <option value="0" selected>Seleccionar</option>
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
                                                                <input type="file" id="subirImgCPlanPago3" accept="image/jpg,image/jpeg,image/png" name="clientePlan3">
                                                                <div class="card-footer">
                                                                    <span>Plan de pagos</span>
                                                                </div>
                                                            </div>
                                                            <button type="button" class="col-md-2 btn btn-danger" style="display:inline-block; position:absolute; height:30px; margin-left:30px; padding:2px;" id="quitaCPlanPago3">Quitar</button>
                                                        </div>
                                                        <div class="col-12" style="margin:30px;width:200px;">
                                                            <div class="container card col-md-3 " id="perfilCBoletaCancelacion3">
                                                                <i id="iconoCBoletaCancelacion3" class="fa fa-upload"></i>
                                                                <img alt="perfil" class="fotoCBoletaCancelacion3">
                                                                <input type="file" id="subirImgCBoletaCancelacion3" accept="image/jpg,image/jpeg,image/png" name="clienteCancelacion3">
                                                                <div class="card-footer">
                                                                    <span>Boleta de Cancelacion</span>
                                                                </div>
                                                            </div>
                                                            <button type="button" class="col-md-2 btn btn-danger" style="display:inline-block; position:absolute; height:30px; margin-left:30px; padding:2px;" id="quitaCBoletaCancelacion3">Quitar</button>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-8">
                                                        <div class="form-group">
                                                            <label for="nom_banco" class="bmd-label-floating titulo">Banco</label>
                                                            <select class="form-select" aria-label="Default select example" name="selec_banco_cliente4" id="select_banco_cfolder4">
                                                                <option value="0" selected>Seleccionar</option>
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
                                                                <input type="file" id="subirImgCPlanPago4" accept="image/jpg,image/jpeg,image/png" name="clientePlan4">
                                                                <div class="card-footer">
                                                                    <span>Plan de pagos</span>
                                                                </div>
                                                            </div>
                                                            <button type="button" class="col-md-2 btn btn-danger" style="display:inline-block; position:absolute; height:30px; margin-left:30px; padding:2px;" id="quitaCPlanPago4">Quitar</button>
                                                        </div>
                                                        <div class="col-12" style="margin:30px;width:200px;">
                                                            <div class="container card col-md-3 " id="perfilCBoletaCancelacion4">
                                                                <i id="iconoCBoletaCancelacion4" class="fa fa-upload"></i>
                                                                <img alt="perfil" class="fotoCBoletaCancelacion4">
                                                                <input type="file" id="subirImgCBoletaCancelacion4" accept="image/jpg,image/jpeg,image/png" name="clienteCancelacion4">
                                                                <div class="card-footer">
                                                                    <span>Boleta de Cancelacion</span>
                                                                </div>
                                                            </div>
                                                            <button type="button" class="col-md-2 btn btn-danger" style="display:inline-block; position:absolute; height:30px; margin-left:30px; padding:2px;" id="quitaCBoletaCancelacion4">Quitar</button>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>


                            <p class="text-center" style="margin-top: 20px;">
                                <button type="submit" class="btn botonGuardar" style="padding:10px;"><i class="far fa-save"></i> &nbsp;
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
    <script src="js/pruebaSelect.js"></script>
    <script src="js/expedienteTramite.js"></script>
</body>
</html>