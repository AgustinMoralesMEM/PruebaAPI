<?php

require_once '../config/database.php';
require_once '../repository/UsuarioRepository.php';
require_once '../models/Usuario.php';
require_once '../utils/Utils.php';
require_once '../utils/Curp.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Crear un nuevo usuario con los datos recibidos
    $data = file_get_contents('php://input');
    $usuarioData = json_decode($data, true);
    $fotoPerfilBinaria = base64_decode($usuarioData['fotoPerfil']);
    $curpObj = new Curp($usuarioData['nombre'], $usuarioData['apellidoPaterno'], $usuarioData['apellidoMaterno'],$usuarioData['fechaNacimiento'], getLetraGenero($usuarioData['genero']), getNumeroEntidad($usuarioData['entidadNacimiento']));
    $curpString = $curpObj->curp;
    $rfcString = '';
    if ($usuarioData['edad'] >= 18) {
        $rfcString = substr($curpString, 0, 10);
    }
    $usuario = new Usuario(
        $usuarioData['apellidoPaterno'],
        $usuarioData['apellidoMaterno'],
        $usuarioData['nombre'],
        $usuarioData['edad'],
        $usuarioData['genero'],
        $usuarioData['entidadNacimiento'],
        $usuarioData['fechaNacimiento'],
        $curpString,
        $rfcString,
        $usuarioData['peso'],
        $usuarioData['altura'],
        $fotoPerfilBinaria
    );
    $usuarioRepository = new UsuarioRepository($pdo);
    $id = $usuarioRepository->crearUsuario($usuario);
    echo json_encode(array('message' => 'Usuario creado con éxito', 'id' => $id, 'code' => 200));
} elseif ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    // Actualizar un usuario con los datos recibidos
    $data = file_get_contents('php://input');
    $usuarioData = json_decode($data, true);
    $fotoPerfilBinaria = base64_decode($usuarioData['fotoPerfil']);
    $curpObj = new Curp($usuarioData['nombre'], $usuarioData['apellidoPaterno'], $usuarioData['apellidoMaterno'],$usuarioData['fechaNacimiento'], getLetraGenero($usuarioData['genero']), getNumeroEntidad($usuarioData['entidadNacimiento']));
    $curpString = $curpObj->curp;
    $rfcString = '';
    if (intval($usuarioData['edad']) >= 18) {
        $rfcString = substr($curpString, 0, 10);
    }
    $usuario = new Usuario(
        $usuarioData['apellidoPaterno'],
        $usuarioData['apellidoMaterno'],
        $usuarioData['nombre'],
        $usuarioData['edad'],
        $usuarioData['genero'],
        $usuarioData['entidadNacimiento'],
        $usuarioData['fechaNacimiento'],
        $curpString,
        $rfcString,
        $usuarioData['peso'],
        $usuarioData['altura'],
        $fotoPerfilBinaria
    );
    $usuario->setId($usuarioData['id']);
    $usuarioRepository = new UsuarioRepository($pdo);
    $usuarioRepository->actualizarUsuario($usuario);
    echo json_encode(array('message' => 'Usuario actualizado con éxito', 'code' => 200));
} elseif ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    // Eliminar un usuario con el id recibido
    $id = $_GET['id'];
    $usuarioRepository = new UsuarioRepository($pdo);
    $usuarioRepository->eliminarUsuario($id);
    echo json_encode(array('message' => 'Usuario eliminado con éxito', 'code' => 200));
} elseif ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // obtener todos los usuarios y enviarlos como respuesta json 
    $usuarioRepository = new UsuarioRepository($pdo);
    $usuarios = $usuarioRepository->obtenerTodosLosUsuarios();
    echo json_encode($usuarios, JSON_UNESCAPED_UNICODE);
} else {
    http_response_code(405);
    echo json_encode(array('message' => 'Método no permitido. Se espera una solicitud POST, PUT, DELETE o GET.', 'code' => 405));
    exit;
}
