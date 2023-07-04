<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

$usuarioId = $_SESSION['usuario_id'];
$nombreUsuario = $_SESSION['nombre_usuario'];
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Usuario</title>
    <link rel="icon" type="image/png" href="assets/star.png">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #5908a4;
            font-family: Arial, sans-serif;
        }

        .container {
            text-align: center;
            background-color: #fff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 400px;
        }

        h1 {
            font-size: 2.5rem;
            margin-bottom: 20px;
        }

        p {
            font-size: 1.5rem;
            margin-bottom: 10px;
        }

        .logout-button {
            display: inline-block;
            padding: 10px 20px;
            font-size: 1.3rem;
            margin-top: 20px;
            background-color: #9900FF;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            border: none;
            cursor: pointer;
        }

        .logout-button:hover {
            background-color: #7a00b2;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Bienvenido, <?php echo $nombreUsuario; ?>!</h1>
        <p>Esta es tu página de usuario.</p>
        <p>Tu ID de usuario es: <?php echo $usuarioId; ?></p>
        <a class="logout-button" href="logout.php">Cerrar sesión</a>
    </div>
</body>
</html>
