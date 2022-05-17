<?php
include('conexion.php');
include('verificaAuto.php');



$proveedor = $_POST["selecproveedor"];
$precioCompra = $_POST["precio_compra"];
$precioMinVenta = $_POST["precio_minventa"];
$precioVenta = $_POST["precio_venta"];
$marca = $_POST["seleccion_marca"];
if ($marca == "Otro") {
    $marca = $_POST["marca_otro"];
}
$tipo = $_POST["seleccion_tipo"];
if ($tipo == "Otro") {
    $tipo = $_POST["tipo_otro"];
}
$modelo = $_POST["modelo_movi"];
$numpasaj = $_POST["num_pasamovi"];
$cilindrada = $_POST["cil_movi"];
$colores = $_POST["color"];
$fotoAuto = $_FILES["foto_auto"];

$mensaje = "";

if (verificar_Auto($marca, strtolower($modelo),$numpasaj)) {
    $mensaje = "El automovil ya existe";
} else {
    if ($fotoAuto["type"] == "image/jpg" or $fotoAuto["type"] == "image/jpeg") {
        $ima = $_FILES["foto_auto"]["tmp_name"];
        $ruta = "../img_vehiculos/" . $marca . "-" . $modelo;
        if (!file_exists($ruta)) {
            mkdir($ruta, true);
        }
        move_uploaded_file($ima, $ruta . "/" . $fotoAuto["name"]);

        $sentencia = $con->prepare("INSERT INTO vehiculo(marca,tipo,modelo,fotovehiculo) VALUES (?, ?, ?, ?);");
        $resultado = $sentencia->execute([$marca, $tipo, $modelo, $ruta . "/" . $fotoAuto["name"]]); # Pasar en el mismo orden de los ?
        if ($resultado === true) {
            $sentencia1 = $con->prepare("SELECT idvehiculo FROM vehiculo WHERE marca=? and tipo=? and modelo=?");
            $sentencia1->execute([$marca, $tipo, $modelo]);
            $resultado = $sentencia1->fetch();
            $idVehiculo =  $resultado["idvehiculo"];

            for ($i = 0; $i < sizeof($colores); $i++) {
                $sentencia2 = $con->prepare("INSERT INTO color_vehiculo(color,automovil) VALUES (?, ?);");
                $resultado = $sentencia2->execute([$colores[$i], $idVehiculo]); # Pasar en el mismo orden de los ?
            }
            $sentencia3 = $con->prepare("INSERT INTO detalle_vehiculo(vehiculo,numpas,cilindrada,precioproveedor,preciominimo,precioventa) VALUES (?, ?, ?, ?, ?, ?);");
            $resultado = $sentencia3->execute([$idVehiculo, $numpasaj, $cilindrada, $precioCompra, $precioMinVenta, $precioVenta]); # Pasar en el mismo orden de los ?

            $sentencia4 = $con->prepare("INSERT INTO auto_prov(proveedor,automovil) VALUES (?, ?);");
            $resultado1 = $sentencia4->execute([$proveedor, $idVehiculo]); # Pasar en el mismo orden de los ?

            $mensaje = "Registro de Auto exitoso";
        } else {
            $mensaje = "Error al registrar el auto";
        }
    } else {
        $mensaje = "Elija una imagen";
    }
}
echo $mensaje;
