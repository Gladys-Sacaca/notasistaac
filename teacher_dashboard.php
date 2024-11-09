<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'docente') {
    header("Location: login.php"); // Redirigir al inicio de sesión si no está autenticado o no es docente
    exit();
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Docente</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Bienvenido al Panel de Docente</h1>
        <nav>
            <ul>
                <li><a href="upload_grades.php">Subir Notas</a></li>
                <li><a href="settings.php">Configuración</a></li>
                <li><a href="logout.php">Cerrar Sesión</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h2>Gestión de Notas</h2>
        <p>Aquí puedes subir las notas de los estudiantes y gestionar el rendimiento académico.</p>
    </main>
</body>
</html>
