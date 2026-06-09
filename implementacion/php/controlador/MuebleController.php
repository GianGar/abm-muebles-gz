<?php
require_once __DIR__ . '/../modelo/Mueble.php';
require_once __DIR__ . '/../modelo/Categoria.php';

class MuebleController {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // CU01: Catálogo público
    public function mostrarCatalogo() {
        $muebles = Mueble::obtenerTodos($this->pdo);
        require_once __DIR__ . '/../vista/public/index.php';
    }

    // Pantalla de administración (tabla + modal para agregar)
    public function panelAdmin() {
        // Obtener todos los muebles
        $muebles = Mueble::obtenerTodos($this->pdo);
        // Obtener todas las categorías para el select del modal
        $stmt = $this->pdo->query("SELECT id_categoria, nombre FROM categoria ORDER BY nombre");
        $categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // Incluir la vista
        require_once __DIR__ . '/../vista/admin/index.php';
    }

    // CU02: Guardar un nuevo mueble
    public function guardar() {
        // Validar campos obligatorios
        if (empty($_POST['descripcion']) || empty($_POST['id_categoria']) || 
            empty($_POST['ancho']) || empty($_POST['alto']) || empty($_POST['largo'])) {
            header('Location: admin.php?error=1');
            exit;
        }

        $mueble = new Mueble($this->pdo);
        $mueble->establecerDescripcion($_POST['descripcion']);
        $mueble->establecerAncho($_POST['ancho']);
        $mueble->establecerAlto($_POST['alto']);
        $mueble->establecerLargo($_POST['largo']);
        $mueble->establecerPeso(empty($_POST['peso']) ? null : $_POST['peso']);

        // Obtener la categoría
        $id_categoria = $_POST['id_categoria'];
        $categoria = $this->obtenerCategoriaPorId($id_categoria);
        if (!$categoria) {
            header('Location: admin.php?error=2');
            exit;
        }
        $mueble->establecerCategoria($categoria);

        if ($mueble->guardar()) {
            header('Location: admin.php?success=1');
        } else {
            header('Location: admin.php?error=3');
        }
        exit;
    }

    // Métodos temporales para CU03 y CU04 (aún no implementados)
    public function actualizar() {
        header('Location: admin.php?msg=modificacion_no_implementada');
        exit;
    }

    public function eliminar($id) {
        header('Location: admin.php?msg=eliminacion_no_implementada');
        exit;
    }

    public function obtenerMueble($id) {
        echo json_encode(['error' => 'Modificación no implementada aún']);
        exit;
    }

    private function obtenerCategoriaPorId($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM categoria WHERE id_categoria = ?");
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($data) {
            $cat = new Categoria($this->pdo);
            $cat->establecerId($data['id_categoria']);
            $cat->establecerNombre($data['nombre']);
            return $cat;
        }
        return null;
    }
}
?>