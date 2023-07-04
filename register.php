<?php
require_once 'db/db_config.php';

$error = ""; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombreUsuario = $_POST['nombre_usuario'];
    $contraseña = $_POST['contraseña'];

    if (!empty($nombreUsuario) && !empty($contraseña)) {
        // Verificar si el usuario ya existe
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE nombre_usuario = ?");
        $stmt->execute([$nombreUsuario]);
        $usuarioExistente = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuarioExistente) {
            $error = "El nombre de usuario ya está en uso. Por favor, elige otro.";
        } else {
            
            $hash = password_hash($contraseña, PASSWORD_DEFAULT);

            $stmt = $pdo->prepare("INSERT INTO usuarios (nombre_usuario, contraseña) VALUES (?, ?)");
            $stmt->execute([$nombreUsuario, $hash]);

            
            header("Location: login.php");
            exit;
        }
    } else {
        $error = "Por favor, completa todos los campos.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Registro de usuario</title>
    <link rel="icon" type="image/png" href="assets/star.png">
    <link rel="stylesheet" type="text/css" href="assets/styles.css">
    <style>
        .error-message {
            color: red;
            font-size: 1.2rem;
            margin-top: 10px;
        }
    </style>
    <script>
        function displayErrorMessage(message) {
            const errorElement = document.getElementById("error-message");
            errorElement.textContent = message;
            errorElement.style.display = "block";
        }
    </script>
</head>
<body>
    <div class="container">
            
        <div class="text">
            <h1>Registro de usuario</h1>
            <span id="error-message" class="error-message"><?php echo $error; ?></span>

        </div>
        <div class="login-container">
            <form method="POST" action="register.php" class="form">
                <div class="animated-input">
                    <input type="text" id="nombre_usuario" name="nombre_usuario" maxlength="45" required>
                    <label for="nombre_usuario">Nombre de usuario</label>
                </div>
                <div class="animated-input">
                    <input type="password" id="contraseña" name="contraseña" required>
                    <label for="contraseña">Contraseña</label>
                </div>
                <button type="submit" class="btn">Registrarse</button>
                <div class="account">
                    ¿Ya tienes una cuenta? <a href="login.php">Inicia sesión</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
