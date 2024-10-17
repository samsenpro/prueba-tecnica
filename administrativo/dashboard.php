<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: /login.html");
    exit();
}
$pageTitle = 'Dashboard';

ob_start();
?>
<div class="row">
    <!-- Tarjeta para tareas pendientes -->
    <div class="col-md-6 mb-3">
        <div class="card text-white bg-warning">
            <div class="card-body">
                <h5 class="card-title">Tareas Pendientes</h5>
                <h2 class="card-title" data-count="pendientes">0</h2>
            </div>
        </div>
    </div>

    <!-- Tarjeta para tareas completadas -->
    <div class="col-md-6 mb-3">
        <div class="card text-white bg-success">
            <div class="card-body">
                <h5 class="card-title">Tareas Completadas</h5>
                <h2 class="card-title" data-count="completadas">0</h2>
            </div>
        </div>
    </div>
</div>

<div class="row tareas">
    <!-- Aquí se llenarán las tarjetas de tareas con JavaScript -->
</div>
<?php
$pageContent = ob_get_clean();

include '../template/plantilla-dashboard.php';
