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
    <title>Buscar_Venta</title>
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
                        <a href="nuevaVenta.php" style="font-size:15.5px!important;"><i class="fas fa-plus fa-fw"></i> &nbsp; REGISTRAR VENTA</a>
                    </li>
                    <li>
                        <a href="listaVenta.php" style="font-size:15.5px!important;"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE VENTAS</a>
                    </li>
                    <li>
                        <a class="active" href="buscaVenta.php" style="font-size:15.5px!important;"><i class="fas fa-search fa-fw"></i>&nbsp; BUSCA
                            VENTA</a>
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
                                        CI</label>
                                    <input type="text" class="form-control" pattern="[0-9]{5,10}" id="inputCi" name="busquedaCarnet" maxlength="10" style="font-size:15px;">
                                </div>
                            </div>

                            <div class="col-12 col-md-4">
                                <div class="form-group">
                                    <label for="inputSearch" class="bmd-label-floating labelBusqueda">
                                        Nombre</label>
                                    <input type="text" class="form-control" id="inputNom" name="busquedaNombre" style="font-size:15px;">
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <p class="text-center" style="margin-top: 30px;">
                                    <button type="submit" class="btn botonBuscar" id="idbusca" name="buscaVenta"><i class="fas fa-search"></i> BUSCAR</button>
                                </p>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!-- TABLA RESULTADO-->
            <div class="container-fluid">
                <div class="table-responsive contenedorTablaBus" id="idtablabusV" style="display:none;">
                    <table class="table table-sm tabla " id="idTab">
                        <thead>
                            <tr class="text-center" style="font-size:14px;">
                                <th>#</th>
                                <th>CI</th>
                                <th>Paterno</th>
                                <th>Materno</th>
                                <th>Nombre</th>
                                <th>Fecha</th>
                                <th>Cantidad</th>
                                <th>Monto Total</th>
                                <th>Reporte</th>
                                <?php if ($tusu == "Administrador") : ?>
                                    <th>Editar</th>
                                <?php endif ?>
                            </tr>
                        </thead>
                        <tbody>
                           
                        <?php

                        if (isset($_POST['buscaVenta'])) :

                            echo "<script>
                            document.getElementById('idtablabusV').style.display = 'block';
                            </script>";

                            $ci = trim($_POST['busquedaCarnet']);
                            $nom = trim($_POST['busquedaNombre']);
                            $nom = strtolower($nom);
                            $sentencia;
                            $totalreg;
                            $usuario = $_SESSION['usuario'];
                            $tusu = $_SESSION['tipo'];
                            $idusu = $_SESSION['idusuario'];
                            $estado = $_SESSION['estado'];
                            if ($usuario == null || $usuario == "" || $estado != "Activo") {
                                header("Location: ../scripts/cerrarSesion.php");
                            }
                            include "../scripts/conexion.php";
                            if ($ci === "") {
                                if ($nom === "") {
                                    $totalreg = 0;
                                } else {
                                    if ($tusu === "Administrador") {
                                        $sql = "SELECT
                            v.idventa,c.cicliente,c.paterno,c.materno,c.nombre,v.fecha,count(*),sum(dv.precio) from
                            detalle_venta dv
                            inner join venta v
                            on dv.venta = v.idventa
                            inner join cliente c
                            on v.cliente = c.idcliente
                            where lower(c.paterno) like ? OR lower(c.materno) like ? OR lower(c.nombre) like ?
                            group by dv.venta,v.idventa,c.cicliente,c.paterno,c.materno,c.nombre
                            order by v.idventa ";
                                        $sentencia = $con->prepare($sql);
                                        $sentencia->bindValue(1, "%$nom%", PDO::PARAM_STR);
                                        $sentencia->bindValue(2, "%$nom%", PDO::PARAM_STR);
                                        $sentencia->bindValue(3, "%$nom%", PDO::PARAM_STR);
                                        $sentencia->execute();
                                        $resultado = $sentencia->fetchAll();
                                        $totalreg = $sentencia->rowCount();
                                    } else {
                                        $sql = "SELECT
                            v.idventa,c.cicliente,c.paterno,c.materno,c.nombre,v.fecha,count(*),sum(dv.precio) from
                            detalle_venta dv
                            inner join venta v
                            on dv.venta = v.idventa
                            inner join cliente c
                            on v.cliente = c.idcliente
                            where c.usuario = ? and (lower(c.paterno) like ? OR lower(c.materno) like ? OR
                            lower(c.nombre) like ?)
                            group by dv.venta,v.idventa,c.cicliente,c.paterno,c.materno,c.nombre
                            order by v.idventa ";
                                        $sentencia = $con->prepare($sql);
                                        $sentencia->bindValue(1, $idusu, PDO::PARAM_STR);
                                        $sentencia->bindValue(2, "%$nom%", PDO::PARAM_STR);
                                        $sentencia->bindValue(3, "%$nom%", PDO::PARAM_STR);
                                        $sentencia->bindValue(4, "%$nom%", PDO::PARAM_STR);
                                        $sentencia->execute();
                                        $resultado = $sentencia->fetchAll();
                                        $totalreg = $sentencia->rowCount();
                                    }
                                }
                            } else {

                                if ($tusu === "Administrador") {

                                    if ($nom === "") {
                                        /*CI SIN NOM*/
                                        $sql = "SELECT
                            v.idventa,c.cicliente,c.paterno,c.materno,c.nombre,v.fecha,count(*),sum(dv.precio) from
                            detalle_venta dv
                            inner join venta v
                            on dv.venta = v.idventa
                            inner join cliente c
                            on v.cliente = c.idcliente
                            where c.cicliente = ?
                            group by dv.venta,v.idventa,c.cicliente,c.paterno,c.materno,c.nombre
                            order by v.idventa ";
                                        $sentencia = $con->prepare($sql);
                                        $sentencia->bindValue(1, $ci, PDO::PARAM_STR);
                                        $sentencia->execute();
                                        $resultado = $sentencia->fetchAll();
                                        $totalreg = $sentencia->rowCount();
                                    } else {
                                        $sql = "SELECT
                            v.idventa,c.cicliente,c.paterno,c.materno,c.nombre,v.fecha,count(*),sum(dv.precio) from
                            detalle_venta dv
                            inner join venta v
                            on dv.venta = v.idventa
                            inner join cliente c
                            on v.cliente = c.idcliente
                            where c.cicliente=? or lower(c.paterno) like ? OR lower(c.materno) like ? OR lower(c.nombre)
                            like ?
                            group by dv.venta,v.idventa,c.cicliente,c.paterno,c.materno,c.nombre
                            order by v.idventa ";
                                        $sentencia = $con->prepare($sql);
                                        $sentencia->bindValue(1, $idusu, PDO::PARAM_STR);
                                        $sentencia->bindValue(2, "%$nom%", PDO::PARAM_STR);
                                        $sentencia->bindValue(3, "%$nom%", PDO::PARAM_STR);
                                        $sentencia->bindValue(4, "%$nom%", PDO::PARAM_STR);
                                        $sentencia->execute();
                                        $resultado = $sentencia->fetchAll();
                                        $totalreg = $sentencia->rowCount();
                                    }
                                } else {
                                    if ($nom === "") {
                                        $sql = "SELECT
                            v.idventa,c.cicliente,c.paterno,c.materno,c.nombre,v.fecha,count(*),sum(dv.precio) from
                            detalle_venta dv
                            inner join venta v
                            on dv.venta = v.idventa
                            inner join cliente c
                            on v.cliente = c.idcliente
                            where c.cicliente = ? and c.usuario = ?
                            group by dv.venta,v.idventa,c.cicliente,c.paterno,c.materno,c.nombre
                            order by v.idventa ";
                                        $sentencia = $con->prepare($sql);
                                        $sentencia->bindValue(1, $ci, PDO::PARAM_STR);
                                        $sentencia->bindValue(2, $idusu, PDO::PARAM_STR);
                                        $sentencia->execute();
                                        $resultado = $sentencia->fetchAll();
                                        $totalreg = $sentencia->rowCount();
                                    } else {
                                        $sql = "SELECT
                            v.idventa,c.cicliente,c.paterno,c.materno,c.nombre,v.fecha,count(*),sum(dv.precio) from
                            detalle_venta dv
                            inner join venta v
                            on dv.venta = v.idventa
                            inner join cliente c
                            on v.cliente = c.idcliente
                            where c.usuario=? and (c.cicliente=? or lower(c.paterno) like ? OR lower(c.materno) like ?
                            OR lower(c.nombre) like ?)
                            group by dv.venta,v.idventa,c.cicliente,c.paterno,c.materno,c.nombre
                            order by v.idventa ";
                                        $sentencia = $con->prepare($sql);
                                        $sentencia->bindValue(1, $idusu, PDO::PARAM_STR);
                                        $sentencia->bindValue(2, "%$nom%", PDO::PARAM_STR);
                                        $sentencia->bindValue(3, "%$nom%", PDO::PARAM_STR);
                                        $sentencia->bindValue(4, "%$nom%", PDO::PARAM_STR);
                                        $sentencia->execute();
                                        $resultado = $sentencia->fetchAll();
                                        $totalreg = $sentencia->rowCount();
                                    }
                                }
                            }
                            $cont = 1;
                            if ($totalreg > 0) :
                                foreach ($resultado as $venta) :

                        ?>

                                    <tr class="text-center" style="font-size:14px;">
                                        <td><?= $cont++ ?></td>
                                        <td><?= $venta[1] ?></td>
                                        <td><?= $venta[2] ?></td>
                                        <td><?= $venta[3] ?></td>
                                        <td><?= $venta[4] ?></td>
                                        <td><?= explode("-", $venta[5])[2] . "-" . explode("-", $venta[5])[1] . "-" . explode("-", $venta[5])[0] ?>
                                        </td>
                                        <td><?= $venta[6] ?></td>
                                        <td><?= $venta[7] ?></td>
                                        <td>
                                            <a href="reporteVenta.php?idVenta=<?php echo base64_encode($venta[0]) ?>" target="_blank" class="btn botonReporteVenta">
                                                <i class="fas fa-file-pdf"></i>
                                            </a>

                                            <a href="reporteVenta.php?idVenta=<?php echo base64_encode($venta[0]) ?>" download="" style="margin: top 0px;" class="descargaPDF" style="border-radius:25%;"><i class="fas fa-file-pdf"></i></a>
                                        </td>
                                        <?php if ($tusu == "Administrador") : ?>
                                            <td>
                                                <a href="editaVenta.php?id=<?php echo base64_encode($venta[0]) ?>" class="btn botonEditaVenta">
                                                    <i class="fas fa-edit fa-xs"></i>
                                                </a>
                                            </td>
                                        <?php endif ?>


                                    </tr>
                                <?php
                                endforeach;
                            else :
                                ?>
                                <tr class="text-center">
                                    <td colspan="12">No hay coincidencias</td>
                                </tr>
                                <script>
                                    setTimeout(function() {
                                        $("#idtablabusV").fadeOut(1500);
                                    }, 3000);
                                </script>
                            <?php endif; ?>
                        <?php endif; ?>

                        </tbody>
                    </table>
                </div>
            </div>




        </section>
    </main>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/sweetalert2.min.js"></script>
    <script src="js/home.js"></script>
    <script src="js/eliminaVenta.js"></script>

</body>

</html>