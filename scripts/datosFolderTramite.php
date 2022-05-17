<?php

include '../scripts/conexion.php';
$idT = $_POST["idtramite"];
$sql = "SELECT f.idfolder,f.tipo,f.contrato,f.fotcarnet,
f.facluz,f.facagua,f.croquis,f.folio,f.testimonio,f.impuesto,f.ruat,f.soat,
f.nit,f.boletapago,f.afp,f.patente, 
lf.idlistafolder,lf.contrato as checkcontrato,lf.fotcarnet as checkcarnet,lf.facluz as checkluz,
lf.facagua as checkagua,lf.croquis as checkcroquis,lf.folio as checkfolio,lf.testimonio
as checktestimonio,lf.impuesto as checkimpuesto,
lf.ruat as checkruat,lf.soat as checksoat,lf.nit as checknit,lf.boletapago as checkboletap,lf.afp as checkafp,lf.patente
as checkpatente
from tramitebancario t 
inner join folder f 
on t.idtramitebancario = f.tramite 
full join lista_folder lf 
on f.idfolder = lf.folder 
where t.idtramitebancario =?
group by f.idfolder,t.idtramitebancario,lf.idlistafolder ";
$sentencia = $con->prepare($sql);
$sentencia->bindValue(1, $idT, PDO::PARAM_STR);
$sentencia->execute();
$resultado = $sentencia->fetchAll();
echo json_encode($resultado);