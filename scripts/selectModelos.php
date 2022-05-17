<?php
    require_once '../scripts/conexion.php';
    $marca=$_POST['marca'];
    $sentencia = $con->prepare("SELECT modelo from vehiculo v 
    where v.marca = ? order by modelo;");
    $sentencia->execute([$marca]); # Pasar en el mismo orden de los ?
    $resultado = $sentencia->fetchAll();    
    echo '<option value="">Seleccionar</option>';                        
    foreach ($resultado as $modelo) : ?>
        <option value="<?php echo $modelo["modelo"]; ?>"><?php echo $modelo["modelo"]; ?>
        </option>
    <?php endforeach; ?>
    <option value="Otro">Otro</option>