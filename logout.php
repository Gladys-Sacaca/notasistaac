<?php
session_start();
session_unset();
session_destroy();
header("Location: login.php"); // Redirigir al login después de cerrar sesión
exit();
?>
