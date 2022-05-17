<?php
    require_once '../scripts/conexion.php';
    $marca=$_POST['marca'];
    $modelo=$_POST['modelo'];
    $sentencia = $con->prepare("SELECT dv.cilindrada from detalle_vehiculo dv 
    inner join vehiculo v 
    on dv.vehiculo = v.idvehiculo
    where v.marca = ?
    and v.modelo =? order by cilindrada;");
    
    $sentencia->execute([$marca,$modelo]); # Pasar en el mismo orden de los ?
    $resultado = $sentencia->fetchAll();    
    echo '<option value="">Seleccionar</option>';                        
    foreach ($resultado as $cilindrada) : ?>
        <option value="<?php echo $cilindrada["cilindrada"]; ?>"><?php echo $cilindrada["cilindrada"]; ?>
        </option>
    <?php endforeach; ?>
    <option value="Otro">Otro</option>