<?php
require_once __DIR__ . '/MapperInterface.php';
require_once __DIR__ . '/../modelo/Mueble.php';
require_once __DIR__ . '/../modelo/Categoria.php';

class MuebleMapper implements MapperInterface
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function findById(int $id): ?object
    {
        $stmt = $this->pdo->prepare("
            SELECT m.*, c.nombre as categoria_nombre 
            FROM mueble m 
            JOIN categoria c ON m.id_categoria = c.id_categoria 
            WHERE m.id_mueble = ?
        ");
        $stmt->execute([$id]);
        $row = $stmt->fetch();
        if (!$row)
            return null;
        return $this->crearMueble($row);
    }

    public function findAll(): array
    {
        $stmt = $this->pdo->query("
            SELECT m.*, c.nombre as categoria_nombre 
            FROM mueble m 
            JOIN categoria c ON m.id_categoria = c.id_categoria 
            ORDER BY m.id_mueble DESC
        ");
        $muebles = [];
        while ($row = $stmt->fetch()) {
            $muebles[] = $this->crearMueble($row);
        }
        return $muebles;
    }

    public function insert(object $obj): bool
    {
        if (!$obj instanceof Mueble)
            return false;
        $sql = "INSERT INTO mueble (descripcion, id_categoria, ancho, alto, largo, peso) 
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $obj->getDescripcion(),
            $obj->getCategoria()->getId(),
            $obj->getAncho(),
            $obj->getAlto(),
            $obj->getLargo(),
            $obj->getPeso()
        ]);
    }

    public function update(object $obj): bool
    {
        if (!$obj instanceof Mueble)
            return false;
        $sql = "UPDATE mueble SET descripcion=?, id_categoria=?, ancho=?, alto=?, largo=?, peso=? WHERE id_mueble=?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $obj->getDescripcion(),
            $obj->getCategoria()->getId(),
            $obj->getAncho(),
            $obj->getAlto(),
            $obj->getLargo(),
            $obj->getPeso(),
            $obj->getId()
        ]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM mueble WHERE id_mueble = ?");
        return $stmt->execute([$id]);
    }

    private function crearMueble(array $row): Mueble
    {
        $categoria = new Categoria();
        $categoria->setId($row['id_categoria']);
        $categoria->setNombre($row['categoria_nombre']);

        $mueble = new Mueble();
        $mueble->setId($row['id_mueble']);
        $mueble->setDescripcion($row['descripcion']);
        $mueble->setCategoria($categoria);
        $mueble->setAncho($row['ancho']);
        $mueble->setAlto($row['alto']);
        $mueble->setLargo($row['largo']);
        $mueble->setPeso($row['peso']);
        return $mueble;
    }
}
?>