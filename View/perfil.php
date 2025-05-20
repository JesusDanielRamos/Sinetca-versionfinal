<?php
session_start();
include_once("../Model/Usuario.php");
<<<<<<< HEAD
include_once("../Model/Post.php");

=======

// Verificamos si el usuario ha iniciado sesión
>>>>>>> 7a8759c (Actualizar .gitignore y limpiar archivos no deseados)
if (!isset($_SESSION['UserID'])) {
    header("Location: ../View/login.php");
    exit;
}

<<<<<<< HEAD
$current_user_id = $_SESSION['UserID'];
$profile_user_id = $_GET['user_id'] ?? $current_user_id;

$is_own_profile = ($current_user_id == $profile_user_id);
$is_current_page_own_profile = basename($_SERVER['PHP_SELF']) === 'perfil.php' && $is_own_profile;


$usuario = Usuario::buscarPorId($profile_user_id);
$posts = Post::getAllPorUsuario($profile_user_id);
=======
// Obtener el ID del usuario actual
$current_user_id = $_SESSION['UserID'];
$profile_user_id = $_GET['user_id'];
$usuario = Usuario::buscarPorId($profile_user_id);

// Verificar si es su propio perfil
$is_own_profile = ($current_user_id == $profile_user_id);

>>>>>>> 7a8759c (Actualizar .gitignore y limpiar archivos no deseados)
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Perfil de <?= htmlspecialchars($usuario['Username']) ?></title>
<<<<<<< HEAD
    <link rel="stylesheet" href="/css/estilo.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .seccion-perfil { display: none; }
        .seccion-activa { display: block; }
        .activo-perfil{ background-color: #9B8AED; }
        .morado{ background-color: #9B8AED!important; }
        .crema{ background-color: #eef0db!important; }
    </style>
</head>
<body>

<div class="top_nav_main">
    <div class="top_nav_izquierda_main">SINETICA</div>
    <div class="top_nav_derecha_main">
    <?php if ($is_own_profile): ?>
            MI PERFIL
        <?php endif; ?>
        <?php if (!$is_own_profile): ?>
            CONECTAR CON
        <?php endif; ?>
    </div>
</div>

<div class="nav_perfil">
    <ul class="nav_mitad">
        <li class="tab-btn crema" id="btn-posts"><a  href="#"  onclick="mostrarSeccion('posts')">PUBLICACIONES</a></li>
        <li class="tab-btn morado" id="btn-info"><a  href="#"  onclick="mostrarSeccion('info')">INFORMACIÓN</a></li>
    </ul>
</div>

<div class="fondo">
    <div class="profile-container">

        <!-- INFORMACIÓN DEL PERFIL -->
        <div id="seccion-info" class="seccion-perfil seccion-activa">
            <img src="../uploads/profiles/<?= htmlspecialchars($usuario['PicProfile'] ?: 'default.jpg') ?>" alt="Foto de perfil" />

            <div class="barra">
                <p>@<?= htmlspecialchars($usuario['Username']  ?? '') ?></p>
                <p> <?= htmlspecialchars($usuario['Pronombres'] ?? '') ?></p>
            </div>

            <div class="barra_modos">
                <ul>
                    <li id="modo_virtual" class="<?= $usuario['WorkModality'] === 'Virtual' ? 'modo-activo' : '' ?>">VIRTUAL</li>
                    <li id="modo_hibrido" class="<?= $usuario['WorkModality'] === 'Híbrido' ? 'modo-activo' : '' ?>">HÍBRIDO</li>
                    <li id="modo_presencial" class="<?= $usuario['WorkModality'] === 'Presencial' ? 'modo-activo' : '' ?>">PRESENCIAL</li>
                </ul>
            </div>
            
            <?php
            
            ?>
            <div id="informacion_personal">
                
                <div class="parrafo">
                    <h2>INFORMACIÓN PERSONAL</h2>
                    <p> <?= htmlspecialchars($usuario['Alias']  ?? '') ?></p>
                    <p> <?= htmlspecialchars($usuario['Email']  ?? '') ?></p>
                    <p> <?= nl2br(htmlspecialchars($usuario['bio'] ?? 'Este usuario no tiene biografía.')) ?></p>
                </div>
                <div class="area_de_trabajo">
                    <h2>ÁREAS DE TRABAJO</h2><p> <?= htmlspecialchars($usuario['WorkArea']  ?? '') ?></p>
                </div>
                <div class="herramientas">
                    <h2>HERRAMIENTAS</h2><p> <?= htmlspecialchars($usuario['WorkTools']  ?? '') ?></p>
                </div>
            </div>
        </div>
            
            
        </div>

        <!-- PUBLICACIONES -->
        <div id="seccion-posts" class="seccion-perfil">
            <h3>Publicaciones</h3>
            <?php if ($posts): ?>
                <?php foreach ($posts as $post): ?>
                    
                    <div class="post">
                    <?php if (!empty($post['image'])): ?>
                        <img class="post-image" src="../uploads/<?= htmlspecialchars($post['image']) ?>" alt="Imagen del post">
                    <?php endif; ?>
                        <h4><?= htmlspecialchars($post['title']) ?></h4>
                        <p><?= nl2br(htmlspecialchars($post['content'])) ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Este usuario no ha publicado nada aún.</p>
            <?php endif; ?>
        </div>

    </div>

    <div class="cerrar_sesion" style="<?= $is_own_profile ? 'display: block' : 'display: none;' ?>">
        <?php if ($is_own_profile): ?>
            <a href="cerrar_sesion.php" class="logout-btn">Cerrar sesión</a>
        <?php endif; ?>
    </div>
</div>
<div class="bottom_nav_main">
    <div class="izquierda">
        <?php if ($is_own_profile): ?>
            <a href="editar_perfil.php" class="btn-edit">Editar perfil</a>
        <?php else: ?>
            <a style="text-decoration: none!important;
    color: #eef0db!important;" href="posts.php">Comunidad</a>
        <?php endif; ?>
    </div>
    <div class="derecha ">
        <div class="<?= $is_own_profile ? 'crema' : 'morado' ?>">
            <?php if ($is_own_profile): ?>
                <a href="posts.php">Comunidad</a>
            <?php else: ?>
                <a href="" >Conectar con</a>
            <?php endif; ?>
        </div>
        <div class="<?= $is_own_profile ? 'morado' : 'crema' ?>">
            <a class="profile-btn" href="perfil.php?user_id=<?= $current_user_id ?>">Mi Perfil</a>

        </div>
    </div>
</div>

<script>

function mostrarSeccion(seccion) {
    const infoDiv = document.getElementById("seccion-info");
    const postsDiv = document.getElementById("seccion-posts");

    const btnInfo = document.getElementById("btn-info");
    const btnPosts = document.getElementById("btn-posts");

    // Ocultar todas las secciones
    infoDiv.classList.remove("seccion-activa");
    postsDiv.classList.remove("seccion-activa");

    // Resetear colores
    btnInfo.classList.remove("morado", "crema");
    btnPosts.classList.remove("morado", "crema");

    // Activar la sección y aplicar el color
    if (seccion === 'info') {
        infoDiv.classList.add("seccion-activa");
        btnInfo.classList.add("morado");
        btnPosts.classList.add("crema");
    } else {
        postsDiv.classList.add("seccion-activa");
        btnPosts.classList.add("morado");
        btnInfo.classList.add("crema");
    }
}


</script>

=======
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
        .profile-container img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 20px;
        }
        .profile-container h2 {
            margin: 0 0 10px 0;
        }
        .profile-container p {
            color: #555;
        }
        .btn-back {
            display: inline-block;
            background-color: #3498db;
            color: #ffffff;
            padding: 10px 20px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: bold;
            margin-bottom: 20px;
            transition: background-color 0.2s ease;
        }
        .btn-back:hover {
            background-color: #2979b9;
        }
        .btn-edit {
            display: inline-block;
            background-color: #2ecc71;
            color: #ffffff;
            padding: 10px 20px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: bold;
            margin-bottom: 20px;
            transition: background-color 0.2s ease;
        }
        .btn-edit:hover {
            background-color: #27ae60;
        }
         .logout-btn {
            display: block;
            background-color: #f04a27;
            color: #ffffff;
            padding: 10px 20px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: bold;
            text-align: center;
            margin-top: 20px;
            transition: background-color 0.2s ease;
        }
        .logout-btn:hover {
            background-color: #bf2100;
        }
    </style>
</head>
<body>
    <div class="profile-container">
        <img src="../uploads/profiles/<?= htmlspecialchars($usuario['PicProfile'] ?: 'default.jpg') ?>" alt="Imagen de perfil">
        <h2>@<?= htmlspecialchars($usuario['Username']) ?></h2>
        <p><?= nl2br(htmlspecialchars($usuario['bio'] ?: 'Este usuario no tiene biografía.')) ?></p>

        <a href="Home.php" class="btn-back">Regresar</a>
        <?php if ($is_own_profile): ?>
            <a href="editar_perfil.php" class="btn-edit">Editar perfil</a>
            <a href="cerrar_sesion.php" class="logout-btn">Cerrar sesión</a>
        <?php endif; ?>
    </div>
>>>>>>> 7a8759c (Actualizar .gitignore y limpiar archivos no deseados)
</body>
</html>
