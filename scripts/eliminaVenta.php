<?php

include('conexion.php');
include('verifica.php');

$id = $_POST["idventa"];
verificar_fecha($id);
function verificar_fecha($id)
{

    include('conexion.php');
    $fechaActual = date('d-m-Y');
    date_default_timezone_set('Etc/GMT-6');
    $horaActual = date('h:i:s A', time() + 43200);
    $datoActual = $fechaActual . " " . $horaActual;
    $sql = "SELECT fecha,hora FROM venta where idventa =:id";
    $sentencia = $con->prepare($sql);
    $sentencia->bindParam(':id', $id, PDO::PARAM_STR);
    $sentencia->execute();
    $resultado = $sentencia->fetchAll();
    $fecha = $resultado[0]["fecha"];
    $hora = $resultado[0]["hora"];
    $fechaV = explode("-", $fecha)[2] . "-" . explode("-", $fecha)[1] . "-" . explode("-", $fecha)[0];
    $datoV = $fechaV . " " . $hora;

    $mifecha = new DateTime($datoV);
    $mifecha->modify('+48 hours');
    $fechaVencimiento = $mifecha->format('d-m-Y H:i:s');

    $datoActual1 =new DateTime($datoActual);
    $datoActual1 = $datoActual1->format('d-m-Y H:i:s');

    //echo $fechaVencimiento." ".$datoActual1;

    if($datoActual<=$fechaVencimiento){
       return true;
    }
    return false;
}
if(verificar_fecha($id)){
    $sql = 'DELETE FROM detalle_venta dv
    WHERE dv.venta = :venta';
    $sentencia = $con->prepare($sql);
    $sentencia->bindParam(':venta', $id, PDO::PARAM_INT);
    $resultado = $sentencia->execute();

    $sql = 'DELETE FROM venta v
    WHERE v.idventa = :venta';
    $sentencia = $con->prepare($sql);
    $sentencia->bindParam(':venta', $id, PDO::PARAM_INT);
    $resultado = $sentencia->execute();

    echo "Eliminado";
}else{
    echo "No eliminado";
}
