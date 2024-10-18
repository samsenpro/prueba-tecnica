<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: /login.html");
    exit();
}

$pageTitle = 'Tareas';
$username = $_SESSION['usuario'];

ob_start();
?>
<div>
    <h3>Gesti&oacute;n para la Creaci&oacute;n de Tareas</h3>
    <form id="tareaForm">
    <input type="hidden" class="form-control" id="idTarea" name="idTarea">

    <div class="mb-3">
        <label for="titulo" class="form-label">Título</label>
        <input type="text" class="form-control" id="titulo" name="titulo" required>
    </div>
    <div class="mb-3">
        <label for="descripcion" class="form-label">Descripción</label>
        <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
    </div>
    <div class="mb-3">
        <label for="prioridad" class="form-label">Prioridad</label>
        <select class="form-select" id="prioridad" name="prioridad" required>
            <option value="-9">*Seleccionar...</option>
            <option value="alta">Alta</option>
            <option value="media">Media</option>
            <option value="baja">Baja</option>
        </select>
    </div>

    <button type="button" class="btn btn-success" onclick="guardarTarea()" title="Guardar Tarea">
        <i class="fas fa-save"></i>
    </button>

    <button type="button" class="btn btn-primary" onclick="cargarTareasCrud()" style="color: white;" title="Buscar Tarea" data-bs-toggle="modal" data-bs-target="#tareaModal">
        <i class="fas fa-search"></i>
    </button>


    <button type="button" class="btn btn-danger" style="color: white;" title="Eliminar Tarea" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">
    <i class="fas fa-trash-alt"></i>
    </button>

    
</form>

<div class="modal fade" id="tareaModal" tabindex="-1" aria-labelledby="tareaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tareaModalLabel">Seleccionar Tarea</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <thead id="tareasTableHead">
                    </thead>
                    <tbody id="tareasTableBody">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<!-- Modal de Confirmación para Eliminar Tarea -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmar Eliminación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <i class="fas fa-exclamation-triangle" style="color: red; font-size: 50px;"></i> 
                <p>¿Estás seguro de que deseas eliminar esta tarea?</p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" onclick="eliminarTarea()" id="confirmDeleteBtn">Eliminar</button>
            </div>
        </div>
    </div>
</div>




</div>




<?php
$pageContent = ob_get_clean();

include '../template/plantilla-dashboard.php';
