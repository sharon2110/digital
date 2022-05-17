<?php
ob_start();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">


    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/ASCMotorsDigital/views/css/all.css">
    <link rel="stylesheet" href="../views/css/sweetalert2.min.css">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/ASCMotorsDigital/views/css/estiloHome.css">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/ASCMotorsDigital/views/css/estiloVentas.css">
    <title>Reporte_Ventas</title>

</head>

<body class="reporteVentasFecha">
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
    $datos = $_GET['datos'];
    $vectorDatos = explode("/",$datos);
    $fechaini = $vectorDatos[0];
    $fechafinal = $vectorDatos[1];
    $usuarioId = $vectorDatos[2];
    //$fechaI = explode("-",$fechaini)[2]."-".explode("-",$fechaini)[1]."-".explode("-",$fechaini)[0];
    ///$fechaF = explode("-",$fechafinal)[2]."-".explode("-",$fechafinal)[1]."-".explode("-",$fechafinal)[0];
    include '../scripts/conexion.php';
    $sentencia = $con->prepare("SELECT * from usuario u where u.idusuario =:usuario");
    $sentencia->bindParam(':usuario',$usuarioId);
    $sentencia->execute();
    $resultado = $sentencia->fetch();
    $tipoUsuario =  $resultado["tipousuario"];
    if($tipoUsuario=="Administrador"){
        $sentencia = $con->prepare("SELECT v.idventa, v.fecha,u.usuario, c.nombre,c.paterno,c.materno,count(dv.iddetalleventa) as cantidad,
        sum(dv.precio) as importe from venta v 
        inner join detalle_venta dv 
        on v.idventa = dv.venta 
        inner join usuario u 
        on v.usuario = u.idusuario 
        inner join cliente c 
        on v.cliente = c.idcliente 
        where (v.fecha) between ?  and ?
        group by v.idventa, u.usuario, c.nombre, c.paterno, c.materno ");
        $sentencia->bindParam(1,$fechaini);
        $sentencia->bindParam(2,$fechafinal);
        $sentencia->execute();
        $resultado = $sentencia->fetchAll();
    }else{
        $sentencia = $con->prepare("SELECT v.idventa, v.fecha,u.usuario, c.nombre,c.paterno,c.materno,count(dv.iddetalleventa) as cantidad,
        sum(dv.precio) as importe from venta v 
        inner join detalle_venta dv 
        on v.idventa = dv.venta 
        inner join usuario u 
        on v.usuario = u.idusuario 
        inner join cliente c 
        on v.cliente = c.idcliente 
        where (v.fecha) between ?  and ? and v.usuario=?
        group by v.idventa, u.usuario, c.nombre, c.paterno, c.materno ");
        $sentencia->bindParam(1,$fechaini);
        $sentencia->bindParam(2,$fechafinal);
        $sentencia->bindParam(3,$usuarioId);
        $sentencia->execute();
        $resultado = $sentencia->fetchAll();
    }
    $contador = 0;

    ?>

    <div>
        <div class="container-fluid">
            <div class="row">
                <img src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/ASCMotorsDigital/views/assets/logo.jpg" class="logoReporte col-1" style="height:85px!important; width:85px !important;margin-top:25px!important;">
                <!--<div class="nombreEmpresa col-5"><b>ASC Motors</b></div>-->
                <div class="fecha col-4">
                    <b style="font-size:14px!important;"><?php
                                                    function obtenerFechaEnLetra($fecha)
                                                    {
                                                        $dia = conocerDiaSemanaFecha($fecha);
                                                        $num = date("j", strtotime($fecha));
                                                        $anno = date("Y", strtotime($fecha));
                                                        $mes = array('enero', 'febrero', 'marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre', 'diciembre');
                                                        $mes = $mes[(date('m', strtotime($fecha)) * 1) - 1];
                                                        return $dia . ' ' . $num . ' de ' . $mes . ' del ' . $anno;
                                                    }

                                                    function conocerDiaSemanaFecha($fecha)
                                                    {
                                                        $dias = array('Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado');
                                                        $dia = $dias[date('w', strtotime($fecha))];
                                                        return $dia;
                                                    }
                                                    $fecha = gmdate('d-m-Y h:i:s a', time() - 25200);

                                                    echo obtenerFechaEnLetra($fecha) ?></b>
                </div>

            </div>
            <div style="background-color: rgb(112, 40, 24);height:4px; margin: left 50px; margin-right:50px; border-radius:4%;"></div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-4" style="margin-left:55px; font-weight:bold;font-size:13px; margin-left:300px;">
                <?php
                echo "<b>REPORTE DE VENTAS<br>"?>
            </div>
            <br>
   
            <div class="col-md-4" style="margin-left:55px; font-weight:bold;font-size:13px; margin-left:250px;">
            <?php
             $fechaI = explode("-",$fechaini)[2]."-".explode("-",$fechaini)[1]."-".explode("-",$fechaini)[0];
             $fechaF = explode("-",$fechafinal)[2]."-".explode("-",$fechafinal)[1]."-".explode("-",$fechafinal)[0]; 
             echo "DEL:&nbsp;&nbsp; </b>".$fechaI."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>AL </b> &nbsp;&nbsp;&nbsp;".$fechaF?>
            </div>
        </div>

        <div style="margin-top:10px;margin-left:55px; margin-right:55px; ">
            <div>
                <table class="table tablaReporte" style="margin-top: 30px;width:100%; border-collapse:collapse;">
                    <thead>
                        <tr style="font-size:14px important;">
                            <th>#</th>
                            <th>Cód</th>
                            <th>Fecha</th>
                            <th>Usuario</th>
                            <th>Cliente</th>
                            <th>Cant.</th>
                            <th>Importe</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php


                        foreach ($resultado as $ventas) :
                            $contador++;
                        ?>
                            <tr class="" style="font-size:13px important; text-align:center;">
                                <td style="padding:2px;"><?= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$contador?></td>
                                <td style="padding:2px;"><?= "&nbsp;&nbsp;&nbsp;&nbsp;  ".$ventas[0] ?></td>
                                <td style="padding:2px;"><?= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ".explode("-", $ventas[1])[2] . "-" . explode("-", $ventas[1])[1] . "-" . explode("-", $ventas[1])[0]?></td>
                                <td style="padding:2px;"><?= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ".$ventas[2]?></td>
                                <td style="padding:2px;"><?= $ventas[3]." ".$ventas[4]." ".$ventas[5] ?></td>
                                <td style="padding:2px;"><?= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$ventas[6] ?></td>
                                <td style="padding:2px;"><?= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$ventas[7]."$" ?></td>
                            </tr>

                        <?php
                        endforeach;
                        ?>
                        <tr style="background-color:rgb(34, 48, 37);">
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                      
                        
                     
                        </tr>
                        <tr class="text-center" style="font-size:13px!important; text-align:center;">
                            <td style="padding:5px;" colspan="4">
                                <b>
                                    TOTAL EN VENTAS:</b>

                            </td>
                            <td></td>
                            <td></td>
                           
                      

                            <td style="font-size:13px !important;">
                                <b>
                                    <?php
                                    if($tipoUsuario=="Administrador"){
                                        include '../scripts/conexion.php';
                                        $sentencia4 = $con->prepare("SELECT count(*),sum(dv.precio) from detalle_venta dv
                                        inner join venta v on v.idventa=dv.venta
                                        where (v.fecha) between ?  and ? ");
                                        $sentencia4->bindParam(1,$fechaini);
                                        $sentencia4->bindParam(2,$fechafinal);
                                        $resultado4 = $sentencia4->execute();
                                        $resultado4 = $sentencia4->fetchAll();
                                        echo $resultado4[0]["sum"] . " " . "$";
                                    }else{
                                        include '../scripts/conexion.php';
                                        $sentencia4 = $con->prepare("SELECT count(*),sum(dv.precio) from detalle_venta dv
                                        inner join venta v on v.idventa=dv.venta
                                        where (v.fecha) between ?  and ? and v.usuario=?");
                                        $sentencia4->bindParam(1,$fechaini);
                                          $sentencia4->bindParam(2,$fechafinal);
                                          $sentencia4->bindParam(3,$usuarioId);
                                        $resultado4 = $sentencia4->execute();
                                        $resultado4 = $sentencia4->fetchAll();
                                        echo $resultado4[0]["sum"] . " " . "$";
                                    }
                     
                                    ?></b>
                            </td>
                        </tr>
                    </tbody>
                </table>


            </div>
        </div>

    </div>
</body>

</html>
<script type="text/php">
    if ( isset($pdf) ) {
    // OLD 
    $font = Font_Metrics::get_font("Arial", "normal");
    $pdf->page_text(960, 590, "{PAGE_NUM} de {PAGE_COUNT}", $font, 10, array(0,0,0));
    // v.0.7.0 and greater
    /*$x = 72;
    $y = 18;
    $text = "{PAGE_NUM} of {PAGE_COUNT}";
    $font = $fontMetrics->get_font("helvetica", "bold");
    $size = 6;
    $color = array(255,0,0);
    $word_space = 0.0;  //  default
    $char_space = 0.0;  //  default
    $angle = 0.0;   //  default
    $pdf->page_text($x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle);*/
}
</script>
<?php
$html = ob_get_clean();
require_once '../libreria/dompdf/autoload.inc.php';

use Dompdf\Dompdf;

$dompdf = new Dompdf(['chroot' => __DIR__]);
$options = $dompdf->getOptions();
$options->set(array('isRemoteEnabled' => true));
$dompdf->setOptions($options);
$dompdf->loadHtml($html);
$dompdf->setPaper('letter');
$dompdf->render();

$dompdf->stream("reporteVentasF.pdf", array("Attachment" => false));
?>