<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'administrador') {
    header("Location: login.php"); // Redirigir al inicio de sesión si no está autenticado o no es administrador
    exit();
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administrador</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Bienvenido al Panel de Administrador</h1>
        <nav>
            <ul>
                <li><a href="user_management.php">Gestión de Usuarios</a></li>
                <li><a href="generate_reports.php">Generar Reportes</a></li>
                <li><a href="settings.php">Configuración</a></li>
                <li><a href="logout.php">Cerrar Sesión</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h2>Gestión Administrativa</h2>
        <p>Aquí puedes gestionar usuarios, generar reportes y administrar el sistema.</p>
    </main>
</body>
</html>
