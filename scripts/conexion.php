<?php
$db="basemotors";
$username = "uofwg7ny4iayy9vr";
$password="Us65MNPpSEneTJS2KZsY";

try{
   $con = new PDO('mysql:host=bbyhlfffxo0hldaxg1zt-mysql.services.clever-cloud.com;dbname=bbyhlfffxo0hldaxg1zt',$username,$password);
   $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   
}catch(PDOException $e){
   echo "ERROR: " . $e->getMessage();
}
?>
