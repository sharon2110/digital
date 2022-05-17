<?php
session_start();
$usuario = $_SESSION['usuario'];
$tusu = $_SESSION['tipo'];
$idusu = $_SESSION['idusuario'];
if ($usuario == null || $usuario == "") {
    header("Location: ../scripts/cerrarSesion.php");
}

include('conexion.php');
$numcarnet = $_POST["carnet"];
$nombre = $_POST["nombre"];
if (isset($_POST["carnet"])) {
    if (isset($_POST["nombre"])) {
        $sql = "SELECT t.idtramitebancario,c.cicliente,c.paterno,c.materno,c.nombre,b.banco,t.monto_prestamo
        ,t.fechaini from tramitebancario t
    inner join cliente c
    on t.cliente = c.idcliente 
    inner join banco b 
    on t.banco = b.idbanco 
    where c.cicliente =:ci or UPPER(c.nombre) like UPPER('%$nombre%') or UPPER(c.paterno) like UPPER('%$nombre%') or UPPER(c.materno) like UPPER('%$nombre%')
    order by t.fechaini desc ";
        $sentencia = $con->prepare($sql);
        $sentencia->bindParam(':ci', $numcarnet, PDO::PARAM_INT);
        $sentencia->execute();
        $resultado = $sentencia->fetchAll();
        echo (json_encode($resultado));
    }
} else {
    echo $numcarnet;
}
