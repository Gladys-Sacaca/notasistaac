<?php
// Incluye el archivo de configuración para la conexión a la base de datos
include 'config.php';

// Verifica si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibe los datos del formulario
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);  // Encripta la contraseña
    $role = $_POST['role'];  // Role seleccionado por el usuario (ej. estudiante, docente, administrador)

    // Verifica si el correo ya está registrado
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Si ya existe un usuario con ese correo
        echo "El correo electrónico ya está registrado.";
    } else {
        // Inserta el nuevo usuario en la base de datos
        $sql = "INSERT INTO users (name, email, password, role) VALUES ('$name', '$email', '$password', '$role')";

        if ($conn->query($sql) === TRUE) {
            echo "Usuario registrado con éxito. Ahora puedes iniciar sesión.";
            // Redirige a la página de inicio de sesión después de un registro exitoso
            header("Location: login.php");
        } else {
            echo "Error: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Portal de Notas Académicas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fff5e1; /* Fondo cálido */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .register-container {
            background-color: #ffe7d6; /* Fondo suave */
            border-radius: 12px;
            padding: 30px;
            width: 350px;
            text-align: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        h2 {
            color: #d9534f; /* Título cálido */
            font-size: 24px;
            margin-bottom: 20px;
        }

        input[type="text"], input[type="email"], input[type="password"], select {
            width: 100%;
            padding: 12px;
            margin: 8px 0;
            border-radius: 6px;
            border: 1px solid #f5b895;
            background-color: #fffaf5;
            box-sizing: border-box;
            font-size: 16px;
        }

        input[type="text"]:focus, input[type="email"]:focus, input[type="password"]:focus, select:focus {
            border-color: #e2976e;
            outline: none;
            box-shadow: 0 0 8px rgba(226, 151, 110, 0.3);
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #f28e69; /* Botón cálido */
            border: none;
            color: white;
            font-size: 18px;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #e57350; /* Efecto de hover */
        }

        .register-container p {
            color: #8a6d3b;
            font-size: 14px;
        }

        .register-container a {
            color: #d9534f;
            text-decoration: none;
        }

        .register-container a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <!-- Contenedor del formulario de registro -->
    <div class="register-container">
        <h2>Registro de Usuario</h2>
        <form method="POST" action="">
            <!-- Campo para el nombre completo -->
            <input type="text" name="name" placeholder="Nombre Completo" required>

            <!-- Campo para el correo electrónico -->
            <input type="email" name="email" placeholder="Correo Electrónico" required>

            <!-- Campo para la contraseña -->
            <input type="password" name="password" placeholder="Contraseña" required>

            <!-- Selección de rol -->
            <select name="role" required>
                <option value="estudiante">Estudiante</option>
                <option value="docente">Docente</option>
                <option value="administrador">Administrador</option>
            </select>

            <!-- Botón para enviar el formulario -->
            <button type="submit" class="btn btn-register">Registrarse</button>
        </form>

        <!-- Enlace a la página de inicio de sesión si ya tienes cuenta -->
        <p>¿Ya tienes cuenta? <a href="login.php">Iniciar sesión</a></p>
    </div>

</body>
</html>
