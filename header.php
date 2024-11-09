<?php
session_start();
?>

<nav>
    <ul>
        <li><a href="index.php">Inicio</a></li>
        <li><a href="view_grades.php">Mis Notas</a></li>
        <li><a href="upload_grades.php">Subir Notas</a></li>
        <li><a href="generate_reports.php">Reportes</a></li>
        <li><a href="settings.php">Configuración</a></li>
        <li><a href="help.php">Ayuda</a></li>
        <?php if (isset($_SESSION['user_id'])): ?>
            <li><a href="logout.php">Cerrar Sesión</a></li>
        <?php endif; ?>
    </ul>
</nav>
