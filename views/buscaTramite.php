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
    <title>Buscar_Tramite</title>
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
                        <a href="nuevoCredito.php" style="font-size:15.5px!important;"><i class="fas fa-plus fa-fw"></i> &nbsp; NUEVO TRÁMITE</a>
                    </li>
                    <li>
                        <a href="listaTramites.php" style="font-size:15.5px!important;"><i class="fas fa-clipboard-list fa-fw"></i>&nbsp;LISTA TRÁMITES
                        </a>
                    </li>
                    <li>
                        <a class="active" href="buscaTramite.php" style="font-size:15.5px!important;"><i class="fas fa-search fa-fw"></i>&nbsp;&nbsp;&nbsp;BUSCAR TRÁMITE
                        </a>
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
                                    <label for="inputSearch" class="bmd-label-floating labelBusqueda">CI</label>
                                    <input type="text" class="form-control" name="busquedaCI" id="inputCI" maxlength="30" style="font-size:14px;">
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
                                <p class="text-center" style="margin-top: 20px;">
                                    <button type="submit" class="btn botonBuscar" name="buscaTramite"><i class="fas fa-search"></i> BUSCAR</button>
                                </p>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!-- TABLA RESULTADO-->
            <div class="container-fluid">
                <div class="table-responsive contenedorTabla" id="idtablabusT" style="display:none;">
                    <table class="table table-sm tabla">
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

                        if (isset($_POST['buscaTramite'])) :
                            echo "<script>
                            document.getElementById('idtablabusT').style.display = 'block';
                            </script>";

                           
                            if(!isset($_POST['busquedaCI'])){
                               $ci = "";
                            }else{
                                $ci = trim($_POST['busquedaCI']);
                            }
                            if(!isset($_POST['busquedaNombre'])){
                                $nom = "";
                             }else{
                                $nom = trim($_POST['busquedaNombre']);
                             }
                         
                            $ci = strtolower($ci);
                            $nom = strtolower($nom);
                            $usuario = $_SESSION['usuario'];
                            $tusu = $_SESSION['tipo'];
                            $idusu = $_SESSION['idusuario'];
                            $estado = $_SESSION['estado'];
                            if ($usuario == null || $usuario == "" || $estado != "Activo") {
                                header("Location: ../scripts/cerrarSesion.php");
                            }
                            include "../scripts/conexion.php";
                            if ($tusu === "Administrador") {

                                if($ci==""){
                                    if($nom==""){
                                      $totalreg = 0;
                                    }else{
                                        $sql = "SELECT t.idtramitebancario,c.cicliente,c.paterno,c.materno,c.nombre,b.banco,t.monto_prestamo
                                        ,t.fechaini from tramitebancario t
                                    inner join cliente c
                                    on t.cliente = c.idcliente 
                                    inner join banco b 
                                    on t.banco = b.idbanco 
                                    where lower(c.nombre) like '%$nom%' or lower(c.paterno) like '%$nom%' or lower(c.materno) like '%$nom%'
                                    order by t.fechaini desc ";
                                        $sentencia = $con->prepare($sql);
                                        $sentencia->bindParam(':ci', $ci, PDO::PARAM_STR);
                                        $sentencia->execute();
                                        $resultado = $sentencia->fetchAll();
                                        $totalreg = $sentencia->rowCount();
                                    }
                                  
                                }else{
                                    if($nom==""){
                                        $sql = "SELECT t.idtramitebancario,c.cicliente,c.paterno,c.materno,c.nombre,b.banco,t.monto_prestamo
                                        ,t.fechaini from tramitebancario t
                                    inner join cliente c
                                    on t.cliente = c.idcliente 
                                    inner join banco b 
                                    on t.banco = b.idbanco 
                                    where c.cicliente=:ci 
                                    order by t.fechaini desc ";
                                        $sentencia = $con->prepare($sql);
                                        $sentencia->bindParam(':ci', $ci, PDO::PARAM_STR);
                                        $sentencia->execute();
                                        $resultado = $sentencia->fetchAll();
                                        $totalreg = $sentencia->rowCount();
                                    }else{
                                        $sql = "SELECT t.idtramitebancario,c.cicliente,c.paterno,c.materno,c.nombre,b.banco,t.monto_prestamo
                                        ,t.fechaini from tramitebancario t
                                    inner join cliente c
                                    on t.cliente = c.idcliente 
                                    inner join banco b 
                                    on t.banco = b.idbanco 
                                    where c.cicliente=:ci or lower(c.nombre) like '%$nom%' or lower(c.paterno) like '%$nom%' or lower(c.materno) like '%$nom%'
                                    order by t.fechaini desc ";
                                        $sentencia = $con->prepare($sql);
                                        $sentencia->bindParam(':ci', $ci, PDO::PARAM_STR);
                                        $sentencia->execute();
                                        $resultado = $sentencia->fetchAll();
                                        $totalreg = $sentencia->rowCount();
                                    }

                                }
                               
                                    
                                
                            } else {
                                if($ci==""){
                                    if($nom==""){
                                      $totalreg = 0;
                                    }else{
                                        $sql = "SELECT t.idtramitebancario,c.cicliente,c.paterno,c.materno,c.nombre,b.banco,t.monto_prestamo
                                        ,t.fechaini from tramitebancario t
                                    inner join cliente c
                                    on t.cliente = c.idcliente 
                                    inner join banco b 
                                    on t.banco = b.idbanco 
                                    where lower(c.nombre) like '%$nom%' or lower(c.paterno) like '%$nom%' or lower(c.materno) like '%$nom%'
                                    and t.usuario=:usuario
                                    order by t.fechaini desc ";
                                        $sentencia = $con->prepare($sql);
                                        $sentencia->bindParam(':usuario', $idusu, PDO::PARAM_INT);
                                        $sentencia->execute();
                                        $resultado = $sentencia->fetchAll();
                                        $totalreg = $sentencia->rowCount();
                                    }
                                  
                                }else{
                                    if($nom==""){
                                        $sql = "SELECT t.idtramitebancario,c.cicliente,c.paterno,c.materno,c.nombre,b.banco,t.monto_prestamo
                                        ,t.fechaini from tramitebancario t
                                    inner join cliente c
                                    on t.cliente = c.idcliente 
                                    inner join banco b 
                                    on t.banco = b.idbanco 
                                    where c.cicliente=:ci 
                                    and t.usuario=:usuario
                                    order by t.fechaini desc ";
                                        $sentencia = $con->prepare($sql);
                                        $sentencia->bindParam(':ci', $ci, PDO::PARAM_STR);
                                        $sentencia->bindParam(':usuario', $idusu, PDO::PARAM_INT);
                                        $sentencia->execute();
                                        $resultado = $sentencia->fetchAll();
                                        $totalreg = $sentencia->rowCount();
                                    }else{
                                        $sql = "SELECT t.idtramitebancario,c.cicliente,c.paterno,c.materno,c.nombre,b.banco,t.monto_prestamo
                                        ,t.fechaini from tramitebancario t
                                    inner join cliente c
                                    on t.cliente = c.idcliente 
                                    inner join banco b 
                                    on t.banco = b.idbanco 
                                    where c.cicliente=:ci or lower(c.nombre) like '%$nom%' or lower(c.paterno) like '%$nom%' or lower(c.materno) like '%$nom%'
                                    and t.usuario=:usuario
                                    order by t.fechaini desc ";
                                        $sentencia = $con->prepare($sql);
                                        $sentencia->bindParam(':ci', $ci, PDO::PARAM_STR);
                                        $sentencia->bindParam(':usuario', $idusu, PDO::PARAM_INT);
                                        $sentencia->execute();
                                        $resultado = $sentencia->fetchAll();
                                        $totalreg = $sentencia->rowCount();
                                    }

                                }   
                                    
                                
                            }
                            $cont = 1;
                            if ($totalreg > 0) :
                                foreach ($resultado as $tramite) :

                        ?>
                         <tr class="text-center" style="font-size:14px;">
                                        <td><?= $cont++ ?></td>
                                        <td><?= $tramite[1] ?></td>
                                        <td><?= $tramite[2] ?></td>
                                        <td><?= $tramite[3] ?></td>
                                        <td><?= $tramite[4] ?></td>
                                        <td><?= $tramite[5] ?></td>
                                        <td><?= $tramite[6] ?></td>
                                        <td><?= $tramite[7] ?></td>
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
                                    <td colspan="12">No hay coincidencias</td>
                                </tr>
                                <script>
                                    setTimeout(function() {
                                        $("#idtablabusT").fadeOut(1500);
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
    <script src="js/eliminaTramite.js"></script>
</body>

</html>