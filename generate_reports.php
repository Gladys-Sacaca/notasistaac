<?php
session_start();
include 'config.php';


// Verificar si el usuario tiene rol de administrador
if ($_SESSION['role'] != 'administrador') {
    echo "Acceso denegado.";
    exit();
}

echo "<h2 style='text-align: center; font-family: Arial, sans-serif; color: #333;'>Reporte Académico</h2>";
echo "<p style='text-align: center; font-family: Arial, sans-serif; color: #666;'>Lista completa de calificaciones por estudiante y curso</p>";

// Obtener los datos de calificaciones
$sql = "SELECT students.name AS student_name, courses.name AS course_name, grades.grade
        FROM grades
        JOIN students ON grades.student_id = students.id
        JOIN courses ON grades.course_id = courses.id
        ORDER BY students.name, courses.name";

$result = $conn->query($sql);

echo "<div style='display: flex; justify-content: center;'>";
echo "<div style='width: 80%; max-width: 800px; background-color: #ffffff; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1); border-radius: 8px; padding: 20px; font-family: Arial, sans-serif; color: #333;'>";

if ($result && $result->num_rows > 0) {
    echo "<table style='width: 100%; border-collapse: collapse; margin-top: 10px;'>
            <thead>
                <tr style='background-color: #4CAF50; color: white;'>
                    <th style='border: 1px solid #ddd; padding: 12px; text-align: left;'>Estudiante</th>
                    <th style='border: 1px solid #ddd; padding: 12px; text-align: left;'>Curso</th>
                    <th style='border: 1px solid #ddd; padding: 12px; text-align: left;'>Nota</th>
                </tr>
            </thead>
            <tbody>";

    // Mostrar datos de calificaciones
    while ($row = $result->fetch_assoc()) {
        echo "<tr style='background-color: #f9f9f9;'>
                <td style='border: 1px solid #ddd; padding: 12px;'>{$row['student_name']}</td>
                <td style='border: 1px solid #ddd; padding: 12px;'>{$row['course_name']}</td>
                <td style='border: 1px solid #ddd; padding: 12px; text-align: center;'>{$row['grade']}</td>
              </tr>";
    }

    echo "</tbody></table>";
} else {
    echo "<p style='text-align: center; font-family: Arial, sans-serif; color: #888;'>No hay datos disponibles para generar el reporte.</p>";
}

echo "</div></div>";

$conn->close();
?>
