<?php
session_start();
$usuario = $_SESSION['usuario'];
$tusu = $_SESSION['tipo'];
$idusu = $_SESSION['idusuario'];
$estado = $_SESSION['estado'];
if ($usuario == null || $usuario == "" || $estado != "Activo") {
    header("Location: ../scripts/cerrarSesion.php");
}
$sumaTotal = 0;
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
    <title>Lista_Ventas</title>
</head>

<body>
    <main class="contenedorPrincipal">
        <section class="contenedorMenu">
            <?php include "./inc/navlateral.php" ?>
        </section>


        <section class="navbar">
            <?php include "./inc/navbar.php" ?>

            <!-- OPCIONES RAPIDAS-->
            <div class="container-fluid">
                <ul class="opciones">
                    <li>
                        <a href="nuevaVenta.php" style="font-size:15.5px!important;"><i class="fas fa-plus fa-fw"></i> &nbsp; REGISTRAR VENTA</a>
                    </li>
                    <li>
                        <a class="active" href="listaVenta.php" style="font-size:15.5px!important;"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA
                            DE VENTAS</a>
                    </li>
                    <li>
                        <a href="buscaVenta.php" style="font-size:15.5px!important;"><i class="fas fa-search fa-fw"></i>&nbsp; BUSCA VENTA</a>
                    </li>
                </ul>
            </div>
            <div class="row fechasReporte" style="margin-bottom:20px; width:40%;">
                <button class="btn fa-sm" data-bs-toggle="modal" data-bs-target="#modalFechas" type="button" style="width:50%; margin-bottom:10px; background-color:rgb(56, 48, 77); color:white; font-size:14px;">Reporte por fecha</button>
            </div>
            <div class="modal fade" id="modalFechas" tabindex="-1" aria-labelledby="modelTitleId" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" style="text-align:center;">
                            <div class="col-12 col-mb-6" style="display: inline !important;">
                                <div class="col-md-4 fechaI">
                                    <b>De:</b>
                                    <input type="date" name="fecha1" style="display: inline-block;" min="2022-04-01" id="inputFecha1">
                                </div>
                            </div>
                            <div class="col-12 col-mb-6" style="display: inline !important; margin-left:5px;">
                                <div class="col-md-4 fechaF">
                                    <b>Al:</b>
                                    <input type="date" name="fecha2" id="inputFecha2" min="2022-04-01" style="display: inline-block;">
                                </div>
                            </div>
                            <div class="col-12 col-md-4" style="margin:20px auto; width:40%;">
                                <button type="button" class="btn btn-success" style="margin:auto; width:100%; padding:0;font-size:15px;" download="" name="btnReporteFechas" id="idbtnReporteFechas">Generar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            include "../scripts/paginadorVentas.php"
            ?>

            <!-- TABLA LISTADO-->
            <div class="container-fluid">
                <div class="table-responsive contenedorTabla">
                    <table class="table table-sm tabla">
                        <thead>
                            <tr class="text-center" style="font-size:14px;">
                                <th>#</th>
                                <th>CI</th>
                                <th>Paterno</th>
                                <th>Materno</th>
                                <th>Nombre</th>
                                <th>Fecha</th>
                                <th>Cantidad</th>
                                <th>Monto</th>
                                <th>Reporte</th>
                                <?php if ($tusu == "Administrador") : ?>
                                    <th>Editar</th>
                                <?php endif ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            if ($totalreg > 0) :

                                foreach ($sentencia as $venta) :
                                    $sumaTotal = $sumaTotal + $venta[7];
                            ?>
                                    <tr class="text-center" style="font-size:14px;">
                                        <td><?php
                                            echo $cont;
                                            $cont = $cont + 1;
                                            ?></td>
                                        <td><?= $venta[1] ?></td>
                                        <td><?= $venta[2] ?></td>
                                        <td><?= $venta[3] ?></td>
                                        <td><?= $venta[4] ?></td>
                                        <td><?= explode("-", $venta[5])[2] . "-" . explode("-", $venta[5])[1] . "-" . explode("-", $venta[5])[0] ?>
                                        </td>
                                        <td><?= $venta[6] ?></td>
                                        <td><?= $venta[7] . "" . " $" ?></td>
                                        <td>
                                            <a href="reporteVenta.php?idVenta=<?php echo base64_encode($venta[0]) ?>" target="_blank" class="btn botonReporteVenta">
                                                <i class="fas fa-file-pdf fa-xs"></i>
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
                                    <td colspan="12">No hay ventas</td>
                                </tr>


                            <?php endif; ?>
                            <?php if ($pagina >= $numeroPag) {
                                echo '<tr class="text-center" style="   background-image: linear-gradient(230deg, #cce6ee 0, #cde6f0 7.14%, #cfe5f1 14.29%, #d0e5f2 21.43%, #d2e4f3 28.57%, #d5e3f4 35.71%, #d7e3f4 42.86%, #dae2f4 50%, #dde1f4 57.14%, #e0e0f3 64.29%, #e3e0f2 71.43%, #e5dff1 78.57%, #e8def0 85.71%, #ebdeee 92.86%, #edddec 100%);color: rgb(0, 0, 0)  !important;">
                                        <td style="padding:5px;" colspan="5">
                                            <b> Monto total de ventas:</b>
                                        </td>
                                    <td style="padding:5px;" colspan="5">
                                    <b>' ?>
                                <?php
                                echo $sumaTotal . " $";
                                ?>
                            <?php echo '</b>
                                    </td>
                                    </tr>';
                            } ?>

                        </tbody>
                    </table>


                </div>
                <?php if ($totalreg > 0) : ?>

                    <nav aria-label="Page navigation example" class="paginador">
                        <ul class="pagination justify-content-center ">
                            <?php if ($pagina == 1) : ?>
                                <li class="page-item disabled">
                                    <a class="page-link atras" href="">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>

                            <?php else : ?>
                                <li class="page-item">
                                    <a class="page-link atras" href="listaVenta.php?pagina=<?php echo $pagina - 1 ?>">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                            <?php
                            endif;
                            for ($i = 1; $i <= $numeroPag; $i++) {
                                if ($pagina == $i) {
                                    echo '<li class="page-item numpag active">
                                        <a class="page-link" href="listaVenta.php?pagina=' . $i . '">' . $i . '
                                        </a>
                                      </li>';
                                } else {
                                    echo '<li class="page-item numpag">
                                        <a class="page-link" href="listaVenta.php?pagina=' . $i . '">' . $i . '
                                        </a>
                                      </li>';
                                }
                            }

                            if ($pagina == $numeroPag) :
                            ?>
                                <li class="page-item disabled">
                                    <a class="page-link adelante" href="#" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            <?php else : ?>
                                <li class="page-item">
                                    <a class="page-link adelante" href="listaVenta.php?pagina=<?php echo $pagina + 1 ?>" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            <?php endif; ?>

                        </ul>
                    </nav>

                <?php endif; ?>

            </div>
        </section>
    </main>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/sweetalert2.min.js"></script>
    <script src="js/home.js"></script>
    <script>
        let reporte = document.getElementById("idbtnReporteFechas");
        reporte.onclick = function() {
            var f1 = document.getElementById("inputFecha1").value;
            var f2 = document.getElementById("inputFecha2").value;
            var usuario = <?php echo $idusu ?>;
            if (f1 !== "" && f2 !== "") {
                if (f2 >= f1) {
                    if (screen.width <= 700) {
                        window.open("reporteVentasFecha.php?datos=" + f1 + "/" + f2 + "/" + usuario, '_blank', );
                    } else {
                        window.open("reporteVentasFecha.php?datos=" + f1 + "/" + f2 + "/" + usuario, '_blank');
                    }


                } else {
                    console.log("Intervalo erroneo");
                }
            } else {
                console.log("Introduzca un intervalo");
            }

        }
    </script>
    <script src="js/eliminaVenta.js"></script>
</body>

</html>