<?php
/**
 * PROYECTO: ABM de Muebles
 * ARCHIVO: controladores/MuebleControlador.php
 * DESCRIPCIÓN: Controlador del MVC para gestionar el flujo de Muebles.
 * * HISTORIAL DE CAMBIOS:
 * v1.0.0 (26/05/2026) - Creación e importación del script de la base de datos.
 * v1.2.0 (24/06/2026) - Separación de dimensiones en columnas y acordeón dinámico.
 * v1.3.0 (24/06/2026) - Implementación del método y acción para Eliminar (CU-06).
 * v1.4.0 (25/06/2026) - Integración de Composer y Autoloading automático.
 */

// Se incluye el cargador automatizado de Composer para gestionar controladores y mapeadores
require_once 'vendor/autoload.php';

$controlador = new MuebleControlador();
$accion = $_GET['accion'] ?? 'listar';

if ($accion === 'agregar') {
    $controlador->agregar();
} elseif ($accion === 'eliminar') {
    $controlador->eliminar();
} else {
    $controlador->listar();
}