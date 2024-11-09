<?php
session_start(); // Asegúrate de iniciar la sesión

// Verifica si el usuario está autenticado y tiene el rol adecuado
if (!isset($_SESSION['user_id']) || !isset($_SESSION['role']) || $_SESSION['role'] != 'docente') {
    echo "Acceso denegado. Debes ser docente para acceder a esta página.";
    exit(); // Termina el script si el usuario no tiene acceso
}

include 'config.php'; // Conexión a la base de datos

// Código para subir las notas
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica si los datos necesarios están disponibles
    $course_id = $_POST['course_id'];
    $student_id = $_POST['student_id'];
    $grade = $_POST['grade'];

    $sql = "INSERT INTO grades (course_id, student_id, grade) VALUES ('$course_id', '$student_id', '$grade')";
    if ($conn->query($sql) === TRUE) {
        echo "Nota registrada con éxito.";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Subir Notas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fff8e1;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .form-container {
            background-color: #ffecd0;
            border-radius: 12px;
            padding: 30px;
            width: 400px;
            text-align: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #e67e22;
            font-size: 24px;
            margin-bottom: 20px;
        }

        input[type="text"], input[type="number"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border-radius: 6px;
            border: 1px solid #f5b895;
            background-color: #fffaf5;
            box-sizing: border-box;
            font-size: 16px;
        }

        input[type="text"]:focus, input[type="number"]:focus {
            border-color: #e2976e;
            outline: none;
            box-shadow: 0 0 8px rgba(226, 151, 110, 0.3);
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #f39c12;
            border: none;
            color: white;
            font-size: 18px;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 15px;
        }

        button:hover {
            background-color: #e67e22;
        }

        .error-message {
            color: #e74c3c;
            font-size: 14px;
            margin-top: 10px;
        }
    </style>
</head>
<body>

    <!-- Contenedor del formulario de subida de notas -->
    <div class="form-container">
        <h2>Subir Notas</h2>
        <form method="POST" action="">
            <!-- Campo para el ID del curso -->
            <input type="text" name="course_id" placeholder="ID del curso" required>

            <!-- Campo para el ID del estudiante -->
            <input type="text" name="student_id" placeholder="ID del estudiante" required>

            <!-- Campo para la nota -->
            <input type="number" name="grade" placeholder="Nota" required>

            <!-- Botón para subir la nota -->
            <button type="submit">Subir Nota</button>
        </form>
    </div>

</body>
</html>
