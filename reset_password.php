<?php
session_start();
include 'config.php';

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Verificar el token en la base de datos
    $sql = "SELECT * FROM users WHERE reset_token = '$token' AND reset_expires > " . time();
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $new_password = password_hash($_POST['new_password'], PASSWORD_BCRYPT);
            $sql = "UPDATE users SET password = '$new_password', reset_token = NULL, reset_expires = NULL WHERE reset_token = '$token'";
            $conn->query($sql);
            echo "Tu contraseña ha sido restablecida con éxito.";
        }
    } else {
        echo "El enlace de recuperación de contraseña es inválido o ha expirado.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Restablecer Contraseña</title>
</head>
<body>
    <form method="POST" action="">
        <input type="password" name="new_password" placeholder="Nueva Contraseña" required>
        <button type="submit">Restablecer Contraseña</button>
    </form>
</body>
</html>

