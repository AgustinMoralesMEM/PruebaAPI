<?php

class Usuario  implements JsonSerializable {
    private $id;
    private $apellidoPaterno;
    private $apellidoMaterno;
    private $nombre;
    private $edad;
    private $genero;
    private $entidadNacimiento;
    private $fechaNacimiento;
    private $curp;
    private $rfc;
    private $peso;
    private $altura;
    private $fotoPerfil;

    // Constructor
    public function __construct($apellidoPaterno, $apellidoMaterno, $nombre, $edad, $genero, $entidadNacimiento, $fechaNacimiento , $curp, $rfc, $peso, $altura, $fotoPerfil) {
        $this->apellidoPaterno = $apellidoPaterno;
        $this->apellidoMaterno = $apellidoMaterno;
        $this->nombre = $nombre;
        $this->edad = $edad;
        $this->genero = $genero;
        $this->entidadNacimiento = $entidadNacimiento;
        $this->fechaNacimiento = $fechaNacimiento;
        $this->curp = $curp;
        $this->rfc = $rfc;
        $this->peso = $peso;
        $this->altura = $altura;
        $this->fotoPerfil = $fotoPerfil;
    }

    public function jsonSerialize() {
        return [
            'id' => $this->id,
            'apellidoPaterno' => $this->apellidoPaterno,
            'apellidoMaterno' => $this->apellidoMaterno,
            'nombre' => $this->nombre,
            'edad' => $this->edad,
            'genero' => $this->genero,
            'entidadNacimiento' => $this->entidadNacimiento,
            'fechaNacimiento' => $this->fechaNacimiento,
            'curp' => $this->curp,
            'rfc' => $this->rfc,
            'peso' => $this->peso,
            'altura' => $this->altura,
            'fotoPerfil' => base64_encode($this->fotoPerfil)
        ];
    }	

    public static function crearTabla($pdo) {
        $sql = "CREATE TABLE IF NOT EXISTS usuarios (
            id INT AUTO_INCREMENT PRIMARY KEY,
            apellido_paterno VARCHAR(50),
            apellido_materno VARCHAR(50),
            nombre VARCHAR(50),
            edad INT,
            genero ENUM('Masculino', 'Femenino'),
            entidad_nacimiento VARCHAR(100),
            fecha_nacimiento DATE,
            curp VARCHAR(18),
            rfc VARCHAR(13),
            peso FLOAT,
            altura FLOAT,
            foto_perfil LONGBLOB
        )";

        $pdo->exec($sql);
    }

        // Getters y setters
        public function getId() {
            return $this->id;
        }
    
        public function setId($id) {
            $this->id = $id;
        }
    
        public function getApellidoPaterno() {
            return $this->apellidoPaterno;
        }
    
        public function setApellidoPaterno($apellidoPaterno) {
            $this->apellidoPaterno = $apellidoPaterno;
        }
    
        public function getApellidoMaterno() {
            return $this->apellidoMaterno;
        }
    
        public function setApellidoMaterno($apellidoMaterno) {
            $this->apellidoMaterno = $apellidoMaterno;
        }
    
        public function getNombre() {
            return $this->nombre;
        }
    
        public function setNombre($nombre) {
            $this->nombre = $nombre;
        }
    
        public function getEdad() {
            return $this->edad;
        }
    
        public function setEdad($edad) {
            $this->edad = $edad;
        }
    
        public function getGenero() {
            return $this->genero;
        }
    
        public function setGenero($genero) {
            $this->genero = $genero;
        }
    
        public function getEntidadNacimiento() {
            return $this->entidadNacimiento;
        }
    
        public function setEntidadNacimiento($entidadNacimiento) {
            $this->entidadNacimiento = $entidadNacimiento;
        }
    
        public function getPeso() {
            return $this->peso;
        }
    
        public function setPeso($peso) {
            $this->peso = $peso;
        }
    
        public function getAltura() {
            return $this->altura;
        }
    
        public function setAltura($altura) {
            $this->altura = $altura;
        }
    
        public function getFotoPerfil() {
            return $this->fotoPerfil;
        }
    
        public function setFotoPerfil($fotoPerfil) {
            $this->fotoPerfil = $fotoPerfil;
        }

        public function getFechaNacimiento() {
            return $this->fechaNacimiento;
        }
        public function setFechaNacimiento($fechaNacimiento) {
            $this->fechaNacimiento = $fechaNacimiento;
        }
        public function getCurp() {
            return $this->curp;
        }
        public function setCurp($curp) {
            $this->curp = $curp;
        }
        public function getRfc() {
            return $this->rfc;
        }
        public function setRfc($rfc) {
            $this->rfc = $rfc;
        }

}
