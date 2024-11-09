<?php
// auth.php - Archivo de autenticación

include 'config.php';  // Conexión a la base de datos

// Verificar si la sesión ya está iniciada
if (session_status() === PHP_SESSION_NONE) {
    session_start();  // Iniciar sesión solo si no está iniciada
}

// Verificar si se envió el formulario desde `login.php`
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Verificar las credenciales
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        
        // Verificar la contraseña
        if (password_verify($password, $row['password'])) {
            // Guardar la información del usuario en la sesión
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['role'] = $row['role'];  // Establecer el rol

            // Redirigir al panel según el rol del usuario
            if ($_SESSION['role'] == 'estudiante') {
                header("Location: student_dashboard.php");  // Redirigir a panel de estudiante
            } elseif ($_SESSION['role'] == 'docente') {
                header("Location: teacher_dashboard.php");  // Redirigir a panel de docente
            } elseif ($_SESSION['role'] == 'administrador') {
                header("Location: admin_dashboard.php");  // Redirigir a panel de administrador
            }
            exit();  // Detener la ejecución después de la redirección
        } else {
            // Mensaje de error si la contraseña es incorrecta
            header("Location: login.php?error=Contraseña incorrecta");
            exit();
        }
    } else {
        // Mensaje de error si no se encuentra el usuario
        header("Location: login.php?error=Usuario no encontrado");
        exit();
    }
}
?>
