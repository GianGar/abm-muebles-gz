<?php
require_once __DIR__ . '/MapperInterface.php';
require_once __DIR__ . '/../modelo/Categoria.php';

class CategoriaMapper implements MapperInterface
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function findAll(): array
    {
        $stmt = $this->pdo->query("SELECT id_categoria, nombre FROM categoria ORDER BY nombre");
        $categorias = [];
        while ($row = $stmt->fetch()) {
            $cat = new Categoria();
            $cat->setId($row['id_categoria']);
            $cat->setNombre($row['nombre']);
            $categorias[] = $cat;
        }
        return $categorias;
    }

    public function findById(int $id): ?object
    {
        $stmt = $this->pdo->prepare("SELECT id_categoria, nombre FROM categoria WHERE id_categoria = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch();
        if (!$row)
            return null;
        $cat = new Categoria();
        $cat->setId($row['id_categoria']);
        $cat->setNombre($row['nombre']);
        return $cat;
    }

    public function insert(object $obj): bool
    { /* no usado */
        return false;
    }
    public function update(object $obj): bool
    {
        return false;
    }
    public function delete(int $id): bool
    {
        return false;
    }
}
?>