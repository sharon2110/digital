<?php
session_start();
$usuario = $_SESSION['usuario'];
$tusu = $_SESSION['tipo'];
$idusu = $_SESSION['idusuario'];
$estado = $_SESSION['estado'];
if($usuario==null || $usuario=="" || $estado!="Activo"){
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
    <link rel="stylesheet" href="./css/estiloMovilidades.css">
    <title>Buscar_Movilidad</title>
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
                <?php if($tusu=="Administrador"):?>
                    <li>
                        <a href="nuevaMovilidad.php" style="font-size:15.5px!important;"><i class="fas fa-plus fa-fw"></i> &nbsp; REGISTRAR VEHÍCULO</a>
                    </li>
                <?php endif?>
                    <li>
                        <a href="listaMovilidad.php" style="font-size:15.5px!important;"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE
                            VEHÍCULOS</a>
                    </li>
                    <li>
                        <a class="active" href="busquedaMovilidad.php" style="font-size:15.5px!important;"><i class="fas fa-search fa-fw"></i> &nbsp; BUSCAR
                        VEHÍCULO</a>
                    </li>
                </ul>
            </div>

            <!-- Busqueda-->
            <div class="container-fluid">
                <form class="form-neon busqueda" action="" autocomplete="off" method="POST">
                    <div class="container-fluid">
                        <div class="row justify-content-md-center">
                            <div class="col-12 col-md-4">
                                <div class="form-group">
                                    <label for="inputSearch" class="bmd-label-floating labelBusqueda">
                                        Marca</label>
                                    <input type="text" class="form-control" name="marca" id="buscaMarca" maxlength="30" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{1,30}" style="font-size:14px;">
                                </div>
                            </div>

                            <div class="col-12 col-md-4">
                                <div class="form-group">
                                    <label for="inputSearch" class="bmd-label-floating labelBusqueda">
                                        Tipo</label>
                                    <input type="text" class="form-control" name="tipo" id="buscaTipo" maxlength="30" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{1,30}" style="font-size:14px;">
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <p class="text-center" style="margin-top: 30px;">
                                    <button type="submit" class="btn botonBuscar" name="botonBuscar"><i
                                            class="fas fa-search"></i> &nbsp; BUSCAR</button>
                                </p>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- TABLA RESULTADO-->
            <div class="container-fluid">
                <div class="table-responsive contenedorTabla tablaresbus" id="idtablabus">
                    <table class="table table-sm tabla">
                        <thead>
                            <tr class="text-center" style="font-size:14px;">
                                <th>#</th>
                                <th>Marca</th>
                                <th>Tipo</th>
                                <th>Modelo</th>
                                <?php if($tusu=="Administrador"):?>
                                <th>Precio Compra</th>
                                <?php endif?>
                                <th>Precio Min.Venta</th>
                                <th>Precio Venta</th>
                                <th>Detalles</th>
                                <?php if($tusu=="Administrador"):?>
                                <th>Editar</th>
                                <th>Eliminar</th>
                                <?php endif?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($_POST['botonBuscar'])) :
                                echo "<script>
                                document.getElementById('idtablabus').style.display='block';
                                </script>";
                                $marca = trim($_POST['marca']);
                                $tipo = trim($_POST['tipo']);
                                $marca = strtolower($marca);
                                $tipo = strtolower($tipo);
                                $sentencia;
                                $totalreg;
                                include "../scripts/conexion.php";
                                if ($marca === "") {
                                    if ($tipo === "") {
                                        /*TODOS LOS CAMPOS VACIOS */
                                        $totalreg = 0;
                                    } else {
                                        /*TIPO */
                                        if(!is_numeric($tipo)){
                                            $sql = "SELECT v.idvehiculo,v.marca, v.tipo,v.modelo, dv.precioproveedor,dv.preciominimo,dv.precioventa from vehiculo v INNER JOIN detalle_vehiculo dv ON v.idvehiculo = dv.vehiculo WHERE lower(v.tipo) like ?";
                                            $sentencia = $con->prepare($sql);
                                            $sentencia->bindValue(1,"%$tipo%", PDO::PARAM_STR);
                                            $sentencia->execute();
                                            $resultado = $sentencia->fetchAll();
                                            $totalreg = $sentencia->rowCount();
                                        }
                                    }
                                } else {

                                    if ($tipo === "") {
                                        /*MARCA SIN TIPO*/
                                        if(!is_numeric($marca)){
                                            $sql = "SELECT v.idvehiculo,v.marca, v.tipo,v.modelo, dv.precioproveedor,dv.preciominimo,dv.precioventa from vehiculo v INNER JOIN detalle_vehiculo dv ON v.idvehiculo = dv.vehiculo WHERE lower(v.marca) like ?";
                                            $sentencia = $con->prepare($sql);
                                            $sentencia->bindValue(1, "%$marca%", PDO::PARAM_STR);
                                            $sentencia->execute();
                                            $resultado = $sentencia->fetchAll();
                                            $totalreg = $sentencia->rowCount();
                                        }
                                    } else {
                                        /*MARCA Y TIPO*/
                                        if(!is_numeric($marca) && !is_numeric($tipo)){
                                            $sql = "SELECT v.idvehiculo,v.marca, v.tipo,v.modelo, dv.precioproveedor,dv.preciominimo,dv.precioventa from vehiculo v INNER JOIN detalle_vehiculo dv ON v.idvehiculo = dv.vehiculo WHERE lower(v.marca) like ? OR lower(v.tipo) like ?";
                                            $sentencia = $con->prepare($sql);
                                            $sentencia->bindValue(1, "%$marca%", PDO::PARAM_STR);
                                            $sentencia->bindValue(2, "%$tipo%", PDO::PARAM_STR);
                                            $sentencia->execute();
                                            $resultado = $sentencia->fetchAll();
                                            $totalreg = $sentencia->rowCount();
                                        }
                                    }
                                }
                                $cont = 1;
                                if ($totalreg > 0) :
                                    foreach ($resultado as $movilidad) :

                            ?>
                            <tr class="text-center" style="font-size:14px;">
                                <td><?= $cont++ ?></td>
                                <td><?= $movilidad[1] ?></td>
                                <td><?= $movilidad[2] ?></td>
                                <td><?= $movilidad[3] ?></td>
                                <?php if($tusu=="Administrador"):?>
                                <td><?= $movilidad[4] ?></td>
                                <?php endif?>
                                <td><?= $movilidad[5] ?></td>
                                <td><?= $movilidad[6] ?></td>
                                <td>
                                    <a type="button" class="btn botonDetalleMovilidad" idv="<?php echo $movilidad[0] ?>"
                                        data-bs-toggle="modal" data-bs-target="#modelId" id="infomovi">
                                        <i class="fas fa-info fa-xs"></i>
                                    </a>
                                </td>
                                <?php if($tusu=="Administrador"):?>
                                <td>
                                    <a href="editaMovilidad.php?id=<?= $movilidad[0] ?>"
                                        class="btn botonEditarMovilidad">
                                        <i class="fas fa-edit fa-xs"></i>
                                    </a>
                                </td>
                                <td>

                                    <a href="" class="btn botonEliminaMovilidad" idv="<?php echo $movilidad[0] ?>">
                                        <i class="far fa-trash-alt fa-xs"></i>
                                    </a>
                                </td>
                                <?php endif?>
                            </tr>
                            <?php
                                    endforeach;
                                else :
                                    ?>
                            <tr class="text-center" style="font-size:14px;">
                                <td colspan="12">No hay coincidencias</td>
                            </tr>
                            <script>
                                    setTimeout(function() {
                                        $("#idtablabus").fadeOut(1500);
                                    }, 3000);
                                </script>


                            <?php endif; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        <div class="modal fade" id="modelId" tabindex="-1" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 col-md-5" style="margin-top:20px; margin:auto;     text-align: center;">
                                <img src="" style="width:150px; height:100px; margin:auto;border-radius:10%; padding:0;" id="imgFotoVehiculo"></img>
                            </div>
                        </div>
                        <div class="row" style="text-align: center;">
                            <div class="col-12 col-md-3">
                                <label for="numpas_auto" class="bmd-label-floating" style="color:rgb(0,0,0);"><b>Nro.
                                        Pasajeros:</b></label>
                                <label for="numpas_auto" class="bmd-label-floating" id="labelNro" style="color:rgb(0,0,0);"></label>
                            </div>
                            <div class="col-12 col-md-3">
                                <label for="cil_auto" class="bmd-label-floating" style="color:rgb(0,0,0);"><b>Cilindrada:</b></label>
                                <label for="cil_auto" class="bmd-label-floating" id="labelCil" style="color:rgb(0,0,0);"></label>
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="colores_auto" class="bmd-label-floating" style="color:rgb(0,0,0);"><b>Colores:</b></label><br>
                                <label for="colores_auto" class="bmd-label-floating" id="labelColor" style="color:rgb(0,0,0);"></label>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/sweetalert2.min.js"></script>
    <script src="js/home.js"></script>
    <script src="js/verInfoMovi.js"></script>
    <script src="js/eliminaMovi.js"></script>
</body>

</html>