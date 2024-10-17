<?php
session_start();
include '../conexion/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'] ?? '';
    $contrasenia = $_POST['contrasenia'] ?? '';

    $usuario = mysqli_real_escape_string($conn, $usuario);
    $contrasenia = mysqli_real_escape_string($conn, $contrasenia);

    $sql = "SELECT usuario FROM usuarios WHERE usuario = '$usuario' AND contrasenia = '$contrasenia' LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if ($result === false) {
        echo '<div class="alert alert-danger">Error en la consulta: ' . mysqli_error($conn) . '</div>';
    } else {
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['usuario'] = $row['usuario'];
            header("Location: /administrativo/dashboard.php");
            exit();
        } else {
            echo '<div class="alert alert-danger">Usuario o contraseña incorrectos</div>';
        }
    }
}
?>
