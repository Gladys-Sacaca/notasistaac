<?php
include 'config.php';
include 'auth.php'; // Verificar autenticación

echo "<div style='display: flex; justify-content: center; margin-top: 50px;'>";
echo "<div style='background-color: #ffe6f0; border: 2px solid #ffb3c6; border-radius: 8px; padding: 20px; width: 50%; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.15); text-align: center;'>";

// Mostrar enlaces específicos para cada rol
if ($_SESSION['role'] == 'estudiante') {
    echo "<a href='view_grades.php' style='display: inline-block; padding: 10px 20px; color: #cc3366; background-color: #ffccd9; border: none; border-radius: 5px; text-decoration: none; font-weight: bold;'>Mis Notas</a>";
} elseif ($_SESSION['role'] == 'docente') {
    echo "<a href='upload_grades.php' style='display: inline-block; padding: 10px 20px; color: #cc3366; background-color: #ffccd9; border: none; border-radius: 5px; text-decoration: none; font-weight: bold;'>Subir Notas</a>";
} elseif ($_SESSION['role'] == 'administrador') {
    echo "<a href='generate_reports.php' style='display: inline-block; padding: 10px 20px; color: #cc3366; background-color: #ffccd9; border: none; border-radius: 5px; text-decoration: none; font-weight: bold;'>Generar Reportes</a>";
}

echo "</div>";
echo "</div>";
?>
