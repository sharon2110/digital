<?php


$db="id18908801_ascmotors2110";
$username = "utkzf2xu6vocpfxk";
$password="imPu7ZRGYNzUT9MuXees";

try{
   $con = new PDO("mysql:host=bs1yhrxmrexwadxaayyb-mysql.services.clever-cloud.com;port=3306;dbname=bs1yhrxmrexwadxaayyb",$username,$password);
   $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   
}catch(PDOException $e){
   echo "ERROR: " . $e->getMessage();
}
?>