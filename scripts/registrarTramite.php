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
$vehiculos = $_POST["vehiculos"];
$usuario = $_POST["usuario"];
$banco = $_POST["sel_banco"];
$monto = $_POST["monto_prestamo"];
$asesorCredito = $_POST["asesor_credito"];
$sucursal = $_POST["sucursal_banco"];
$observacion = $_POST["observacionT"];
$fechaini = date('d-m-Y', time());
$sentencia = $con->prepare("INSERT INTO tramitebancario(fechaini,cliente,usuario,banco,monto_prestamo,asesor_credito,sucursal,observacion) VALUES (?, ?, ?, ?, ?, ?, ?, ?);");
$resultado = $sentencia->execute([$fechaini, $cliente, $usuario, $banco, $monto,$asesorCredito,$sucursal,$observacion]);
if ($resultado === true) {
  $sentencia1 = $con->prepare("SELECT idtramitebancario FROM tramitebancario WHERE cliente=? and banco=?");
  $sentencia1->execute([$cliente, $banco]);
  $resultado1 = $sentencia1->fetch();
  $idtramite =  $resultado1["idtramitebancario"];
  foreach ($vehiculos as $vehiculo) {
    $v = (explode(',', $vehiculo));
    $marca = $v[0];
    $modelo = $v[1];
    $tipo = $v[2];
    $color = $v[3];
    $numpas = $v[4];
    $cilindrada = $v[5];
    $precio = $v[6];
    $sentencia2 = $con->prepare("INSERT INTO detalle_tramite(tramite,marca,modelo,tipo,color,nump,cilindrada, precio) VALUES (?, ?, ?, ?, ?, ?, ?,?);");
    $resultado2 = $sentencia2->execute([$idtramite, $marca, $modelo, $tipo, $color, $numpas, $cilindrada, $precio]); #
  }
  date_default_timezone_set('Etc/GMT-6');
  $hora = date('h:i:s:A', time() + 43200);
  $sentencia3 = $con->prepare("INSERT INTO estado_tramite(fecha,tramite,estado,hora) VALUES (?, ?, ?,?)");
  $resultado3 = $sentencia3->execute([$fechaini, $idtramite, '1', $hora]);
  $ruta = "../tramites/" . $cliente . "-" . $banco;
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
  }
  //---------------------CREANDO EXPEDIENTE CLIENTE Y GARANTE----------------------------------//
  $sql = $con->prepare("INSERT INTO folder(tramite,tipo) VALUES (?, ?)");
  $res = $sql->execute([$idtramite, 'cliente']);

  $sql1 = $con->prepare("INSERT INTO folder(tramite,tipo) VALUES (?, ?)");
  $res1 = $sql1->execute([$idtramite, 'garante']);


  if ($res && $res1) {
    $sqlfc = $con->prepare("SELECT idfolder FROM folder WHERE tramite=? and tipo=?");
    $sqlfc->execute([$idtramite, 'cliente']);
    $resfc = $sqlfc->fetch();
    $idfolderC =  $resfc["idfolder"];

    $sqlfg = $con->prepare("SELECT idfolder FROM folder WHERE tramite=? and tipo=?");
    $sqlfg->execute([$idtramite, 'garante']);
    $resfg = $sqlfg->fetch();
    $idfolderG =  $resfg["idfolder"];

    //****************CREAR LA LISTA DE DOCUMENTOS CLIENTE************ */
    $sqlistaC = $con->prepare("INSERT INTO lista_folder(folder) values (?)");
    $sqlistaresC = $sqlistaC->execute([$idfolderC]);

    //*****************CREAR LA LISTA DE DOCUMENTOS GARANTE */
    $sqlistaG = $con->prepare("INSERT INTO lista_folder(folder) values (?)");
    $sqlistaresG = $sqlistaG->execute([$idfolderG]);


    //--------------------------SUBIENDO IMAGENES DE CLIENTE CON UPDATE------------------------//
    if ($_FILES["clienteContrato"]["name"] !== "") {
      $contrato = $_FILES["clienteContrato"];
      move_uploaded_file($contrato["tmp_name"], $ruta1 . "/" . $contrato["name"]);
      $sql2 = $con->prepare("UPDATE folder set contrato=? where idfolder =?;");
      $res2 = $sql2->execute([$ruta1 . "/" . $contrato["name"], $idfolderC]);
    }
    if ($_FILES["clienteCarnet"]["name"] !== "") {
      $ccarnet = $_FILES["clienteCarnet"];
      move_uploaded_file($ccarnet["tmp_name"], $ruta1 . "/" . $ccarnet["name"]);
      $sql3 = $con->prepare("UPDATE folder set fotcarnet=? where idfolder =?;");
      $res3 = $sql3->execute([$ruta1 . "/" . $ccarnet["name"], $idfolderC]);
    }
    if ($_FILES["clienteFacLuz"]["name"] !== "") {
      $cfacluz = $_FILES["clienteFacLuz"];
      move_uploaded_file($cfacluz["tmp_name"], $ruta1 . "/" . $cfacluz["name"]);
      $sql4 = $con->prepare("UPDATE folder set facluz=? where idfolder =?;");
      $res4 = $sql4->execute([$ruta1 . "/" . $cfacluz["name"], $idfolderC]);
    }
    if ($_FILES["clienteFacAgua"]["name"] !== "") {
      $cfacagua = $_FILES["clienteFacAgua"];
      move_uploaded_file($cfacagua["tmp_name"], $ruta1 . "/" . $cfacagua["name"]);
      $sql5 = $con->prepare("UPDATE folder set facagua=? where idfolder =?;");
      $res5 = $sql5->execute([$ruta1 . "/" . $cfacagua["name"], $idfolderC]);
    }
    if ($_FILES["clienteCroquis"]["name"] !== "") {
      $ccroquis = $_FILES["clienteCroquis"];
      move_uploaded_file($ccroquis["tmp_name"], $ruta1 . "/" . $ccroquis["name"]);
      $sql6 = $con->prepare("UPDATE folder set croquis=? where idfolder =?;");
      $res6 = $sql6->execute([$ruta1 . "/" . $ccroquis["name"], $idfolderC]);
    }
    if ($_FILES["clienteFolioReal"]["name"] !== "") {
      $cfolio = $_FILES["clienteFolioReal"];
      move_uploaded_file($cfolio["tmp_name"], $ruta1 . "/" . $cfolio["name"]);
      $sql7 = $con->prepare("UPDATE folder set folio=? where idfolder =?;");
      $res7 = $sql7->execute([$ruta1 . "/" . $cfolio["name"], $idfolderC]);
    }
    if ($_FILES["clienteTestimonio"]["name"] !== "") {
      $ctestimonio = $_FILES["clienteTestimonio"];
      move_uploaded_file($ctestimonio["tmp_name"], $ruta1 . "/" . $ctestimonio["name"]);
      $sql8 = $con->prepare("UPDATE folder set testimonio=? where idfolder =?;");
      $res8 = $sql8->execute([$ruta1 . "/" . $ctestimonio["name"], $idfolderC]);
    }
    if ($_FILES["clienteImpuesto"]["name"] !== "") {
      $cimpuesto = $_FILES["clienteImpuesto"];
      move_uploaded_file($cimpuesto["tmp_name"], $ruta1 . "/" . $cimpuesto["name"]);
      $sql9 = $con->prepare("UPDATE folder set impuesto=? where idfolder =?;");
      $res9 = $sql9->execute([$ruta1 . "/" . $cimpuesto["name"], $idfolderC]);
    }
    if ($_FILES["clienteRuat"]["name"] !== "") {
      $cruat = $_FILES["clienteRuat"];
      move_uploaded_file($cruat["tmp_name"], $ruta1 . "/" . $cruat["name"]);
      $sql10 = $con->prepare("UPDATE folder set ruat=? where idfolder =?;");
      $res10 = $sql10->execute([$ruta1 . "/" . $cruat["name"], $idfolderC]);
    }
    if ($_FILES["clienteSoat"]["name"] !== "") {
      $csoat = $_FILES["clienteSoat"];
      move_uploaded_file($csoat["tmp_name"], $ruta1 . "/" . $csoat["name"]);
      $sql11 = $con->prepare("UPDATE folder set soat=? where idfolder =?;");
      $res11 = $sql11->execute([$ruta1 . "/" . $csoat["name"], $idfolderC]);
    }
    if ($_FILES["clienteNit"]["name"] !== "") {
      $cnit = $_FILES["clienteNit"];
      move_uploaded_file($cnit["tmp_name"], $ruta1 . "/" . $cnit["name"]);
      $sql12 = $con->prepare("UPDATE folder set nit=? where idfolder =?;");
      $res12 = $sql12->execute([$ruta1 . "/" . $cnit["name"], $idfolderC]);
    }
    if ($_FILES["clientePatente"]["name"] !== "") {
      $cpatente = $_FILES["clientePatente"];
      move_uploaded_file($cpatente["tmp_name"], $ruta1 . "/" . $cpatente["name"]);
      $sql13 = $con->prepare("UPDATE folder set patente=? where idfolder =?;");
      $res13 = $sql13->execute([$ruta1 . "/" . $cpatente["name"], $idfolderC]);
    }
    if ($_FILES["clienteBoletaPago"]["name"] !== "") {
      $csueldos = $_FILES["clienteBoletaPago"];
      move_uploaded_file($csueldos["tmp_name"], $ruta1 . "/" . $csueldos["name"]);
      $sql14 = $con->prepare("UPDATE folder set boletapago=? where idfolder =?;");
      $res14 = $sql14->execute([$ruta1 . "/" . $csueldos["name"], $idfolderC]);
    }
    if ($_FILES["clienteAfp"]["name"] !== "") {
      $cafp = $_FILES["clienteAfp"];
      move_uploaded_file($cafp["tmp_name"], $ruta1 . "/" . $cafp["name"]);
      $sql15 = $con->prepare("UPDATE folder set afp=? where idfolder =?;");
      $res15 = $sql15->execute([$ruta1 . "/" . $cafp["name"], $idfolderC]);
    }
    //------------------------SUBIENDO IMAGENES DE DEUDAS CON BANCO CLIENTE-----------------------//
    //----------------------------BANCO 1------------------------------------------//
    if ($_POST["selec_banco_cliente1"] != '0') {
      $cbancodeuda1 = $_POST["selec_banco_cliente1"];
      $sql16 = $con->prepare("INSERT INTO deuda_banco_folder(folder,banco) VALUES (?, ?)");
      $res16 = $sql16->execute([$idfolderC, $cbancodeuda1]);

      $sql17 = $con->prepare("SELECT iddeudabancofolder FROM deuda_banco_folder WHERE folder=? and banco=?");
      $sql17->execute([$idfolderC, $cbancodeuda1]);
      $res17 = $sql17->fetch();
      $iddeudabancoC1 =  $res17["iddeudabancofolder"];
      if ($_FILES["clientePlan1"]["name"] !== "") {
        $cplan1 = $_FILES["clientePlan1"];
        move_uploaded_file($cplan1["tmp_name"], $ruta1d . "/" . $cplan1["name"]);
        $sql18 = $con->prepare("UPDATE deuda_banco_folder set planpago=? where iddeudabancofolder =?;");
        $res18 = $sql18->execute([$ruta1d . "/" . $cplan1["name"], $iddeudabancoC1]);
      }
      if ($_FILES["clienteCancelacion1"]["name"] !== "") {
        $cboleta1 = $_FILES["clienteCancelacion1"];
        move_uploaded_file($cboleta1["tmp_name"], $ruta1d . "/" . $cboleta1["name"]);
        $sql19 = $con->prepare("UPDATE deuda_banco_folder set ultimaboleta=? where iddeudabancofolder =?;");
        $res19 = $sql19->execute([$ruta1d . "/" . $cboleta1["name"], $iddeudabancoC1]);
      }
    }
    //----------------------------BANCO 2------------------------------------------//
    if ($_POST["selec_banco_cliente2"] != '0') {
      $cbancodeuda2 = $_POST["selec_banco_cliente2"];
      $sql20 = $con->prepare("INSERT INTO deuda_banco_folder(folder,banco) VALUES (?, ?)");
      $res20 = $sql20->execute([$idfolderC, $cbancodeuda2]);

      $sql21 = $con->prepare("SELECT iddeudabancofolder FROM deuda_banco_folder WHERE folder=? and banco=?");
      $sql21->execute([$idfolderC, $cbancodeuda2]);
      $res21 = $sql21->fetch();
      $iddeudabancoC2 =  $res21["iddeudabancofolder"];

      if ($_FILES["clientePlan2"]["name"] !== "") {
        $cplan2 = $_FILES["clientePlan2"];
        move_uploaded_file($cplan2["tmp_name"], $ruta1d . "/" . $cplan2["name"]);
        $sql22 = $con->prepare("UPDATE deuda_banco_folder set planpago=? where iddeudabancofolder =?;");
        $res22 = $sql22->execute([$ruta1d . "/" . $cplan2["name"], $iddeudabancoC2]);
      }
      if ($_FILES["clienteCancelacion2"]["name"] !== "") {
        $cboleta2 = $_FILES["clienteCancelacion2"];
        move_uploaded_file($cboleta2["tmp_name"], $ruta1d . "/" . $cboleta2["name"]);
        $sql23 = $con->prepare("UPDATE deuda_banco_folder set ultimaboleta=? where iddeudabancofolder =?;");
        $res23 = $sql23->execute([$ruta1d . "/" . $cboleta2["name"], $iddeudabancoC2]);
      }
    }
    //----------------------------BANCO 3------------------------------------------//
    if ($_POST["selec_banco_cliente3"] != '0') {
      $cbancodeuda3 = $_POST["selec_banco_cliente3"];
      $sql24 = $con->prepare("INSERT INTO deuda_banco_folder(folder,banco) VALUES (?, ?)");
      $res24 = $sql24->execute([$idfolderC, $cbancodeuda3]);

      $sql25 = $con->prepare("SELECT iddeudabancofolder FROM deuda_banco_folder WHERE folder=? and banco=?");
      $sql25->execute([$idfolderC, $cbancodeuda3]);
      $res25 = $sql25->fetch();
      $iddeudabancoC3 =  $res25["iddeudabancofolder"];

      if ($_FILES["clientePlan3"]["name"] !== "") {
        $cplan3 = $_FILES["clientePlan3"];
        move_uploaded_file($cplan3["tmp_name"], $ruta1d . "/" . $cplan3["name"]);
        $sql26 = $con->prepare("UPDATE deuda_banco_folder set planpago=? where iddeudabancofolder =?;");
        $res26 = $sql26->execute([$ruta1d . "/" . $cplan3["name"], $iddeudabancoC3]);
      }
      if ($_FILES["clienteCancelacion3"]["name"] !== "") {
        $cboleta3 = $_FILES["clienteCancelacion3"];
        move_uploaded_file($cboleta3["tmp_name"], $ruta1d . "/" . $cboleta3["name"]);
        $sql27 = $con->prepare("UPDATE deuda_banco_folder set ultimaboleta=? where iddeudabancofolder =?;");
        $res27 = $sql27->execute([$ruta1d . "/" . $cboleta3["name"], $iddeudabancoC3]);
      }
    }
    //----------------------------BANCO 4------------------------------------------//
    if ($_POST["selec_banco_cliente4"] != '0') {
      $cbancodeuda4 = $_POST["selec_banco_cliente4"];
      $sql28 = $con->prepare("INSERT INTO deuda_banco_folder(folder,banco) VALUES (?, ?)");
      $res28 = $sql28->execute([$idfolderC, $cbancodeuda4]);

      $sql29 = $con->prepare("SELECT iddeudabancofolder FROM deuda_banco_folder WHERE folder=? and banco=?");
      $sql29->execute([$idfolderC, $cbancodeuda4]);
      $res29 = $sql29->fetch();
      $iddeudabancoC4 =  $res29["iddeudabancofolder"];

      if ($_FILES["clientePlan4"]["name"] !== "") {
        $cplan4 = $_FILES["clientePlan4"];
        move_uploaded_file($cplan4["tmp_name"], $ruta1d . "/" . $cplan4["name"]);
        $sql30 = $con->prepare("UPDATE deuda_banco_folder set planpago=? where iddeudabancofolder =?;");
        $res30 = $sql30->execute([$ruta1d . "/" . $cplan4["name"], $iddeudabancoC4]);
      }
      if ($_FILES["clienteCancelacion4"]["name"] !== "") {
        $cboleta4 = $_FILES["clienteCancelacion4"];
        move_uploaded_file($cboleta4["tmp_name"], $ruta1d . "/" . $cboleta4["name"]);
        $sql31 = $con->prepare("UPDATE deuda_banco_folder set planpago=? where iddeudabancofolder =?;");
        $res31 = $sql31->execute([$ruta1d . "/" . $cboleta4["name"], $iddeudabancoC4]);
      }
    }
    //------------------------------------SUBIENDO LA LISTA DE DOCUMENTOS CLIENTE---------------------------------//
    if ($sqlistaresC) {
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
      //------------------------------------SUBIENDO LA LISTA DE DEUDAS DEL CLIENTE--------------------------//

      //-----------------------------------------DEUDA BANCO 1-------------------------------//
      if ($_POST["selec_deuda_cliente1"] != '0') {
        $ccheckb1 = $_POST["selec_deuda_cliente1"];
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
      //-----------------------------------------DEUDA BANCO 2-------------------------------//
      if ($_POST["selec_deuda_cliente2"] != '0') {
        $ccheckb2 = $_POST["selec_deuda_cliente2"];
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
        $sql34 = $con->prepare("INSERT INTO lista_deuda_banco(planpago,ultimaboleta,listafolder,banco) VALUES (?, ?, ?, ?)");
        $res34 = $sql34->execute([$ccheck17, $ccheck18, $idfolderlistaC, $ccheckb2]);
      }
      //-----------------------------------------DEUDA BANCO 3-------------------------------//
      if ($_POST["selec_deuda_cliente3"] != '0') {
        $ccheckb3 = $_POST["selec_deuda_cliente3"];
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
        $sql35 = $con->prepare("INSERT INTO lista_deuda_banco(planpago,ultimaboleta,listafolder,banco) VALUES (?, ?, ?, ?);");
        $res35 = $sql35->execute([$ccheck19, $ccheck20, $idfolderlistaC, $ccheckb3]);
      }
      //-----------------------------------------DEUDA BANCO 4-------------------------------//
      if ($_POST["selec_deuda_cliente4"] != '0') {
        $ccheckb4 = $_POST["selec_deuda_cliente4"];
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
        $sql36 = $con->prepare("INSERT INTO lista_deuda_banco(planpago,ultimaboleta,listafolder,banco) VALUES(?, ?, ?, ?);");
        $res36 = $sql36->execute([$ccheck21, $ccheck22, $idfolderlistaC, $ccheckb4]);
      }
    } else {
      echo "ERROR AL CREAR LISTA CLIENTE";
    }


    //--------------------------SUBIENDO IMAGENES DE GARANTE CON UPDATE------------------------//
    if ($_FILES["garanteCarnet"]["name"] !== "") {
      $gcarnet = $_FILES["garanteCarnet"];
      move_uploaded_file($gcarnet["tmp_name"], $ruta2 . "/" . $gcarnet["name"]);
      $sql3 = $con->prepare("UPDATE folder set fotcarnet=? where idfolder =?;");
      $res3 = $sql3->execute([$ruta2 . "/" . $gcarnet["name"], $idfolderG]);
    }
    if ($_FILES["garanteFacLuz"]["name"] !== "") {
      $gfacluz = $_FILES["garanteFacLuz"];
      move_uploaded_file($gfacluz["tmp_name"], $ruta2 . "/" . $gfacluz["name"]);
      $sql4 = $con->prepare("UPDATE folder set facluz=? where idfolder =?;");
      $res4 = $sql4->execute([$ruta2 . "/" . $gfacluz["name"], $idfolderG]);
    }
    if ($_FILES["garanteFacAgua"]["name"] !== "") {
      $gfacagua = $_FILES["garanteFacAgua"];
      move_uploaded_file($gfacagua["tmp_name"], $ruta2 . "/" . $gfacagua["name"]);
      $sql5 = $con->prepare("UPDATE folder set facagua=? where idfolder =?;");
      $res5 = $sql5->execute([$ruta2 . "/" . $gfacagua["name"], $idfolderG]);
    }
    if ($_FILES["garanteCroquis"]["name"] !== "") {
      $gcroquis = $_FILES["garanteCroquis"];
      move_uploaded_file($gcroquis["tmp_name"], $ruta2 . "/" . $gcroquis["name"]);
      $sql6 = $con->prepare("UPDATE folder set croquis=? where idfolder =?;");
      $res6 = $sql6->execute([$ruta2 . "/" . $gcroquis["name"], $idfolderG]);
    }
    if ($_FILES["garanteFolioReal"]["name"] !== "") {
      $gfolio = $_FILES["garanteFolioReal"];
      move_uploaded_file($gfolio["tmp_name"], $ruta2 . "/" . $gfolio["name"]);
      $sql7 = $con->prepare("UPDATE folder set folio=? where idfolder =?;");
      $res7 = $sql7->execute([$ruta2 . "/" . $gfolio["name"], $idfolderG]);
    }
    if ($_FILES["garanteTestimonio"]["name"] !== "") {
      $gtestimonio = $_FILES["garanteTestimonio"];
      move_uploaded_file($gtestimonio["tmp_name"], $ruta2 . "/" . $gtestimonio["name"]);
      $sql8 = $con->prepare("UPDATE folder set testimonio=? where idfolder =?;");
      $res8 = $sql8->execute([$ruta2 . "/" . $gtestimonio["name"], $idfolderG]);
    }
    if ($_FILES["garanteImpuesto"]["name"] !== "") {
      $gimpuesto = $_FILES["garanteImpuesto"];
      move_uploaded_file($gimpuesto["tmp_name"], $ruta2 . "/" . $gimpuesto["name"]);
      $sql9 = $con->prepare("UPDATE folder set impuesto=? where idfolder =?;");
      $res9 = $sql9->execute([$ruta2 . "/" . $gimpuesto["name"], $idfolderG]);
    }
    if ($_FILES["garanteRuat"]["name"] !== "") {
      $gruat = $_FILES["garanteRuat"];
      move_uploaded_file($gruat["tmp_name"], $ruta2 . "/" . $gruat["name"]);
      $sql10 = $con->prepare("UPDATE folder set ruat=? where idfolder =?;");
      $res10 = $sql10->execute([$ruta2 . "/" . $gruat["name"], $idfolderG]);
    }
    if ($_FILES["garanteSoat"]["name"] !== "") {
      $gsoat = $_FILES["garanteSoat"];
      move_uploaded_file($gsoat["tmp_name"], $ruta2 . "/" . $gsoat["name"]);
      $sql11 = $con->prepare("UPDATE folder set soat=? where idfolder =?;");
      $res11 = $sql11->execute([$ruta2 . "/" . $gsoat["name"], $idfolderG]);
    }
    if ($_FILES["garanteNit"]["name"] !== "") {
      $gnit = $_FILES["garanteNit"];
      move_uploaded_file($gnit["tmp_name"], $ruta2 . "/" . $gnit["name"]);
      $sql12 = $con->prepare("UPDATE folder set nit=? where idfolder =?;");
      $res12 = $sql12->execute([$ruta2 . "/" . $gnit["name"], $idfolderG]);
    }
    if ($_FILES["garantePatente"]["name"] !== "") {
      $gpatente = $_FILES["garantePatente"];
      move_uploaded_file($gpatente["tmp_name"], $ruta2 . "/" . $gpatente["name"]);
      $sql13 = $con->prepare("UPDATE folder set patente=? where idfolder =?;");
      $res13 = $sql13->execute([$ruta2 . "/" . $gpatente["name"], $idfolderG]);
    }
    if ($_FILES["garanteBoletaPago"]["name"] !== "") {
      $gsueldos = $_FILES["garanteBoletaPago"];
      move_uploaded_file($gsueldos["tmp_name"], $ruta2 . "/" . $gsueldos["name"]);
      $sql14 = $con->prepare("UPDATE folder set boletapago=? where idfolder =?;");
      $res14 = $sql14->execute([$ruta2 . "/" . $gsueldos["name"], $idfolderG]);
    }
    if ($_FILES["garanteAfp"]["name"] !== "") {
      $gafp = $_FILES["garanteAfp"];
      move_uploaded_file($gafp["tmp_name"], $ruta2 . "/" . $gafp["name"]);
      $sql15 = $con->prepare("UPDATE folder set afp=? where idfolder =?;");
      $res15 = $sql15->execute([$ruta2 . "/" . $gafp["name"], $idfolderG]);
    }
    //------------------------SUBIENDO IMAGENES DE DEUDAS CON BANCO GARANTE-----------------------//
    //----------------------------BANCO 1------------------------------------------//
    if ($_POST["selec_banco_garante1"] != '0') {
      $gbancodeuda1 = $_POST["selec_banco_garante1"];
      $sql16 = $con->prepare("INSERT INTO deuda_banco_folder(folder,banco) VALUES (?, ?)");
      $res16 = $sql16->execute([$idfolderG, $gbancodeuda1]);

      $sql17 = $con->prepare("SELECT iddeudabancofolder FROM deuda_banco_folder WHERE folder=? and banco=?");
      $sql17->execute([$idfolderG, $gbancodeuda1]);
      $res17 = $sql17->fetch();
      $iddeudabancoG1 =  $res17["iddeudabancofolder"];

      if ($_FILES["garantePlan1"]["name"] !== "") {
        $gplan1 = $_FILES["garantePlan1"];
        move_uploaded_file($gplan1["tmp_name"], $ruta2d . "/" . $gplan1["name"]);
        $sql18 = $con->prepare("UPDATE deuda_banco_folder set planpago=? where iddeudabancofolder =?;");
        $res18 = $sql18->execute([$ruta2d . "/" . $gplan1["name"], $iddeudabancoG1]);
      }
      if ($_FILES["garanteCancelacion1"]["name"] !== "") {
        $gboleta1 = $_FILES["garanteCancelacion1"];
        move_uploaded_file($gboleta1["tmp_name"], $ruta2d . "/" . $gboleta1["name"]);
        $sql19 = $con->prepare("UPDATE deuda_banco_folder set ultimaboleta=? where iddeudabancofolder =?;");
        $res19 = $sql19->execute([$ruta2d . "/" . $gboleta1["name"], $iddeudabancoG1]);
      }
    }
    //----------------------------BANCO 2------------------------------------------//
    if ($_POST["selec_banco_garante2"] != '0') {
      $gbancodeuda2 = $_POST["selec_banco_garante2"];
      $sql20 = $con->prepare("INSERT INTO deuda_banco_folder(folder,banco) VALUES (?, ?)");
      $res20 = $sql20->execute([$idfolderG, $gbancodeuda2]);

      $sql21 = $con->prepare("SELECT iddeudabancofolder FROM deuda_banco_folder WHERE folder=? and banco=?");
      $sql21->execute([$idfolderG, $gbancodeuda2]);
      $res21 = $sql21->fetch();
      $iddeudabancoG2 =  $res21["iddeudabancofolder"];

      if ($_FILES["garantePlan2"]["name"] !== "") {
        $gplan2 = $_FILES["garantePlan2"];
        move_uploaded_file($gplan2["tmp_name"], $ruta2d . "/" . $gplan2["name"]);
        $sql22 = $con->prepare("UPDATE deuda_banco_folder set planpago=? where iddeudabancofolder =?;");
        $res22 = $sql22->execute([$ruta2d . "/" . $gplan2["name"], $iddeudabancoG2]);
      }
      if ($_FILES["garanteCancelacion2"]["name"] !== "") {
        $gboleta2 = $_FILES["garanteCancelacion2"];
        move_uploaded_file($gboleta2["tmp_name"], $ruta2d . "/" . $gboleta2["name"]);
        $sql23 = $con->prepare("UPDATE deuda_banco_folder set ultimaboleta=? where iddeudabancofolder =?;");
        $res23 = $sql23->execute([$ruta2d . "/" . $gboleta2["name"], $iddeudabancoG2]);
      }
    }
    //----------------------------BANCO 3------------------------------------------//
    if ($_POST["selec_banco_garante3"] != '0') {
      $gbancodeuda3 = $_POST["selec_banco_garante3"];
      $sql24 = $con->prepare("INSERT INTO deuda_banco_folder(folder,banco) VALUES (?, ?)");
      $res24 = $sql24->execute([$idfolderG, $gbancodeuda3]);

      $sql25 = $con->prepare("SELECT iddeudabancofolder FROM deuda_banco_folder WHERE folder=? and banco=?");
      $sql25->execute([$idfolderG, $gbancodeuda3]);
      $res25 = $sql25->fetch();
      $iddeudabancoG3 =  $res25["iddeudabancofolder"];

      if ($_FILES["garantePlan3"]["name"] !== "") {
        $gplan3 = $_FILES["garantePlan3"];
        move_uploaded_file($gplan3["tmp_name"], $ruta2d . "/" . $gplan3["name"]);
        $sql26 = $con->prepare("UPDATE deuda_banco_folder set planpago=? where iddeudabancofolder =?;");
        $res26 = $sql26->execute([$ruta2d . "/" . $gplan3["name"], $iddeudabancoG3]);
      }
      if ($_FILES["garanteCancelacion3"]["name"] !== "") {
        $gboleta3 = $_FILES["garanteCancelacion3"];
        move_uploaded_file($gboleta3["tmp_name"], $ruta2d . "/" . $gboleta3["name"]);
        $sql27 = $con->prepare("UPDATE deuda_banco_folder set ultimaboleta=? where iddeudabancofolder =?;");
        $res27 = $sql27->execute([$ruta2d . "/" . $gboleta3["name"], $iddeudabancoG3]);
      }
    }
    //----------------------------BANCO 4------------------------------------------//
    if ($_POST["selec_banco_garante4"] != '0') {
      $gbancodeuda4 = $_POST["selec_banco_garante4"];
      $sql28 = $con->prepare("INSERT INTO deuda_banco_folder(folder,banco) VALUES (?, ?)");
      $res28 = $sql28->execute([$idfolderG, $gbancodeuda4]);

      $sql29 = $con->prepare("SELECT iddeudabancofolder FROM deuda_banco_folder WHERE folder=? and banco=?");
      $sql29->execute([$idfolderG, $gbancodeuda4]);
      $res29 = $sql29->fetch();
      $iddeudabancoG4 =  $res29["iddeudabancofolder"];

      if ($_FILES["garantePlan4"]["name"] !== "") {
        $gplan4 = $_FILES["garantePlan4"];
        move_uploaded_file($gplan4["tmp_name"], $ruta2d . "/" . $gplan4["name"]);
        $sql30 = $con->prepare("UPDATE deuda_banco_folder set planpago=? where iddeudabancofolder =?;");
        $res30 = $sql30->execute([$ruta2d . "/" . $gplan4["name"], $iddeudabancoG4]);
      }
      if ($_FILES["garanteCancelacion4"]["name"] !== "") {
        $gboleta4 = $_FILES["garanteCancelacion4"];
        move_uploaded_file($gboleta4["tmp_name"], $ruta2d . "/" . $gboleta4["name"]);
        $sql31 = $con->prepare("UPDATE deuda_banco_folder set ultimaboleta=? where iddeudabancofolder =?;");
        $res31 = $sql31->execute([$ruta2d . "/" . $gboleta4["name"], $iddeudabancoG4]);
      }
    }
    //------------------------------------SUBIENDO LA LISTA DE DOCUMENTOS GARANTE---------------------------------//
    if ($sqlistaresG) {
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
      //------------------------------------SUBIENDO LA LISTA DE DEUDAS DEL GARANTE--------------------------//

      //-----------------------------------------DEUDA BANCO 1-------------------------------//
      if ($_POST["selec_deuda_garante1"] != '0') {
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
      //-----------------------------------------DEUDA BANCO 2-------------------------------//
      if ($_POST["selec_deuda_garante2"] != '0') {
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
        $sql34 = $con->prepare("INSERT INTO lista_deuda_banco(planpago,ultimaboleta,listafolder,banco) VALUES (?, ?, ?, ?)");
        $res34 = $sql34->execute([$gcheck16, $gcheck17, $idfolderlistaG, $gcheckb2]);
      }
      //-----------------------------------------DEUDA BANCO 3-------------------------------//
      if ($_POST["selec_deuda_garante3"] != '0') {
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
        $sql35 = $con->prepare("INSERT INTO lista_deuda_banco(planpago,ultimaboleta,listafolder,banco) VALUES (?, ?, ?, ?);");
        $res35 = $sql35->execute([$gcheck18, $gcheck19, $idfolderlistaG, $gcheckb3]);
      }
      //-----------------------------------------DEUDA BANCO 4-------------------------------//
      if ($_POST["selec_deuda_garante4"] != '0') {
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
        $sql36 = $con->prepare("INSERT INTO lista_deuda_banco(planpago,ultimaboleta,listafolder,banco) VALUES(?, ?, ?, ?);");
        $res36 = $sql36->execute([$gcheck20, $gcheck21, $idfolderlistaG, $gcheckb4]);
      }
    } else {
      echo "ERROR AL CREAR LISTA CLIENTE";
    }
  } else {
    echo "ERROR NO SE PUDO CREAR LOS FOLDERS";
  }
}
