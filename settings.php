<?php
session_start();
include 'config.php'; // Conexión a la base de datos

// Verifica si el usuario está autenticado
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Redirige al login si no está autenticado
    exit();
}

// Obtener los datos del usuario actual
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE id = '$user_id'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();

// **Configurar Perfil y Contraseña**
// Actualizar perfil y contraseña
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Actualización de perfil
    if (isset($_POST['update_profile'])) {
        $new_name = $_POST['name'];
        $new_email = $_POST['email'];

        $update_sql = "UPDATE users SET name = '$new_name', email = '$new_email' WHERE id = '$user_id'";
        if ($conn->query($update_sql) === TRUE) {
            echo "<div class='success-message'>Perfil actualizado con éxito.</div>";
        } else {
            echo "<div class='error-message'>Error: " . $conn->error . "</div>";
        }
    }

    // Cambio de contraseña
    if (isset($_POST['change_password'])) {
        $current_password = $_POST['current_password'];
        $new_password = $_POST['new_password'];

        // Verificar si la contraseña actual es correcta
        if (password_verify($current_password, $user['password'])) {
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            $update_password_sql = "UPDATE users SET password = '$hashed_password' WHERE id = '$user_id'";

            if ($conn->query($update_password_sql) === TRUE) {
                echo "<div class='success-message'>Contraseña cambiada con éxito.</div>";
            } else {
                echo "<div class='error-message'>Error al cambiar la contraseña: " . $conn->error . "</div>";
            }
        } else {
            echo "<div class='error-message'>La contraseña actual es incorrecta.</div>";
        }
    }
}

// **Cerrar sesión**
if (isset($_GET['logout'])) {
    session_unset();  // Eliminar todas las variables de sesión
    session_destroy();  // Destruir la sesión
    header('Location: login.php');
    exit();
}

// **Ayuda (FAQ y Guías)**
// Opcionalmente podrías crear una página separada, pero por ahora lo incluiré en este archivo.

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal - Configuración y Ayuda</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* Hace que el contenido se centre vertical y horizontalmente */
            margin: 0;
        }

        header {
            background-color: #003366;
            color: white;
            padding: 15px;
            text-align: center;
            width: 100%;
        }

        .main-container {
            max-width: 800px;
            width: 100%;
            padding: 20px;
            background-color: #ffffff;
            border: 3px solid #003366;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .buttons {
            text-align: center;
            margin-top: 20px;
        }

        .buttons a {
            padding: 10px 20px;
            background-color: #ff85a2;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .buttons a:hover {
            background-color: #f76f8e;
        }

        .profile-section, .faq-section {
            margin-top: 40px;
        }

        .profile-section h2, .faq-section h2 {
            color: #003366;
        }

        .form-container {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .form-container input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 14px;
        }

        .form-container button {
            padding: 10px 20px;
            background-color: #003366;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .form-container button:hover {
            background-color: #002244;
        }

        .faq {
            text-align: left;
            margin-top: 20px;
        }

        .faq h3 {
            margin-top: 15px;
        }

        .faq a {
            color: #003366;
            text-decoration: none;
        }

        .faq a:hover {
            text-decoration: underline;
        }

        .success-message, .error-message {
            padding: 10px;
            margin-top: 10px;
            border-radius: 5px;
            font-size: 14px;
        }

        .success-message {
            background-color: #d4edda;
            color: #155724;
        }

        .error-message {
            background-color: #f8d7da;
            color: #721c24;
        }
    </style>
</head>
<body>

<header>
    <h1>Bienvenido al Portal Académico</h1>
</header>

<div class="main-container">
    <!-- Configuración del Perfil -->
    <div class="profile-section">
        <h2>Configuración del Perfil</h2>
        
        <!-- Actualización del Perfil -->
        <div class="form-container">
            <h3>Actualizar Perfil</h3>
            <form method="POST" action="">
                <input type="text" name="name" value="<?= $user['name'] ?>" required placeholder="Nombre completo">
                <input type="email" name="email" value="<?= $user['email'] ?>" required placeholder="Correo electrónico">
                <button type="submit" name="update_profile">Actualizar Perfil</button>
            </form>
        </div>

        <!-- Cambio de Contraseña -->
        <div class="form-container">
            <h3>Cambiar Contraseña</h3>
            <form method="POST" action="">
                <input type="password" name="current_password" placeholder="Contraseña Actual" required>
                <input type="password" name="new_password" placeholder="Nueva Contraseña" required>
                <button type="submit" name="change_password">Cambiar Contraseña</button>
            </form>
        </div>
    </div>

    <!-- Sección de Ayuda (FAQ) -->
    <div class="faq-section">
        <h2>Ayuda - Preguntas Frecuentes (FAQ)</h2>
        <div class="faq">
            <h3>¿Cómo cambiar mi contraseña?</h3>
            <p>Para cambiar tu contraseña, ve a la sección de configuración de tu perfil y selecciona "Cambiar Contraseña". Asegúrate de conocer tu contraseña actual para poder cambiarla.</p>

            <h3>¿Cómo actualizo mi perfil?</h3>
            <p>Para actualizar tu perfil, ve a la sección de configuración, donde puedes modificar tu nombre y correo electrónico.</p>

            <h3>¿Cómo ver mis calificaciones?</h3>
            <p>Puedes ver tus calificaciones en la sección de "Notas Académicas" después de iniciar sesión en el portal.</p>
        </div>

        <h3>Guías de Usuario</h3>
        <ul>
            <li><a href="guia_usuario.pdf" target="_blank">Guía del Usuario (PDF)</a></li>
            <li><a href="tutorial_video.mp4" target="_blank">Ver Tutorial de Video</a></li>
        </ul>
    </div>

    <!-- Botón para Cerrar sesión -->
    <div class="buttons">
        <a href="?logout=true">Cerrar Sesión</a>
    </div>
</div>

</body>
</html>
