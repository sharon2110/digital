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
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/ASCMotorsDigital/views/css/estiloHome.css">
    <link rel="stylesheet" href="http://<?php echo $_SERVER['HTTP_HOST']; ?>/ASCMotorsDigital/views/css/estiloVentas.css">
    <title>Detalle_Tramite</title>

</head>

<body>
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
    $tramiteC = $_GET['idTramite'];
    $tramite = base64_decode($tramiteC);
    include '../scripts/conexion.php';
    $sentencia = $con->prepare("SELECT dt.marca,dt.modelo,dt.tipo,dt.color,dt.nump,dt.precio from detalle_tramite dt 
    where dt.tramite =? ");
    $resultado = $sentencia->execute([$tramite]);
    $resultado = $sentencia->fetchAll();
    $contador = 0;

    ?>

    <div>
        <div class="container-fluid">
            <div class="row">
                <img src="http://<?php echo $_SERVER['HTTP_HOST']; ?>/ASCMotorsDigital/views/assets/logo.jpg" class="logoReporte col-1" style="height:85px!important; width:85px !important;margin-top:25px!important;">
                <!--<div class="nombreEmpresa col-5"><b>ASC Motors</b></div>-->
                <div class="fecha col-4" style="font-size:14px!important;margin-top:-65px !important">
                    <b><?php
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

                        echo obtenerFechaEnLetra($fecha) . "<br>" . "<br>" . "Código de trámite: " . $tramite; ?></b>
                </div>

            </div>
            <div style="background-color: rgb(112, 40, 24);height:4px; margin: left 50px; margin-right:50px; border-radius:4%;"></div>
        </div>
        <div class="row">
            <div class="col-md-4" style="font-weight:bold;font-size:14px; margin-left:300px;">
                <?php
                echo "<br><b>DETALLE DE TRÁMITE<b>" ?>
            </div>
            <div class="col-md-4" style="font-size:14px; margin-left:70px; margin-top:10px;">
                <?php
                include '../scripts/conexion.php';
                $sentencia1 = $con->prepare("SELECT c.paterno,c.materno,c.nombre,c.cicliente,c.ciextcli from tramitebancario t
                inner join cliente c
                on c.idcliente = t.cliente 
                where t.idtramitebancario =?");
                $resultado1 = $sentencia1->execute([(int)$tramite]);
                $resultado1 = $sentencia1->fetchAll();
                echo "<br>Cliente:" . " " . $resultado1[0]["paterno"] . " " . $resultado1[0]["materno"] . " " . $resultado1[0]["nombre"]
                    . "&nbsp;" ?>
                            <?php
                include '../scripts/conexion.php';
                $sentencia2 = $con->prepare("SELECT u.paterno,u.materno,u.nombre from tramitebancario t 
                inner join usuario u ON 
                t.usuario = u.idusuario 
                where t.idtramitebancario =?");
                $resultado2 = $sentencia2->execute([(int)$tramite]);
                $resultado2 = $sentencia2->fetchAll();
                echo "&nbsp;&nbsp;&nbsp;Ases@r: " . " " . $resultado2[0]["paterno"] . " " . $resultado2[0]["materno"] . " " . $resultado2[0]["nombre"];
                ?>

<?php
                include '../scripts/conexion.php';
                $sentencia2 = $con->prepare("SELECT b.banco, t.monto_prestamo from tramitebancario t 
                inner join banco b 
                on t.banco = b.idbanco 
                where t.idtramitebancario =?");
                $resultado2 = $sentencia2->execute([(int)$tramite]);
                $resultado2 = $sentencia2->fetchAll();
                echo "&nbsp;&nbsp;&nbsp;" . " " . $resultado2[0]["banco"]. "&nbsp;". " - ".$resultado2[0]["monto_prestamo"]." $";
                ?>
                <br><br>
                <?php 
                     include '../scripts/conexion.php';
                     $sentencia2 = $con->prepare("SELECT t.asesor_credito,t.sucursal,t.observacion from tramitebancario t 
                     where t.idtramitebancario =?");
                     $resultado2 = $sentencia2->execute([(int)$tramite]);
                     $resultado2 = $sentencia2->fetchAll();
                     echo " Sucursal: ".$resultado2[0]["sucursal"]. "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"." Asesor de crédito: " . $resultado2[0]["asesor_credito"]. "&nbsp;&nbsp;&nbsp; Observación:  ".$resultado2[0]["observacion"];
                     ?>

                
        </div>
            <div class="col-md-4" style="font-size:13px; margin-left:0px; margin-top:5px; display:inline;">

            </div>
            <div class="col-md-4" style="font-size:13px; margin-left:0px; margin-top:5px;">

            </div>

        </div>

        <div class="container-fluid" style="margin-left:70px; margin-right:60px; ">
            <div class="table-responsive">
                <table class="table tablaReporte" style="margin-top: 30px; border-collapse:collapse; width:100%;">
                    <thead>
                        <tr class="" style="font-size:14px !important;">
                            <th style="padding:5px">#</th>
                            <th style="padding:5px;">Marca</th>
                            <th style="padding:5px;">Modelo</th>
                            <th style="padding:5px;">Tipo</th>
                            <th style="padding:5px;">Color</th>
                            <th style="padding:5px;">#Pas</th>
                            <th style="padding:5px;">Precio</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($resultado as $ventas) :
                            $contador++;
                        ?>
                            <tr class="text-center" style="font-size:13px !important; text-align:center;">
                                <td style="padding:5px;"><?= $contador ?></td>
                                <td style="padding:5px;"><?= $ventas[0] ?></td>
                                <td style="padding:5px"><?= $ventas[1] ?></td>
                                <td style="padding:5px;"><?= $ventas[2] ?></td>
                                <td style="padding:5px;"><?= $ventas[3] ?></td>
                                <td style="padding:5px;"><?= $ventas[4] ?></td>
                                <td style="padding:5px;"><?= $ventas[5] . " " . "$" ?></td>
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
                    </tbody>
                </table>
            </div>
        </div>
        <div style="font-size:14px; margin-top:20px; margin-left:70px; font-weight:bold;">Historial de estados</div>
        <table class="table tablaReporte" style="margin-top: 15px; margin-left:70px; border-collapse:collapse;">
            <thead>
                <tr class="text-center">
                    <th style="padding:5px; font-size:14px;">Estado</th>
                    <th style="padding:5px;font-size:14px;">Fecha</th>
                </tr>
            </thead>
            <?php     $sentencia1 = $con->prepare("SELECT e.estado,et.fecha from estado_tramite et 
    inner join estado e 
    on et.estado = e.idestado 
    where et.tramite = ?
    order by et.fecha asc");
    $resultado1 = $sentencia1->execute([$tramite]);
    $resultado1 = $sentencia1->fetchAll();?>
            <tbody>
                <?php
                foreach ($resultado1 as $estado) :

                ?>
                    <tr class="text-center">

                        <td style="padding:5px;font-size:13px;"><?= $estado[0] ?></td>
                        <td style="padding:5px;font-size:13px;"><?= explode("-", $estado[1])[2] . "-" . explode("-", $estado[1])[1] . "-" . explode("-", $estado[1])[0] ?></td>

                    </tr>
                    <tr style="">
                        <td></td>
                        <td></td>

                    </tr>
            </tbody>
        <?php
                endforeach;
        ?>

        </table>

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
$dompdf->setPaper( [0, 0,  600.0551181102,526.7913385827 ]); 
$dompdf->render();
$dompdf->stream("detalleTramite.pdf", array("Attachment" => false));
?>