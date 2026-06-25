<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Muebles</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        
        <?php if (isset($mensajeExito)): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                ¡Mueble guardado con éxito!
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php if (isset($mensajeEliminado)): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                El mueble ha sido eliminado correctamente del catálogo.
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Catálogo de Muebles</h2>
            <a href="index.php?accion=agregar" class="btn btn-primary">+ Registrar Mueble</a>
        </div>

        <div class="card shadow-sm">
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Descripción</th>
                            <th>Categoría</th>
                            <th>Ancho (cm)</th>
                            <th>Alto (cm)</th>
                            <th>Largo (cm)</th>
                            <th>Peso</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($listaMuebles)): ?>
                            <tr><td colspan="8" class="text-center py-3 text-muted">No hay registros.</td></tr>
                        <?php else: ?>
                            <?php foreach ($listaMuebles as $m): ?>
                                <tr>
                                    <td><?= $m['id_mueble']; ?></td>
                                    <td><?= htmlspecialchars($m['descripcion']); ?></td>
                                    <td><span class="badge bg-secondary"><?= htmlspecialchars($m['nombre_categoria']); ?></span></td>
                                    <td><?= $m['ancho']; ?></td>
                                    <td><?= $m['alto']; ?></td>
                                    <td><?= $m['largo']; ?></td>
                                    <td><?= $m['peso'] !== null ? $m['peso'] . ' kg' : 'N/A'; ?></td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-warning disabled">Modificar</button>
                                        <a href="index.php?accion=eliminar&id=<?= $m['id_mueble']; ?>" 
                                           class="btn btn-sm btn-danger" 
                                           onclick="return confirm('¿Está seguro de que desea eliminar el mueble: <?= htmlspecialchars($m['descripcion']); ?>?');">
                                            Eliminar
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>