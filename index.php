<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="/css/estilo.css">
    <title>Registro - Sinetica</title>
<<<<<<< HEAD
    
</head>
<body>
    <div class="contenedor_columna">
        <!-- Pantalla de carga -->
        <div id="loadingScreen">
            <div id="titulo">SINETICA</div>
            <div id="barra">

                <div id="progreso"><p id="porcentaje">0%</p></div></div>
            <div id="manos"><img src="/assets/inicio.svg" alt=""></div>
        </div>

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
                <a href="/View/Registro.php">REGISTRARME</a>
                </p>
            </div>
        </div>
        <div class="login-container">
            <form id="form-login" action="/Controller/AuthController.php" method="POST" class="registro">
                <input type="hidden" name="action" value="login">
                <label for="username">NOMBRE DE USUARIO</label>
                <input type="text" name="username" placeholder="Username" required>
                <label for="password">CONTRASEÑA</label>
                <input type="password" name="password" placeholder="Contraseña" required>
            </form>
        </div>
        <div class="imagen_fondo">
            <img src="/assets/llave.svg" alt="">
        </div>
        <div class="bottom_nav">
            <div class="tercio_izquierdo">

            </div>
            <div class="dos_tercios_derecha">
                <button id="btn_login">INICIAR SESIÓN</button>
            </div>
        </div>
    </div>

    <script>
        // Cuando la página haya cargado completamente, espera un poco antes de ocultar la pantalla de carga
       if (!localStorage.getItem('loadingShown')) {

        const duration = 5000;
        const porcentaje = document.getElementById("porcentaje");
        let percent = 0;

        const interval = setInterval(() => {
            percent++;
            porcentaje.textContent = percent + "%";

            if (percent >= 100) {
                clearInterval(interval);
            }
        }, duration / 100);

        // Oculta la pantalla de carga después de 5 segundos
        setTimeout(function() {
            document.getElementById('loadingScreen').style.display = 'none';
            // Marca como mostrado
            localStorage.setItem('loadingShown', 'true');
        }, 5000);
        } else {
        // Si ya se mostró antes, oculta directamente
        document.getElementById('loadingScreen').style.display = 'none';
        }
        document.getElementById("btn_login").addEventListener("click", function() {
            
        document.getElementById("form-login").submit();
=======
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
        /* Pantalla de carga */
        #loadingScreen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(255, 255, 255, 0.8); /* Fondo translúcido */
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }

        .spinner {
            border: 4px solid #f3f3f3;
            border-top: 4px solid #3498db;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* El contenido principal */
        #content {
            display: none;
        }
    </style>
</head>
<body>
    <!-- Pantalla de carga -->
    <div id="loadingScreen">
        <div class="spinner"></div>
    </div>

    <!-- Contenido principal -->
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

    <script>
        // Cuando la página haya cargado completamente, espera un poco antes de ocultar la pantalla de carga
        window.addEventListener('load', function() {
            // Establecer un retraso antes de ocultar la pantalla de carga (2 segundos en este caso)
            setTimeout(function() {
                document.getElementById('loadingScreen').style.display = 'none';  // Ocultamos la pantalla de carga
                document.getElementById('content').style.display = 'block';  // Mostramos el contenido principal
            }, 1000); // 2000 milisegundos = 2 segundos
>>>>>>> 7a8759c (Actualizar .gitignore y limpiar archivos no deseados)
        });
    </script>
</body>
</html>
