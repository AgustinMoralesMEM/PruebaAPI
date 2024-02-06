<?php

function getNumeroEntidad($nombre_entidad)
{
    $entidades = array(
        "Aguascalientes",
        "Baja California",
        "Baja California Sur",
        "Campeche",
        "Chiapas",
        "Chihuahua",
        "Ciudad de México",
        "Coahuila",
        "Colima",
        "Durango",
        "Estado de México",
        "Guanajuato",
        "Guerrero",
        "Hidalgo",
        "Jalisco",
        "Michoacán",
        "Morelos",
        "Nayarit",
        "Nuevo León",
        "Oaxaca",
        "Puebla",
        "Querétaro",
        "Quintana Roo",
        "San Luis Potosí",
        "Sinaloa",
        "Sonora",
        "Tabasco",
        "Tamaulipas",
        "Tlaxcala",
        "Veracruz",
        "Yucatán",
        "Zacatecas"
    );

    $indice = array_search($nombre_entidad, $entidades);

    // Verificar si se encontró la entidad en la lista
    if ($indice !== false) {
        // Sumar 1 al índice para obtener el número de entidad
        $numero_entidad = $indice + 1;

        // Formatear el número de entidad a dos dígitos
        $numero_entidad_dos_digitos = sprintf('%02d', $numero_entidad);

        return $numero_entidad_dos_digitos;
    } else {
        // Si no se encuentra la entidad, devolver null o un mensaje de error
        return null;
    }
}

function getLetraGenero($genero)
{
    if ($genero === "Masculino") {
        return "H";
    } elseif ($genero === "Femenino") {
        return "M";
    } else {
        return null;
    }
}

function getFechaNacimiento($fecha_nacimiento)
{
    $fecha = new DateTime($fecha_nacimiento);
    return $fecha->format('y-m-d');
}

?>