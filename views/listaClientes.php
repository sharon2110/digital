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
    <link rel="stylesheet" href="./css/estiloClientes.css">
    <title>Lista_Clientes</title>
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
                        <a href="nuevoCliente.php" style="font-size:15.5px!important;"><i class="fas fa-plus fa-fw"></i> &nbsp; REGISTRAR
                            CLIENTE</a>
                    </li>
                    <li>
                        <a class="active" href="listaClientes.php" style="font-size:15.5px!important;"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp;
                            LISTA DE
                            CLIENTES</a>
                    </li>
                    <li>
                        <a href="buscarCliente.php" style="font-size:15.5px!important;"><i class="fas fa-search fa-fw"></i> &nbsp; BUSCAR CLIENTE</a>
                    </li>
                </ul>
            </div>

            <?php
            include "../scripts/paginadorClientes.php"
            ?>
            <!-- TABLA LISTADO-->
            <div class="container-fluid">
                <div class="table-responsive contenedorTabla">
                    <table class="table table-sm tabla">
                        <thead>
                            <tr class="text-center" style="font-size:13.5px;">
                                <th>#</th>
                                <th>CI</th>
                                <th>Paterno</th>
                                <th>Materno</th>
                                <th>Nombre</th>
                                <th>Celular</th>
                                <th>Dirección</th>
                                <th>Empleo</th>
                                <th>Actualizar</th>
                                <th>Eliminar</th>
                             
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            if ($totalreg > 0) :

                                foreach ($sentencia as $cliente) :

                            ?>
                                    <tr class="text-center" style="font-size:13.5px;">
                                        <td><?php
                                            echo $cont;
                                            $cont = $cont + 1;
                                            ?></td>
                                        <td><?= $cliente[2] ?></td>
                                        <td><?= $cliente[4] ?></td>
                                        <td><?= $cliente[5] ?></td>
                                        <td><?= $cliente[6] ?></td>
                                        <td><?= $cliente[7] ?></td>
                                        <td><?= $cliente[8] ?></td>
                                        <td><?= $cliente[9] ?></td>
                                        <td>
                                            <a href="actualizarCliente.php?id=<?php echo base64_encode($cliente[0])?>" class="btn botonActualiza">
                                                <i class="fas fa-sync-alt fa-xs"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="" class="btn botonElimina" id="<?php echo $cliente[0]?>">
                                                <i class="far fa-trash-alt fa-xs"></i>
                                            </a>
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
                                <a class="page-link atras" href="listaClientes.php?pagina=<?php echo $pagina - 1 ?>">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>
                        <?php
                        endif;
                        for ($i = 1; $i <= $numeroPag; $i++) {
                            if ($pagina == $i) {
                                echo '<li class="page-item numpag active">
                                        <a class="page-link" href="listaClientes.php?pagina=' . $i . '">' . $i . '
                                        </a>
                                      </li>';
                            } else {
                                echo '<li class="page-item numpag">
                                        <a class="page-link" href="listaClientes.php?pagina=' . $i . '">' . $i . '
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
                                <a class="page-link adelante" href="listaClientes.php?pagina=<?php echo $pagina + 1 ?>" aria-label="Next">
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
    <script src="js/eliminaCliente.js"></script>

</body>

</html>