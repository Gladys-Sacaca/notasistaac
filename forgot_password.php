<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    // Verificar si el correo existe en la base de datos
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $token = bin2hex(random_bytes(50)); // Generar un token único
        $expires = date("U") + 1800; // El enlace será válido por 30 minutos

        // Guardar el token y la fecha de expiración en la base de datos
        $sql = "UPDATE users SET reset_token = '$token', reset_expires = '$expires' WHERE email = '$email'";
        $conn->query($sql);

        // Enviar un correo con el enlace para restablecer la contraseña
        $reset_link = "http://localhost/notas/reset_password.php?token=$token";
        $subject = "Restablecer tu contraseña";
        $message = "Haz clic en el siguiente enlace para restablecer tu contraseña: $reset_link";
        mail($email, $subject, $message);

        echo "Te hemos enviado un correo con el enlace para restablecer tu contraseña.";
    } else {
        echo "No hemos encontrado un usuario con ese correo electrónico.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Recuperar Contraseña</title>
</head>
<body>
    <form method="POST" action="">
        <input type="email" name="email" placeholder="Correo Electrónico" required>
        <button type="submit">Enviar enlace de recuperación</button>
    </form>
</body>
</html>
