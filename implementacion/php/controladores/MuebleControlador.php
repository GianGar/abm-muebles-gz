<?php
/**
 * PROYECTO: ABM de Muebles
 * ARCHIVO: controladores/MuebleControlador.php
 * DESCRIPCIÓN: Controlador para gestionar las acciones y flujos lógicos.
 * * HISTORIAL DE CAMBIOS:
 * v1.0.0 (10/06/2026) - Métodos iniciales listar() y agregar().
 * v1.3.0 (24/06/2026) - Adición de la acción eliminar() y control de alertas.
 */

class MuebleControlador {
    private $mapeador;

    public function __construct() {
        $this->mapeador = new MuebleMapeador();
    }

    public function listar() {
        $listaMuebles = $this->mapeador->buscarTodos();
        $mensajeExito = $_GET['exito'] ?? null;
        $mensajeEliminado = $_GET['eliminado'] ?? null;
        
        require_once 'vistas/listar.php';
    }

    public function agregar() {
        $errores = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $descripcion = trim($_POST['descripcion'] ?? '');
            $idCategoria = (int)($_POST['id_categoria'] ?? 0);
            $ancho = (float)($_POST['ancho'] ?? 0);
            $alto = (float)($_POST['alto'] ?? 0);
            $largo = (float)($_POST['largo'] ?? 0);
            $peso = $_POST['peso'] !== '' ? (float)$_POST['peso'] : null;

            if (empty($descripcion)) $errores[] = "La descripción es obligatoria.";
            if ($idCategoria <= 0) $errores[] = "Debe seleccionar una categoría.";
            if ($ancho <= 0 || $alto <= 0 || $largo <= 0) $errores[] = "Las dimensiones deben ser mayores a 0.";

            if (empty($errores)) {
                $nuevoMueble = [
                    'descripcion' => $descripcion,
                    'id_categoria' => $idCategoria,
                    'ancho' => $ancho,
                    'alto' => $alto,
                    'largo' => $largo,
                    'peso' => $peso
                ];

                if ($this->mapeador->insertar($nuevoMueble)) {
                    header("Location: index.php?accion=listar&exito=1");
                    exit();
                } else {
                    $errores[] = "No se pudo guardar en la base de datos.";
                }
            }
        }

        $categorias = $this->mapeador->obtenerCategorias();
        require_once 'vistas/agregar.php';
    }

    public function eliminar() {
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

        if ($id > 0) {
            if ($this->mapeador->eliminar($id)) {
                header("Location: index.php?accion=listar&eliminado=1");
                exit();
            }
        }
        header("Location: index.php?accion=listar");
        exit();
    }
}