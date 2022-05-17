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
include '../scripts/conexion.php';
$cliente = $_POST["cliente"];
$sql = "SELECT b.banco,dt.precio from tramitebancario t 
inner join estado_tramite et 
on t.idtramitebancario = et.tramite 
inner join folder f 
on t.idtramitebancario  = f.tramite 
inner join lista_folder lf 
on f.idfolder = lf.folder 
inner join banco b 
on t.banco = b.idbanco 
inner join detalle_tramite dt 
on t.idtramitebancario = dt.tramite
where t.cliente =:cliente
and et.estado = '4'
and f.tipo = 'cliente'
and f.contrato is not null
and lf.contrato ='si'";
$sentencia = $con->prepare($sql);
$sentencia->bindParam(':cliente',$cliente, PDO::PARAM_INT);
$sentencia->execute();
$resultado = $sentencia->fetchAll();
echo(json_encode($resultado));