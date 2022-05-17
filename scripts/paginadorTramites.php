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
$regpagina = 4;
$inicio = ($pagina > 1) ? (($pagina * $regpagina) - $regpagina) : 0;
$cont = ($pagina > 1) ? (($pagina * $regpagina) - ($regpagina-1)) : 1;

if ($tusu === "Administrador") {
    $sentencia = $con->prepare("SELECT distinct t.idtramitebancario,c.cicliente,c.paterno,c.materno,c.nombre,b.banco,t.monto_prestamo
    ,t.fechaini,max(e.estado) from tramitebancario t 
    inner join cliente c
    on t.cliente = c.idcliente 
    inner join banco b 
    on t.banco = b.idbanco 
    inner join estado_tramite et 
    on et.tramite = t.idtramitebancario 
    inner join estado e 
    on et.estado = e.idestado 
    group by et.tramite,t.idtramitebancario,c.cicliente,c.paterno,c.materno,c.nombre,
    b.banco,t.monto_prestamo,t.fechaini
    order by t.fechaini desc 
LIMIT $regpagina offset $inicio");
    $sentencia->execute();
    $sentencia = $sentencia->fetchAll();
 
    $sentencia1 = $con->prepare("SELECT * from tramitebancario ");
    $sentencia1->execute();
    $totalreg = $sentencia1->rowCount();
    $numeroPag = ceil($totalreg / $regpagina);
    
} else {
    $sentencia = $con->prepare("SELECT distinct t.idtramitebancario,c.cicliente,c.paterno,c.materno,c.nombre,b.banco,t.monto_prestamo
    ,t.fechaini,max(e.estado) from tramitebancario t 
    inner join cliente c
    on t.cliente = c.idcliente 
    inner join banco b 
    on t.banco = b.idbanco 
    inner join estado_tramite et 
    on et.tramite = t.idtramitebancario 
    inner join estado e 
    on et.estado = e.idestado 
    where t.usuario = $idusu
    group by et.tramite,t.idtramitebancario,c.cicliente,c.paterno,c.materno,c.nombre,
    b.banco,t.monto_prestamo,t.fechaini
    order by t.fechaini desc 

LIMIT $regpagina offset $inicio");
    $sentencia->execute();
    $sentencia = $sentencia->fetchAll();

    $sentencia1 = $con->prepare("SELECT * from tramitebancario t where t.usuario =?");
    $sentencia1->execute([$idusu]);
    $totalreg = $sentencia1->rowCount();
    $numeroPag = ceil($totalreg / $regpagina);

 
}
