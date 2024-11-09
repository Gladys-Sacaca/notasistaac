<?php
// index.php - Página de inicio del Portal de Notas Académicas

include 'header.php'; // Incluye el encabezado
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal de Notas Académicas</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="main-content">
        <h1>Bienvenido al Portal de Notas Académicas</h1>
        
        <!-- Imagen de bienvenida centrada con borde y sombra -->
        <div class="welcome-image">
            <img src="img/1.png" alt="Bienvenidos al portal" class="img-welcome">
        </div>
        
        <p>Accede fácilmente a tus calificaciones, reportes académicos y mantente informado sobre el rendimiento académico.</p>
        
        <div class="buttons">
            <a href="login.php" class="btn btn-login">Iniciar Sesión</a>
            <a href="register.php" class="btn btn-register">Registrarse</a>
        </div>



    <style>
        /* Estilos generales para el portal */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f4;
        }

        /* Estilos para el encabezado */
        header {
            background-color: #003366;
            padding: 15px;
            text-align: center;
            color: white;
        }

        /* Estilos para el contenido principal */
        .main-content {
            padding: 40px;
            text-align: center;
        }

        h1 {
            color: #003366;
        }

        .welcome-image img {
            width: 80%;
            max-width: 500px;
            border-radius: 10px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .buttons a {
            display: inline-block;
            margin: 15px;
            padding: 10px 20px;
            background-color: #000001;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .buttons a:hover {
            background-color: #f76f8e;
        }

        /* Estilos generales para las noticias */
        .news-section {
            margin-top: 40px;
            text-align: center;
        }

        .news-item {
            background-color: #f2f2f4; /* Color de fondo de los cuadros */
            padding: 20px;
            margin: 15px;
            border-radius: 10px;  /* Esquinas redondeadas */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); /* Sombra suave */
            transition: transform 0.3s ease-in-out;  /* Suaviza la transición */
            text-align: left;
            width: 90%;
            max-width: 350px;  /* Ancho máximo del cuadro */
            margin-left: auto;
            margin-right: auto;
        }

        .news-item h3 {
            color: #003366;  /* Color para el título */
            font-size: 18px;
            margin-bottom: 10px;
        }

        .news-item p {
            color: #333;  /* Color de texto */
            font-size: 14px;
            line-height: 1.6;  /* Espaciado entre líneas */
        }

        /* Efecto de hover: Aumentar ligeramente el tamaño */
        .news-item:hover {
            transform: translateY(-5px);  /* Desplazar hacia arriba cuando se pase el ratón */
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2); /* Aumenta la sombra al pasar el ratón */
        }

        /* Estilo para dispositivos más pequeños */
        @media (max-width: 768px) {
            .news-item {
                width: 80%;
            }
        }

        @media (max-width: 480px) {
            .news-item {
                width: 95%;
            }
        }
    </style>
</head>
<body>


        <!-- Sección de noticias relevantes académicas -->
        <div class="news-section">
            <h2>Noticias Relevantes</h2>
            <div class="news-item">
                <h3>Nuevo Programa de Estudios</h3>
                <p>Se ha abierto un nuevo Programa de Estudios para el próximo semestre. ¡Inscríbete ahora!</p>
            </div>
            <div class="news-item">
                <h3>Cierre de Inscripciones</h3>
                <p>Las inscripciones para el próximo semestre estarán abiertas hasta el 15 de diciembre. No pierdas la oportunidad de inscribirte a tus cursos favoritos.</p>
            </div>
            <div class="news-item">
                <h3>Convocatoria para Becas</h3>
                <p>Ya están disponibles las becas académicas para estudiantes destacados. Consulta los requisitos en la página de becas.</p>
            </div>
        </div>
      
    <?php include 'footer.php'; ?> <!-- Incluye el pie de página -->

</body>
</html>
