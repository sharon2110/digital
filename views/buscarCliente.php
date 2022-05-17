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
    <title>Buscar_Cliente</title>
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
                        <a href="nuevoCliente.php" style="font-size:15.5px!important;"><i class="fas fa-plus fa-fw"></i> &nbsp; REGISTRAR CLIENTE</a>
                    </li>
                    <li>
                        <a href="listaClientes.php" style="font-size:15.5px!important;"><i class="fas fa-clipboard-list fa-fw"></i> &nbsp; LISTA DE
                            CLIENTES</a>
                    </li>
                    <li>
                        <a class="active" href="buscarCliente.php" style="font-size:15.5px!important;"><i class="fas fa-search fa-fw"></i> &nbsp; BUSCAR
                            CLIENTE</a>
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
                                    <input type="text" class="form-control" pattern="[0-9]{5,10}" name="busquedaCI"
                                        id="inputCi" maxlength="10" style="font-size:14px;">
                                </div>
                            </div>

                            <div class="col-12 col-md-4">
                                <div class="form-group">
                                    <label for="inputSearch" class="bmd-label-floating labelBusqueda">
                                        Nombre</label>
                                    <input type="text" class="form-control" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{1,80}"  maxlength="80" name="busquedaN" id="inputNom" style="font-size:14px;">
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <p class="text-center" style="margin-top: 30px;">
                                    <button type="submit" class="btn botonBuscar" name="busca"> <i
                                            class="fas fa-search"></i>  BUSCAR</button>

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
                            if (isset($_POST['busca'])) :
                                echo "<script>
                                document.getElementById('idtablabus').style.display='block';
                                </script>";
                                $ci = trim($_POST['busquedaCI']);
                                $nom = trim($_POST['busquedaN']);
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
                                        /*TODOS LOS CAMPOS VACIOS */
                                        $totalreg = 0;
                                    } else {
                                        if ($tusu === "Administrador") {
                                            $sql = "SELECT * FROM cliente where lower(paterno) like ? OR lower(materno) like ? OR lower(nombre) like ?";
                                            $sentencia = $con->prepare($sql);
                                            $sentencia->bindValue(1, "%$nom%", PDO::PARAM_STR);
                                            $sentencia->bindValue(2, "%$nom%", PDO::PARAM_STR);
                                            $sentencia->bindValue(3, "%$nom%", PDO::PARAM_STR);

                                            $sentencia->execute();
                                            $resultado = $sentencia->fetchAll();
                                            $totalreg = $sentencia->rowCount();
                                        } else {
                                            $sql = "SELECT * FROM cliente where lower(paterno) like ? OR lower(materno) like ? OR lower(nombre) like ? and cliente.usuario=?";
                                            $sentencia = $con->prepare($sql);
                                            $sentencia->bindValue(1, "%$nom%", PDO::PARAM_STR);
                                            $sentencia->bindValue(2, "%$nom%", PDO::PARAM_STR);
                                            $sentencia->bindValue(3, "%$nom%", PDO::PARAM_STR);
                                            $sentencia->bindValue(4, $idusu, PDO::PARAM_STR);
                                            $sentencia->execute();
                                            $resultado = $sentencia->fetchAll();
                                            $totalreg = $sentencia->rowCount();
                                        }
                                        /*NOM */
                                    }
                                } else {
                                    if ($tusu === "Administrador") {

                                        if ($nom === "") {
                                            /*CI SIN NOM*/
                                            $sql = "SELECT * FROM cliente where cicliente = ?";
                                            $sentencia = $con->prepare($sql);
                                            $sentencia->bindValue(1, $ci, PDO::PARAM_STR);
                                            $sentencia->execute();
                                            $resultado = $sentencia->fetchAll();
                                            $totalreg = $sentencia->rowCount();
                                        } else {
                                            /*CI Y NOM*/
                                            $sql = "SELECT * FROM cliente where cicliente=? OR lower(paterno) like ? OR lower(materno) like ? OR lower(nombre) like ?";
                                            $sentencia = $con->prepare($sql);
                                            $sentencia->bindValue(1, $ci, PDO::PARAM_STR);
                                            $sentencia->bindValue(2, "%$nom%", PDO::PARAM_STR);
                                            $sentencia->bindValue(3, "%$nom%", PDO::PARAM_STR);
                                            $sentencia->bindValue(4, "%$nom%", PDO::PARAM_STR);
                                            $sentencia->execute();
                                            $resultado = $sentencia->fetchAll();
                                            $totalreg = $sentencia->rowCount();
                                        }
                                    } else {

                                        if ($nom === "") {
                                            /*CI SIN NOM*/
                                            $sql = "SELECT * FROM cliente where cicliente = ? and cliente.usuario=?";
                                            $sentencia = $con->prepare($sql);
                                            $sentencia->bindValue(1, $ci, PDO::PARAM_STR);
                                            $sentencia->bindValue(2, $idusu, PDO::PARAM_STR);
                                            $sentencia->execute();
                                            $resultado = $sentencia->fetchAll();
                                            $totalreg = $sentencia->rowCount();
                                        } else {
                                            /*CI Y NOM*/
                                            $sql = "SELECT * FROM cliente where cicliente=? OR lower(paterno) like ? OR lower(materno) like ? OR lower(nombre) like ? and cliente.usuario=?";
                                            $sentencia = $con->prepare($sql);
                                            $sentencia->bindValue(1, $ci, PDO::PARAM_STR);
                                            $sentencia->bindValue(2, "%$nom%", PDO::PARAM_STR);
                                            $sentencia->bindValue(3, "%$nom%", PDO::PARAM_STR);
                                            $sentencia->bindValue(4, "%$nom%", PDO::PARAM_STR);
                                            $sentencia->bindValue(5, $idusu, PDO::PARAM_STR);
                                            $sentencia->execute();
                                            $resultado = $sentencia->fetchAll();
                                            $totalreg = $sentencia->rowCount();
                                        }
                                    }
                                }
                                $cont = 1;
                                if ($totalreg > 0) :
                                    foreach ($resultado as $cliente) :

                            ?>

                            <tr class="text-center" style="font-size:13.5px;">
                                <td><?= $cont++ ?></td>
                                <td><?= $cliente[2] ?></td>
                                <td><?= $cliente[4] ?></td>
                                <td><?= $cliente[5] ?></td>
                                <td><?= $cliente[6] ?></td>
                                <td><?= $cliente[7] ?></td>
                                <td><?= $cliente[8] ?></td>
                                <td><?= $cliente[9] ?></td>
                                <td>
                                    <a href="actualizarCliente.php?id=<?php echo base64_encode($cliente[0]) ?>"
                                        class="btn botonActualiza">
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
    </main>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/sweetalert2.min.js"></script>
    <script src="js/home.js"></script>
    <script src="js/eliminaCliente.js"></script>
</body>

</html>