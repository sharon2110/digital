<?php
session_start();
$usuario = $_SESSION['usuario'];
$tusu = $_SESSION['tipo'];
$idusu = $_SESSION['idusuario'];
$estado = $_SESSION['estado'];
if ($usuario == null || $usuario == "" || $estado != "Activo") {
    header("Location: ../scripts/cerrarSesion.php");
}
if ($tusu !== "Administrador") {
    header("Location: ../views/home.php");
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
    <link rel="stylesheet" href="./css/estiloMovilidades.css">
    <title>Edita_Movilidad</title>
</head>

<body>
    <input type="text" name="id" id="id_movilidad" maxlength="16" value="<?= $proceso ?>" hidden>
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
                        <a href="nuevaMovilidad.php" style="font-size:15.5px!important;"><i class="fas fa-plus fa-fw"></i> &nbsp; REGISTRAR VEHICULO</a>
                    </li>
                    <li>
                        <a href="listaMovilidad.php" style="font-size:15.5px!important;"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE
                            VEHÍCULOS</a>
                    </li>
                    <li>
                        <a href="busquedaMovilidad.php" style="font-size:15.5px!important;"><i class="fas fa-search fa-fw"></i> &nbsp; BUSCAR VEHÍCULO</a>
                    </li>
                </ul>
            </div>

            <!-- TABLA REGISTRO-->
            <div class="container-fluid">
                <form action="" class="formularioRegMovilidad" autocomplete="off" id="actualizaAuto">
                    <fieldset>
                        <legend><i class="fas fa-car-side"></i> &nbsp; Editar Movilidad</legend>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 col-md-3">
                                    <div class="form-group">
                                        <label for="proveedor_auto" class="bmd-label-floating">Proveedor</label>
                                        <select class="form-select" name="selecproveedor" id="idselproveedor" style="font-size:15px;">

                                            <option value="XIAMEN KING LONG UNITED AUTOMOTIVE">XIAMEN KING LONG UNITED
                                                AUTOMOTIVE</option>
                                            <option value="FUJIAN NEW LONGMA AUTOMOTIVE CO.,LT.">FUJIAN NEW LONGMA
                                                AUTOMOTIVE CO.,LT.</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-md-3">
                                    <div class="form-group">
                                        <label for="precio_compra" class="bmd-label-floating">Precio Compra</label>
                                        <input type="text" pattern="[0-9]{5,12}" class="form-control" name="precio_compra" id="idpreciocompra" maxlength="12" required style="font-size:15px;">
                                    </div>
                                </div>
                                <div class="col-12 col-md-3">
                                    <div class="form-group">
                                        <label for="precio_minventa" class="bmd-label-floating">Precio
                                            Mín.Venta</label>
                                        <input type="text" pattern="[0-9]{5,12}" class="form-control" name="precio_minventa" id="idpreciominventa" maxlength="12" required style="font-size:15px;">
                                    </div>
                                </div>
                                <div class="col-12 col-md-3">
                                    <div class="form-group">
                                        <label for="precio_venta" class="bmd-label-floating">Precio de Venta</label>
                                        <input type="text" pattern="[0-9]{5,12}" class="form-control" name="precio_venta" id="idprecioventa" maxlength="12" required style="font-size:15px;">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-3">
                                    <div class="form-group">
                                        <label for="marca_auto" class="bmd-label-floating">Marca</label>
                                        <select class="form-select" aria-label="Default select example" required name="seleccion_marca" id="idselmarca" style="font-size:15px;">
                                            <option value="" selected>Seleccionar</option>
                                            <option value="King Long">King Long</option>
                                            <option value="Foton">Foton</option>
                                            <option value="Keyton">Keyton</option>
                                            <option value="Cherry">Cherry</option>
                                            <option value="Golden Dragon">Golden Dragon</option>
                                            <option value="Higer">Higer</option>
                                            <option value="T-King">T-King</option>
                                            <option value="Soueast">Soueast</option>
                                            <option value="Kama">Kama</option>
                                            <option value="Otro">Otro</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-md-3">
                                    <div class="form-group">
                                        <label for="marca_otro" class="bmd-label-floating">Otro</label>
                                        <input type="text" pattern="[a-zA-Z\s.-]{3,50}" class="form-control" required name="marca_otro" id="idselecmarcaotro" maxlength="50" disabled style="font-size:15px;">
                                    </div>
                                </div>
                                <div class="col-12 col-md-3">
                                    <div class="form-group">
                                        <label for="tipo_auto" class="bmd-label-floating">Tipo</label>
                                        <select class="form-select" aria-label="Default select example" required name="seleccion_tipo" id="idseltipo" style="font-size:15px;">
                                            <option value="" selected>Seleccionar</option>
                                            <option value="Minibus">Minibus</option>
                                            <option value="Vagoneta">Vagoneta</option>
                                            <option value="Camión">Camión</option>
                                            <option value="Otro">Otro</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-md-3">
                                    <div class="form-group">
                                        <label for="tipo_otro" class="bmd-label-floating">Otro</label>
                                        <input type="text" pattern="[a-zA-Z\s.-]{5,50}" class="form-control" required name="tipo_otro" id="idselecttipoOtro" maxlength="50" disabled style="font-size:15px;">
                                    </div>
                                </div>
                                <div class="col-12 col-md-3">
                                    <div class="form-group">
                                        <label for="modelo_movi" class="bmd-label-floating">Modelo</label>
                                        <input type="text" pattern="[a-zA-Z0-9\s.-]{3,50}" class="form-control" required name="modelo_movi" id="idmodelo" maxlength="50" requered style="font-size:15px;">
                                    </div>
                                </div>
                                <div class="col-12 col-md-3">
                                    <div class="form-group">
                                        <label for="num_pasamovi" class="bmd-label-floating">Nro. Pasajeros</label>
                                        <input type="text" pattern="[0-9]{1,3}" class="form-control" name="num_pasamovi" id="idnumpas" maxlength="3" requered style="font-size:15px;">
                                    </div>
                                </div>
                                <div class="col-12 col-md-2">
                                    <div class="form-group">
                                        <label for="cil_movi" class="bmd-label-floating">Cilindrada</label>
                                        <input type="text" pattern="[a-zA-Z0-9\s.]{4,8}" class="form-control" name="cil_movi" id="idcilindrada" maxlength="10" requered style="font-size:15px;">
                                    </div>
                                </div>

                                <div class="col-12 col-md-2" style="margin-top:30px;">
                                    <button class="btn btn-danger" type="button" style="font-size:15px;" data-bs-toggle="modal" data-bs-target="#modalColores">Colores</button>
                                </div>
                                <div class="col-12 col-md-4">
                                    <label for="foto_cliente" class="bmd-label-floating">Foto</label>
                                    <div id="perfil" class="container">
                                        <i id="icono" class="fa fa-upload"></i>
                                        <img alt="perfil" class="foto">
                                        <input type="file" id="subirImg" accept="image/jpeg,image/jpg" name="foto_auto">
                                    </div>
                                    <button type="button" class="col-2 btn btn-danger botonQuitaFotoV" id="quitaFotoV" hidden>
                                        <i class="fas fa-trash fa-xs"></i></button>
                                </div>
                            </div>
                            <div class="modal fade" id="modalColores" tabindex="-1" aria-labelledby="modelTitleId" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Colores del vehículo</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row" style="text-align:center; margin-top:5px;">
                                                <div class="table-responsive contenedorTabla">
                                                    <table class="table table-sm tablaColores">
                                                        <thead>
                                                            <tr class="text-center">
                                                                <th>#</th>
                                                                <th>Color</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr class="text-center">
                                                                <td>1</td>
                                                                <td>Blanco</td>
                                                                <td>
                                                                    <div class="col-2 col-md-2">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" style="border: 1px solid rgb(51, 49, 49); margin-left:0px;" type="checkbox" value="" name="color_uno" id="color_uno_id">
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr class="text-center">
                                                                <td>2</td>
                                                                <td>Plata</td>
                                                                <td>
                                                                    <div class="col-2 col-md-2">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" style="border: 1px solid rgb(51, 49, 49); margin-left:0px;" type="checkbox" value="" name="color_dos" id="color_dos_id">
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr class="text-center">
                                                                <td>3</td>
                                                                <td>Gris</td>
                                                                <td>
                                                                    <div class="col-2 col-md-2">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" style="border: 1px solid rgb(51, 49, 49); margin-left:0px;" type="checkbox" value="" name="color_tres" id="color_tres_id">
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr class="text-center">
                                                                <td>4</td>
                                                                <td>Rojo</td>
                                                                <td>
                                                                    <div class="col-2 col-md-2">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" style="border: 1px solid rgb(51, 49, 49); margin-left:0px;" type="checkbox" value="" name="color_cuatro" id="color_cuatro_id">
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr class="text-center">
                                                                <td>5</td>
                                                                <td>Verde</td>
                                                                <td>
                                                                    <div class="col-2 col-md-2">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" style="border: 1px solid rgb(51, 49, 49); margin-left:0px;" type="checkbox" value="" name="color_cinco" id="color_cinco_id">
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr class="text-center">
                                                                <td>6</td>
                                                                <td>Blanco y Verde</td>
                                                                <td>
                                                                    <div class="col-2 col-md-2">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" style="border: 1px solid rgb(51, 49, 49); margin-left:0px;" type="checkbox" value="" name="color_seis" id="color_seis_id">
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr class="text-center">
                                                                <td>7</td>
                                                                <td>Blanco y Gris</td>
                                                                <td>
                                                                    <div class="col-2 col-md-2">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" style="border: 1px solid rgb(51, 49, 49); margin-left:0px;" type="checkbox" value="" name="color_siete" id="color_siete_id">
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr class="text-center">
                                                                <td>8</td>
                                                                <td>Gris y Plata</td>
                                                                <td>
                                                                    <div class="col-2 col-md-2">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" style="border: 1px solid rgb(51, 49, 49); margin-left:0px;" type="checkbox" value="" name="color_ocho" id="color_ocho_id">
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr class="text-center">
                                                                <td>9</td>
                                                                <td>Azul</td>
                                                                <td>
                                                                    <div class="col-2 col-md-2">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" style="border: 1px solid rgb(51, 49, 49); margin-left:0px;" type="checkbox" value="" name="color_nueve" id="color_nueve_id">
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr class="text-center">
                                                                <td>10</td>
                                                                <td>Naranjado</td>
                                                                <td>
                                                                    <div class="col-2 col-md-2">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" style="border: 1px solid rgb(51, 49, 49); margin-left:0px;" type="checkbox" value="" name="color_diez" id="color_diez_id">
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
                    </fieldset>
                    <p class="text-center" style="margin-top: 25px;">
                        <button type="submit" class="btn btn-success" style="font-size:15px;"><i class="far fa-save"></i> &nbsp;
                            ACTUALIZAR</button>
                    </p>
                </form>
            </div>
        </section>
    </main>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/sweetalert2.min.js"></script>
    <script src="js/home.js"></script>
    <script src="js/actualizaAuto.js"></script>

    <script>
        $('#selecmarca').change(function(e) {
            if (($(this).val()).trim() === "Otro") {
                $('#marca_autoOtro').prop('disabled', false);
            } else {
                $('#marca_autoOtro').prop('disabled', true);
            }
        })
        $('#selectipo').change(function(e) {
            if (($(this).val()).trim() === "Otro") {
                $('#tipo_Otro').prop('disabled', false);
            } else {
                $('#tipo_Otro').prop('disabled', true);
            }
        })
    </script>



</body>

</html>