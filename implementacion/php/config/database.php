<?php
$host = 'localhost';
$dbname = 'abm_muebles';   // nombre de la base de datos
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;
} catch(PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>