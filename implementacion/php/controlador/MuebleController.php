<?php
require_once __DIR__ . '/../mappers/MuebleMapper.php';
require_once __DIR__ . '/../mappers/CategoriaMapper.php';
require_once __DIR__ . '/../modelo/Mueble.php';
require_once __DIR__ . '/../modelo/Categoria.php';

class MuebleController
{
    private $pdo;
    private $muebleMapper;
    private $categoriaMapper;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
        $this->muebleMapper = new MuebleMapper($pdo);
        $this->categoriaMapper = new CategoriaMapper($pdo);
    }

    // CU01: Listado público
    public function mostrarCatalogo()
    {
        $muebles = $this->muebleMapper->findAll();
        require_once __DIR__ . '/../vista/public/index.php';
    }

    // Pantalla de administración (tabla + modal)
    public function panelAdmin()
    {
        $muebles = $this->muebleMapper->findAll();
        $categorias = $this->categoriaMapper->findAll();
        require_once __DIR__ . '/../vista/admin/index.php';
    }

    // CU02: Agregar mueble
    public function guardar()
    {
        if (
            empty($_POST['descripcion']) || empty($_POST['id_categoria']) ||
            empty($_POST['ancho']) || empty($_POST['alto']) || empty($_POST['largo'])
        ) {
            header('Location: admin.php?error=1');
            exit;
        }

        $categoria = new Categoria();
        $categoria->setId($_POST['id_categoria']);

        $mueble = new Mueble();
        $mueble->setDescripcion($_POST['descripcion']);
        $mueble->setCategoria($categoria);
        $mueble->setAncho($_POST['ancho']);
        $mueble->setAlto($_POST['alto']);
        $mueble->setLargo($_POST['largo']);
        $mueble->setPeso(empty($_POST['peso']) ? null : $_POST['peso']);

        if ($this->muebleMapper->insert($mueble)) {
            header('Location: admin.php?success=1');
        } else {
            header('Location: admin.php?error=2');
        }
        exit;
    }

    // CU04: Eliminar mueble
    public function eliminar($id)
    {
        if ($this->muebleMapper->delete($id)) {
            header('Location: admin.php?deleted=1');
        } else {
            header('Location: admin.php?error=3');
        }
        exit;
    }

    // --- Métodos para CU03 (modificar) - Se implementara luego
    public function obtenerMueble($id)
    {
        $mueble = $this->muebleMapper->findById($id);
        if ($mueble) {
            echo json_encode([
                'id' => $mueble->getId(),
                'descripcion' => $mueble->getDescripcion(),
                'id_categoria' => $mueble->getCategoria()->getId(),
                'ancho' => $mueble->getAncho(),
                'alto' => $mueble->getAlto(),
                'largo' => $mueble->getLargo(),
                'peso' => $mueble->getPeso()
            ]);
        } else {
            echo json_encode(['error' => 'Mueble no encontrado']);
        }
        exit;
    }

    public function actualizar()
    {
        // Por ahora solo redirige (luego implementas la edición)
        header('Location: admin.php?msg=modificacion_no_implementada');
        exit;
    }
}
?>