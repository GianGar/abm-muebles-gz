<?php
require_once __DIR__ . '/Categoria.php';

class Mueble {
    private $id_mueble;
    private $descripcion;
    private $categoria;
    private $ancho;
    private $alto;
    private $largo;
    private $peso;
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Getters
    public function obtenerId() { return $this->id_mueble; }
    public function obtenerDescripcion() { return $this->descripcion; }
    public function obtenerCategoria() { return $this->categoria; }
    public function obtenerAncho() { return $this->ancho; }
    public function obtenerAlto() { return $this->alto; }
    public function obtenerLargo() { return $this->largo; }
    public function obtenerPeso() { return $this->peso; }

    // Setters
    public function establecerId($id) { $this->id_mueble = $id; }
    public function establecerDescripcion($desc) { $this->descripcion = $desc; }
    public function establecerCategoria($cat) { $this->categoria = $cat; }
    public function establecerAncho($ancho) { $this->ancho = $ancho; }
    public function establecerAlto($alto) { $this->alto = $alto; }
    public function establecerLargo($largo) { $this->largo = $largo; }
    public function establecerPeso($peso) { $this->peso = $peso; }

    // Obtener todos los muebles
    public static function obtenerTodos($pdo) {
        $stmt = $pdo->query("
            SELECT m.*, c.nombre as categoria_nombre 
            FROM mueble m 
            JOIN categoria c ON m.id_categoria = c.id_categoria 
            ORDER BY m.id_mueble DESC
        ");
        $muebles = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $m = new Mueble($pdo);
            $m->establecerId($row['id_mueble']);
            $m->establecerDescripcion($row['descripcion']);
            $m->establecerAncho($row['ancho']);
            $m->establecerAlto($row['alto']);
            $m->establecerLargo($row['largo']);
            $m->establecerPeso($row['peso']);

            $cat = new Categoria($pdo);
            $cat->establecerId($row['id_categoria']);
            $cat->establecerNombre($row['categoria_nombre']);
            $m->establecerCategoria($cat);

            $muebles[] = $m;
        }
        return $muebles;
    }

    // Obtener un mueble por ID
    public static function obtenerPorId($pdo, $id) {
        $stmt = $pdo->prepare("
            SELECT m.*, c.nombre as categoria_nombre 
            FROM mueble m 
            JOIN categoria c ON m.id_categoria = c.id_categoria 
            WHERE m.id_mueble = ?
        ");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $m = new Mueble($pdo);
            $m->establecerId($row['id_mueble']);
            $m->establecerDescripcion($row['descripcion']);
            $m->establecerAncho($row['ancho']);
            $m->establecerAlto($row['alto']);
            $m->establecerLargo($row['largo']);
            $m->establecerPeso($row['peso']);

            $cat = new Categoria($pdo);
            $cat->establecerId($row['id_categoria']);
            $cat->establecerNombre($row['categoria_nombre']);
            $m->establecerCategoria($cat);

            return $m;
        }
        return null;
    }

    public function guardar() {
        $sql = "INSERT INTO mueble (descripcion, id_categoria, ancho, alto, largo, peso) 
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $this->obtenerDescripcion(),
            $this->obtenerCategoria()->obtenerId(),
            $this->obtenerAncho(),
            $this->obtenerAlto(),
            $this->obtenerLargo(),
            $this->obtenerPeso()
        ]);
    }

    public function actualizar() {
        $sql = "UPDATE mueble SET descripcion=?, id_categoria=?, ancho=?, alto=?, largo=?, peso=? WHERE id_mueble=?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $this->obtenerDescripcion(),
            $this->obtenerCategoria()->obtenerId(),
            $this->obtenerAncho(),
            $this->obtenerAlto(),
            $this->obtenerLargo(),
            $this->obtenerPeso(),
            $this->obtenerId()
        ]);
    }

    public function eliminar() {
        $sql = "DELETE FROM mueble WHERE id_mueble = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$this->obtenerId()]);
    }
}
?>