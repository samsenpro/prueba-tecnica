<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include '../../conexion/conexion.php';

// Crear conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Comprobar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_SESSION['usuario'])) {
        $usuario_id = $_SESSION['usuario'];

        $data = json_decode(file_get_contents('php://input'), true);
        $idTarea = $data['idTarea'] ?? '';

        $stmt = $conn->prepare("DELETE FROM tareas WHERE id=? AND usuario_id=?");
        $stmt->bind_param("ss", $idTarea, $usuario_id);

        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                echo json_encode(['status' => 'success', 'message' => 'Tarea eliminada exitosamente.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'No se encontró la tarea.']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error al eliminar la tarea: ' . $stmt->error]);
        }

        $stmt->close();
        $conn->close();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No hay usuario autenticado.']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Método no permitido.']);
}
?>
