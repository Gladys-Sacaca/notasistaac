<?php
session_start(); 

// Verifica si el usuario está autenticado y tiene el rol correcto
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'estudiante') {
    echo "<div style='color: red; text-align: center;'>Acceso denegado.</div>";
    exit();
}

include 'config.php'; 

$user_id = $_SESSION['user_id']; 

// Verificar que $conn esté correctamente definido
if ($conn === false) {
    die("<div style='color: red; text-align: center;'>ERROR: No se pudo conectar a la base de datos.</div>");
}

$sql = "SELECT * FROM grades WHERE student_id = '$user_id'"; 
$result = $conn->query($sql);

if (!$result) {
    die("<div style='color: red; text-align: center;'>ERROR en la consulta: " . $conn->error . "</div>");
}

echo "<h2 style='text-align: center; color: #4A90E2;'>Mis Notas</h2>";
echo "<div style='display: flex; justify-content: center;'>";
echo "<div style='background-color: #f0f8ff; border: 2px solid #b0c4de; border-radius: 8px; padding: 20px; width: 50%; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);'>";

if ($result->num_rows > 0) {
    // Encabezado de tabla
    echo "<table style='width: 100%; border-collapse: collapse;'>";
    echo "<tr style='background-color: #b0c4de; color: #333; text-align: left;'>";
    echo "<th style='padding: 8px; border-bottom: 1px solid #ddd;'>Curso</th>";
    echo "<th style='padding: 8px; border-bottom: 1px solid #ddd;'>Nota</th>";
    echo "</tr>";
    
    // Filas de notas
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td style='padding: 8px; border-bottom: 1px solid #ddd;'>" . htmlspecialchars($row['course_id']) . "</td>";
        echo "<td style='padding: 8px; border-bottom: 1px solid #ddd; text-align: center;'>" . htmlspecialchars($row['grade']) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p style='color: #333; text-align: center;'>No tienes notas registradas.</p>";
}
echo "</div>";
echo "</div>";
?>
