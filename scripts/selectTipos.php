<?php
    require_once '../scripts/conexion.php';
    $modelo=$_POST['modelo'];
    $marca=$_POST['marca'];
    $sentencia = $con->prepare("SELECT v.tipo 
    from vehiculo v
    where v.marca = ? 
    and v.modelo = ?;");
    $sentencia->execute([$marca,$modelo]); # Pasar en el mismo orden de los ?
    $resultado = $sentencia->fetchAll();    
    echo '<option value="">Seleccionar</option>';                        
    foreach ($resultado as $tipo) : ?>
        <option value="<?php echo $tipo["tipo"]; ?>"><?php echo $tipo["tipo"]; ?>
        </option>
    <?php endforeach; 
    echo '<option value="Otro">Otro</option>';?>