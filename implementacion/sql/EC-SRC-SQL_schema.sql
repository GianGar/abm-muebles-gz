-- =====================================================
-- EC-SRC-SQL | Script de base de datos
-- Proyecto: ABM de Muebles
-- Motor: MariaDB 10.4.32 (compatible MySQL)
-- Fecha: 26/05/2026
-- =====================================================

CREATE DATABASE IF NOT EXISTS abm_muebles
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE abm_muebles;

-- -----------------------------------------------------
-- Tabla: categoria
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS categoria (
    id_categoria INT          NOT NULL AUTO_INCREMENT,
    nombre       VARCHAR(50)  NOT NULL,
    descripcion  VARCHAR(255) NULL,
    PRIMARY KEY (id_categoria),
    UNIQUE KEY uq_categoria_nombre (nombre)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------
-- Tabla: mueble
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS mueble (
    id_mueble    INT            NOT NULL AUTO_INCREMENT,
    descripcion  VARCHAR(255)   NOT NULL,
    id_categoria INT            NOT NULL,
    ancho        DECIMAL(10,2)  NOT NULL,
    alto         DECIMAL(10,2)  NOT NULL,
    largo        DECIMAL(10,2)  NOT NULL,
    peso         DECIMAL(10,2)  NULL,
    PRIMARY KEY (id_mueble),
    CONSTRAINT fk_mueble_categoria
        FOREIGN KEY (id_categoria)
        REFERENCES categoria (id_categoria)
        ON DELETE RESTRICT
        ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------
-- Tabla: usuario
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS usuario (
    id_usuario INT          NOT NULL AUTO_INCREMENT,
    usuario    VARCHAR(50)  NOT NULL,
    password   VARCHAR(255) NOT NULL,
    PRIMARY KEY (id_usuario),
    UNIQUE KEY uq_usuario_nombre (usuario)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- -----------------------------------------------------
-- Datos iniciales: categorías
-- -----------------------------------------------------
INSERT INTO categoria (nombre, descripcion) VALUES
    ('Sillas',   'Asientos con respaldo para uso individual'),
    ('Mesas',    'Superficies de apoyo para comedor, escritorio u otros usos'),
    ('Estantes', 'Estructuras de almacenamiento y exhibición'),
    ('Otros',    'Mobiliario no clasificado en las categorías anteriores');

-- -----------------------------------------------------
-- Datos iniciales: usuario administrador
-- Contraseña: admin123 (hasheada con bcrypt)
INSERT INTO usuario (usuario, password) VALUES
    ('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

-- -----------------------------------------------------
-- Datos de prueba: muebles
-- -----------------------------------------------------
INSERT INTO mueble (descripcion, id_categoria, ancho, alto, largo, peso) VALUES
    ('Silla de madera con respaldo recto', 1, 45.00, 90.00, 42.00, 4.00),
    ('Mesa de comedor 6 personas',         2, 160.00, 75.00, 90.00, 32.00),
    ('Estante flotante minimalista',       3, 80.00, 20.00, 15.00, 3.00),
    ('Sillón tapizado en gris',            1, 70.00, 85.00, 75.00, 18.00);