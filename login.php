<?php
require_once 'db/db_config.php';

session_start();

$error = ""; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $nombreUsuario = $_POST['nombre_usuario'];
    $contraseña = $_POST['contraseña'];

    if (!empty($nombreUsuario) && !empty($contraseña)) {
        
        $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE nombre_usuario = ?");
        $stmt->execute([$nombreUsuario]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario && password_verify($contraseña, $usuario['contraseña'])) {
            
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['nombre_usuario'] = $usuario['nombre_usuario'];
            header("Location: user.php");
            exit;
        } else {
            
            $error = "Credenciales inválidas. Por favor, intenta nuevamente.";
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
    <title>Iniciar sesión</title>
    <link rel="stylesheet" type="text/css" href="assets/styles.css">
    <link rel="icon" type="image/png" href="assets/star.png">
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
            <h1>Iniciar sesión</h1>
            <span id="error-message" class="error-message"><?php echo $error; ?></span>
        </div>
        <div class="login-container">
            <form method="POST" action="login.php" class="form">
                <div class="animated-input">
                    <input type="text" id="nombre_usuario" name="nombre_usuario" maxlength="45" required>
                    <label for="nombre_usuario">Nombre de usuario</label>
                </div>
                <div class="animated-input">
                    <input type="password" id="contraseña" name="contraseña" maxlength="45"  required>
                    <label for="contraseña">Contraseña</label>
                </div>
                <div class="check">
                    <label class="forget">
                        <input type="checkbox">
                        <span class="disc"></span>
                        Recordarme
                    </label>
                </div>
                <button type="submit" class="btn">Iniciar sesión</button>
                <div class="account">
                    ¿No tienes una cuenta? <a href="register.php">Regístrate</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>