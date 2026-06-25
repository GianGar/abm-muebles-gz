<?php
/**
 * PROYECTO: ABM de Muebles
 * ARCHIVO: mapeadores/Conexion.php
 * DESCRIPCIÓN: Clase Singleton para conectar a la BD usando PDO.
 * * HISTORIAL DE CAMBIOS:
 * v1.0.0 (11/06/2026) - Creación inicial del componente de conexión.
 * v1.1.1 (15/06/2026) - Se trabajo con Singleton
 */

class Conexion {
    private static ?PDO $pdo = null;

    public static function conectar() {
        if (self::$pdo === null) {
            $c = require 'config/base_datos.php';
            self::$pdo = new PDO("mysql:host={$c['host']};dbname={$c['bd']};charset=utf8mb4", $c['user'], $c['pass']);
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$pdo;
    }
}