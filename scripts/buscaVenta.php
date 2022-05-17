<?php
$ci = $_POST['ci'];
$nom = $_POST['nom'];
$idusu = $_POST['idU'];
include "../scripts/conexion.php";
$sql= "SELECT tipousuario from usuario where idusuario=?";
$sentencia = $con->prepare($sql);
$sentencia->bindValue(1, $usu, PDO::PARAM_STR);
$sentencia->execute();
$tipo = $sentencia->fetch();
if ($ci === "") {
    if ($tipo[0] === "Administrador") {
        $sql = "SELECT v.idventa,c.cicliente,c.paterno,c.materno,c.nombre,v.fecha,count(*),sum(dv.precio) from detalle_venta dv
        inner join venta v 
        on dv.venta = v.idventa 
        inner join cliente c 
        on v.cliente = c.idcliente 
        where lower(c.paterno) like ? OR lower(c.materno) like ? OR lower(c.nombre) like ?
        group by dv.venta,v.idventa,c.cicliente,c.paterno,c.materno,c.nombre 
        order by v.idventa  ";
        $sentencia = $con->prepare($sql);
        $sentencia->bindValue(1, "%$nom%", PDO::PARAM_STR);
        $sentencia->bindValue(2, "%$nom%", PDO::PARAM_STR);
        $sentencia->bindValue(3, "%$nom%", PDO::PARAM_STR);
        $sentencia->execute();
        $resultado = $sentencia->fetchAll();
    } else {
        $sql = "SELECT v.idventa,c.cicliente,c.paterno,c.materno,c.nombre,v.fecha,count(*),sum(dv.precio) from detalle_venta dv
        inner join venta v 
        on dv.venta = v.idventa 
        inner join cliente c 
        on v.cliente = c.idcliente 
        where c.usuario = ? and (lower(c.paterno) like ? OR lower(c.materno) like ? OR lower(c.nombre) like ?) 
        group by dv.venta,v.idventa,c.cicliente,c.paterno,c.materno,c.nombre 
        order by v.idventa  ";
        $sentencia = $con->prepare($sql);
        $sentencia->bindValue(1, $usu, PDO::PARAM_STR);
        $sentencia->bindValue(2, "%$nom%", PDO::PARAM_STR);
        $sentencia->bindValue(3, "%$nom%", PDO::PARAM_STR);
        $sentencia->bindValue(4, "%$nom%", PDO::PARAM_STR);
        $sentencia->execute();
        $resultado = $sentencia->fetchAll();
    }

} else {
    if ($tipo[0] === "Administrador") {
            /*CI SIN NOM*/
            $sql = "    SELECT v.idventa,c.cicliente,c.paterno,c.materno,c.nombre,v.fecha,count(*),sum(dv.precio) from detalle_venta dv
            inner join venta v 
            on dv.venta = v.idventa 
            inner join cliente c 
            on v.cliente = c.idcliente 
            where c.cicliente = ?
            group by dv.venta,v.idventa,c.cicliente,c.paterno,c.materno,c.nombre 
            order by v.idventa   ";
            $sentencia = $con->prepare($sql);
            $sentencia->bindValue(1, $ci, PDO::PARAM_STR);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll();

    } else {
            $sql = "    SELECT v.idventa,c.cicliente,c.paterno,c.materno,c.nombre,v.fecha,count(*),sum(dv.precio) from detalle_venta dv
            inner join venta v 
            on dv.venta = v.idventa 
            inner join cliente c 
            on v.cliente = c.idcliente 
            where c.cicliente = ? and c.usuario = ?
            group by dv.venta,v.idventa,c.cicliente,c.paterno,c.materno,c.nombre 
            order by v.idventa   ";
            $sentencia = $con->prepare($sql);
            $sentencia->bindValue(1, $ci, PDO::PARAM_STR);
            $sentencia->bindValue(2, $usu, PDO::PARAM_STR);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll();

    }
}
echo json_encode($resultado);
