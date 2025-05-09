<!DOCTYPE html>
<html>
<head>
    <title>Login - Sinetica</title>
</head>
<body>
    <h2>Iniciar Sesión</h2>
    <form action="../Controller/AuthController.php" method="POST">
        <input type="hidden" name="action" value="login">
        Username: <input type="text" name="username" required><br>
        Contraseña: <input type="password" name="password" required><br>
        <button type="submit">Entrar</button>
    </form>
    <p><a href="Registro.php">¿No tienes cuenta? Regístrate</a></p>
</body>
</html>
