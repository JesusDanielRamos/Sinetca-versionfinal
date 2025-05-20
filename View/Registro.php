<?php
include("../conexion.php");

// Obtener WorkAreas
$workAreas = [];
$sql = "SELECT Categoria FROM WorkAreas";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $workAreas[] = $row['Categoria'];
    }
}

// Obtener WorkTools (Campo correcto: Tool)
$workTools = [];
$sql = "SELECT Tool FROM WorkTools";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $workTools[] = $row['Tool'];
    }
}

// Obtener WorkModality (Campo correcto: Modality)
$workModalities = [];
$sql = "SELECT Modality FROM WorkModality";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $workModalities[] = $row['Modality'];
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< HEAD
    <link rel="stylesheet" href="/css/estilo.css">

    <title>Registro de Usuario - Sinetica</title>
    
    
</head>
<body>
    <div class="contenedor_columna">
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
                <a href="../Login.php">INICIAR SESIÓN</a>
                </p>
            </div>
            <div>
                <p class="p_der">
                <a href="/View/Registro.php">REGISTRARME</a>
                </p>
            </div>
        </div>
        <div id="espacio" style="height: 150px"></div>
        <div class="login-container">
            <form id="form-register" action="../Controller/AuthController.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="action" value="register">
                <label for="username">NOMBRE DE USUARIO</label>
                <input type="text" name="username" placeholder="Nombre de usuario" required>
                <label for="alias">ALIAS</label>
                <input type="text" name="alias" placeholder="Alias" required>
                <label for="email">EMAIL</label>
                <input type="email" name="email" placeholder="Correo electrónico" required>
                <label for="password">CONTRASEÑA</label>
                <input type="password" name="password" placeholder="Contraseña" required>
                <label for="pronombres">PRONOMBRES</label>
                <input type="text" name="pronombres" placeholder="Pronombres" required>
                <label for="PicProfile">FOTO DE PERFIL</label>
                <input id="input_foto" type="file" name="PicProfile" accept="image/*">

                <!-- Área de Trabajo -->
                 <label for="WorkArea">ÁREA DE TRABAJO</label>
                <select name="WorkArea" required>
                    <option value="" disabled selected>Selecciona una...</option>
                    <?php foreach ($workAreas as $area): ?>
                        <option value="<?= htmlspecialchars($area) ?>"><?= htmlspecialchars($area) ?></option>
                    <?php endforeach; ?>
                </select>

                <label for="WorkTools">HERRAMIENTAS DE TRABAJO</label>
                <!-- Herramientas de Trabajo -->
                <select name="WorkTools" required>
                    <option value="" disabled selected>Selecciona una...</option>
                    <?php foreach ($workTools as $tool): ?>
                        <option value="<?= htmlspecialchars($tool) ?>"><?= htmlspecialchars($tool) ?></option>
                    <?php endforeach; ?>
                </select>

                <!-- Modalidad de Trabajo -->
                 <label for="WorkModality">MODALIDAD DE TRABAJO</label>
                <select name="WorkModality" required>
                    <option value="" disabled selected>Selecciona una...</option>
                    <?php foreach ($workModalities as $modality): ?>
                        <option value="<?= htmlspecialchars($modality) ?>"><?= htmlspecialchars($modality) ?></option>
                    <?php endforeach; ?>
                </select>
                
                
                
            </form>
            
        </div>

        <div class="bottom_nav">
            <div class="tercio_izquierdo">

            </div>
            <div class="dos_tercios_derecha">
                <button id="btn-registrarse" type="submit">CREAR CUENTA</button>
            </div>
        </div>
    </div>
    <script>
        document.getElementById("btn-registrarse").addEventListener("click", function() {
            
        document.getElementById("form-register").submit();
        });
        document.querySelector(".p_izq").style.backgroundColor = "#eef0db";
        document.querySelector(".p_der").style.backgroundColor = "#9B8AED";
    </script>
=======
    <title>Registro de Usuario - Sinetica</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 20px;
        }
        .register-container {
            max-width: 400px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 15px;
            padding: 40px 20px;
            text-align: center;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
        }
        .register-container h1 {
            color: #3498db;
            margin-bottom: 20px;
        }
        .register-container input[type="text"], 
        .register-container input[type="email"], 
        .register-container input[type="password"], 
        .register-container input[type="file"],
        .register-container select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 10px;
            border: 1px solid #ccc;
        }
        .register-container button {
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
        .register-container button:hover {
            background-color: #2979b9;
        }
        .register-container a {
            color: #3498db;
            text-decoration: none;
            font-weight: bold;
        }
        .register-container a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h1>Registro de Usuario</h1>
        <form action="../Controller/AuthController.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="action" value="register">
            <input type="text" name="username" placeholder="Nombre de usuario" required>
            <input type="text" name="alias" placeholder="Alias" required>
            <input type="email" name="email" placeholder="Correo electrónico" required>
            <input type="password" name="password" placeholder="Contraseña" required>

            <!-- Área de Trabajo -->
            <select name="WorkArea" required>
                <option value="" disabled selected>Área de trabajo</option>
                <?php foreach ($workAreas as $area): ?>
                    <option value="<?= htmlspecialchars($area) ?>"><?= htmlspecialchars($area) ?></option>
                <?php endforeach; ?>
            </select>

            <!-- Herramientas de Trabajo -->
            <select name="WorkTools" required>
                <option value="" disabled selected>Herramientas de trabajo</option>
                <?php foreach ($workTools as $tool): ?>
                    <option value="<?= htmlspecialchars($tool) ?>"><?= htmlspecialchars($tool) ?></option>
                <?php endforeach; ?>
            </select>

            <!-- Modalidad de Trabajo -->
            <select name="WorkModality" required>
                <option value="" disabled selected>Modalidad de trabajo</option>
                <?php foreach ($workModalities as $modality): ?>
                    <option value="<?= htmlspecialchars($modality) ?>"><?= htmlspecialchars($modality) ?></option>
                <?php endforeach; ?>
            </select>

            <input type="text" name="pronombres" placeholder="Pronombres" required>
            <input type="file" name="PicProfile" accept="image/*">
            <button type="submit">Registrarse</button>
        </form>
        <p><a href="login.php">¿Ya tienes cuenta? Inicia sesión</a></p>
    </div>
>>>>>>> 7a8759c (Actualizar .gitignore y limpiar archivos no deseados)
</body>

</html>
