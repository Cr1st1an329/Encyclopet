<?php 

$host="localhost";
$basededatos="sitioweb";
$usuario="root";
$contrasenia="";

try {
    $conexion=new PDO("mysql:host=$host;dbname=$basededatos",$usuario,$contrasenia);
    //if($conexion){echo "Conectado.......";}
} catch ( Exception $ex) {
    echo $ex->getMessage();
}

?>