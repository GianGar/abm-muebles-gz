<?php
class Mueble
{
    private $id;
    private $descripcion;
    private $categoria;   // objeto Categoria
    private $ancho;
    private $alto;
    private $largo;
    private $peso;

    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }
    public function setDescripcion($desc)
    {
        $this->descripcion = $desc;
    }

    public function getCategoria()
    {
        return $this->categoria;
    }
    public function setCategoria($cat)
    {
        $this->categoria = $cat;
    }

    public function getAncho()
    {
        return $this->ancho;
    }
    public function setAncho($ancho)
    {
        $this->ancho = $ancho;
    }

    public function getAlto()
    {
        return $this->alto;
    }
    public function setAlto($alto)
    {
        $this->alto = $alto;
    }

    public function getLargo()
    {
        return $this->largo;
    }
    public function setLargo($largo)
    {
        $this->largo = $largo;
    }

    public function getPeso()
    {
        return $this->peso;
    }
    public function setPeso($peso)
    {
        $this->peso = $peso;
    }
}
?>