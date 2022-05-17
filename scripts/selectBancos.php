<?php
require_once '../scripts/conexion.php';
if(isset($_POST['banco1'])&& isset($_POST['banco2']) && isset($_POST['banco3'])){
    $banco1=$_POST['banco1'];
    $banco2=$_POST['banco2'];
    $banco3=$_POST['banco3'];
    $sentencia = $con->prepare("SELECT * from banco b where b.idbanco!= ? and b.idbanco!=? 
    and b.idbanco!=? order by banco;");
    $sentencia->execute([(int)$banco1,(int)$banco2,(int)$banco3]); # Pasar en el mismo orden de los ?
    $resultado = $sentencia->fetchAll(); 
}else{
    if(isset($_POST['banco1']) && isset($_POST['banco2'])){
        $banco1=$_POST['banco1'];
        $banco2=$_POST['banco2'];
        $sentencia = $con->prepare("SELECT * from banco b where b.idbanco!= ? and b.idbanco!=? order by banco;");
        $sentencia->execute([(int)$banco1,(int)$banco2]); # Pasar en el mismo orden de los ?
        $resultado = $sentencia->fetchAll(); 

    }else{
        if(isset($_POST['banco1'])){
            $banco=$_POST['banco1'];
            $sentencia = $con->prepare("SELECT * from banco b where b.idbanco!= ? order by banco;");
            $sentencia->execute([(int)$banco]); # Pasar en el mismo orden de los ?
            $resultado = $sentencia->fetchAll();    
        }
    }
}
echo '<option value="">Seleccionar</option>';                        
foreach ($resultado as $banco) : ?>
    <option value="<?php echo $banco["idbanco"]; ?>"><?php echo $banco["banco"]; ?>
    </option>
<?php endforeach; ?>   
    