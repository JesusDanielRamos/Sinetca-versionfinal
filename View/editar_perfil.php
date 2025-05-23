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

// Procesar el formulario de edición
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $bio = $_POST['bio'];
    $alias = $_POST['alias'];
    $pronombres = $_POST['pronombres'];
    $profile_image = $usuario['PicProfile'];

    // Verificar si se ha subido una nueva imagen
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0) {
        $image_path = '../uploads/profiles/' . basename($_FILES['profile_image']['name']);
        move_uploaded_file($_FILES['profile_image']['tmp_name'], $image_path);
        $profile_image = basename($_FILES['profile_image']['name']);
    }

    // Actualizar el perfil del usuario
    Usuario::actualizarPerfil($alias, $pronombres, $bio, $profile_image,  $current_user_id);
    header("Location: perfil.php?user_id=$current_user_id");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>Editar Perfil</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 20px;
        }
        .profile-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
        }
        .profile-container h2 {
            margin: 0 0 20px 0;
        }
        .profile-container label {
            font-weight: bold;
            margin-top: 15px;
            display: block;
        }
        .profile-container textarea {
            width: 100%;
            height: 100px;
            margin-bottom: 20px;
            border-radius: 10px;
            padding: 10px;
            border: 1px solid #ccc;
        }
        .profile-container input[type="file"] {
            margin-bottom: 15px;
        }
        .profile-container button {
            background-color: #3498db;
            color: #ffffff;
            padding: 10px 20px;
            border-radius: 25px;
            border: none;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.2s ease;
        }
        .profile-container button:hover {
            background-color: #2979b9;
        }
        .profile-container a {
            display: inline-block;
            background-color: #e74c3c;
            color: #ffffff;
            padding: 10px 20px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: bold;
            margin-bottom: 20px;
            transition: background-color 0.2s ease;
        }
        .profile-container a:hover {
            background-color: #c0392b;
        }

        .seccion-perfil { display: none; }
        .seccion-activa { display: block; }
        .activo-perfil{ background-color: #9B8AED; }
        .morado{ background-color: #9B8AED!important; }
        .crema{ background-color: #eef0db!important; }
    </style>
    <link rel="stylesheet" href="/css/estilo.css">
</head>
<body>

<div class="nav_perfil">
    <ul class="nav_mitad">
        <li class="tab-btn crema" id="btn-posts"><a  href="#"  onclick="mostrarSeccion('posts')">PUBLICACIONES</a></li>
        <li class="tab-btn morado" id="btn-info"><a  href="#"  onclick="mostrarSeccion('info')">EDITAR PERFIL</a></li>
    </ul>
</div>

    <div class="profile-container fondo">
        <h2>Editar Perfil</h2>
        <a href="perfil.php?user_id=<?= $current_user_id ?>">Regresar a mi perfil</a>

        <form method="POST" enctype="multipart/form-data">
      
        <label for="alias">Alias:</label>
        <input type="text" name="alias" id="alias" value="<?= htmlspecialchars($usuario['alias']) ?>" >

        <label for="pronombres">Pronombres:</label>
        <input type="text" name="pronombres" id="pronombres" value="<?= htmlspecialchars($usuario['pronombres']) ?>">

        <label for="bio">Biografía:</label>
        <textarea name="bio" id="bio"><?= htmlspecialchars($usuario['bio']) ?></textarea>


            <label for="profile_image">Imagen de perfil:</label>
            <input type="file" name="profile_image" id="profile_image">
            <p>Imagen actual:</p>
            <img src="../uploads/profiles/<?= htmlspecialchars($usuario['PicProfile'] ?: 'default.jpg') ?>" alt="Imagen de perfil" width="150">

            <button type="submit">Guardar cambios</button>
        </form>
        
        
    </div>
    <footer>
    <a href="about.php" style=" text-decoration: none;">© Copyright----Sinetica 2025 </a>  Todos los derechos reservados.
    </footer>
</body>
</html>
