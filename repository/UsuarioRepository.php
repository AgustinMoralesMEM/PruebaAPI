<?php

require_once '../models/Usuario.php';

class UsuarioRepository {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function crearUsuario(Usuario $usuario) {
        $sql = "INSERT INTO usuarios (apellido_paterno, apellido_materno, nombre, edad, genero, entidad_nacimiento, fecha_nacimiento, curp, rfc, peso, altura, foto_perfil)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $usuario->getApellidoPaterno(),
            $usuario->getApellidoMaterno(),
            $usuario->getNombre(),
            $usuario->getEdad(),
            $usuario->getGenero(),
            $usuario->getEntidadNacimiento(),
            $usuario->getFechaNacimiento(),
            $usuario->getCurp(),
            $usuario->getRfc(),
            $usuario->getPeso(),
            $usuario->getAltura(),
            $usuario->getFotoPerfil()
        ]);
        return $this->pdo->lastInsertId();
    }

    public function obtenerUsuarioPorId($id) {
        $sql = "SELECT * FROM usuarios WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        return $usuario;
    }

    public function actualizarUsuario(Usuario $usuario) {
        $sql = "UPDATE usuarios SET apellido_paterno=?, apellido_materno=?, nombre=?, edad=?, genero=?, entidad_nacimiento=?, fecha_nacimiento=?, curp=?, rfc=?, peso=?, altura=?, foto_perfil=? WHERE id=?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $usuario->getApellidoPaterno(),
            $usuario->getApellidoMaterno(),
            $usuario->getNombre(),
            $usuario->getEdad(),
            $usuario->getGenero(),
            $usuario->getEntidadNacimiento(),
            $usuario->getFechaNacimiento(),
            $usuario->getCurp(),
            $usuario->getRfc(),
            $usuario->getPeso(),
            $usuario->getAltura(),
            $usuario->getFotoPerfil(),
            $usuario->getId()
        ]);
        return $this->pdo->lastInsertId();
    }

    public function obtenerFotoUsuarioPorId($idPerfil) {
        $sql = "SELECT foto_perfil FROM usuarios WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$idPerfil]);
        $foto = $stmt->fetchColumn();
        return $foto;
    }

    public function eliminarUsuario($id) {
        $sql = "DELETE FROM usuarios WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
    }

    public function obtenerTodosLosUsuarios() {
        $sql = "SELECT * FROM usuarios";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $usuariosObjetos = array();
        foreach ($usuarios as $usuario) {
            $usuarioObjeto = new Usuario(
                $usuario['apellido_paterno'],
                $usuario['apellido_materno'],
                $usuario['nombre'],
                $usuario['edad'],
                $usuario['genero'],
                $usuario['entidad_nacimiento'],
                $usuario['fecha_nacimiento'],
                $usuario['curp'],
                $usuario['rfc'],
                $usuario['peso'],
                $usuario['altura'],
                $usuario['foto_perfil']
            );
            $usuarioObjeto->setId($usuario['id']);
            $usuariosObjetos[] = $usuarioObjeto;
        }
        return $usuariosObjetos;
    }
    
}
