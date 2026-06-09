<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Administrador de Muebles</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1>Gestión de Muebles</h1>
            <a href="../public/index.php" class="btn btn-outline-secondary">Ver tienda</a>
        </div>

        <!-- Mensajes de éxito/error -->
        <?php if (isset($_GET['success'])): ?>
            <div class="alert alert-success">Mueble agregado correctamente.</div>
        <?php elseif (isset($_GET['error'])): ?>
            <div class="alert alert-danger">Error al guardar el mueble. Verifique los datos.</div>
        <?php elseif (isset($_GET['msg'])): ?>
            <div class="alert alert-info">Funcionalidad en desarrollo.</div>
        <?php endif; ?>

        <!-- Botón para abrir el modal de agregar -->
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalMueble">
            + Agregar mueble
        </button>

        <!-- Tabla de muebles -->
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Descripción</th>
                    <th>Categoría</th>
                    <th>Ancho (cm)</th>
                    <th>Alto (cm)</th>
                    <th>Largo (cm)</th>
                    <th>Peso (kg)</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($muebles as $m): ?>
                    <tr>
                        <td>
                            <?= $m->obtenerId() ?>
                        </td>
                        <td>
                            <?= htmlspecialchars($m->obtenerDescripcion()) ?>
                        </td>
                        <td>
                            <?= htmlspecialchars($m->obtenerCategoria()->obtenerNombre()) ?>
                        </td>
                        <td>
                            <?= $m->obtenerAncho() ?>
                        </td>
                        <td>
                            <?= $m->obtenerAlto() ?>
                        </td>
                        <td>
                            <?= $m->obtenerLargo() ?>
                        </td>
                        <td>
                            <?= $m->obtenerPeso() ?? '-' ?>
                        </td>
                        <td>
                            <!-- Botones no funcionales -->
                            <button class="btn btn-sm btn-warning"
                                onclick="alert('Modificar no implementado aún')">Modificar</button>
                            <button class="btn btn-sm btn-danger"
                                onclick="alert('Eliminar no implementado aún')">Borrar</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Modal para agregar mueble (solo CU02) -->
    <div class="modal fade" id="modalMueble" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Agregar mueble</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <form action="admin.php?accion=guardar" method="POST">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Descripción</label>
                            <input type="text" name="descripcion" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>Categoría</label>
                            <select name="id_categoria" class="form-select" required>
                                <option value="">Seleccione</option>
                                <?php foreach ($categorias as $cat): ?>
                                    <option value="<?= $cat['id_categoria'] ?>">
                                        <?= htmlspecialchars($cat['nombre']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label>Ancho (cm)</label>
                                <input type="number" step="0.01" name="ancho" class="form-control" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label>Alto (cm)</label>
                                <input type="number" step="0.01" name="alto" class="form-control" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label>Largo (cm)</label>
                                <input type="number" step="0.01" name="largo" class="form-control" required>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label>Peso (kg) (opcional)</label>
                                <input type="number" step="0.01" name="peso" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>