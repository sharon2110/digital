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

$pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$regpagina = 8;
$inicio = ($pagina > 1) ? (($pagina * $regpagina) - $regpagina) : 0;
$cont = ($pagina > 1) ? (($pagina * $regpagina) - ($regpagina-1)) : 1;

if ($tusu === "Administrador") {
    $sentencia = $con->prepare("SELECT v.idventa,c.cicliente,c.paterno,c.materno,c.nombre,v.fecha,count(*),sum(dv.precio) from detalle_venta dv
    inner join venta v 
    on dv.venta = v.idventa 
    inner join cliente c 
    on v.cliente = c.idcliente 
    group by dv.venta,v.idventa,c.cicliente,c.paterno,c.materno,c.nombre 
    order by v.fecha desc 
LIMIT $regpagina offset $inicio");
    $sentencia->execute();
    $sentencia = $sentencia->fetchAll();
    
    $sentencia1 = $con->prepare("SELECT * from venta ");
    $sentencia1->execute();
    $totalreg = $sentencia1->rowCount();
    $numeroPag = ceil($totalreg / $regpagina);
    
} else {
    $sentencia = $con->prepare("SELECT v.idventa,c.cicliente,c.paterno,c.materno,c.nombre,v.fecha,count(*),sum(dv.precio) from detalle_venta dv
    inner join venta v 
    on dv.venta = v.idventa 
    inner join cliente c 
    on v.cliente = c.idcliente 
    where v.usuario = $idusu
    group by dv.venta,v.idventa,c.cicliente,c.paterno,c.materno,c.nombre 
    order by v.idventa 
LIMIT $regpagina offset $inicio");
    $sentencia->execute();
    $sentencia = $sentencia->fetchAll();

    $sentencia1 = $con->prepare("SELECT * from venta where venta.usuario = $idusu");
    $sentencia1->execute();
    $totalreg = $sentencia1->rowCount();
    $numeroPag = ceil($totalreg / $regpagina);

 
}
