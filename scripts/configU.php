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
include "../scripts/conexion.php";
$pass = $_POST['password'];
$pass1 = $_POST['passwordR'];
$foto = $_FILES['foto_usuario'];
if (isset($_POST['password']) && isset($_POST['passwordR']) && $pass!=="" && $pass1!=="") {
  if ($pass === $pass1) {
    if ($foto['name'] == "") {
      $sql = $con->prepare("UPDATE usuario set contrase_a=:pass where idusuario=:idusu");
      $sql->bindParam(':pass', password_hash($pass, PASSWORD_BCRYPT), PDO::PARAM_STR);
      $sql->bindParam(':idusu', $idusu, PDO::PARAM_INT);
      $sql->execute();
      if ($sql) {
        echo "ACTUALIZADO";
      }
    } else {
      $imagen = $_FILES["foto_usuario"]["tmp_name"];
      $ruta = "../img_perfiles/" . $idusu;
      if (!file_exists($ruta)) {
        mkdir($ruta, true);
      }
      move_uploaded_file($imagen, $ruta . "/" . $foto["name"]);
      $sql = $con->prepare("UPDATE usuario set contrase_a=:pass, perfil=:perfil where idusuario=:idusu");
      $sql->bindParam(':pass', password_hash($pass, PASSWORD_BCRYPT), PDO::PARAM_STR);
      $sql->bindParam(':idusu', $idusu, PDO::PARAM_INT);
      $sql->bindValue(':perfil', $ruta . "/" . $foto["name"], PDO::PARAM_STR);
      $sql->execute();
      if ($sql) {
        echo "ACTUALIZADO";
      }
    }
  } else {
    echo "CONTRASEÑAS NO COINCIDEN";
  }
} else {
  if ($foto['name'] == "") {
    echo "SIN MODIFICAR";
    
  } else {
    $imagen = $_FILES["foto_usuario"]["tmp_name"];
    $ruta = "../img_perfiles/" . $idusu;
    if (!file_exists($ruta)) {
      mkdir($ruta, true);
    }
    move_uploaded_file($imagen, $ruta . "/" . $foto["name"]);
    $sql = $con->prepare("UPDATE usuario set perfil=:perfil where idusuario=:idusu");
    $sql->bindParam(':idusu', $idusu, PDO::PARAM_INT);
    $sql->bindValue(':perfil', $ruta . "/" . $foto["name"], PDO::PARAM_STR);
    $sql->execute();
    if ($sql) {
      echo "ACTUALIZADO";
    }
  }
}
