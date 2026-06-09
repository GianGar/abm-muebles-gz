<?php
require_once __DIR__ . '/../modelo/Mueble.php';

class MuebleController {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function mostrarCatalogo() {
        $muebles = Mueble::obtenerTodos($this->pdo);
        require_once __DIR__ . '/../vista/public/index.php';
    }
}
?>