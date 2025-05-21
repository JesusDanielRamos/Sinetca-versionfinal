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
    <link rel="stylesheet" href="/css/estilo.css">

    <title>Registro de Usuario - Sinetica</title>
    
    <style> 
        /* Botón de registro */
        .btn-registrarse {
            background-color: #9B8AED;
            color: #2c3e50;
            border: none;
            padding: 5px 5px;
            
            font-weight: bold;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            width: 50%; /* Puedes quitarlo si no lo quieres tan ancho */
             /* Opcional */
             margin-top: 8px;
        }

        /* Hover */
        .btn-registrarse:hover {
            background-color: #7c6bcc;
        }



    </style>
    
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
                      <form id="form-register" action="../Controller/AuthController.php" method="POST" enctype="multipart/form-data" style="justify-content: center;">
    <input type="hidden" name="action" value="register">

    <!-- PASO 1 -->
    <div id="paso1">
        <label for="username">NOMBRE DE USUARIO</label>
        <input type="text" name="username" required>
        <label for="alias">ALIAS</label>
        <input type="text" name="alias" required>
        <label for="email">EMAIL</label>
        <input type="email" name="email" required>
        <label for="password">CONTRASEÑA</label>
        <input type="password" name="password" required>

        <button class="btn-registrarse" type="button" onclick="mostrarPaso2()">---> </button>
    </div>

    <!-- PASO 2 -->
    <div id="paso2" style="display:none">
        <label for="pronombres">PRONOMBRES</label>
        <input type="text" name="pronombres" required>
        <label for="PicProfile">FOTO DE PERFIL</label>
        <input id="input_foto" type="file" name="PicProfile" accept="image/*">
        <label for="WorkArea">ÁREA DE TRABAJO</label>
        <select name="WorkArea" required>
            <option value="" disabled selected>Selecciona una...</option>
            <?php foreach ($workAreas as $area): ?>
                <option value="<?= htmlspecialchars($area) ?>"><?= htmlspecialchars($area) ?></option>
            <?php endforeach; ?>
        </select>

        <label for="WorkTools">HERRAMIENTAS DE TRABAJO</label>
        <select name="WorkTools" required>
            <option value="" disabled selected>Selecciona una...</option>
            <?php foreach ($workTools as $tool): ?>
                <option value="<?= htmlspecialchars($tool) ?>"><?= htmlspecialchars($tool) ?></option>
            <?php endforeach; ?>
        </select>

        <label for="WorkModality">MODALIDAD DE TRABAJO</label>
        <select name="WorkModality" required>
            <option value="" disabled selected>Selecciona una...</option>
            <?php foreach ($workModalities as $modality): ?>
                <option value="<?= htmlspecialchars($modality) ?>"><?= htmlspecialchars($modality) ?></option>
            <?php endforeach; ?>
        </select>

        <button class="btn-registrarse" type="button" onclick="mostrarPaso1()"><----</button>
        <button class="btn-registrarse"  type="submit">CREAR CUENTA</button>
    </div>
</form>

        <div class="imagen_fondo">
            <img src="../assets/candado.svg" alt="">
        </div>
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

    <script>
function mostrarPaso2() {
    document.getElementById('paso1').style.display = 'none';
    document.getElementById('paso2').style.display = 'block';
}

function mostrarPaso1() {
    document.getElementById('paso2').style.display = 'none';
    document.getElementById('paso1').style.display = 'block';
}
</script>

    
</body>

</html>
