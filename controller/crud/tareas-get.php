<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include '../../conexion/conexion.php';

// Establece el encabezado para la respuesta JSON
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['id'])) {
        $idTarea = mysqli_real_escape_string($conn, $_GET['id']);

        // Consulta para obtener la tarea
        $sql = "SELECT id, titulo, descripcion, prioridad, estado FROM tareas WHERE id = '$idTarea' LIMIT 1";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                $tarea = mysqli_fetch_assoc($result);
                echo json_encode($tarea);
            } else {
                echo json_encode(['error' => 'Tarea no encontrada.']);
            }
        } else {
            echo json_encode(['error' => 'Error en la consulta: ' . mysqli_error($conn)]);
        }
    } else {
        echo json_encode(['error' => 'ID de tarea no proporcionado.']);
    }
} else {
    echo json_encode(['error' => 'Método no permitido.']);
}
?>
