<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ambiente Muebles - Catálogo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card { transition: transform 0.2s; margin-bottom: 20px; }
        .card:hover { transform: scale(1.02); }
        .card-img-top { height: 180px; background-color: #f8f9fa; display: flex; align-items: center; justify-content: center; font-size: 3rem; color: #6c757d; }
    </style>
</head>
<body>
<nav class="navbar navbar-dark bg-dark">
    <div class="container">
        <span class="navbar-brand h1">Ambiente Muebles</span>
    </div>
    <a href="admin.php" class="btn btn-outline-light btn-sm">Administrador</a>
</nav>

<div class="container my-5">
    <h1 class="text-center mb-4">Nuestros Muebles</h1>
    <div class="row">
        <?php foreach ($muebles as $m): ?>
        <div class="col-md-4">
            <div class="card h-100 shadow-sm">
                <div class="card-img-top">🪑</div>
                <div class="card-body">
                    <h5 class="card-title"><?= htmlspecialchars($m->obtenerCategoria()->obtenerNombre()) ?></h5>
                    <p class="card-text"><?= nl2br(htmlspecialchars(substr($m->obtenerDescripcion(), 0, 100))) ?>...</p>
                    <p><strong>Dimensiones:</strong> <?= $m->obtenerAncho() ?> x <?= $m->obtenerAlto() ?> x <?= $m->obtenerLargo() ?> cm<br>
                       <strong>Peso:</strong> <?= $m->obtenerPeso() ?? 'No especificado' ?> kg</p>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<footer class="bg-dark text-white text-center py-3">
    <small>&copy; <?= date('Y') ?> Ambiente Muebles</small>
</footer>
</body>
</html>