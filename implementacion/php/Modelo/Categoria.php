<?php
class Categoria
{
    private $id_categoria;
    private $nombre;
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function obtenerId()
    {
        return $this->id_categoria;
    }
    public function establecerId($id)
    {
        $this->id_categoria = $id;
    }

    public function obtenerNombre()
    {
        return $this->nombre;
    }
    public function establecerNombre($nombre)
    {
        $this->nombre = $nombre;
    }
}
?>