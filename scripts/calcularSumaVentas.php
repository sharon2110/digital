<?php
if (!isset($_SESSION)) {
    session_start();
    $usuario = $_SESSION['usuario'];
    $tusu = $_SESSION['tipo'];
    $idusu = $_SESSION['idusuario'];
    if ($usuario == null || $usuario == "") {
        header("Location: ../scripts/cerrarSesion.php");
    }
}

include('conexion.php');

if ($tusu === "Administrador") {
    $sentencia = $con->prepare("SELECT sum(dv.precio) from detalle_venta dv 
    inner join venta v 
    on dv.venta = v.idventa 
    inner join usuario u 
    on u.idusuario = v.usuario");
    $sentencia->execute();
    $sentencia = $sentencia->fetch();
    echo $sentencia["sum"];
}else{
    $sentencia = $con->prepare("SELECT sum(dv.precio) from detalle_venta dv 
    inner join venta v 
    on dv.venta = v.idventa 
    inner join usuario u 
    on u.idusuario = v.usuario 
    where u.idusuario = $idusu");
    $sentencia->execute();
    $sentencia = $sentencia->fetch();
    echo $sentencia["sum"];
}
