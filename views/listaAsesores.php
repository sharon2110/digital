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
    <link rel="stylesheet" href="./css/estiloAsesores.css">
    <title>Lista_Asesores</title>
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
                        <a href="nuevoAsesor.php" style="font-size:15.5px!important;"><i class="fas fa-plus fa-fw"></i> &nbsp; REGISTRAR
                            ASESOR</a>
                    </li>
                    <li>
                        <a class="active" href="listaAsesores.php" style="font-size:15.5px!important;"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp;
                            LISTA DE
                            ASESORES</a>
                    </li>
                </ul>
            </div>
            <?php
            include "../scripts/paginadorUsuarios.php"
            ?>
            <!-- TABLA LISTADO-->
            <div class="container-fluid">
                <div class="table-responsive contenedorTabla">
                    <table class="table table-sm tabla" id="tablaResId">
                        <thead>
                            <tr class="text-center" style="font-size:13.5px;">
                                <th>#</th>
                                <th hidden></th>
                                <th>CI</th>
                                <th>Paterno</th>
                                <th>Materno</th>
                                <th>Nombre</th>
                                <th>Celular</th>
                                <th>Usuario</th>
                                <th>Estado</th>
                                <th>Curriculum</th>
                                <th>Croquis</th>
                                <th>Actualizar</th>
                                <th>Reseteo contraseña</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            if ($totalreg > 0) :

                                foreach ($sentencia as $usuario) :


                            ?>
                                    <tr class="text-center" style="font-size:13.5px;">
                                        <td><?php
                                            echo $cont;
                                            $cont = $cont + 1;
                                            ?></td>
                                        <td hidden><?= $usuario[0] ?></td>
                                        <td><?= $usuario[1] ?></td>
                                        <td><?= $usuario[3] ?></td>
                                        <td><?= $usuario[4] ?></td>
                                        <td><?= $usuario[5] ?></td>
                                        <td><?= $usuario[6] ?></td>
                                        <td><?= $usuario[8] ?></td>
                                        <td><?= $usuario[10] ?></td>
                                        <td>
                                            <?php if ($usuario[12] !== NULL) {
                                                echo '<a href="" type="button" class="btn botonVerCurriculum" id="' . $usuario[0] . '"data-bs-toggle="modal" data-bs-target="#modalCu">
                                               <i class="far fa-file-pdf fa-xs"></i></a>
                                                   <a href="' . $usuario[12] . '" download="" style="margin: top 0px;" class="descargaPDF"><i class="far fa-file-pdf"></i></a>';
                                            } else {
                                                echo '<a href="" type="button" class="btn botonVerCurriculum">
                                               <i class="far fa-file-pdf fa-xs"></i></a>
                                                   <a href="" style="margin: top 0px;" class="descargaPDF"><i class="far fa-file-pdf"></i></a>';
                                            } ?>
                                        </td>
                                        <td>
                                            <?php if ($usuario[13] !== NULL) {
                                                echo '<a href="" type="button" class="btn botonVerCroquis" id="' . $usuario[0] . '"data-bs-toggle="modal" data-bs-target="#modalCro" id="des">
                                               <i class="fas fa-street-view fa-xs"></i></a>
                                                   <a href="' . $usuario[13] . '" download="" style="margin: top 0px;" class="descargaCroquis"><i class="fas fa-street-view"></i></a>';
                                            } else {
                                                echo '<a href="" type="button" class="btn botonVerCroquis">
                                               <i class="fas fa-street-view fa-xs"></i></a>
                                                   <a href="" style="margin: top 0px;" class="descargaCroquis"><i class="fas fa-street-view"></i></a>';
                                            } ?>

                                        </td>
                                        <td>
                                            <a href="actualizarAsesor.php?id=<?php echo base64_encode($usuario[0]) ?>" class="btn botonActualiza">
                                                <i class="fas fa-sync-alt fa-xs"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <button class="btn btn-secondary botonCambiarPassword" id="botonReset"><i class="fas fa-key fa-xs"></i></button>
                                        </td>
                                    </tr>
                                <?php
                                endforeach;
                            else :
                                ?>
                                <tr class="text-center">
                                    <td colspan="12">No hay clientes</td>
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
                                    <a class="page-link atras" href="listaAsesores.php?pagina=<?php echo $pagina - 1 ?>">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                            <?php
                            endif;
                            for ($i = 1; $i <= $numeroPag; $i++) {
                                if ($pagina == $i) {
                                    echo '<li class="page-item numpag active">
                                        <a class="page-link" href="listaAsesores.php?pagina=' . $i . '">' . $i . '
                                        </a>
                                      </li>';
                                } else {
                                    echo '<li class="page-item numpag">
                                        <a class="page-link" href="listaAsesores.php?pagina=' . $i . '">' . $i . '
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
                                    <a class="page-link adelante" href="listaAsesores.php?pagina=<?php echo $pagina + 1 ?>" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </nav>
                <?php endif; ?>
            </div>
        </section>

        <div class="modal fade" id="modalCu" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Curriculum Usuario</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <iframe src="" style="width:100%; height:100vh; " id="frameCurriculum"></iframe>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalCro" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Croquis Usuario</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <img src="" style="width:100%; height:100%; border-radius:0; margin-top:0; padding:0;" id="frameCro"></img>
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
    <script src="js/verCurriculum.js"></script>
    <script src="js/resetearPassword.js"></script>

</body>

</html>