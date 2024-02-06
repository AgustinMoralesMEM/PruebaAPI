<?php

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(array('error' => 'Método no permitido. Se espera una solicitud POST.'));
    exit; 
}

$datos = json_decode(file_get_contents("php://input"), true);

if (!isset($datos['peso']) || !isset($datos['altura'])) {
    http_response_code(400);
    echo json_encode(array('error' => 'Datos incompletos o incorrectos.'));
    exit; 
}

$peso = floatval($datos['peso']);
$altura = floatval($datos['altura']);

if ($altura === 0 || $peso === 0) {
    http_response_code(400);
    echo json_encode(array('error' => 'El peso y la altura deben ser mayores a 0.'));
    exit; 
}


$imc = $peso / ($altura * $altura);

echo json_encode(array('imc' => $imc));