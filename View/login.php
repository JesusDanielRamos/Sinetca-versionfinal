<!DOCTYPE html>
<html lang="es">
<head>
<<<<<<< HEAD
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="/css/estilo.css">
    <title>Registro - Sinetica</title>
    
</head>
<body>
    <div class="contenedor_columna">
       

        <!-- Contenido principal -->
        <div class="top_nav">
                <div class="top_nav_izquierda"> 
                SINETICA 
                </div>
                <div class="top_nav_derecha">
                    IDENTIFICARME
                </div>
        </div>
        <div class="nav">
            <div>
                <p class="p_izq">
                INICIAR SESIÓN
                </p>
            </div>
            <div>
                <p class="p_der">
                <a href="Registro.php">REGISTRARME</a>
                </p>
            </div>
        </div>
        <div class="login-container">
            <form id="form-login" action="../Controller/AuthController.php" method="POST" class="registro">
                <input type="hidden" name="action" value="login">
                <label for="username">NOMBRE DE USUARIO</label>
                <input type="text" name="username" placeholder="Username" required>
                <label for="password">CONTRASEÑA</label>
                <input type="password" name="password" placeholder="Contraseña" required>
            </form>
        </div>
        <div class="imagen_fondo">
            <img src="../assets/llave.svg" alt="">
        </div>
        <div class="bottom_nav">
            <div class="tercio_izquierdo">
         <a href="about.php">@Copyright----Sinetica2025</a>

            </div>
            <div class="dos_tercios_derecha">
                <button id="btn_login">INICIAR SESIÓN</button>
            </div>
        </div>
    </div>

    <script>
        // Cuando la página haya cargado completamente, espera un poco antes de ocultar la pantalla de carga
        
        document.getElementById("btn_login").addEventListener("click", function() {
            
        document.getElementById("form-login").submit();
        });
    </script>
=======
    <meta charset="UTF-8">
    <title>Login - Sinetica</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 20px;
        }
        .login-container {
            max-width: 400px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 15px;
            padding: 40px 20px;
            text-align: center;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
        }
        .login-container h1 {
            color: #3498db;
            margin-bottom: 20px;
        }
        .login-container input[type="text"], .login-container input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 10px;
            border: 1px solid #ccc;
        }
        .login-container button {
            background-color: #3498db;
            color: #ffffff;
            padding: 10px 20px;
            border-radius: 25px;
            border: none;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.2s ease;
            width: 100%;
        }
        .login-container button:hover {
            background-color: #2979b9;
        }
        .login-container a {
            color: #3498db;
            text-decoration: none;
            font-weight: bold;
        }
        .login-container a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Bienvenido a Sinetica</h1>
        <h2>Iniciar Sesión</h2>
        <form action="../Controller/AuthController.php" method="POST">
            <input type="hidden" name="action" value="login">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <button type="submit">Entrar</button>
        </form>
        <p><a href="Registro.php">¿No tienes cuenta? Regístrate</a></p>
    </div>
>>>>>>> 7a8759c (Actualizar .gitignore y limpiar archivos no deseados)
</body>
</html>
