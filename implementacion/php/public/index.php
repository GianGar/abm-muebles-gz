<?php
$pdo = require __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../controlador/MuebleController.php';

$controller = new MuebleController($pdo);
$controller->mostrarCatalogo();
?>