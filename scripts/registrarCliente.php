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
$verificaUsuario = $con->prepare("SELECT * from usuario where idusuario=:id and usuario=:usu");
$verificaUsuario->bindParam(':id', $idusu, PDO::PARAM_INT);
$verificaUsuario->bindParam(':usu', $usuario, PDO::PARAM_INT);
$verificaUsuario->execute();
$resultado = $verificaUsuario->fetchAll();
if (count($resultado) > 0) {
  include('verifica.php');
  $numcarnet = $_POST["carnet_cliente"];
  $extcarnet = $_POST["extension_cliente"];
  $apaterno = $_POST["apellidoP_cliente"];
  $amaterno = $_POST["apellidoM_cliente"];
  $nombre = $_POST["nombre_cliente"];
  $cel = $_POST["celular_cliente"];
  $dir = $_POST["direccion_cliente"];
  $empleo = $_POST["tipoEmpleoSel"];
  $imagen = $_FILES["fotoCli"];
  $ima = $_FILES["fotoCli"]["tmp_name"];
  $ruta = "../images/" . $numcarnet;
  $mensaje;

  if (!file_exists($ruta)) {
    mkdir($ruta, true);
  }
  if ($empleo == '1') {
    $empleo = "Asalariado";
  } else {
    if ($empleo == '2') {
      $empleo = "Comerciante";
    }
  }
  if ($apaterno == "") {
    //Sin apellido paterno
    if ($_FILES["fotoCli"]["name"] == "") {
      //Sin foto
      $sentencia = $con->prepare("INSERT INTO cliente(usuario,cicliente,ciextcli,
       materno,nombre,celular,direccion,tipocliente) VALUES (?, ?, ?, ?, ?, ?, ?, ?);");
      $resultado = $sentencia->execute([
        $idusu, $numcarnet, $extcarnet,
        $amaterno, $nombre, $cel, $dir, $empleo
      ]); # Pasar en el mismo orden de los ?
      if ($resultado === true) {
        $mensaje = "Registro exitoso";
      }
    } else {
      //Con foto
      $ima = $_FILES["fotoCli"]["tmp_name"];
      move_uploaded_file($ima, $ruta . "/" . $imagen["name"]);
      $sentencia = $con->prepare("INSERT INTO cliente(usuario,cicliente,ciextcli
     materno,nombre,celular,direccion,tipocliente,foto) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);");
      $resultado = $sentencia->execute([
        $idusu, $numcarnet, $extcarnet,
        $amaterno, $nombre, $cel, $dir, $empleo, $ruta . "/" . $imagen["name"]
      ]); # Pasar en el mismo orden de los ?
      if ($resultado === true) {
        $mensaje = "Registro exitoso";
      }
    }
  } else {
    //Con apellido paterno
    if ($_FILES["fotoCli"]["name"] == "") {
      //Sin foto
      $sentencia = $con->prepare("INSERT INTO cliente(usuario,cicliente,ciextcli,paterno,
      materno,nombre,celular,direccion,tipocliente) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);");
      $resultado = $sentencia->execute([
        $idusu, $numcarnet, $extcarnet, $apaterno,
        $amaterno, $nombre, $cel, $dir, $empleo
      ]); # Pasar en el mismo orden de los ?
      if ($resultado === true) {
        $mensaje = "Registro exitoso";
      }
    } else {
      //Con foto
      $ima = $_FILES["fotoCli"]["tmp_name"];
      move_uploaded_file($ima, $ruta . "/" . $imagen["name"]);
      $sentencia = $con->prepare("INSERT INTO cliente(usuario,cicliente,ciextcli,paterno,
    materno,nombre,celular,direccion,tipocliente,foto) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?);");
      $resultado = $sentencia->execute([
        $idusu, $numcarnet, $extcarnet, $apaterno,
        $amaterno, $nombre, $cel, $dir, $empleo, $ruta . "/" . $imagen["name"]
      ]); # Pasar en el mismo orden de los ?
      if ($resultado === true) {
        $mensaje = "Registro exitoso";
      }
    }
  }
  echo $mensaje;
}
