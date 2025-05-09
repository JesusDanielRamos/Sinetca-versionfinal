
<!DOCTYPE html>
<html>
<head>
    <title>Registro - Sinetica</title>
</head>
<body>
    <h2>Registro</h2>
    <form action="Controller/AuthController.php" method="POST">
        <input type="hidden" name="action" value="register">
        Username: <input type="text" name="username" required><br>
        Email: <input type="email" name="email" required><br>
        Contraseña: <input type="password" name="password" required><br>
        <button type="submit">Registrarse</button>
    </form>
    <p><a href="View/login.php">¿Ya tienes cuenta? Inicia sesión</a></p>



</body>
</html>
