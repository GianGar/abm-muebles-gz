<?php
$pdo = require __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../controlador/MuebleController.php';

$controller = new MuebleController($pdo);
$accion = $_GET['accion'] ?? 'panel';

switch ($accion) {
    case 'guardar':
        $controller->guardar();
        break;
    case 'eliminar':
        $id = $_GET['id'] ?? 0;
        $controller->eliminar($id);
        break;
    case 'obtener':
        $id = $_GET['id'] ?? 0;
        $controller->obtenerMueble($id);
        break;
    case 'actualizar':
        $controller->actualizar();
        break;
    default:
        $controller->panelAdmin();
}
?>