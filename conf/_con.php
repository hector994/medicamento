<?php
$hostname = "";  
$username = ""; 
$password = "";
$database_name = ""; 

try {
  
    $pdo = new PDO("mysql:host=$hostname;dbname=$database_name", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if($pdo)
    {
        echo "Listo";
    }else
    {
        echo "Fallo la conexion";
    }

}catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>