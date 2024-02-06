<?php

$host = 'localhost'; 
$dbname = 'prueba'; 
$username = 'root'; 
$password = ''; 

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec('SET NAMES utf8');
} catch (PDOException $e) {
    die("Error al conectar con la base de datos: " . $e->getMessage());
}

return $pdo;
