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
$tramite = $_POST["idtramite"];
$monto_prestamo = $_POST["monto_prestamo"];
$asesor_credito = $_POST["asesor_credito"];
$sucursal = $_POST["sucursal_banco"];
$obs= $_POST["observacion"];
$imagenesC = $_POST["imagenesC"];
$imagenesG = $_POST["imagenesG"];
$sentencia = $con->prepare("UPDATE tramitebancario set monto_prestamo=:monto,asesor_credito=:asesorCredito,sucursal=:sucursal,observacion=:obs where idtramitebancario=:idTramite ");
$sentencia->bindParam(':monto', $monto_prestamo, PDO::PARAM_STR);
$sentencia->bindParam(':asesorCredito', $asesor_credito, PDO::PARAM_STR);
$sentencia->bindParam(':sucursal', $sucursal, PDO::PARAM_STR);
$sentencia->bindParam(':obs', $obs, PDO::PARAM_STR);
$sentencia->bindParam(':idTramite', $tramite, PDO::PARAM_INT);
$resultado = $sentencia->execute();
if ($resultado) {
  $vehiculos = $_POST["vehiculos"];
  $sentencia2 = $con->prepare("DELETE from detalle_tramite where tramite=:idTramite");
  $sentencia2->bindParam(':idTramite', $tramite, PDO::PARAM_INT);
  $sentencia2->execute();
  foreach ($vehiculos as $vehiculo) {
    $v = (explode(',', $vehiculo));
    $marca = $v[0];
    $modelo = $v[1];
    $tipo = $v[2];
    $color = $v[3];
    $numpas = $v[4];
    $cilindrada = $v[5];
    $precio = $v[6];
    $sentencia4 = $con->prepare("INSERT INTO detalle_tramite(tramite,marca,modelo,tipo,color,nump,cilindrada, precio) VALUES (:idTramite, :marca,:modelo,
     :tipo, :color,:numpas,:cilindrada,:precio);");
    $sentencia4->bindParam(':idTramite', $tramite, PDO::PARAM_INT);
    $sentencia4->bindParam(':marca', $marca, PDO::PARAM_STR);
    $sentencia4->bindParam(':modelo', $modelo, PDO::PARAM_STR);
    $sentencia4->bindParam(':tipo', $tipo, PDO::PARAM_STR);
    $sentencia4->bindParam(':color', $color, PDO::PARAM_STR);
    $sentencia4->bindParam(':numpas', $numpas, PDO::PARAM_INT);
    $sentencia4->bindParam(':cilindrada', $cilindrada, PDO::PARAM_STR);
    $sentencia4->bindParam(':precio', $precio, PDO::PARAM_STR);
    $resultado4 = $sentencia4->execute();
  }
  $estado = $_POST["estado"];
  $sentencia5 = $con->prepare("SELECT et.estado from estado_tramite et 
  where et.tramite =:idTramite");
  $sentencia5->bindParam(':idTramite', $tramite, PDO::PARAM_INT);
  $sentencia5->execute();
  $resultado5 = $sentencia5->fetchAll();
  $existenciaEstado = false;
  foreach ($resultado5 as $estados) {
    $idestado = $estados["estado"];
    if ($idestado == $estado) {
      $existenciaEstado = true;
    }
  }
  if (!$existenciaEstado) {
    $fecha = date('d-m-Y', time());
    date_default_timezone_set('Etc/GMT-6');
    $hora = date('h:i:s:A', time() + 43200);
    $sentencia6 = $con->prepare("INSERT INTO estado_tramite(fecha,tramite,estado,hora) VALUES (:fecha, :idTramite, :estado,:hora)");
    $sentencia6->bindParam(':idTramite', $tramite, PDO::PARAM_INT);
    $sentencia6->bindParam(':fecha', $fecha, PDO::PARAM_STR);
    $sentencia6->bindParam(':estado', $estado, PDO::PARAM_INT);
    $sentencia6->bindParam(':hora', $hora, PDO::PARAM_STR);
    $resultado6 = $sentencia6->execute();

    if ($estado === '4') {
      $fecha = date('d-m-Y', time());
      $sentencia = $con->prepare("UPDATE tramitebancario set fechafin=:fin where idtramitebancario=:idTramite ");
      $sentencia->bindParam(':fin', $fecha, PDO::PARAM_STR);
      $sentencia->bindParam(':idTramite', $tramite, PDO::PARAM_INT);
      $resultado = $sentencia->execute();
    }
  }
  $sentencia9 = $con->prepare("SELECT cliente, banco from tramitebancario where idtramitebancario =:idTramite");
  $sentencia9->bindValue(':idTramite', $tramite, PDO::PARAM_INT);
  $resultado9 = $sentencia9->execute();
  $resultado9 = $sentencia9->fetch();
  $idbanco = $resultado9["banco"];
  $cliente = $resultado9["cliente"];
  $ruta = "../tramites/" . $cliente . "-" . $idbanco;
  if (!file_exists($ruta)) {
    mkdir($ruta, true);
    $ruta1 = $ruta . "/cliente";
    if (!file_exists($ruta1)) {
      mkdir($ruta1, true);
      $ruta1d = $ruta1 . "/deudas";
      if (!file_exists($ruta1d)) {
        mkdir($ruta1d, true);
      }
    }
    $ruta2 = $ruta . "/garante";
    if (!file_exists($ruta2)) {
      mkdir($ruta2, true);
      $ruta2d = $ruta2 . "/deudas";
      if (!file_exists($ruta2d)) {
        mkdir($ruta2d, true);
      }
    }
  } else {
    $ruta1 = $ruta . "/cliente";
    $ruta1d = $ruta1 . "/deudas";
    $ruta2 = $ruta . "/garante";
    $ruta2d = $ruta2 . "/deudas";
  }
  //------------------------------------------OBTENIENDO LOS IDFOLDERS-----------------------------------//
  $sentencia7 = $con->prepare("SELECT idfolder from folder where tramite =:idTramite and tipo=:tipo");
  $sentencia7->bindValue(':idTramite', $tramite, PDO::PARAM_INT);
  $sentencia7->bindValue(':tipo', 'cliente', PDO::PARAM_STR);
  $resultado7 = $sentencia7->execute();
  $resultado7 = $sentencia7->fetch();
  $idfolderC = $resultado7["idfolder"];

  $sentencia8 = $con->prepare("SELECT idfolder from folder where tramite =:idTramite and tipo=:tipo");
  $sentencia8->bindValue(':idTramite', $tramite, PDO::PARAM_INT);
  $sentencia8->bindValue(':tipo', 'garante', PDO::PARAM_STR);
  $resultado8 = $sentencia8->execute();
  $resultado8 = $sentencia8->fetch();
  $idfolderG = $resultado8["idfolder"];

  //------------------------------------------ACTUALIZANDO EXP.CLIENTE-----------------------------------//
  if (verificaImagen($imagenesC, "contrato")) {
    if ($_FILES["clienteContrato"]["name"] !== "") {
      $contrato = $_FILES["clienteContrato"];
      move_uploaded_file($contrato["tmp_name"], $ruta1 . "/" . $contrato["name"]);
      $sql1 = $con->prepare("UPDATE folder set contrato=? where idfolder =?;");
      $res1 = $sql1->execute([$ruta1 . "/" . $contrato["name"], $idfolderC]);
    }
  } else {
    if ($_FILES["clienteContrato"]["name"] !== "") {
      $contrato = $_FILES["clienteContrato"];
      move_uploaded_file($contrato["tmp_name"], $ruta1 . "/" . $contrato["name"]);
      $sql1 = $con->prepare("UPDATE folder set contrato=? where idfolder =?;");
      $res1 = $sql1->execute([$ruta1 . "/" . $contrato["name"], $idfolderC]);
    } else {
      $sql1 = $con->prepare("UPDATE folder set contrato=? where idfolder =?;");
      $res1 = $sql1->execute([null, $idfolderC]);
    }
  }

  if (verificaImagen($imagenesC, "carnet")) {
    if ($_FILES["clienteCarnet"]["name"] !== "") {
      $ccarnet = $_FILES["clienteCarnet"];
      move_uploaded_file($ccarnet["tmp_name"], $ruta1 . "/" . $ccarnet["name"]);
      $sql2 = $con->prepare("UPDATE folder set fotcarnet=? where idfolder =?;");
      $res2 = $sql2->execute([$ruta1 . "/" . $ccarnet["name"], $idfolderC]);
    }
  } else {
    if ($_FILES["clienteCarnet"]["name"] !== "") {
      $ccarnet = $_FILES["clienteCarnet"];
      move_uploaded_file($ccarnet["tmp_name"], $ruta1 . "/" . $ccarnet["name"]);
      $sql2 = $con->prepare("UPDATE folder set fotcarnet=? where idfolder =?;");
      $res2 = $sql2->execute([$ruta1 . "/" . $ccarnet["name"], $idfolderC]);
    } else {
      $sql2 = $con->prepare("UPDATE folder set fotcarnet=? where idfolder =?;");
      $res2 = $sql2->execute([null, $idfolderC]);
    }
  }

  if (verificaImagen($imagenesC, "luz")) {
    if ($_FILES["clienteFacLuz"]["name"] !== "") {
      $cfacluz = $_FILES["clienteFacLuz"];
      move_uploaded_file($cfacluz["tmp_name"], $ruta1 . "/" . $cfacluz["name"]);
      $sql3 = $con->prepare("UPDATE folder set facluz=? where idfolder =?;");
      $res3 = $sql3->execute([$ruta1 . "/" . $cfacluz["name"], $idfolderC]);
    }
  } else {
    if ($_FILES["clienteFacLuz"]["name"] !== "") {
      $cfacluz = $_FILES["clienteFacLuz"];
      move_uploaded_file($cfacluz["tmp_name"], $ruta1 . "/" . $cfacluz["name"]);
      $sql3 = $con->prepare("UPDATE folder set facluz=? where idfolder =?;");
      $res3 = $sql3->execute([$ruta1 . "/" . $cfacluz["name"], $idfolderC]);
    } else {
      $sql3 = $con->prepare("UPDATE folder set facluz=? where idfolder =?;");
      $res3 = $sql3->execute([null, $idfolderC]);
    }
  }

  if (verificaImagen($imagenesC, "agua")) {
    if ($_FILES["clienteFacAgua"]["name"] !== "") {
      $cfacagua = $_FILES["clienteFacAgua"];
      move_uploaded_file($cfacagua["tmp_name"], $ruta1 . "/" . $cfacagua["name"]);
      $sql4 = $con->prepare("UPDATE folder set facagua=? where idfolder =?;");
      $res4 = $sql4->execute([$ruta1 . "/" . $cfacagua["name"], $idfolderC]);
    }
  } else {
    if ($_FILES["clienteFacAgua"]["name"] !== "") {
      $cfacagua = $_FILES["clienteFacAgua"];
      move_uploaded_file($cfacagua["tmp_name"], $ruta1 . "/" . $cfacagua["name"]);
      $sql4 = $con->prepare("UPDATE folder set facagua=? where idfolder =?;");
      $res4 = $sql4->execute([$ruta1 . "/" . $cfacagua["name"], $idfolderC]);
    } else {
      $sql4 = $con->prepare("UPDATE folder set facagua=? where idfolder =?;");
      $res4 = $sql4->execute([null, $idfolderC]);
    }
  }

  if (verificaImagen($imagenesC, "croquis")) {
    if ($_FILES["clienteCroquis"]["name"] !== "") {
      $ccroquis = $_FILES["clienteCroquis"];
      move_uploaded_file($ccroquis["tmp_name"], $ruta1 . "/" . $ccroquis["name"]);
      $sql5 = $con->prepare("UPDATE folder set croquis=? where idfolder =?;");
      $res5 = $sql5->execute([$ruta1 . "/" . $ccroquis["name"], $idfolderC]);
    }
  } else {
    if ($_FILES["clienteCroquis"]["name"] !== "") {
      $ccroquis = $_FILES["clienteCroquis"];
      move_uploaded_file($ccroquis["tmp_name"], $ruta1 . "/" . $ccroquis["name"]);
      $sql5 = $con->prepare("UPDATE folder set croquis=? where idfolder =?;");
      $res5 = $sql5->execute([$ruta1 . "/" . $ccroquis["name"], $idfolderC]);
    } else {
      $sql5 = $con->prepare("UPDATE folder set croquis=? where idfolder =?;");
      $res5 = $sql5->execute([null, $idfolderC]);
    }
  }
  if (verificaImagen($imagenesC, "folio")) {
    if ($_FILES["clienteFolioReal"]["name"] !== "") {
      $cfolio = $_FILES["clienteFolioReal"];
      move_uploaded_file($cfolio["tmp_name"], $ruta1 . "/" . $cfolio["name"]);
      $sql6 = $con->prepare("UPDATE folder set folio=? where idfolder =?;");
      $res6 = $sql6->execute([$ruta1 . "/" . $cfolio["name"], $idfolderC]);
    }
  } else {
    if ($_FILES["clienteFolioReal"]["name"] !== "") {
      $cfolio = $_FILES["clienteFolioReal"];
      move_uploaded_file($cfolio["tmp_name"], $ruta1 . "/" . $cfolio["name"]);
      $sql6 = $con->prepare("UPDATE folder set folio=? where idfolder =?;");
      $res6 = $sql6->execute([$ruta1 . "/" . $cfolio["name"], $idfolderC]);
    } else {
      $sql6 = $con->prepare("UPDATE folder set folio=? where idfolder =?;");
      $res6 = $sql6->execute([null, $idfolderC]);
    }
  }
  if (verificaImagen($imagenesC, "testimonio")) {
    if ($_FILES["clienteTestimonio"]["name"] !== "") {
      $ctestimonio = $_FILES["clienteTestimonio"];
      move_uploaded_file($ctestimonio["tmp_name"], $ruta1 . "/" . $ctestimonio["name"]);
      $sql7 = $con->prepare("UPDATE folder set testimonio=? where idfolder =?;");
      $res7 = $sql7->execute([$ruta1 . "/" . $ctestimonio["name"], $idfolderC]);
    }
  } else {
    if ($_FILES["clienteTestimonio"]["name"] !== "") {
      $ctestimonio = $_FILES["clienteTestimonio"];
      move_uploaded_file($ctestimonio["tmp_name"], $ruta1 . "/" . $ctestimonio["name"]);
      $sql7 = $con->prepare("UPDATE folder set testimonio=? where idfolder =?;");
      $res7 = $sql7->execute([$ruta1 . "/" . $ctestimonio["name"], $idfolderC]);
    } else {
      $sql7 = $con->prepare("UPDATE folder set testimonio=? where idfolder =?;");
      $res7 = $sql7->execute([null, $idfolderC]);
    }
  }
  if (verificaImagen($imagenesC, "impuesto")) {
    if ($_FILES["clienteImpuesto"]["name"] !== "") {
      $cimpuesto = $_FILES["clienteImpuesto"];
      move_uploaded_file($cimpuesto["tmp_name"], $ruta1 . "/" . $cimpuesto["name"]);
      $sql8 = $con->prepare("UPDATE folder set impuesto=? where idfolder =?;");
      $res8 = $sql8->execute([$ruta1 . "/" . $cimpuesto["name"], $idfolderC]);
    }
  } else {
    if ($_FILES["clienteImpuesto"]["name"] !== "") {
      $cimpuesto = $_FILES["clienteImpuesto"];
      move_uploaded_file($cimpuesto["tmp_name"], $ruta1 . "/" . $cimpuesto["name"]);
      $sql8 = $con->prepare("UPDATE folder set impuesto=? where idfolder =?;");
      $res8 = $sql8->execute([$ruta1 . "/" . $cimpuesto["name"], $idfolderC]);
    } else {
      $sql8 = $con->prepare("UPDATE folder set impuesto=? where idfolder =?;");
      $res8 = $sql8->execute([null, $idfolderC]);
    }
  }
  if (verificaImagen($imagenesC, "ruat")) {
    if ($_FILES["clienteRuat"]["name"] !== "") {
      $cruat = $_FILES["clienteRuat"];
      move_uploaded_file($cruat["tmp_name"], $ruta1 . "/" . $cruat["name"]);
      $sql9 = $con->prepare("UPDATE folder set ruat=? where idfolder =?;");
      $res9 = $sql9->execute([$ruta1 . "/" . $cruat["name"], $idfolderC]);
    }
  } else {
    if ($_FILES["clienteRuat"]["name"] !== "") {
      $cruat = $_FILES["clienteRuat"];
      move_uploaded_file($cruat["tmp_name"], $ruta1 . "/" . $cruat["name"]);
      $sql9 = $con->prepare("UPDATE folder set ruat=? where idfolder =?;");
      $res9 = $sql9->execute([$ruta1 . "/" . $cruat["name"], $idfolderC]);
    } else {
      $sql9 = $con->prepare("UPDATE folder set ruat=? where idfolder =?;");
      $res9 = $sql9->execute([null, $idfolderC]);
    }
  }
  if (verificaImagen($imagenesC, "soat")) {
    if ($_FILES["clienteSoat"]["name"] !== "") {
      $csoat = $_FILES["clienteSoat"];
      move_uploaded_file($csoat["tmp_name"], $ruta1 . "/" . $csoat["name"]);
      $sql10 = $con->prepare("UPDATE folder set soat=? where idfolder =?;");
      $res10 = $sql10->execute([$ruta1 . "/" . $csoat["name"], $idfolderC]);
    }
  } else {
    if ($_FILES["clienteSoat"]["name"] !== "") {
      $csoat = $_FILES["clienteSoat"];
      move_uploaded_file($csoat["tmp_name"], $ruta1 . "/" . $csoat["name"]);
      $sql10 = $con->prepare("UPDATE folder set soat=? where idfolder =?;");
      $res10 = $sql10->execute([$ruta1 . "/" . $csoat["name"], $idfolderC]);
    } else {
      $sql10 = $con->prepare("UPDATE folder set soat=? where idfolder =?;");
      $res10 = $sql10->execute([null, $idfolderC]);
    }
  }
  if (verificaImagen($imagenesC, "nit")) {
    if ($_FILES["clienteNit"]["name"] !== "") {
      $cnit = $_FILES["clienteNit"];
      move_uploaded_file($cnit["tmp_name"], $ruta1 . "/" . $cnit["name"]);
      $sql11 = $con->prepare("UPDATE folder set nit=? where idfolder =?;");
      $res11 = $sql11->execute([$ruta1 . "/" . $cnit["name"], $idfolderC]);
    }
  } else {
    if ($_FILES["clienteNit"]["name"] !== "") {
      $cnit = $_FILES["clienteNit"];
      move_uploaded_file($cnit["tmp_name"], $ruta1 . "/" . $cnit["name"]);
      $sql11 = $con->prepare("UPDATE folder set nit=? where idfolder =?;");
      $res11 = $sql11->execute([$ruta1 . "/" . $cnit["name"], $idfolderC]);
    } else {
      $sql11 = $con->prepare("UPDATE folder set nit=? where idfolder =?;");
      $res11 = $sql11->execute([null, $idfolderC]);
    }
  }
  if (verificaImagen($imagenesC, "patente")) {
    if ($_FILES["clientePatente"]["name"] !== "") {
      $cpatente = $_FILES["clientePatente"];
      move_uploaded_file($cpatente["tmp_name"], $ruta1 . "/" . $cpatente["name"]);
      $sql12 = $con->prepare("UPDATE folder set patente=? where idfolder =?;");
      $res12 = $sql12->execute([$ruta1 . "/" . $cpatente["name"], $idfolderC]);
    }
  } else {
    if ($_FILES["clientePatente"]["name"] !== "") {
      $cpatente = $_FILES["clientePatente"];
      move_uploaded_file($cpatente["tmp_name"], $ruta1 . "/" . $cpatente["name"]);
      $sql12 = $con->prepare("UPDATE folder set patente=? where idfolder =?;");
      $res12 = $sql12->execute([$ruta1 . "/" . $cpatente["name"], $idfolderC]);
    } else {
      $sql12 = $con->prepare("UPDATE folder set patente=? where idfolder =?;");
      $res12 = $sql12->execute([null, $idfolderC]);
    }
  }

  if (verificaImagen($imagenesC, "boletapago")) {
    if ($_FILES["clienteBoletaPago"]["name"] !== "") {
      $csueldos = $_FILES["clienteBoletaPago"];
      move_uploaded_file($csueldos["tmp_name"], $ruta1 . "/" . $csueldos["name"]);
      $sql13 = $con->prepare("UPDATE folder set boletapago=? where idfolder =?;");
      $res13 = $sql13->execute([$ruta1 . "/" . $csueldos["name"], $idfolderC]);
    }
  } else {
    if ($_FILES["clienteBoletaPago"]["name"] !== "") {
      $csueldos = $_FILES["clienteBoletaPago"];
      move_uploaded_file($csueldos["tmp_name"], $ruta1 . "/" . $csueldos["name"]);
      $sql13 = $con->prepare("UPDATE folder set boletapago=? where idfolder =?;");
      $res13 = $sql13->execute([$ruta1 . "/" . $csueldos["name"], $idfolderC]);
    } else {
      $sql13 = $con->prepare("UPDATE folder set boletapago=? where idfolder =?;");
      $res13 = $sql13->execute([null, $idfolderC]);
    }
  }
  if (verificaImagen($imagenesC, "afp")) {
    if ($_FILES["clienteAfp"]["name"] !== "") {
      $cafp = $_FILES["clienteAfp"];
      move_uploaded_file($cafp["tmp_name"], $ruta1 . "/" . $cafp["name"]);
      $sql14 = $con->prepare("UPDATE folder set afp=? where idfolder =?;");
      $res14 = $sql14->execute([$ruta1 . "/" . $cafp["name"], $idfolderC]);
    }
  } else {
    if ($_FILES["clienteAfp"]["name"] !== "") {
      $cafp = $_FILES["clienteAfp"];
      move_uploaded_file($cafp["tmp_name"], $ruta1 . "/" . $cafp["name"]);
      $sql14 = $con->prepare("UPDATE folder set afp=? where idfolder =?;");
      $res14 = $sql14->execute([$ruta1 . "/" . $cafp["name"], $idfolderC]);
    } else {
      if ($_FILES["clienteAfp"]["name"] !== "") {
        $cafp = $_FILES["clienteAfp"];
        move_uploaded_file($cafp["tmp_name"], $ruta1 . "/" . $cafp["name"]);
        $sql14 = $con->prepare("UPDATE folder set afp=? where idfolder =?;");
        $res14 = $sql14->execute([$ruta1 . "/" . $cafp["name"], $idfolderC]);
      } else {
        $sql14 = $con->prepare("UPDATE folder set afp=? where idfolder =?;");
        $res14 = $sql14->execute([null, $idfolderC]);
      }
    }
  }

  //--------------------------------ACTUALIZANDO DEUDA BANCO FOLDER CLIENTE---------------------------//

  $sentencia = $con->prepare("SELECT planpago,ultimaboleta from deuda_banco_folder where folder=?");
  $resultado = $sentencia->execute([$idfolderC]);
  $resultado = $sentencia->fetchAll();
  $imadeudac = $resultado;
  $sentencia = $con->prepare("DELETE FROM deuda_banco_folder where folder=?");
  $resultado = $sentencia->execute([$idfolderC]);

  ///////////////////////////////BANCO 1///////////////////////////
  if ($_POST["selec_banco_cliente1"] !== "0") {
    $cbancodeuda1 = $_POST["selec_banco_cliente1"];
    $sql16 = $con->prepare("INSERT INTO deuda_banco_folder(folder,banco) VALUES (?, ?)");
    $res16 = $sql16->execute([$idfolderC, $cbancodeuda1]);

    $sql17 = $con->prepare("SELECT iddeudabancofolder FROM deuda_banco_folder WHERE folder=? and banco=?");
    $sql17->execute([$idfolderC, $cbancodeuda1]);
    $res17 = $sql17->fetch();
    $iddeudabancoC1 =  $res17["iddeudabancofolder"];

    if (verificaImagen($imagenesC, "planpago1")) {
      if ($_FILES["clientePlan1"]["name"] !== "") {
        $cplan1 = $_FILES["clientePlan1"];
        move_uploaded_file($cplan1["tmp_name"], $ruta1d . "/" . $cplan1["name"]);
        $sql18 = $con->prepare("UPDATE deuda_banco_folder set planpago=? where iddeudabancofolder =?;");
        $res18 = $sql18->execute([$ruta1d . "/" . $cplan1["name"], $iddeudabancoC1]);
      } else {
        $sql18 = $con->prepare("UPDATE deuda_banco_folder set planpago=? where iddeudabancofolder =?;");
        $res18 = $sql18->execute([$imadeudac[0]["planpago"], $iddeudabancoC1]);
      }
    } else {
      if ($_FILES["clientePlan1"]["name"] !== "") {
        $cplan1 = $_FILES["clientePlan1"];
        move_uploaded_file($cplan1["tmp_name"], $ruta1d . "/" . $cplan1["name"]);
        $sql18 = $con->prepare("UPDATE deuda_banco_folder set planpago=? where iddeudabancofolder =?;");
        $res18 = $sql18->execute([$ruta1d . "/" . $cplan1["name"], $iddeudabancoC1]);
      } else {
        $sql18 = $con->prepare("UPDATE deuda_banco_folder set planpago=? where iddeudabancofolder =?;");
        $res18 = $sql18->execute([null, $iddeudabancoC1]);
      }
    }
    if (verificaImagen($imagenesC, "ultimaboleta1")) {
      if ($_FILES["clienteCancelacion1"]["name"] !== "") {
        $cboleta1 = $_FILES["clienteCancelacion1"];
        move_uploaded_file($cboleta1["tmp_name"], $ruta1d . "/" . $cboleta1["name"]);
        $sql19 = $con->prepare("UPDATE deuda_banco_folder set ultimaboleta=? where iddeudabancofolder =?;");
        $res19 = $sql19->execute([$ruta1d . "/" . $cboleta1["name"], $iddeudabancoC1]);
      } else {
        $sql18 = $con->prepare("UPDATE deuda_banco_folder set ultimaboleta=? where iddeudabancofolder =?;");
        $res18 = $sql18->execute([$imadeudac[0]["ultimaboleta"], $iddeudabancoC1]);
      }
    } else {
      if ($_FILES["clienteCancelacion1"]["name"] !== "") {
        $cboleta1 = $_FILES["clienteCancelacion1"];
        move_uploaded_file($cboleta1["tmp_name"], $ruta1d . "/" . $cboleta1["name"]);
        $sql19 = $con->prepare("UPDATE deuda_banco_folder set ultimaboleta=? where iddeudabancofolder =?;");
        $res19 = $sql19->execute([$ruta1d . "/" . $cboleta1["name"], $iddeudabancoC1]);
      } else {
        $sql18 = $con->prepare("UPDATE deuda_banco_folder set ultimaboleta=? where iddeudabancofolder =?;");
        $res18 = $sql18->execute([null, $iddeudabancoC1]);
      }
    }
  }
  ///////////////////////////////BANCO 2///////////////////////////
  if ($_POST["selec_banco_cliente2"] !== "0") {
    $cbancodeuda2 = (int)$_POST["selec_banco_cliente2"];
    $sql16 = $con->prepare("INSERT INTO deuda_banco_folder(folder,banco) VALUES (?, ?)");
    $res16 = $sql16->execute([$idfolderC, $cbancodeuda2]);

    $sql17 = $con->prepare("SELECT iddeudabancofolder FROM deuda_banco_folder WHERE folder=? and banco=?");
    $sql17->execute([$idfolderC, $cbancodeuda2]);
    $res17 = $sql17->fetch();
    $iddeudabancoC2 =  $res17["iddeudabancofolder"];

    if (verificaImagen($imagenesC, "planpago2")) {
      if ($_FILES["clientePlan2"]["name"] !== "") {
        $cplan2 = $_FILES["clientePlan2"];
        move_uploaded_file($cplan2["tmp_name"], $ruta1d . "/" . $cplan2["name"]);
        $sql18 = $con->prepare("UPDATE deuda_banco_folder set planpago=? where iddeudabancofolder =?;");
        $res18 = $sql18->execute([$ruta1d . "/" . $cplan2["name"], $iddeudabancoC1]);
      } else {
        $sql18 = $con->prepare("UPDATE deuda_banco_folder set planpago=? where iddeudabancofolder =?;");
        $res18 = $sql18->execute([$imadeudac[1]["planpago"], $iddeudabancoC2]);
      }
    } else {
      if ($_FILES["clientePlan2"]["name"] !== "") {
        $cplan2 = $_FILES["clientePlan2"];
        move_uploaded_file($cplan2["tmp_name"], $ruta1d . "/" . $cplan2["name"]);
        $sql18 = $con->prepare("UPDATE deuda_banco_folder set planpago=? where iddeudabancofolder =?;");
        $res18 = $sql18->execute([$ruta1d . "/" . $cplan2["name"], $iddeudabancoC2]);
      } else {
        $sql18 = $con->prepare("UPDATE deuda_banco_folder set planpago=? where iddeudabancofolder =?;");
        $res18 = $sql18->execute([null, $iddeudabancoC2]);
      }
    }
    if (verificaImagen($imagenesC, "ultimaboleta2")) {
      if ($_FILES["clienteCancelacion2"]["name"] !== "") {
        $cboleta2 = $_FILES["clienteCancelacion2"];
        move_uploaded_file($cboleta2["tmp_name"], $ruta1d . "/" . $cboleta2["name"]);
        $sql19 = $con->prepare("UPDATE deuda_banco_folder set ultimaboleta=? where iddeudabancofolder =?;");
        $res19 = $sql19->execute([$ruta1d . "/" . $cboleta2["name"], $iddeudabancoC2]);
      } else {
        $sql18 = $con->prepare("UPDATE deuda_banco_folder set ultimaboleta=? where iddeudabancofolder =?;");
        $res18 = $sql18->execute([$imadeudac[1]["ultimaboleta"], $iddeudabancoC2]);
      }
    } else {
      if ($_FILES["clienteCancelacion2"]["name"] !== "") {
        $cboleta2 = $_FILES["clienteCancelacion2"];
        move_uploaded_file($cboleta2["tmp_name"], $ruta1d . "/" . $cboleta2["name"]);
        $sql19 = $con->prepare("UPDATE deuda_banco_folder set ultimaboleta=? where iddeudabancofolder =?;");
        $res19 = $sql19->execute([$ruta1d . "/" . $cboleta2["name"], $iddeudabancoC2]);
      } else {
        $sql18 = $con->prepare("UPDATE deuda_banco_folder set ultimaboleta=? where iddeudabancofolder =?;");
        $res18 = $sql18->execute([null, $iddeudabancoC2]);
      }
    }
  }
  ///////////////////////////////BANCO 3///////////////////////////
  if ($_POST["selec_banco_cliente3"] !== "0") {
    $cbancodeuda3 = $_POST["selec_banco_cliente3"];
    $sql16 = $con->prepare("INSERT INTO deuda_banco_folder(folder,banco) VALUES (?, ?)");
    $res16 = $sql16->execute([$idfolderC, $cbancodeuda3]);

    $sql17 = $con->prepare("SELECT iddeudabancofolder FROM deuda_banco_folder WHERE folder=? and banco=?");
    $sql17->execute([$idfolderC, $cbancodeuda3]);
    $res17 = $sql17->fetch();
    $iddeudabancoC3 =  $res17["iddeudabancofolder"];

    if (verificaImagen($imagenesC, "planpago3")) {
      if ($_FILES["clientePlan3"]["name"] !== "") {
        $cplan3 = $_FILES["clientePlan3"];
        move_uploaded_file($cplan3["tmp_name"], $ruta1d . "/" . $cplan3["name"]);
        $sql18 = $con->prepare("UPDATE deuda_banco_folder set planpago=? where iddeudabancofolder =?;");
        $res18 = $sql18->execute([$ruta1d . "/" . $cplan3["name"], $iddeudabancoC3]);
      } else {
        $sql18 = $con->prepare("UPDATE deuda_banco_folder set planpago=? where iddeudabancofolder =?;");
        $res18 = $sql18->execute([$imadeudac[2]["planpago"], $iddeudabancoC3]);
      }
    } else {
      if ($_FILES["clientePlan3"]["name"] !== "") {
        $cplan3 = $_FILES["clientePlan3"];
        move_uploaded_file($cplan3["tmp_name"], $ruta1d . "/" . $cplan3["name"]);
        $sql18 = $con->prepare("UPDATE deuda_banco_folder set planpago=? where iddeudabancofolder =?;");
        $res18 = $sql18->execute([$ruta1d . "/" . $cplan3["name"], $iddeudabancoC3]);
      } else {
        $sql18 = $con->prepare("UPDATE deuda_banco_folder set planpago=? where iddeudabancofolder =?;");
        $res18 = $sql18->execute([null, $iddeudabancoC3]);
      }
    }
    if (verificaImagen($imagenesC, "ultimaboleta3")) {
      if ($_FILES["clienteCancelacion3"]["name"] !== "") {
        $cboleta3 = $_FILES["clienteCancelacion3"];
        move_uploaded_file($cboleta3["tmp_name"], $ruta1d . "/" . $cboleta3["name"]);
        $sql19 = $con->prepare("UPDATE deuda_banco_folder set ultimaboleta=? where iddeudabancofolder =?;");
        $res19 = $sql19->execute([$ruta1d . "/" . $cboleta3["name"], $iddeudabancoC3]);
      } else {
        $sql18 = $con->prepare("UPDATE deuda_banco_folder set ultimaboleta=? where iddeudabancofolder =?;");
        $res18 = $sql18->execute([$imadeudac[2]["ultimaboleta"], $iddeudabancoC3]);
      }
    } else {
      if ($_FILES["clienteCancelacion3"]["name"] !== "") {
        $cboleta3 = $_FILES["clienteCancelacion3"];
        move_uploaded_file($cboleta3["tmp_name"], $ruta1d . "/" . $cboleta3["name"]);
        $sql19 = $con->prepare("UPDATE deuda_banco_folder set ultimaboleta=? where iddeudabancofolder =?;");
        $res19 = $sql19->execute([$ruta1d . "/" . $cboleta3["name"], $iddeudabancoC3]);
      } else {
        $sql18 = $con->prepare("UPDATE deuda_banco_folder set ultimaboleta=? where iddeudabancofolder =?;");
        $res18 = $sql18->execute([null, $iddeudabancoC3]);
      }
    }
  }
  ///////////////////////////////BANCO 4///////////////////////////
  if ($_POST["selec_banco_cliente4"] !== "0") {
    $cbancodeuda4 = $_POST["selec_banco_cliente4"];
    $sql16 = $con->prepare("INSERT INTO deuda_banco_folder(folder,banco) VALUES (?, ?)");
    $res16 = $sql16->execute([$idfolderC, $cbancodeuda4]);

    $sql17 = $con->prepare("SELECT iddeudabancofolder FROM deuda_banco_folder WHERE folder=? and banco=?");
    $sql17->execute([$idfolderC, $cbancodeuda4]);
    $res17 = $sql17->fetch();
    $iddeudabancoC4 =  $res17["iddeudabancofolder"];

    if (verificaImagen($imagenesC, "planpago4")) {
      if ($_FILES["clientePlan4"]["name"] !== "") {
        $cplan4 = $_FILES["clientePlan4"];
        move_uploaded_file($cplan4["tmp_name"], $ruta1d . "/" . $cplan4["name"]);
        $sql18 = $con->prepare("UPDATE deuda_banco_folder set planpago=? where iddeudabancofolder =?;");
        $res18 = $sql18->execute([$ruta1d . "/" . $cplan4["name"], $iddeudabancoC4]);
      } else {
        $sql18 = $con->prepare("UPDATE deuda_banco_folder set planpago=? where iddeudabancofolder =?;");
        $res18 = $sql18->execute([$imadeudac[3]["planpago"], $iddeudabancoC4]);
      }
    } else {
      if ($_FILES["clientePlan4"]["name"] !== "") {
        $cplan4 = $_FILES["clientePlan4"];
        move_uploaded_file($cplan4["tmp_name"], $ruta1d . "/" . $cplan4["name"]);
        $sql18 = $con->prepare("UPDATE deuda_banco_folder set planpago=? where iddeudabancofolder =?;");
        $res18 = $sql18->execute([$ruta1d . "/" . $cplan4["name"], $iddeudabancoC4]);
      } else {
        $sql18 = $con->prepare("UPDATE deuda_banco_folder set planpago=? where iddeudabancofolder =?;");
        $res18 = $sql18->execute([null, $iddeudabancoC4]);
      }
    }
    if (verificaImagen($imagenesC, "ultimaboleta4")) {
      if ($_FILES["clienteCancelacion4"]["name"] !== "") {
        $cboleta4 = $_FILES["clienteCancelacion4"];
        move_uploaded_file($cboleta4["tmp_name"], $ruta1d . "/" . $cboleta4["name"]);
        $sql19 = $con->prepare("UPDATE deuda_banco_folder set ultimaboleta=? where iddeudabancofolder =?;");
        $res19 = $sql19->execute([$ruta1d . "/" . $cboleta4["name"], $iddeudabancoC4]);
      } else {
        $sql18 = $con->prepare("UPDATE deuda_banco_folder set ultimaboleta=? where iddeudabancofolder =?;");
        $res18 = $sql18->execute([$imadeudac[3]["ultimaboleta"], $iddeudabancoC4]);
      }
    } else {
      if ($_FILES["clienteCancelacion4"]["name"] !== "") {
        $cboleta4 = $_FILES["clienteCancelacion4"];
        move_uploaded_file($cboleta4["tmp_name"], $ruta1d . "/" . $cboleta4["name"]);
        $sql19 = $con->prepare("UPDATE deuda_banco_folder set ultimaboleta=? where iddeudabancofolder =?;");
        $res19 = $sql19->execute([$ruta1d . "/" . $cboleta4["name"], $iddeudabancoC4]);
      } else {
        $sql18 = $con->prepare("UPDATE deuda_banco_folder set ultimaboleta=? where iddeudabancofolder =?;");
        $res18 = $sql18->execute([null, $iddeudabancoC4]);
      }
    }
  }
  //----------------------------------------ACTUALIZANDO LISTA DE CLIENTE----------------------------//
  $sqlistaC = $con->prepare("SELECT idlistafolder FROM lista_folder WHERE folder=?");
  $sqlistaC->execute([$idfolderC]);
  $reslistaC = $sqlistaC->fetch();
  $idfolderlistaC =  $reslistaC["idlistafolder"];

  if (isset($_POST["checkCliente1"])) {
    $ccheck1 = "si";
  } else {
    $ccheck1 = "no";
  }

  if (isset($_POST["checkCliente2"])) {
    $ccheck2 = "si";
  } else {
    $ccheck2 = "no";
  }

  if (isset($_POST["checkCliente3"])) {
    $ccheck3 = "si";
  } else {
    $ccheck3 = "no";
  }
  if (isset($_POST["checkCliente4"])) {
    $ccheck4 = "si";
  } else {
    $ccheck4 = "no";
  }
  if (isset($_POST["checkCliente5"])) {
    $ccheck5 = "si";
  } else {
    $ccheck5 = "no";
  }
  if (isset($_POST["checkCliente6"])) {
    $ccheck6 = "si";
  } else {
    $ccheck6 = "no";
  }
  if (isset($_POST["checkCliente7"])) {
    $ccheck7 = "si";
  } else {
    $ccheck7 = "no";
  }
  if (isset($_POST["checkCliente8"])) {
    $ccheck8 = "si";
  } else {
    $ccheck8 = "no";
  }
  if (isset($_POST["checkCliente9"])) {
    $ccheck9 = "si";
  } else {
    $ccheck9 = "no";
  }

  if (isset($_POST["checkCliente10"])) {
    $ccheck10 = "si";
  } else {
    $ccheck10 = "no";
  }

  if (isset($_POST["checkCliente11"])) {
    $ccheck11 = "si";
  } else {
    $ccheck11 = "no";
  }

  if (isset($_POST["checkCliente12"])) {
    $ccheck12 = "si";
  } else {
    $ccheck12 = "no";
  }

  if (isset($_POST["checkCliente13"])) {
    $ccheck13 = "si";
  } else {
    $ccheck13 = "no";
  }

  if (isset($_POST["checkCliente14"])) {
    $ccheck14 = "si";
  } else {
    $ccheck14 = "no";
  }

  $sql32 = $con->prepare("UPDATE lista_folder set contrato=?,fotcarnet=?,facluz=?,
  facagua=?,croquis=?,folio=?,testimonio=?,impuesto=?,ruat=?,soat=?,nit=?,boletapago=?,
  afp=?,patente=? where idlistafolder =?;");
  $res32 = $sql32->execute([
    $ccheck1, $ccheck2, $ccheck3, $ccheck4, $ccheck5, $ccheck6,
    $ccheck7, $ccheck8, $ccheck9, $ccheck10, $ccheck11, $ccheck12, $ccheck13, $ccheck14,
    $idfolderlistaC
  ]);
  //-------------------------------------ACTUALIZANDO LISTA DEUDA BANCO CLIENTE-----------------------//
  $sentencia = $con->prepare("DELETE FROM lista_deuda_banco where listafolder=?");
  $resultado = $sentencia->execute([$idfolderlistaC]);

  if ($_POST["selec_deuda_lcliente1"] !== "0") {
    if ($_POST["selec_deuda_lcliente1"] !== null) {
      $ccheckb1 = $_POST["selec_deuda_lcliente1"];
      if (isset($_POST["checkCliente15"])) {
        $ccheck15 = "si";
      } else {
        $ccheck15 = "no";
      }
      if (isset($_POST["checkCliente16"])) {
        $ccheck16 = "si";
      } else {
        $ccheck16 = "no";
      }
      $sql33 = $con->prepare("INSERT INTO lista_deuda_banco(planpago,ultimaboleta,listafolder,banco) VALUES(?, ?, ?, ?);");
      $res33 = $sql33->execute([$ccheck15, $ccheck16, $idfolderlistaC, $ccheckb1]);
    }
  }
  if ($_POST["selec_deuda_lcliente2"] !== "0") {
    if ($_POST["selec_deuda_lcliente2"] !== null) {
      $ccheckb2 = $_POST["selec_deuda_lcliente2"];
      if (isset($_POST["checkCliente17"])) {
        $ccheck17 = "si";
      } else {
        $ccheck17 = "no";
      }
      if (isset($_POST["checkCliente18"])) {
        $ccheck18 = "si";
      } else {
        $ccheck18 = "no";
      }
      $sql33 = $con->prepare("INSERT INTO lista_deuda_banco(planpago,ultimaboleta,listafolder,banco) VALUES(?, ?, ?, ?);");
      $res33 = $sql33->execute([$ccheck17, $ccheck18, $idfolderlistaC, $ccheckb2]);
    }
  }
  if ($_POST["selec_deuda_lcliente3"] !== "0") {
    if ($_POST["selec_deuda_lcliente3"] !== null) {
      $ccheckb3 = $_POST["selec_deuda_lcliente3"];
      if (isset($_POST["checkCliente19"])) {
        $ccheck19 = "si";
      } else {
        $ccheck19 = "no";
      }
      if (isset($_POST["checkCliente20"])) {
        $ccheck20 = "si";
      } else {
        $ccheck20 = "no";
      }
      $sql33 = $con->prepare("INSERT INTO lista_deuda_banco(planpago,ultimaboleta,listafolder,banco) VALUES(?, ?, ?, ?);");
      $res33 = $sql33->execute([$ccheck19, $ccheck20, $idfolderlistaC, $ccheckb3]);
    }
  }
  if ($_POST["selec_deuda_lcliente4"] !== "0") {
    if ($_POST["selec_deuda_lcliente4"] !== null) {
      $ccheckb4 = $_POST["selec_deuda_lcliente4"];
      if (isset($_POST["checkCliente21"])) {
        $ccheck21 = "si";
      } else {
        $ccheck21 = "no";
      }
      if (isset($_POST["checkCliente22"])) {
        $ccheck22 = "si";
      } else {
        $ccheck22 = "no";
      }
      $sql33 = $con->prepare("INSERT INTO lista_deuda_banco(planpago,ultimaboleta,listafolder,banco) VALUES(?, ?, ?, ?);");
      $res33 = $sql33->execute([$ccheck21, $ccheck22, $idfolderlistaC, $ccheckb4]);
    }
  }

  //------------------------------------------ACTUALIZANDO EXP.GARANTE-----------------------------------//
  if (verificaImagen($imagenesG, "carnet")) {
    if ($_FILES["garanteCarnet"]["name"] !== "") {
      $carnet = $_FILES["garanteCarnet"];
      move_uploaded_file($carnet["tmp_name"], $ruta2 . "/" . $carnet["name"]);
      $sql1 = $con->prepare("UPDATE folder set fotcarnet=? where idfolder =?;");
      $res1 = $sql1->execute([$ruta2 . "/" . $carnet["name"], $idfolderG]);
    }
  } else {
    if ($_FILES["garanteCarnet"]["name"] !== "") {
      $carnet = $_FILES["garanteCarnet"];
      move_uploaded_file($carnet["tmp_name"], $ruta2 . "/" . $carnet["name"]);
      $sql1 = $con->prepare("UPDATE folder set fotcarnet=? where idfolder =?;");
      $res1 = $sql1->execute([$ruta2 . "/" . $carnet["name"], $idfolderG]);
    } else {
      $sql1 = $con->prepare("UPDATE folder set fotcarnet=? where idfolder =?;");
      $res1 = $sql1->execute([null, $idfolderG]);
    }
  }

  if (verificaImagen($imagenesG, "luz")) {
    if ($_FILES["garanteFacLuz"]["name"] !== "") {
      $luz = $_FILES["garanteFacLuz"];
      move_uploaded_file($luz["tmp_name"], $ruta2 . "/" . $luz["name"]);
      $sql2 = $con->prepare("UPDATE folder set facluz=? where idfolder =?;");
      $res2 = $sql2->execute([$ruta2 . "/" . $luz["name"], $idfolderG]);
    }
  } else {
    if ($_FILES["garanteFacLuz"]["name"] !== "") {
      $luz = $_FILES["garanteFacLuz"];
      move_uploaded_file($luz["tmp_name"], $ruta2 . "/" . $luz["name"]);
      $sql2 = $con->prepare("UPDATE folder set facluz=? where idfolder =?;");
      $res2 = $sql2->execute([$ruta2 . "/" . $luz["name"], $idfolderG]);
    } else {
      $sql2 = $con->prepare("UPDATE folder set facluz=? where idfolder =?;");
      $res2 = $sql2->execute([null, $idfolderG]);
    }
  }

  if (verificaImagen($imagenesG, "agua")) {
    if ($_FILES["garanteFacAgua"]["name"] !== "") {
      $agua = $_FILES["garanteFacAgua"];
      move_uploaded_file($agua["tmp_name"], $ruta2 . "/" . $agua["name"]);
      $sql3 = $con->prepare("UPDATE folder set facagua=? where idfolder =?;");
      $res3 = $sql3->execute([$ruta2 . "/" . $agua["name"], $idfolderG]);
    }
  } else {
    if ($_FILES["garanteFacAgua"]["name"] !== "") {
      $agua = $_FILES["garanteFacAgua"];
      move_uploaded_file($agua["tmp_name"], $ruta2 . "/" . $agua["name"]);
      $sql3 = $con->prepare("UPDATE folder set facagua=? where idfolder =?;");
      $res3 = $sql3->execute([$ruta2 . "/" . $agua["name"], $idfolderG]);
    } else {
      $sql3 = $con->prepare("UPDATE folder set facagua=? where idfolder =?;");
      $res3 = $sql3->execute([null, $idfolderG]);
    }
  }

  if (verificaImagen($imagenesG, "croquis")) {
    if ($_FILES["garanteCroquis"]["name"] !== "") {
      $croquis = $_FILES["garanteCroquis"];
      move_uploaded_file($croquis["tmp_name"], $ruta2 . "/" . $croquis["name"]);
      $sql4 = $con->prepare("UPDATE folder set croquis=? where idfolder =?;");
      $res4 = $sql4->execute([$ruta2 . "/" . $croquis["name"], $idfolderG]);
    }
  } else {
    if ($_FILES["garanteCroquis"]["name"] !== "") {
      $croquis = $_FILES["garanteCroquis"];
      move_uploaded_file($croquis["tmp_name"], $ruta2 . "/" . $croquis["name"]);
      $sql4 = $con->prepare("UPDATE folder set croquis=? where idfolder =?;");
      $res4 = $sql4->execute([$ruta2 . "/" . $croquis["name"], $idfolderG]);
    } else {
      $sql4 = $con->prepare("UPDATE folder set croquis=? where idfolder =?;");
      $res4 = $sql4->execute([null, $idfolderG]);
    }
  }

  if (verificaImagen($imagenesG, "folio")) {
    if ($_FILES["garanteFolioReal"]["name"] !== "") {
      $folio = $_FILES["garanteFolioReal"];
      move_uploaded_file($folio["tmp_name"], $ruta2 . "/" . $folio["name"]);
      $sql5 = $con->prepare("UPDATE folder set folio=? where idfolder =?;");
      $res5 = $sql5->execute([$ruta2 . "/" . $folio["name"], $idfolderG]);
    }
  } else {
    if ($_FILES["garanteFolioReal"]["name"] !== "") {
      $folio = $_FILES["garanteFolioReal"];
      move_uploaded_file($folio["tmp_name"], $ruta2 . "/" . $folio["name"]);
      $sql5 = $con->prepare("UPDATE folder set folio=? where idfolder =?;");
      $res5 = $sql5->execute([$ruta2 . "/" . $folio["name"], $idfolderG]);
    } else {
      $sql5 = $con->prepare("UPDATE folder set croquis=? where idfolder =?;");
      $res5 = $sql5->execute([null, $idfolderG]);
    }
  }
  if (verificaImagen($imagenesG, "testimonio")) {
    if ($_FILES["garanteTestimonio"]["name"] !== "") {
      $testimonio = $_FILES["garanteTestimonio"];
      move_uploaded_file($testimonio["tmp_name"], $ruta2 . "/" . $testimonio["name"]);
      $sql6 = $con->prepare("UPDATE folder set testimonio=? where idfolder =?;");
      $res6 = $sql6->execute([$ruta2 . "/" . $folio["name"], $idfolderG]);
    }
  } else {
    if ($_FILES["garanteTestimonio"]["name"] !== "") {
      $testimonio = $_FILES["garanteTestimonio"];
      move_uploaded_file($testimonio["tmp_name"], $ruta2 . "/" . $testimonio["name"]);
      $sql6 = $con->prepare("UPDATE folder set testimonio=? where idfolder =?;");
      $res6 = $sql6->execute([$ruta2 . "/" . $folio["name"], $idfolderG]);
    } else {
      $sql6 = $con->prepare("UPDATE folder set testimonio=? where idfolder =?;");
      $res6 = $sql6->execute([null, $idfolderG]);
    }
  }

  if (verificaImagen($imagenesG, "impuesto")) {
    if ($_FILES["garanteImpuesto"]["name"] !== "") {
      $impuesto = $_FILES["garanteImpuesto"];
      move_uploaded_file($impuesto["tmp_name"], $ruta2 . "/" . $impuesto["name"]);
      $sql7 = $con->prepare("UPDATE folder set impuesto=? where idfolder =?;");
      $res7 = $sql7->execute([$ruta2 . "/" . $impuesto["name"], $idfolderG]);
    }
  } else {
    if ($_FILES["garanteImpuesto"]["name"] !== "") {
      $impuesto = $_FILES["garanteImpuesto"];
      move_uploaded_file($impuesto["tmp_name"], $ruta2 . "/" . $impuesto["name"]);
      $sql7 = $con->prepare("UPDATE folder set impuesto=? where idfolder =?;");
      $res7 = $sql7->execute([$ruta2 . "/" . $impuesto["name"], $idfolderG]);
    } else {
      $sql7 = $con->prepare("UPDATE folder set impuesto=? where idfolder =?;");
      $res7 = $sql7->execute([null, $idfolderG]);
    }
  }

  if (verificaImagen($imagenesG, "ruat")) {
    if ($_FILES["garanteRuat"]["name"] !== "") {
      $ruat = $_FILES["garanteRuat"];
      move_uploaded_file($ruat["tmp_name"], $ruta2 . "/" . $ruat["name"]);
      $sql8 = $con->prepare("UPDATE folder set ruat=? where idfolder =?;");
      $res8 = $sql8->execute([$ruta2 . "/" . $ruat["name"], $idfolderG]);
    }
  } else {
    if ($_FILES["garanteRuat"]["name"] !== "") {
      $ruat = $_FILES["garanteRuat"];
      move_uploaded_file($ruat["tmp_name"], $ruta2 . "/" . $ruat["name"]);
      $sql8 = $con->prepare("UPDATE folder set ruat=? where idfolder =?;");
      $res8 = $sql8->execute([$ruta2 . "/" . $ruat["name"], $idfolderG]);
    } else {
      $sql8 = $con->prepare("UPDATE folder set ruat=? where idfolder =?;");
      $res8 = $sql8->execute([null, $idfolderG]);
    }
  }
  if (verificaImagen($imagenesG, "soat")) {
    if ($_FILES["garanteSoat"]["name"] !== "") {
      $soat = $_FILES["garanteSoat"];
      move_uploaded_file($soat["tmp_name"], $ruta2 . "/" . $soat["name"]);
      $sql9 = $con->prepare("UPDATE folder set soat=? where idfolder =?;");
      $res9 = $sql9->execute([$ruta2 . "/" . $soat["name"], $idfolderG]);
    }
  } else {
    if ($_FILES["garanteSoat"]["name"] !== "") {
      $soat = $_FILES["garanteSoat"];
      move_uploaded_file($soat["tmp_name"], $ruta2 . "/" . $soat["name"]);
      $sql9 = $con->prepare("UPDATE folder set soat=? where idfolder =?;");
      $res9 = $sql9->execute([$ruta2 . "/" . $soat["name"], $idfolderG]);
    } else {
      $sql9 = $con->prepare("UPDATE folder set soat=? where idfolder =?;");
      $res9 = $sql9->execute([null, $idfolderG]);
    }
  }
  if (verificaImagen($imagenesG, "nit")) {
    if ($_FILES["garanteNit"]["name"] !== "") {
      $nit = $_FILES["garanteNit"];
      move_uploaded_file($nit["tmp_name"], $ruta2 . "/" . $nit["name"]);
      $sql10 = $con->prepare("UPDATE folder set nit=? where idfolder =?;");
      $res10 = $sql10->execute([$ruta2 . "/" . $nit["name"], $idfolderG]);
    }
  } else {
    if ($_FILES["garanteNit"]["name"] !== "") {
      $nit = $_FILES["garanteNit"];
      move_uploaded_file($nit["tmp_name"], $ruta2 . "/" . $nit["name"]);
      $sql10 = $con->prepare("UPDATE folder set nit=? where idfolder =?;");
      $res10 = $sql10->execute([$ruta2 . "/" . $nit["name"], $idfolderG]);
    } else {
      $sql10 = $con->prepare("UPDATE folder set nit=? where idfolder =?;");
      $res10 = $sql10->execute([null, $idfolderG]);
    }
  }
  if (verificaImagen($imagenesG, "patente")) {
    if ($_FILES["garantePatente"]["name"] !== "") {
      $patente = $_FILES["garantePatente"];
      move_uploaded_file($patente["tmp_name"], $ruta2 . "/" . $patente["name"]);
      $sql11 = $con->prepare("UPDATE folder set patente=? where idfolder =?;");
      $res11 = $sql11->execute([$ruta2 . "/" . $patente["name"], $idfolderG]);
    }
  } else {
    if ($_FILES["garantePatente"]["name"] !== "") {
      $patente = $_FILES["garantePatente"];
      move_uploaded_file($patente["tmp_name"], $ruta2 . "/" . $patente["name"]);
      $sql11 = $con->prepare("UPDATE folder set patente=? where idfolder =?;");
      $res11 = $sql11->execute([$ruta2 . "/" . $patente["name"], $idfolderG]);
    } else {
      $sql11 = $con->prepare("UPDATE folder set patente=? where idfolder =?;");
      $res11 = $sql11->execute([null, $idfolderG]);
    }
  }
  if (verificaImagen($imagenesG, "boletapago")) {
    if ($_FILES["garanteBoletaPago"]["name"] !== "") {
      $boletapago = $_FILES["garanteBoletaPago"];
      move_uploaded_file($boletapago["tmp_name"], $ruta2 . "/" . $boletapago["name"]);
      $sql12 = $con->prepare("UPDATE folder set boletapago=? where idfolder =?;");
      $res12 = $sql12->execute([$ruta2 . "/" . $boletapago["name"], $idfolderG]);
    }
  } else {
    if ($_FILES["garanteBoletaPago"]["name"] !== "") {
      $boletapago = $_FILES["garanteBoletaPago"];
      move_uploaded_file($boletapago["tmp_name"], $ruta2 . "/" . $boletapago["name"]);
      $sql12 = $con->prepare("UPDATE folder set boletapago=? where idfolder =?;");
      $res12 = $sql12->execute([$ruta2 . "/" . $boletapago["name"], $idfolderG]);
    } else {
      $sql12 = $con->prepare("UPDATE folder set boletapago=? where idfolder =?;");
      $res12 = $sql12->execute([null, $idfolderG]);
    }
  }
  if (verificaImagen($imagenesG, "afp")) {
    if ($_FILES["garanteAfp"]["name"] !== "") {
      $afp = $_FILES["garanteAfp"];
      move_uploaded_file($afp["tmp_name"], $ruta2 . "/" . $afp["name"]);
      $sql13 = $con->prepare("UPDATE folder set afp=? where idfolder =?;");
      $res13 = $sql13->execute([$ruta2 . "/" . $afp["name"], $idfolderG]);
    }
  } else {
    if ($_FILES["garanteAfp"]["name"] !== "") {
      $afp = $_FILES["garanteAfp"];
      move_uploaded_file($afp["tmp_name"], $ruta2 . "/" . $afp["name"]);
      $sql13 = $con->prepare("UPDATE folder set afp=? where idfolder =?;");
      $res13 = $sql13->execute([$ruta2 . "/" . $afp["name"], $idfolderG]);
    } else {
      $sql13 = $con->prepare("UPDATE folder set afp=? where idfolder =?;");
      $res13 = $sql13->execute([null, $idfolderG]);
    }
  }
  //--------------------------------ACTUALIZANDO DEUDA BANCO FOLDER GARANTE---------------------------//

  $sentencia = $con->prepare("SELECT planpago,ultimaboleta from deuda_banco_folder where folder=?");
  $resultado = $sentencia->execute([$idfolderG]);
  $resultado = $sentencia->fetchAll();
  $imadeudag = $resultado;
  $sentencia = $con->prepare("DELETE FROM deuda_banco_folder where folder=?");
  $resultado = $sentencia->execute([$idfolderG]);


  ///////////////////////////////BANCO 1///////////////////////////
  if ($_POST["selec_banco_garante1"] !== "0") {
    $gbancodeuda1 = $_POST["selec_banco_garante1"];
    $sql16 = $con->prepare("INSERT INTO deuda_banco_folder(folder,banco) VALUES (?, ?)");
    $res16 = $sql16->execute([$idfolderG, $gbancodeuda1]);

    $sql17 = $con->prepare("SELECT iddeudabancofolder FROM deuda_banco_folder WHERE folder=? and banco=?");
    $sql17->execute([$idfolderG, $gbancodeuda1]);
    $res17 = $sql17->fetch();
    $iddeudabancoG1 =  $res17["iddeudabancofolder"];
    if (verificaImagen($imagenesG, "planpago1")) {
      if ($_FILES["garantePlan1"]["name"] !== "") {
        $gplan1 = $_FILES["garantePlan1"];
        move_uploaded_file($gplan1["tmp_name"], $ruta2d . "/" . $gplan1["name"]);
        $sql18 = $con->prepare("UPDATE deuda_banco_folder set planpago=? where iddeudabancofolder =?;");
        $res18 = $sql18->execute([$ruta2d . "/" . $gplan1["name"], $iddeudabancoG1]);
      } else {
        $sql18 = $con->prepare("UPDATE deuda_banco_folder set planpago=? where iddeudabancofolder =?;");
        $res18 = $sql18->execute([$imadeudag[0]["planpago"], $iddeudabancoG1]);
      }
    } else {
      if ($_FILES["garantePlan1"]["name"] !== "") {
        $gplan1 = $_FILES["garantePlan1"];
        move_uploaded_file($gplan1["tmp_name"], $ruta2d . "/" . $gplan1["name"]);
        $sql18 = $con->prepare("UPDATE deuda_banco_folder set planpago=? where iddeudabancofolder =?;");
        $res18 = $sql18->execute([$ruta2d . "/" . $gplan1["name"], $iddeudabancoG1]);
      } else {
        $sql18 = $con->prepare("UPDATE deuda_banco_folder set planpago=? where iddeudabancofolder =?;");
        $res18 = $sql18->execute([null, $iddeudabancoG1]);
      }
    }

    if (verificaImagen($imagenesG, "ultimaboleta1")) {
      if ($_FILES["garanteCancelacion1"]["name"] !== "") {
        $gboleta1 = $_FILES["garanteCancelacion1"];
        move_uploaded_file($gboleta1["tmp_name"], $ruta2d . "/" . $gboleta1["name"]);
        $sql19 = $con->prepare("UPDATE deuda_banco_folder set ultimaboleta=? where iddeudabancofolder =?;");
        $res19 = $sql19->execute([$ruta2d . "/" . $gboleta1["name"], $iddeudabancoG1]);
      } else {
        $sql18 = $con->prepare("UPDATE deuda_banco_folder set ultimaboleta=? where iddeudabancofolder =?;");
        $res18 = $sql18->execute([$imadeudag[0]["ultimaboleta"], $iddeudabancoG1]);
      }
    } else {
      if ($_FILES["garanteCancelacion1"]["name"] !== "") {
        $gboleta1 = $_FILES["garanteCancelacion1"];
        move_uploaded_file($gboleta1["tmp_name"], $ruta2d . "/" . $gboleta1["name"]);
        $sql19 = $con->prepare("UPDATE deuda_banco_folder set ultimaboleta=? where iddeudabancofolder =?;");
        $res19 = $sql19->execute([$ruta2d . "/" . $gboleta1["name"], $iddeudabancoG1]);
      } else {
        $sql18 = $con->prepare("UPDATE deuda_banco_folder set ultimaboleta=? where iddeudabancofolder =?;");
        $res18 = $sql18->execute([null, $iddeudabancoG1]);
      }
    }
  }
  //////////////////////////////BANCO 2///////////////////////////
  if ($_POST["selec_banco_garante2"] !== "0") {
    $gbancodeuda2 = $_POST["selec_banco_garante2"];
    $sql16 = $con->prepare("INSERT INTO deuda_banco_folder(folder,banco) VALUES (?, ?)");
    $res16 = $sql16->execute([$idfolderG, $gbancodeuda2]);

    $sql17 = $con->prepare("SELECT iddeudabancofolder FROM deuda_banco_folder WHERE folder=? and banco=?");
    $sql17->execute([$idfolderG, $gbancodeuda2]);
    $res17 = $sql17->fetch();
    $iddeudabancoG2 =  $res17["iddeudabancofolder"];
    if (verificaImagen($imagenesG, "planpago2")) {
      if ($_FILES["garantePlan2"]["name"] !== "") {
        $gplan2 = $_FILES["garantePlan2"];
        move_uploaded_file($gplan2["tmp_name"], $ruta2d . "/" . $gplan2["name"]);
        $sql18 = $con->prepare("UPDATE deuda_banco_folder set planpago=? where iddeudabancofolder =?;");
        $res18 = $sql18->execute([$ruta2d . "/" . $gplan2["name"], $iddeudabancoG2]);
      } else {
        $sql18 = $con->prepare("UPDATE deuda_banco_folder set planpago=? where iddeudabancofolder =?;");
        $res18 = $sql18->execute([$imadeudag[1]["planpago"], $iddeudabancoG2]);
      }
    } else {
      if ($_FILES["garantePlan2"]["name"] !== "") {
        $gplan2 = $_FILES["garantePlan2"];
        move_uploaded_file($gplan2["tmp_name"], $ruta2d . "/" . $gplan2["name"]);
        $sql18 = $con->prepare("UPDATE deuda_banco_folder set planpago=? where iddeudabancofolder =?;");
        $res18 = $sql18->execute([$ruta2d . "/" . $gplan2["name"], $iddeudabancoG2]);
      } else {
        $sql18 = $con->prepare("UPDATE deuda_banco_folder set planpago=? where iddeudabancofolder =?;");
        $res18 = $sql18->execute([null, $iddeudabancoG2]);
      }
    }

    if (verificaImagen($imagenesG, "ultimaboleta2")) {
      if ($_FILES["garanteCancelacion2"]["name"] !== "") {
        $gboleta2 = $_FILES["garanteCancelacion2"];
        move_uploaded_file($gboleta2["tmp_name"], $ruta2d . "/" . $gboleta2["name"]);
        $sql19 = $con->prepare("UPDATE deuda_banco_folder set ultimaboleta=? where iddeudabancofolder =?;");
        $res19 = $sql19->execute([$ruta2d . "/" . $gboleta2["name"], $iddeudabancoG2]);
      } else {
        $sql18 = $con->prepare("UPDATE deuda_banco_folder set ultimaboleta=? where iddeudabancofolder =?;");
        $res18 = $sql18->execute([$imadeudag[1]["ultimaboleta"], $iddeudabancoG2]);
      }
    } else {
      if ($_FILES["garanteCancelacion2"]["name"] !== "") {
        $gboleta2 = $_FILES["garanteCancelacion2"];
        move_uploaded_file($gboleta2["tmp_name"], $ruta2d . "/" . $gboleta2["name"]);
        $sql19 = $con->prepare("UPDATE deuda_banco_folder set ultimaboleta=? where iddeudabancofolder =?;");
        $res19 = $sql19->execute([$ruta2d . "/" . $gboleta2["name"], $iddeudabancoG2]);
      } else {
        $sql18 = $con->prepare("UPDATE deuda_banco_folder set ultimaboleta=? where iddeudabancofolder =?;");
        $res18 = $sql18->execute([null, $iddeudabancoG2]);
      }
    }
  }
  /////////////////////////////BANCO 3////////////////////////////
  if ($_POST["selec_banco_garante3"] !== "0") {
    $gbancodeuda3 = $_POST["selec_banco_garante3"];
    $sql16 = $con->prepare("INSERT INTO deuda_banco_folder(folder,banco) VALUES (?, ?)");
    $res16 = $sql16->execute([$idfolderG, $gbancodeuda3]);

    $sql17 = $con->prepare("SELECT iddeudabancofolder FROM deuda_banco_folder WHERE folder=? and banco=?");
    $sql17->execute([$idfolderG, $gbancodeuda3]);
    $res17 = $sql17->fetch();
    $iddeudabancoG3 =  $res17["iddeudabancofolder"];
    if (verificaImagen($imagenesG, "planpago3")) {
      if ($_FILES["garantePlan3"]["name"] !== "") {
        $gplan3 = $_FILES["garantePlan3"];
        move_uploaded_file($gplan3["tmp_name"], $ruta2d . "/" . $gplan3["name"]);
        $sql18 = $con->prepare("UPDATE deuda_banco_folder set planpago=? where iddeudabancofolder =?;");
        $res18 = $sql18->execute([$ruta2d . "/" . $gplan3["name"], $iddeudabancoG3]);
      } else {
        $sql18 = $con->prepare("UPDATE deuda_banco_folder set planpago=? where iddeudabancofolder =?;");
        $res18 = $sql18->execute([$imadeudag[2]["planpago"], $iddeudabancoG3]);
      }
    } else {
      if ($_FILES["garantePlan3"]["name"] !== "") {
        $gplan3 = $_FILES["garantePlan3"];
        move_uploaded_file($gplan3["tmp_name"], $ruta2d . "/" . $gplan3["name"]);
        $sql18 = $con->prepare("UPDATE deuda_banco_folder set planpago=? where iddeudabancofolder =?;");
        $res18 = $sql18->execute([$ruta2d . "/" . $gplan3["name"], $iddeudabancoG3]);
      } else {
        $sql18 = $con->prepare("UPDATE deuda_banco_folder set planpago=? where iddeudabancofolder =?;");
        $res18 = $sql18->execute([null, $iddeudabancoG3]);
      }
    }

    if (verificaImagen($imagenesG, "ultimaboleta3")) {
      if ($_FILES["garanteCancelacion3"]["name"] !== "") {
        $gboleta3 = $_FILES["garanteCancelacion3"];
        move_uploaded_file($gboleta3["tmp_name"], $ruta2d . "/" . $gboleta3["name"]);
        $sql19 = $con->prepare("UPDATE deuda_banco_folder set ultimaboleta=? where iddeudabancofolder =?;");
        $res19 = $sql19->execute([$ruta2d . "/" . $gboleta3["name"], $iddeudabancoG3]);
      } else {
        $sql18 = $con->prepare("UPDATE deuda_banco_folder set ultimaboleta=? where iddeudabancofolder =?;");
        $res18 = $sql18->execute([$imadeudag[2]["ultimaboleta"], $iddeudabancoG3]);
      }
    } else {
      if ($_FILES["garanteCancelacion3"]["name"] !== "") {
        $gboleta3 = $_FILES["garanteCancelacion3"];
        move_uploaded_file($gboleta3["tmp_name"], $ruta2d . "/" . $gboleta3["name"]);
        $sql19 = $con->prepare("UPDATE deuda_banco_folder set ultimaboleta=? where iddeudabancofolder =?;");
        $res19 = $sql19->execute([$ruta2d . "/" . $gboleta3["name"], $iddeudabancoG3]);
      } else {
        $sql18 = $con->prepare("UPDATE deuda_banco_folder set ultimaboleta=? where iddeudabancofolder =?;");
        $res18 = $sql18->execute([null, $iddeudabancoG3]);
      }
    }
  }
  /////////////////////////////BANCO 4////////////////////////////
  if ($_POST["selec_banco_garante4"] !== "0") {
    $gbancodeuda4 = $_POST["selec_banco_garante4"];
    $sql16 = $con->prepare("INSERT INTO deuda_banco_folder(folder,banco) VALUES (?, ?)");
    $res16 = $sql16->execute([$idfolderG, $gbancodeuda4]);

    $sql17 = $con->prepare("SELECT iddeudabancofolder FROM deuda_banco_folder WHERE folder=? and banco=?");
    $sql17->execute([$idfolderG, $gbancodeuda4]);
    $res17 = $sql17->fetch();
    $iddeudabancoG4 =  $res17["iddeudabancofolder"];
    if (verificaImagen($imagenesG, "planpago4")) {
      if ($_FILES["garantePlan4"]["name"] !== "") {
        $gplan4 = $_FILES["garantePlan4"];
        move_uploaded_file($gplan4["tmp_name"], $ruta2d . "/" . $gplan["name"]);
        $sql18 = $con->prepare("UPDATE deuda_banco_folder set planpago=? where iddeudabancofolder =?;");
        $res18 = $sql18->execute([$ruta2d . "/" . $gplan4["name"], $iddeudabancoG4]);
      } else {
        $sql18 = $con->prepare("UPDATE deuda_banco_folder set planpago=? where iddeudabancofolder =?;");
        $res18 = $sql18->execute([$imadeudag[3]["planpago"], $iddeudabancoG4]);
      }
    } else {
      if ($_FILES["garantePlan4"]["name"] !== "") {
        $gplan4 = $_FILES["garantePlan4"];
        move_uploaded_file($gplan4["tmp_name"], $ruta2d . "/" . $gplan["name"]);
        $sql18 = $con->prepare("UPDATE deuda_banco_folder set planpago=? where iddeudabancofolder =?;");
        $res18 = $sql18->execute([$ruta2d . "/" . $gplan4["name"], $iddeudabancoG4]);
      } else {
        $sql18 = $con->prepare("UPDATE deuda_banco_folder set planpago=? where iddeudabancofolder =?;");
        $res18 = $sql18->execute([null, $iddeudabancoG4]);
      }
    }

    if (verificaImagen($imagenesG, "ultimaboleta4")) {
      if ($_FILES["garanteCancelacion4"]["name"] !== "") {
        $gboleta4 = $_FILES["garanteCancelacion4"];
        move_uploaded_file($gboleta4["tmp_name"], $ruta2d . "/" . $gboleta4["name"]);
        $sql19 = $con->prepare("UPDATE deuda_banco_folder set ultimaboleta=? where iddeudabancofolder =?;");
        $res19 = $sql19->execute([$ruta2d . "/" . $gboleta4["name"], $iddeudabancoG4]);
      } else {
        $sql18 = $con->prepare("UPDATE deuda_banco_folder set ultimaboleta=? where iddeudabancofolder =?;");
        $res18 = $sql18->execute([$imadeudag[3]["ultimaboleta"], $iddeudabancoG4]);
      }
    } else {
      if ($_FILES["garanteCancelacion4"]["name"] !== "") {
        $gboleta4 = $_FILES["garanteCancelacion4"];
        move_uploaded_file($gboleta4["tmp_name"], $ruta2d . "/" . $gboleta4["name"]);
        $sql19 = $con->prepare("UPDATE deuda_banco_folder set ultimaboleta=? where iddeudabancofolder =?;");
        $res19 = $sql19->execute([$ruta2d . "/" . $gboleta4["name"], $iddeudabancoG4]);
      } else {
        $sql18 = $con->prepare("UPDATE deuda_banco_folder set ultimaboleta=? where iddeudabancofolder =?;");
        $res18 = $sql18->execute([null, $iddeudabancoG4]);
      }
    }
  }
  //----------------------------------------ACTUALIZANDO LISTA DE GARANTE----------------------------//
  $sqlistaG = $con->prepare("SELECT idlistafolder FROM lista_folder WHERE folder=?");
  $sqlistaG->execute([$idfolderG]);
  $reslistaG = $sqlistaG->fetch();
  $idfolderlistaG =  $reslistaG["idlistafolder"];

  if (isset($_POST["checkGarante1"])) {
    $gcheck1 = "si";
  } else {
    $gcheck1 = "no";
  }

  if (isset($_POST["checkGarante2"])) {
    $gcheck2 = "si";
  } else {
    $gcheck2 = "no";
  }

  if (isset($_POST["checkGarante3"])) {
    $gcheck3 = "si";
  } else {
    $gcheck3 = "no";
  }
  if (isset($_POST["checkGarante4"])) {
    $gcheck4 = "si";
  } else {
    $gcheck4 = "no";
  }
  if (isset($_POST["checkGarante5"])) {
    $gcheck5 = "si";
  } else {
    $gcheck5 = "no";
  }
  if (isset($_POST["checkGarante6"])) {
    $gcheck6 = "si";
  } else {
    $gcheck6 = "no";
  }
  if (isset($_POST["checkGarante7"])) {
    $gcheck7 = "si";
  } else {
    $gcheck7 = "no";
  }
  if (isset($_POST["checkGarante8"])) {
    $gcheck8 = "si";
  } else {
    $gcheck8 = "no";
  }
  if (isset($_POST["checkGarante9"])) {
    $gcheck9 = "si";
  } else {
    $gcheck9 = "no";
  }

  if (isset($_POST["checkGarante10"])) {
    $gcheck10 = "si";
  } else {
    $gcheck10 = "no";
  }

  if (isset($_POST["checkGarante11"])) {
    $gcheck11 = "si";
  } else {
    $gcheck11 = "no";
  }

  if (isset($_POST["checkGarante12"])) {
    $gcheck12 = "si";
  } else {
    $gcheck12 = "no";
  }

  if (isset($_POST["checkGarante13"])) {
    $gcheck13 = "si";
  } else {
    $gcheck13 = "no";
  }

  $sql32 = $con->prepare("UPDATE lista_folder set fotcarnet=?,facluz=?,
  facagua=?,croquis=?,folio=?,testimonio=?,impuesto=?,ruat=?,soat=?,nit=?,boletapago=?,
  afp=?,patente=? where idlistafolder =?;");
  $res32 = $sql32->execute([
    $gcheck1, $gcheck2, $gcheck3, $gcheck4, $gcheck5, $gcheck6,
    $gcheck7, $gcheck8, $gcheck9, $gcheck10, $gcheck11, $gcheck12, $gcheck13,
    $idfolderlistaG
  ]);
  //-------------------------------------ACTUALIZANDO LISTA DEUDA BANCO CLIENTE-----------------------//
  $sentencia = $con->prepare("DELETE FROM lista_deuda_banco where listafolder=?");
  $resultado = $sentencia->execute([$idfolderlistaG]);

  if ($_POST["selec_deuda_garante1"] !== "0") {
    if ($_POST["selec_deuda_garante1"] !== null) {
      $gcheckb1 = $_POST["selec_deuda_garante1"];
      if (isset($_POST["checkGarante14"])) {
        $gcheck14 = "si";
      } else {
        $gcheck14 = "no";
      }
      if (isset($_POST["checkGarante15"])) {
        $gcheck15 = "si";
      } else {
        $gcheck15 = "no";
      }
      $sql33 = $con->prepare("INSERT INTO lista_deuda_banco(planpago,ultimaboleta,listafolder,banco) VALUES(?, ?, ?, ?);");
      $res33 = $sql33->execute([$gcheck14, $gcheck15, $idfolderlistaG, $gcheckb1]);
    }
  }
  if ($_POST["selec_deuda_garante2"] !== "0") {
    if ($_POST["selec_deuda_garante2"] !== null) {
      $gcheckb2 = $_POST["selec_deuda_garante2"];
      if (isset($_POST["checkGarante16"])) {
        $gcheck16 = "si";
      } else {
        $gcheck16 = "no";
      }
      if (isset($_POST["checkGarante17"])) {
        $gcheck17 = "si";
      } else {
        $gcheck17 = "no";
      }
      $sql33 = $con->prepare("INSERT INTO lista_deuda_banco(planpago,ultimaboleta,listafolder,banco) VALUES(?, ?, ?, ?);");
      $res33 = $sql33->execute([$gcheck16, $gcheck17, $idfolderlistaG, $gcheckb2]);
    }
  }
  if ($_POST["selec_deuda_garante3"] !== "0") {
    if ($_POST["selec_deuda_garante3"] !== null) {
      $gcheckb3 = $_POST["selec_deuda_garante3"];
      if (isset($_POST["checkGarante18"])) {
        $gcheck18 = "si";
      } else {
        $gcheck18 = "no";
      }
      if (isset($_POST["checkGarante19"])) {
        $gcheck19 = "si";
      } else {
        $gcheck19 = "no";
      }
      $sql33 = $con->prepare("INSERT INTO lista_deuda_banco(planpago,ultimaboleta,listafolder,banco) VALUES(?, ?, ?, ?);");
      $res33 = $sql33->execute([$gcheck18, $gcheck19, $idfolderlistaG, $gcheckb3]);
    }
  }
  if ($_POST["selec_deuda_garante4"] !== "0") {
    if ($_POST["selec_deuda_garante4"] !== null) {
      $gcheckb4 = $_POST["selec_deuda_garante4"];
      if (isset($_POST["checkGarante20"])) {
        $gcheck20 = "si";
      } else {
        $gcheck20 = "no";
      }
      if (isset($_POST["checkGarante21"])) {
        $gcheck21 = "si";
      } else {
        $gcheck21 = "no";
      }
      $sql33 = $con->prepare("INSERT INTO lista_deuda_banco(planpago,ultimaboleta,listafolder,banco) VALUES(?, ?, ?, ?);");
      $res33 = $sql33->execute([$gcheck20, $gcheck21, $idfolderlistaG, $gcheckb4]);
    }
  }
  echo "Actualizado";
}
function verificaImagen($vector, $imagen)
{
  if ($vector !== null) {
    if (in_array($imagen, $vector)) {
      return true;
    } else {
      return false;
    }
  } else {
    return false;
  }
}
function verificaBanco($banco, $folder)
{
  include '../scripts/conexion.php';
  $sentencia10 = $con->prepare("SELECT * from deuda_banco_folder where banco=? and folder =?;");
  $ressentencia10 = $sentencia10->execute([$banco, $folder]);
  $ressentencia10 = $sentencia10->fetchAll();
  if (count($ressentencia10) > 0) {
    return true;
  } else {
    return false;
  }
}
