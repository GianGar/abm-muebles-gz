<?php

/**
 * Catálogo público de muebles.
 *
 * Muestra el listado de muebles disponibles obtenido desde la base de datos.
 * No requiere autenticación (RF-01).
 *
 * @author Gargaglione, Giancarlo
 * @version 1.0
 */

// Configuración de conexión
$host     = 'localhost';
$dbname   = 'abm_muebles';
$user     = 'root';
$password = '';

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $user,
        $password,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
} catch (PDOException $e) {
    die('Error de conexión: ' . $e->getMessage());
}

// Consulta de muebles con su categoría
$stmt = $pdo->query(
    'SELECT m.descripcion, c.nombre AS categoria,
            m.ancho, m.alto, m.largo, m.peso
     FROM mueble m
     INNER JOIN categoria c ON m.id_categoria = c.id_categoria
     ORDER BY c.nombre, m.descripcion'
);

$muebles = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Muebles</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="contenedor-principal">
        <div class="header">
            <h1>Catálogo de muebles</h1>
            <a href="login.php">Iniciar sesión</a>
        </div>

        <div class="contenedor-tabla">
            <table>
                <thead>
                    <tr>
                        <th>Imagen</th>
                        <th>Descripción</th>
                        <th>Categoría</th>
                        <th>Medidas (an × al × la)</th>
                        <th>Peso</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($muebles)): ?>
                        <tr>
                            <td colspan="5">No hay muebles registrados.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($muebles as $mueble): ?>
                            <tr>
                                <td><div class="icono"></div></td>
                                <td><?= htmlspecialchars($mueble['descripcion']) ?></td>
                                <td><?= htmlspecialchars($mueble['categoria']) ?></td>
                                <td>
                                    <?= htmlspecialchars($mueble['ancho']) ?> ×
                                    <?= htmlspecialchars($mueble['alto']) ?> ×
                                    <?= htmlspecialchars($mueble['largo']) ?> cm
                                </td>
                                <td>
                                    <?= $mueble['peso'] !== null
                                        ? htmlspecialchars($mueble['peso']) . ' kg'
                                        : '—' ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="footer">
            Sistema de catálogo de muebles &mdash; Gestión de Calidad (2026)
        </div>
    </div>
</body>
</html>