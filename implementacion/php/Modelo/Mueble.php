<?php
/**
 * Clase pública de muebles
 *
 * Esta clase se usará para el manejo de los datos de los muebles que se usarán en el ABM.
 * @author Zapata Agustín
 * @version 1.0
 */

class Mueble {
    // Propiedades privadas
    private int $idMueble;
    private string $descripcion;
    private string $categoria;
    private float $ancho;
    private float $alto;
    private float $largo;
    private float $peso;

    // Constructor
    public function __construct(
        int $idMueble, 
        string $descripcion, 
        string $categoria, 
        float $ancho, 
        float $alto, 
        float $largo, 
        float $peso
    ) {
        $this->idMueble = $idMueble;
        $this->descripcion = $descripcion;
        $this->categoria = $categoria;
        $this->ancho = $ancho;
        $this->alto = $alto;
        $this->largo = $largo;
        $this->peso = $peso;
    }

    // Getters y Setters
    public function getIdMueble(): int {
        return $this->idMueble;
    }

    public function setIdMueble(int $idMueble): void {
        $this->idMueble = $idMueble;
    }

    public function getDescripcion(): string {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): void {
        $this->descripcion = $descripcion;
    }

    public function getCategoria(): string {
        return $this->categoria;
    }

    public function setCategoria(string $categoria): void {
        $this->categoria = $categoria;
    }

    public function getAncho(): float {
        return $this->ancho;
    }

    public function setAncho(float $ancho): void {
        $this->ancho = $ancho;
    }

    public function getAlto(): float {
        return $this->alto;
    }

    public function setAlto(float $alto): void {
        $this->alto = $alto;
    }

    public function getLargo(): float {
        return $this->largo;
    }

    public function setLargo(float $largo): void {
        $this->largo = $largo;
    }

    public function getPeso(): float {
        return $this->peso;
    }

    public function setPeso(float $peso): void {
        $this->peso = $peso;
    }
}