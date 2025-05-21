<?php
session_start();
include_once("../Model/Usuario.php");
include_once("../Model/Post.php");

if (!isset($_SESSION['UserID'])) {
    header("Location: ../View/login.php");
    exit;
}

$current_user_id = $_SESSION['UserID'];
$profile_user_id = $_GET['user_id'] ?? $current_user_id;

$is_own_profile = ($current_user_id == $profile_user_id);
$is_current_page_own_profile = basename($_SERVER['PHP_SELF']) === 'perfil.php' && $is_own_profile;


$usuario = Usuario::buscarPorId($profile_user_id);
$posts = Post::getAllPorUsuario($profile_user_id);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Perfil de <?= htmlspecialchars($usuario['Username']) ?></title>
    <link rel="stylesheet" href="../css/estilo.css">
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
    <div class="top_nav_izquierda_main"><a href="posts.php" style="text-decoration: none; color: inherit;">SINETICA </a></div>
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
        <li class=" crema" id="btn-posts"><a  href="#"  onclick="mostrarSeccion('posts')">PUBLICACIONES</a></li>
        <li class=" morado" id="btn-info"><a  href="#"  onclick="mostrarSeccion('info')">INFORMACIÓN</a></li>
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
                    <li id="modo_virtual" class="<?= $usuario['WorkModality'] === 'Remota' ? 'modo-activo' : '' ?>">VIRTUAL</li>
                    <li id="modo_hibrido" class="<?= $usuario['WorkModality'] === 'Mixta' ? 'modo-activo' : '' ?>">HÍBRIDO</li>
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
                    <p> <?= nl2br(htmlspecialchars($usuario['Bio'] ?? 'Este usuario no tiene biografía.')) ?></p>
                </div>
                <div class="area_de_trabajo">
                    <h2>ÁREAS DE TRABAJO</h2><p> <?= htmlspecialchars($usuario['WorkArea']  ?? '') ?></p>
                </div>
                <div class="herramientas borde_abajo">
                    <h2>HERRAMIENTAS</h2><p> <?= htmlspecialchars($usuario['WorkTools']  ?? '') ?></p>
                </div>
            </div>
        </div>
            
            
        </div>

        <!-- PUBLICACIONES -->
        <div id="seccion-posts" class="seccion-perfil" >
            <?php if ($posts): ?>
                <?php foreach ($posts as $post): ?>
                    <?php 
                        $likeCount = Post::contarLikes($post['id']);
                    ?>
                    
                    <div class="post sin_borde">
                        <div class="author">
                            <a class="profile-link" href="perfil.php?user_id=<?= htmlspecialchars($post['user_id'] ?? '') ?>">
                                @<?= htmlspecialchars($post['Username'] ?? '') ?>
                            </a>
                            <p class="categoria"> <?= htmlspecialchars($post['categoria'] ?? '') ?></p>
                        </div>
                        <?php if (!empty($post['image'])): ?>
                            <img class="post-image" src="../uploads/<?= htmlspecialchars($post['image'] ?? '') ?>" alt="Imagen del post">
                        <?php endif; ?>

                        <h3 class="title"><?= htmlspecialchars($post['title']?? '') ?></h3>

                    
                        <p class="content"><?= nl2br(htmlspecialchars($post['content'] ?? '')) ?></p>
                    </div>

                    <div class="barra_like_conectar borde_abajo">
                        <div class="like sin_borde">
                            <p id="likes" style=" width: 50px; margin:0px;"> ⬤ <?= $likeCount ?> <?= $likeCount != 1 ? '' : '' ?>
                            </p>                            
                        </div>
                        <div class="fecha sin_borde">
                            <p class="date" style="padding-top:5px;"><?= date('Y-m-d', strtotime($post['created_at'])) ?></p>
                        </div>
                    </div>

                <?php endforeach; ?>
                </div>
            
            <?php else: ?>
                <p>Este usuario no ha publicado nada aún.</p>
            <?php endif; ?>
        </div>    
    

        <div class="cerrar_sesion" style="<?= $is_own_profile ? 'display: block' : 'display: none;' ?>">
            <?php if ($is_own_profile): ?>
                <a href="cerrar_sesion.php" class="logout-btn">Cerrar sesión</a>
            <?php endif; ?>
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
            sessionStorage.setItem('pestanaPerfil', seccion);
            const infoDiv = document.getElementById("seccion-info");
            const postsDiv = document.getElementById("seccion-posts");
            const btnInfo = document.getElementById("btn-info");
            const btnPosts = document.getElementById("btn-posts");

            infoDiv.classList.remove("seccion-activa");
            postsDiv.classList.remove("seccion-activa");
            btnInfo.classList.remove("morado", "crema");
            btnPosts.classList.remove("morado", "crema");

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

        window.addEventListener('DOMContentLoaded', () => {
            const pestañaGuardada = sessionStorage.getItem('pestanaPerfil');
            mostrarSeccion(pestañaGuardada || 'posts');
        });
    </script>



    </body>
</html>
