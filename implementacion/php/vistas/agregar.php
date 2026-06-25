<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Mueble</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5" style="max-width: 600px;">
        
        <?php if (!empty($errores)): ?>
            <div class="alert alert-danger">
                <ul class="mb-0">
                    <?php foreach ($errores as $e): ?>
                        <li><?= htmlspecialchars($e); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white"><h5>Nuevo Mueble</h5></div>
            <div class="card-body">
                <form action="index.php?accion=agregar" method="POST">
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Descripción *</label>
                        <input type="text" class="form-control" name="descripcion" value="<?= htmlspecialchars($_POST['descripcion'] ?? ''); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Categoría *</label>
                        <select class="form-select" id="id_categoria" name="id_categoria" required onchange="filtrarAcordeon()">
                            <option value="">-- Seleccione --</option>
                            <?php foreach ($categorias as $c): ?>
                                <option value="<?= $c['id_categoria']; ?>" <?= (isset($_POST['id_categoria']) && $_POST['id_categoria'] == $c['id_categoria']) ? 'selected' : ''; ?>>
                                    <?= htmlspecialchars($c['nombre']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <?php foreach ($categorias as $c): ?>
                            <div class="accordion clase-acordeon d-none" id="acordeon-<?= $c['id_categoria']; ?>">
                                <div class="accordion-item border-info">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button bg-info-subtle text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#col-<?= $c['id_categoria']; ?>">
                                            Información sobre: <?= htmlspecialchars($c['nombre']); ?>
                                        </button>
                                    </h2>
                                    <div id="col-<?= $c['id_categoria']; ?>" class="accordion-collapse collapse show">
                                        <div class="accordion-body text-muted">
                                            <?= htmlspecialchars($c['descripcion']); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-4">
                            <label class="form-label small fw-bold">Ancho (cm) *</label>
                            <input type="number" step="0.01" class="form-control" name="ancho" value="<?= htmlspecialchars($_POST['ancho'] ?? ''); ?>" required>
                        </div>
                        <div class="col-4">
                            <label class="form-label small fw-bold">Alto (cm) *</label>
                            <input type="number" step="0.01" class="form-control" name="alto" value="<?= htmlspecialchars($_POST['alto'] ?? ''); ?>" required>
                        </div>
                        <div class="col-4">
                            <label class="form-label small fw-bold">Largo (cm) *</label>
                            <input type="number" step="0.01" class="form-control" name="largo" value="<?= htmlspecialchars($_POST['largo'] ?? ''); ?>" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label small fw-bold">Peso (kg)</label>
                        <input type="number" step="0.01" class="form-control" name="peso" value="<?= htmlspecialchars($_POST['peso'] ?? ''); ?>">
                    </div>

                    <div class="d-flex justify-content-end gap-2">
                        <a href="index.php" class="btn btn-secondary">Cancelar</a>
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function filtrarAcordeon() {
            const idSeleccionado = document.getElementById('id_categoria').value;
            
            // Ocultamos todos los acordeones
            document.querySelectorAll('.clase-acordeon').forEach(div => div.classList.add('d-none'));
            
            // Si eligió una opción, mostramos el acordeón de esa opción
            if(idSeleccionado !== "") {
                const elemento = document.getElementById('acordeon-' + idSeleccionado);
                if(elemento) elemento.classList.remove('d-none');
            }
        }
        document.addEventListener("DOMContentLoaded", filtrarAcordeon);
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>