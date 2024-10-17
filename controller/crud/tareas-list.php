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

if (isset($_SESSION['usuario'])) {
    $usuario_id = $_SESSION['usuario'];

    $stmt = $conn->prepare("SELECT id, titulo, descripcion, prioridad, estado FROM tareas WHERE usuario_id = ?");
    $stmt->bind_param("s", $usuario_id);
    
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $tareas = $result->fetch_all(MYSQLI_ASSOC);
        echo json_encode(['status' => 'success', 'tareas' => $tareas]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error al obtener las tareas: ' . $stmt->error]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'No hay usuario autenticado.']);
}
?>
