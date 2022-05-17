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
    <link rel="stylesheet" href="./css/estiloClientes.css">
    <title>Actualizar_Cliente</title>
</head>

<body>
    <input type="text" name="id" id="id_cliente" maxlength="16" value="<?php echo base64_decode($proceso) ?>" hidden>
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
                        <a href="nuevoCliente.php" style="font-size:15.5px!important;"><i class="fas fa-plus fa-fw"></i> &nbsp; REGISTRAR CLIENTE</a>
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
                <form action="" class="formulario" autocomplete="off" id="actualizar_cliente" method="POST" enctype="multipart/form-data">
                    <fieldset>
                        <legend><i class="fas fa-user-edit"></i> &nbsp; Actualizar Cliente</legend>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 col-md-3">
                                    <div class="form-group">
                                        <label for="ci_cliente" class="bmd-label-floating" style="font-size:14px;  color: rgb(136, 139, 143);">CI</label>
                                        <input type="text" pattern="[0-9]{5,15}" class="form-control" name="carnet_cliente" id="ci_cliente" maxlength="15" style="font-size:14px;">
                                    </div>
                                </div>
                                <div class="col-12 col-md-2">
                                    <div class="form-group">
                                        <label for="ci_extcliente" class="bmd-label-floating" style="font-size:14px;  color: rgb(136, 139, 143);">Ext.</label>
                                        <input type="text" pattern="[A-Z.]{1,4}" class="form-control" name="extension_cliente" id="ci_cliente_ext" maxlength="4" style="font-size:14px;">
                                    </div>
                                </div>
                                <div class="col-12 col-md-3">
                                    <div class="form-group">
                                        <label for="apP_cliente" class="bmd-label-floating" style="font-size:14px;  color: rgb(136, 139, 143);">Paterno</label>
                                        <input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{1,50}" class="form-control" name="apellidoP_cliente" id="apP_cliente" maxlength="50" style="font-size:14px;">
                                    </div>
                                </div>
                                <div class="col-12 col-md-3">
                                    <div class="form-group">
                                        <label for="apM_cliente" class="bmd-label-floating" style="font-size:14px;  color: rgb(136, 139, 143);">Materno</label>
                                        <input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{1,50}" class="form-control" name="apellidoM_cliente" id="apM_cliente" maxlength="50" style="font-size:14px;">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-3">
                                    <div class="form-group">
                                        <label for="nom_cliente" class="bmd-label-floating" style="font-size:14px;  color: rgb(136, 139, 143);">Nombre</label>
                                        <input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{1,50}" class="form-control" name="nombre_cliente" id="nom_cliente" maxlength="50" required style="font-size:14px;">
                                    </div>
                                </div>
                                <div class="col-12 col-md-2">
                                    <div class="form-group">
                                        <label for="cel_cliente" class="bmd-label-floating" style="font-size:14px;  color: rgb(136, 139, 143);">Celular</label>
                                        <input type="text" pattern="[0-9()+\s]{8,15}" class="form-control" name="celular_cliente" id="cel_cliente" maxlength="15" style="font-size:14px;">
                                    </div>
                                </div>
                                <div class="col-12 col-md-3">
                                    <div class="form-group">
                                        <label for="dir_cliente" class="bmd-label-floating" style="font-size:14px;  color: rgb(136, 139, 143);">Dirección</label>
                                        <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\s-]{10,100}" class="form-control" name="direccion_cliente" id="dir_cliente" maxlength="100" required style="font-size:14px;">
                                    </div>
                                </div>
                                <div class="col-12 col-md-3">
                                    <div class="form-group">
                                        <label for="dir_cliente" class="bmd-label-floating" style="font-size:14px;  color: rgb(136, 139, 143);">Empleo</label>
                                        <select name="tipoEmpleoSel" class="form-select" id="empleo" style="font-size:14px;">
                                            <option value="1">Asalariado</option>
                                            <option value="2">Comerciante</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                            </div>
                            <?php if($tusu=="Administrador"): echo '
                            <div class="row">
                                <div class="col-12 col-md-4">
                                <label for="asesor_cliente" class="bmd-label-floating" style="font-size:13px;  color: rgb(136, 139, 143);">Asesor</label>
                                <select name="asesorCliente" class="form-select" id="asesor" style="font-size:14px;">';?>
                                    <?php
                                    include "../scripts/conexion.php";
                                    $sentencia = $con->prepare("SELECT u.idusuario,u.nombre,u.paterno,u.materno from usuario u order by u.paterno");
                                    $sentencia->execute(); # Pasar en el mismo orden de los ?
                                    $resultado = $sentencia->fetchAll();
                                    foreach ($resultado as $asesor) : ?>
                                        <option value="<?php echo $asesor["idusuario"]; ?>"><?php echo $asesor["nombre"]." ".$asesor["paterno"]." ".$asesor["materno"]; ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php echo '</select>
                                </div>
                            </div>'; endif?>
                            <label for="foto_cliente" class="bmd-label-floating" style="font-size:14px;  color: rgb(136, 139, 143);">Foto</label>
                            <div id="perfil" class="container">
                                <i id="icono" class="fa fa-upload"></i>
                                <img alt="perfil" class="foto" name="imagenMuestra">
                                <input type="file" id="subirImg" accept="image/jpg,image/jpeg" name="fotoCli">
                            </div>
                            <button type="button" class="col-6 col-md-1 btn btn-danger botonQuitaFoto" id="quitaFotoCliente" hidden>
                                <i class="fas fa-trash fa-xs"></i></button>
                            <p class="text-center" style="margin-top: 8px;">
                                <button type="submit" class="btn btn-success" id="actualizar" style="font-size:15px;"><i class="fas fa-user-edit" ></i> &nbsp; ACTUALIZAR</button>
                            </p>
                        </div>
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
    <script src="js/actualizarCliente.js"></script>


</body>

</html>