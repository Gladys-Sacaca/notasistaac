<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'estudiante') {
    header("Location: login.php"); // Redirigir al inicio de sesión si no está autenticado o no es estudiante
    exit();
}

// Aquí puedes mostrar las notas o cualquier otra información relevante para el estudiante
include 'config.php';

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM grades WHERE student_id = '$user_id'";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Estudiante</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Bienvenido al Panel de Estudiante</h1>
        <nav>
            <ul>
                <li><a href="view_grades.php">Mis Notas</a></li>
                <li><a href="settings.php">Configuración</a></li>
                <li><a href="logout.php">Cerrar Sesión</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h2>Mis Notas</h2>
        <?php if ($result->num_rows > 0): ?>
            <table>
                <tr>
                    <th>Curso</th>
                    <th>Nota</th>
                </tr>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['course_id']; ?></td>
                        <td><?php echo $row['grade']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php else: ?>
            <p>No tienes notas registradas.</p>
        <?php endif; ?>
    </main>
</body>
</html>
