<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include '../../conexion/conexion.php';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_SESSION['usuario'])) {
        $usuario_id = $_SESSION['usuario'];

        $data = json_decode(file_get_contents('php://input'), true);

        $titulo = $data['titulo'] ?? '';
        $descripcion = $data['descripcion'] ?? '';
        $prioridad = $data['prioridad'] ?? '';

        $stmt = $conn->prepare("INSERT INTO tareas (usuario_id, titulo, descripcion, prioridad) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $usuario_id, $titulo, $descripcion, $prioridad);

        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Registro guardado exitosamente.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error al guardar la tarea: ' . $stmt->error]);
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
