<?php
session_start();
include '../../conexion/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_SESSION['usuario'])) {
        $data = json_decode(file_get_contents('php://input'), true);
        $id = $data['id'] ?? '';
        $estado = $data['estado'] ?? '';

        $stmt = $conn->prepare("UPDATE tareas SET estado = ? WHERE id = ?");
        $stmt->bind_param("si", $estado, $id);

        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Estado actualizado exitosamente.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error al actualizar la tarea: ' . $stmt->error]);
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
