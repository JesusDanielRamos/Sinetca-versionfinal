<?php
session_start();
include_once("../Model/Usuario.php");

// Verificamos si el usuario ha iniciado sesión
if (!isset($_SESSION['UserID'])) {
    header("Location: ../View/login.php");
    exit;
}

// Obtener el ID del usuario actual
$current_user_id = $_SESSION['UserID'];
$usuario = Usuario::buscarPorId($current_user_id);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../css/estilo.css">
    <meta charset="UTF-8">

    <title>¿YA TE VAS?</title>
    
</head>
<body>
    <div class="top_nav">
        <div class="top_nav_izquierda"> 
            SINETICA 
        </div>
        <div class="top_nav_derecha">
            SALIR
        </div>
    </div>
    <div id="anuncio_salir">
        
            <h2>
            ¿YA TE VAS?
            </h2>
        
    </div>
    
    <div class="imagen_fondo_logout">
            <img src="../assets/puerta_abierta.svg" alt="">
    </div>
    <div class="bottom_nav_logout">
        <div class="mitad">
            <div class="confirm-container">
        
                <form action="logout.php" method="POST">
                    <button type="submit">Sí ✔</button>
                </form>
                
            </div>
        </div>
        <div class="mitad">
            <a href="perfil.php?user_id=<?= $current_user_id ?>" class="cancel-btn">𝝬 No</a>
        </div>
    </div>
</body>
</html>
