<?php
    require_once '../scripts/conexion.php';
    $modelo=$_POST['modelo'];
    $marca=$_POST['marca'];
    $sentencia = $con->prepare("SELECT dv.preciominimo, dv.precioventa 
    from detalle_vehiculo dv 
    inner join vehiculo v 
    on dv.vehiculo =v.idvehiculo 
    where v.marca = ? 
    and v.modelo = ?;");
    
    $sentencia->execute([$marca,$modelo]); # Pasar en el mismo orden de los ?
    $resultado = $sentencia->fetchAll();    
    echo '<option value="">Seleccionar</option>';                        
    foreach ($resultado as $precio) : ?>
        <option value="<?php echo $precio["preciominimo"]; ?>"><?php echo $precio["preciominimo"]; echo " $"; ?>
        <option value="<?php echo $precio["precioventa"]; ?>"><?php echo $precio["precioventa"]; echo " $"; ?>
        </option>
    <?php endforeach; 
    echo '<option value="Otro">Otro</option>';?>