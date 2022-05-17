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
    <link rel="stylesheet" href="./css/estiloClientes.css">
    <title>Nuevo_Cliente</title>
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
                        <a class="active" href="nuevoCliente.php" style="font-size:15.5px!important;"><i class="fas fa-plus fa-fw"></i> &nbsp; REGISTRAR CLIENTE</a>
                    </li>
                    <li>
                        <a href="listaClientes.php" style="font-size:15.5px!important;"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE CLIENTES</a>
                    </li>
                    <li>
                        <a href="buscarCliente.php" style="font-size:15.5px!important;"><i class="fas fa-search fa-fw"></i> &nbsp; BUSCAR CLIENTE</a>
                    </li>
                </ul>
            </div>

            <!-- TABLA REGISTRO-->
            <div class="container-fluid">
                <form class="formulario" autocomplete="off" id="registrar_cliente" method="POST" enctype="multipart/form-data">
                    <fieldset>
                        <legend><i class="fas fa-user-plus"></i> &nbsp; Registro de Nuevo Cliente</legend>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 col-md-3">
                                    <div class="form-group">
                                        <label for="ci_cliente" class="bmd-label-floating">CI</label>
                                        <input type="text" pattern="[0-9]{5,13}" class="form-control" name="carnet_cliente" id="ci_cliente input" maxlength="13" required style="font-size:14px;">
                                    </div>
                                </div>
                                <div class="col-12 col-md-2">
                                    <div class="form-group">
                                        <label for="ci_extcliente" class="bmd-label-floating">Ext.</label>
                                        <input type="text" pattern="[A-Z.]{1,4}" class="form-control" name="extension_cliente" id="ci_ext_cliente input" maxlength="4" required style="font-size:14px;">
                                    </div>
                                </div>
                                <div class="col-12 col-md-3">
                                    <div class="form-group">
                                        <label for="apP_cliente" class="bmd-label-floating">Paterno</label>
                                        <input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{1,50}" class="form-control" name="apellidoP_cliente" id="apP_cliente_input" maxlength="50" style="font-size:14px;">
                                    </div>
                                </div>
                                <div class="col-12 col-md-3">
                                    <div class="form-group">
                                        <label for="apM_cliente" class="bmd-label-floating">Materno</label>
                                        <input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{1,50}" class="form-control" name="apellidoM_cliente" id="apM_cliente_input" maxlength="50" required style="font-size:14px;">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-3">
                                    <div class="form-group">
                                        <label for="nom_cliente" class="bmd-label-floating">Nombre</label>
                                        <input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{1,50}" class="form-control" name="nombre_cliente" id="nom_cliente_input" maxlength="50" required style="font-size:14px;">
                                    </div>
                                </div>
                                <div class="col-12 col-md-2">
                                    <div class="form-group">
                                        <label for="cel_cliente" class="bmd-label-floating">Celular</label>
                                        <input type="text" pattern="[0-9()+]{8,11}" class="form-control" name="celular_cliente" id="cel_cliente_input" maxlength="11" required style="font-size:14px;">
                                    </div>
                                </div>
                                <div class="col-12 col-md-3">
                                    <div class="form-group">
                                        <label for="dir_cliente" class="bmd-label-floating">Dirección</label>
                                        <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\s-]{10,100}" class="form-control" name="direccion_cliente" id="dir_cliente_input" maxlength="100" required style="font-size:14px;">
                                    </div>
                                </div>
                                <div class="col-12 col-md-3">
                                    <div class="form-group">
                                        <label for="empleo_cliente" class="bmd-label-floating">Empleo</label>
                                        <select name="tipoEmpleoSel" class="form-select" required id="tipoEmpleo_cliente_selecc" style="font-size:14px;">
                                            <option value="" selected>Seleccionar</option>
                                            <option value="1">Asalariado</option>
                                            <option value="2">Comerciante</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <label for="foto_cliente" class="bmd-label-floating">Foto</label>
                            <div id="perfil" class="container">
                                <i id="icono" class="fa fa-upload"></i>
                                <img alt="perfil" class="foto">
                                <input type="file" id="subirImg" accept="image/jpg,image/jpeg" name="fotoCli">
                            </div>
                            <button type="button" class="col-1 btn btn-danger botonQuitaFoto" id="quitaFotoCliente" hidden>
                                <i class="fas fa-trash fa-xs"></i></button>
                        </div>
                        <p class="text-center">

                            <button type="submit" class="btn btn-success" style="margin-top: 15px; font-size:15px;"><i class="far fa-save"></i> &nbsp; GUARDAR</button>
                        </p>
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
    <script src="js/registrarCliente.js"></script>


</body>

</html>