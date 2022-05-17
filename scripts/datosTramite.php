<?php

include '../scripts/conexion.php';
$idT = $_POST["idtramite"];

$sql = "SELECT t.cliente,c.paterno,c.materno,c.nombre,b.banco,t.monto_prestamo,t.asesor_credito,t.sucursal,t.observacion from tramitebancario t 
inner join cliente c 
on c.idcliente = t.cliente 
inner join banco b 
on t.banco = b.idbanco 
where t.idtramitebancario =?";
$sentencia = $con->prepare($sql);
$sentencia->bindValue(1, $idT, PDO::PARAM_STR);
$sentencia->execute();
$resultado = $sentencia->fetchAll();

$sql1 = "SELECT dt.marca,dt.modelo,dt.tipo,dt.color,dt.nump,dt.cilindrada,dt.precio from detalle_tramite dt 
where dt.tramite =?";
$sentencia1 = $con->prepare($sql1);
$sentencia1->bindValue(1, $idT, PDO::PARAM_STR);
$sentencia1->execute();
$resultado1 = $sentencia1->fetchAll();

$sql2 = "SELECT e.idestado,et.fecha from estado e 
inner join estado_tramite et 
on e.idestado = et.estado 
where et.tramite =?
and et.fecha = (select max(et2.fecha)from estado_tramite et2 where et2.tramite=?)
and et.estado = (select max(et3.estado)from estado_tramite et3 where et3.tramite=?)";
$sentencia2 = $con->prepare($sql2);
$sentencia2->bindValue(1, $idT, PDO::PARAM_STR);
$sentencia2->bindValue(2, $idT, PDO::PARAM_STR);
$sentencia2->bindValue(3, $idT, PDO::PARAM_STR);
$sentencia2->execute();
$resultado2 = $sentencia2->fetchAll();

$enviar = array_merge($resultado, $resultado2);
$enviarT = array_merge($enviar, $resultado1);
echo json_encode($enviarT);
