<?php
session_start();
include '../../conexion/conexion.php';


$usuario_id = $_SESSION['usuario'];

$sql = "SELECT * FROM tareas WHERE usuario_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $usuario_id);
$stmt->execute();
$tareas = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

$sqlCount = "SELECT estado, COUNT(*) as total FROM tareas WHERE usuario_id = ? GROUP BY estado";
$stmtCount = $conn->prepare($sqlCount);
$stmtCount->bind_param("s", $usuario_id);
$stmtCount->execute();
$resultCount = $stmtCount->get_result();

$contPendiente = 0;
$contCompletada = 0;

while ($row = $resultCount->fetch_assoc()) {
    if ($row['estado'] === 'pendiente') {
        $contPendiente = $row['total'];
    } elseif ($row['estado'] === 'completada') {
        $contCompletada = $row['total'];
    }
}

$stmt->close();
$stmtCount->close();
$conn->close();

echo json_encode([
    'tareas' => $tareas,
    'conteo' => [
        'pendientes' => $contPendiente,
        'completadas' => $contCompletada,
    ]
]);
?>
