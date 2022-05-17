<?php
session_start();
$usuario = $_SESSION['usuario'];
$tusu = $_SESSION['tipo'];
$idusu = $_SESSION['idusuario'];
if ($usuario == null || $usuario == "") {
    header("Location: ../scripts/cerrarSesion.php");
}

include('conexion.php');
include('verifica.php');

$id = $_POST["idcli"];
$numcarnet = $_POST["carnet_cliente"];
$extcarnet = $_POST["extension_cliente"];
$apaterno = $_POST["apellidoP_cliente"];
$amaterno = $_POST["apellidoM_cliente"];
$nombre = $_POST["nombre_cliente"];
$cel = $_POST["celular_cliente"];
$dir = $_POST["direccion_cliente"];
$empleo = $_POST["tipoEmpleoSel"];
$imagen = $_FILES["fotoCli"];
$verificaFoto = $_POST["verificaFoto"];
if ($empleo == '1') {
    $empleo = "Asalariado";
} else {
    if ($empleo == '2') {
        $empleo = "Comerciante";
    }
}
if($tusu=="Administrador" && isset($_POST["asesorCliente"])){
  $asesor = $_POST["asesorCliente"];
}else{
    $asesor = $idusu;
}
$mensaje;


function verificar($id, $tabla)
{
    include('conexion.php');
    $sql = "SELECT * FROM $tabla where idcliente = :id";
    $sentencia = $con->prepare($sql);
    $sentencia->bindParam(':id', $id, PDO::PARAM_STR);
    $sentencia->execute();
    $resultado = $sentencia->fetchAll();
    if (count($resultado) > 0) {
        return true;
    } else {
        return false;
    }
}
if (verificar($id, "cliente")) {
    if ($imagen['name'] == "") {
        if($verificaFoto=="foto"){
            $sql = "UPDATE cliente SET usuario=?, cicliente=?, ciextcli=?, paterno=?,materno=?, nombre=?, celular=?, direccion=?, tipocliente=? WHERE idcliente=?";
            $sentencia = $con->prepare($sql);
            $sentencia->bindParam(1,$asesor,PDO::PARAM_INT);
            $sentencia->bindParam(2,$numcarnet,PDO::PARAM_STR);
            $sentencia->bindParam(3,$extcarnet,PDO::PARAM_STR);
            $sentencia->bindParam(4,$apaterno,PDO::PARAM_STR);
            $sentencia->bindParam(5,$amaterno,PDO::PARAM_STR);
            $sentencia->bindParam(6,$nombre,PDO::PARAM_STR);
            $sentencia->bindParam(7,$cel,PDO::PARAM_STR);
            $sentencia->bindParam(8,$dir,PDO::PARAM_STR);
            $sentencia->bindParam(9,$empleo,PDO::PARAM_STR);
            $sentencia->bindParam(10,$id,PDO::PARAM_INT);
            $resultado = $sentencia->execute();
            $sql1 = "UPDATE tramitebancario SET usuario=? WHERE cliente=?";
            $sentencia = $con->prepare($sql1);
            $sentencia->bindParam(1,$asesor,PDO::PARAM_INT);
            $sentencia->bindParam(2,$id,PDO::PARAM_INT);
            $resultado1 = $sentencia->execute();
            if ($resultado && $resultado1) {
                $mensaje = "Actualizacion exitosa";
            } else {
                $mensaje = "No se pudo actualizar";
            }
        }else{
            $sql = "UPDATE cliente SET usuario=?, cicliente=?, ciextcli=?, paterno=?,materno=?, nombre=?, celular=?, direccion=?, tipocliente=?,foto=? WHERE idcliente=?";
            $sentencia = $con->prepare($sql);
            $sentencia->bindParam(1,$asesor,PDO::PARAM_INT);
            $sentencia->bindParam(2,$numcarnet,PDO::PARAM_STR);
            $sentencia->bindParam(3,$extcarnet,PDO::PARAM_STR);
            $sentencia->bindParam(4,$apaterno,PDO::PARAM_STR);
            $sentencia->bindParam(5,$amaterno,PDO::PARAM_STR);
            $sentencia->bindParam(6,$nombre,PDO::PARAM_STR);
            $sentencia->bindParam(7,$cel,PDO::PARAM_STR);
            $sentencia->bindParam(8,$dir,PDO::PARAM_STR);
            $sentencia->bindParam(9,$empleo,PDO::PARAM_STR);
            $sentencia->bindValue(10,null,PDO::PARAM_STR);
            $sentencia->bindParam(11,$id,PDO::PARAM_INT);
            $resultado = $sentencia->execute();
            $sql1 = "UPDATE tramitebancario SET usuario=? WHERE cliente=?";
            $sentencia = $con->prepare($sql1);
            $sentencia->bindParam(1,$asesor,PDO::PARAM_INT);
            $sentencia->bindParam(2,$id,PDO::PARAM_INT);
            $resultado1 = $sentencia->execute();
            if ($resultado && $resultado1) {
                $mensaje = "Actualizacion exitosa";
            } else {
                $mensaje = "No se pudo actualizar";
            }
        }
    } else {
        $ima = $_FILES["fotoCli"]["tmp_name"];
        $ruta = "../images/" . $numcarnet;
        if (!file_exists($ruta)) {
            mkdir($ruta, true);
        }
        move_uploaded_file($ima, $ruta . "/" . $imagen["name"]);
        $sql = "UPDATE cliente SET usuario=?, cicliente=?, ciextcli=?, paterno=?,
            materno=?, nombre=?, celular=?, direccion=?, tipocliente=?, foto=? WHERE idcliente=?";
        $sentencia = $con->prepare($sql);
        $sentencia->bindParam(1,$asesor,PDO::PARAM_INT);
        $sentencia->bindParam(2,$numcarnet,PDO::PARAM_STR);
        $sentencia->bindParam(3,$extcarnet,PDO::PARAM_STR);
        $sentencia->bindParam(4,$apaterno,PDO::PARAM_STR);
        $sentencia->bindParam(5,$amaterno,PDO::PARAM_STR);
        $sentencia->bindParam(6,$nombre,PDO::PARAM_STR);
        $sentencia->bindParam(7,$cel,PDO::PARAM_STR);
        $sentencia->bindParam(8,$dir,PDO::PARAM_STR);
        $sentencia->bindParam(9,$empleo,PDO::PARAM_STR);
        $sentencia->bindValue(10,$ruta . "/" . $imagen["name"],PDO::PARAM_STR);
        $sentencia->bindParam(11,$id,PDO::PARAM_INT);
        $resultado = $sentencia->execute();
        $sql1 = "UPDATE tramitebancario SET usuario=? WHERE cliente=?";
        $sentencia = $con->prepare($sql1);
        $sentencia->bindParam(1,$asesor,PDO::PARAM_INT);
        $sentencia->bindParam(2,$id,PDO::PARAM_INT);
        $resultado1 = $sentencia->execute();
        if ($resultado && $resultado1) {
            $mensaje = "Actualizacion exitosa";
        } else {
            $mensaje = "No se pudo actualizar";
        }
    }
    echo $mensaje;
   
}
