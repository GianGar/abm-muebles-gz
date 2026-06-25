<?php
/**
 * PROYECTO: ABM de Muebles
 * ARCHIVO: mapeadores/MuebleMapeador.php
 * DESCRIPCIÓN: Data Mapper encargado de las consultas SQL directas.
 * * HISTORIAL DE CAMBIOS:
 * v1.0.0 (15/05/2026) - Primera implementacion del mapper
 * v2.0.0 (24/06/2026) - Mejorando y limpiando el codigo para tener un mapper mas organizado.
 */

class MuebleMapeador {
    private $db;

    public function __construct() {
        $this->db = Conexion::conectar();
    }

    // CU-11: Listar muebles
    public function buscarTodos() {
        $sql = "SELECT m.*, c.nombre AS nombre_categoria 
                FROM mueble m 
                INNER JOIN categoria c ON m.id_categoria = c.id_categoria
                ORDER BY m.id_mueble DESC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // CU-05: Insertar un mueble
    public function insertar($datos) {
        $sql = "INSERT INTO mueble (descripcion, id_categoria, ancho, alto, largo, peso) 
                VALUES (:descripcion, :id_categoria, :ancho, :alto, :largo, :peso)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':descripcion'  => $datos['descripcion'],
            ':id_categoria' => $datos['id_categoria'],
            ':ancho'        => $datos['ancho'],
            ':alto'         => $datos['alto'],
            ':largo'        => $datos['largo'],
            ':peso'         => $datos['peso']
        ]);
    }

    // CU-06: Eliminar mueble
    public function eliminar($id) {
        $sql = "DELETE FROM mueble WHERE id_mueble = :id_mueble";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':id_mueble' => $id]);
    }

    // Trae las categorías para el select y el acordeón descriptivo
    public function obtenerCategorias() {
        $stmt = $this->db->query("SELECT id_categoria, nombre, descripcion FROM categoria ORDER BY nombre ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}