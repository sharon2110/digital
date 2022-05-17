<?php
    require_once '../scripts/conexion.php';
    $modelo=$_POST['modelo'];
    $marca=$_POST['marca'];
    $sentencia = $con->prepare("SELECT c.color from color c 
    inner join color_vehiculo cv 
    on c.idcolor = cv.color 
    inner join vehiculo v 
    on cv.automovil = v.idvehiculo 
    where v.marca = ? and v.modelo = ? order by c.color;");
    
    $sentencia->execute([$marca,$modelo]); # Pasar en el mismo orden de los ?
    $resultado = $sentencia->fetchAll();    
    echo '<option value="">Seleccionar</option>';                        
    foreach ($resultado as $color) : ?>
        <option value="<?php echo $color["color"]; ?>"><?php echo $color["color"]; ?>
        </option>
    <?php endforeach; ?>
    <option value="Otro">Otro</option>