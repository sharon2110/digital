<?php

$usuario = $_SESSION['usuario'];
$tusu = $_SESSION['tipo'];
$idusu = $_SESSION['idusuario'];
if ($usuario == null || $usuario == "") {
    header("Location: ../scripts/cerrarSesion.php");
}

?>
<nav class="contenidoNavbar">
    <a href="#" class="mostrarBar">
        <i class="fas fa-bars"></i>
    </a>

    <a href="" type="button" id="configuracionU" data-bs-toggle="modal" data-bs-target="#modalConf">
        <i class="fas fa-user-cog"></i>
    </a>
    <div class="modal fade" id="modalConf" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel" style="font-size:16px!important;">Configuración de usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" class="" autocomplete="off" id="confU" method="POST" enctype="multipart/form-data">
                        <fieldset>
                            <div class="row text-center">
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label for="inputSearch" class="bmd-label-floating" style="font-size:14px!important;">
                                            Nueva contraseña</label>
                                        <input type="password" class="form-control" name="password" id="idpassword" maxlength="10" pattern="[0-9a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{7,12}" style="font-size:14px;">
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="form-group">
                                        <label for="inputSearch" class="bmd-label-floating" style="font-size:14px!important;">
                                            Repita contraseña</label>
                                        <input type="password" class="form-control" name="passwordR" id="idpasswordR" maxlength="10" pattern="[0-9a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{7,12}" style="font-size:14px;">
                                    </div>
                                </div>
                            </div>
                            <div class="row text-center">
                                <div class="col-12 col-md-4">
                                    <label for="foto_cliente" class="bmd-label-floating" style="font-size:14px important;">Foto de perfil</label>
                                    <div id="perfil1" class="container" style="width:100px!important;height:100px!important;">
                                        <i id="icono1" class="fa fa-upload"></i>
                                        <img alt="perfil1" class="foto1">
                                        <input type="file" id="subirImg1" accept="image/jpeg,image/jpg" name="foto_usuario">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary" id="guardaPerfil">Guardar</button>

                        </fieldset>
                    </form>


                </div>
                <div class="modal-footer">
                   
                </div>
            </div>
        </div>
    </div>
    <a href="#" class="botonSalir">
        <i class="fas fa-power-off"></i>
    </a>

</nav>