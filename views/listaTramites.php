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
    <link rel="stylesheet" href="./css/estiloTramites.css">
    <title>Lista_Trámites</title>
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
                        <a href="nuevoCredito.php" style="font-size:15.5px!important;"><i class="fas fa-plus fa-fw"></i> &nbsp; NUEVO TRÁMITE</a>
                    </li>
                    <li>
                        <a class="active" href="listaTramites.php"style="font-size:15.5px!important;"><i class="fas fa-clipboard-list fa-fw"></i>&nbsp;LISTA TRÁMITES
                        </a>
                    </li>
                    <li>
                        <a href="buscaTramite.php" style="font-size:15.5px!important;"><i class="fas fa-search fa-fw"></i>&nbsp;&nbsp;&nbsp;BUSCAR TRÁMITE
                        </a>
                    </li>
                </ul>
            </div>
            <?php
            include "../scripts/paginadorTramites.php"
            ?>

            <!-- TABLA LISTADO-->
            <div class="container-fluid">
                <div class="table-responsive contenedorTabla">
                    <table class="table table-sm tabla" style="width:100%!important; margin-bottom:10px;">
                        <thead>
                            <tr class="text-center" style="font-size:14px;">
                                <th>#</th>
                                <th>CI</th>
                                <th>Paterno</th>
                                <th>Materno</th>
                                <th>Nombre</th>
                                <th>Banco</th>
                                <th>Monto</th>
                                <th>Inicio</th>
                                <th>Detalle</th>
                                <th>Actualizar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            if ($totalreg > 0) :

                                foreach ($sentencia as $tramite) :

                            ?>
                                    <tr class="text-center" style="font-size:14px;">
                                        <td><?php
                                            echo $cont;
                                            $cont = $cont + 1;
                                            ?></td>
                                        <td><?= $tramite[1] ?></td>
                                        <td><?= $tramite[2] ?></td>
                                        <td><?= $tramite[3] ?></td>
                                        <td><?= $tramite[4] ?></td>
                                        <td><?= $tramite[5] ?></td>
                                        <td><?= $tramite[6] . "$" ?></td>
                                        <td><?= explode("-", $tramite[7])[2] . "-" . explode("-", $tramite[7])[1] . "-" . explode("-", $tramite[7])[0] ?></td>
                                        <td>
                                            <a href="detalleTramite.php?idTramite=<?php echo base64_encode($tramite[0]) ?>" target="_blank" class="btn botonDetalleTramite">
                                                <i class="fas fa-file-pdf fa-xs"></i>
                                            </a>
                                            <a href="detalleTramite.php?idTramite=<?php echo base64_encode($tramite[0]) ?>" download="" style="margin: top 0px;" class="descargaPDF" style="border-radius:25%;"><i class="fas fa-file-pdf fa-xs"></i></a>
                                        </td>

                                        <td>
                                            <a href="actualizarTramite.php?id=<?php echo base64_encode($tramite[0]) ?>" class="btn botonEditaTramite">
                                                <i class="fas fa-sync-alt fa-xs"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php
                                endforeach;
                            else :
                                ?>
                                <tr class="text-center">
                                    <td colspan="12">No hay trámites</td>
                                </tr>
                            <?php endif; ?>
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
                                    <a class="page-link atras" href="listaTramites.php?pagina=<?php echo $pagina - 1 ?>">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                            <?php
                            endif;
                            for ($i = 1; $i <= $numeroPag; $i++) {
                                if ($pagina == $i) {
                                    echo '<li class="page-item numpag active">
                                        <a class="page-link" href="listaTramites.php?pagina=' . $i . '">' . $i . '
                                        </a>
                                      </li>';
                                } else {
                                    echo '<li class="page-item numpag">
                                        <a class="page-link" href="listaTramites.php?pagina=' . $i . '">' . $i . '
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
                                    <a class="page-link adelante" href="listaTramites.php?pagina=<?php echo $pagina + 1 ?>" aria-label="Next">
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
    <script src="js/eliminaTramite.js"></script>
</body>

</html>