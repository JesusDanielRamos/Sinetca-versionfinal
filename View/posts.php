<?php
session_start();
include_once("../Model/Post.php");
include_once("../Model/Usuario.php");

// Verificamos si el usuario ha iniciado sesión
if (!isset($_SESSION['UserID'])) {
    header("Location: ../View/login.php");
    exit;
}

// Obtener todas las publicaciones
$posts = Post::getAll();
// Obtener el ID del usuario actual
$current_user_id = $_SESSION['UserID'];
<<<<<<< HEAD
//obtiene el nombre de la pagina actual
$current_page = basename($_SERVER['PHP_SELF']);
=======


>>>>>>> 7a8759c (Actualizar .gitignore y limpiar archivos no deseados)
// Obtener todas las categorías para el filtro
$categorias = Post::getCategorias();

// Obtener la categoría seleccionada (si existe)
$categoriaSeleccionada = $_GET['categoria'] ?? null;

// Obtener todas las publicaciones (con o sin filtro)
$posts = Post::getAll($categoriaSeleccionada);
<<<<<<< HEAD
$usuario = Usuario::buscarPorId($current_user_id);
=======
>>>>>>> 7a8759c (Actualizar .gitignore y limpiar archivos no deseados)
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/estilo.css">
    <meta charset="UTF-8">
    <title>Publicaciones</title>
<<<<<<< HEAD
    <style>.morado{ background-color: #9B8AED!important; }
        .crema{ background-color: #eef0db!important; }</style>
</head>
<body>
    
<div class="contenedor_todo_posts">
        <div class="top_nav_main">
            <div class="top_nav_izquierda_main"> 
            <a href="posts.php" style="text-decoration: none; color: inherit;">SINETICA </a>
            </div>
            <div class="top_nav_derecha_main">
                COMUNIDAD
            </div>
        </div>
        <div class="nav_main">
            <div class="nav_tercio">
                <ul class="nav_filtros">
                    <li>VIRTUAL</li>
                    <li>HÍBRIDO</li>
                    <li>PRESENCIAL</li>
                </ul>
            </div>
            <div id="filtro_categoria">
                <form method="GET">
                <select name="categoria" onchange="this.form.submit()">
                    <option value="">Todas las categorías</option>
                    <?php foreach ($categorias as $categoria): ?>
                        <option value="<?= htmlspecialchars($categoria ?? '') ?>" <?= $categoria === $categoriaSeleccionada ? 'selected' : '' ?>>
                        <?= htmlspecialchars($categoria ?? '') ?>
                        </option>
                        <?= htmlspecialchars($categoria) ?>
                        </option>
                        <?= htmlspecialchars($categoria) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </form>
            </div>

            <div class="nav_tercio">
                <ul class="nav_filtros">
                    <li>+ POPULAR</li>
                    <li>CRONOLÓGICO</li>
                    <li>PUNTOS</li>
                </ul>
                
            </div>
        </div>
    
=======
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f0f2f5;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 900px;
            margin: 40px auto;
            padding: 20px;
        }

        .post {
            background: #ffffff;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
            margin-bottom: 25px;
            padding: 20px;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .post:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.1);
        }

        .author {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .author img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-right: 15px;
            object-fit: cover;
            border: 2px solid #3498db;
            cursor: pointer;
        }

        .author-name {
            font-weight: 600;
            color: #2c3e50;
            font-size: 1.1rem;
            cursor: pointer;
        }

        .profile-btn {
            margin-left: auto;
            background-color: #3498db;
            color: #fff;
            padding: 5px 15px;
            border-radius: 20px;
            text-decoration: none;
            font-size: 0.9rem;
            transition: background-color 0.2s ease;
        }

        .profile-btn:hover {
            background-color: #2979b9;
        }

        .date {
            font-size: 0.85rem;
            color: #888;
            margin-bottom: 10px;
        }

        .title {
            font-size: 1.4rem;
            color: #333;
            margin: 10px 0 5px 0;
        }

        .content {
            font-size: 1rem;
            color: #555;
            margin-bottom: 15px;
            line-height: 1.6;
        }

        .post img.post-image {
            width: 100%;
            border-radius: 12px;
            margin-top: 10px;
            object-fit: cover;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 40px;
        }

        .btn-publicar {
            display: inline-block;
            background-color: #3498db;
            color: #fff;
            padding: 10px 20px;
            border-radius: 25px;
            text-decoration: none;
            margin-bottom: 20px;
            font-weight: bold;
            transition: background-color 0.2s ease;
        }

        .btn-publicar:hover {
            background-color: #2979b9;
        }

        .profile-link {
            color: #3498db;
            text-decoration: none;
        }

        .profile-link:hover {
            text-decoration: underline;
        }

        .like-btn {
            background-color: #ff4757;
            color: #fff;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
            margin-top: 10px;
            transition: background-color 0.2s ease;
        }

        .like-btn.liked {
            background-color: #e84141;
        }

        .like-count {
            font-size: 0.9rem;
            color: #666;
            margin-top: 5px;
        }

        .header form select {
        padding: 8px;
        border-radius: 20px;
        border: 1px solid #ccc;
        margin-bottom: 20px;
        font-size: 0.9rem;
        background-color: #f9f9f9;
        cursor: pointer;
    }
    </style>
</head>
<body>
    <div class="header">
        <h2>Publicaciones</h2>
        <a class="btn-publicar" href="crear_post.php">+ Nueva publicación</a>
        <a class="profile-btn" href="perfil.php?user_id=<?= $current_user_id ?>">Mi Perfil</a>

          <!-- Filtro de categorías -->
        <form method="GET" style="margin-top: 20px;">
            <select name="categoria" onchange="this.form.submit()">
                <option value="">Todas las categorías</option>
                <?php foreach ($categorias as $categoria): ?>
                    <option value="<?= htmlspecialchars($categoria) ?>" <?= $categoria === $categoriaSeleccionada ? 'selected' : '' ?>>
                        <?= htmlspecialchars($categoria) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </form>

    </div>
>>>>>>> 7a8759c (Actualizar .gitignore y limpiar archivos no deseados)

    <div class="container">
        <?php foreach ($posts as $post): ?>
            <div class="post">
                <div class="author">
<<<<<<< HEAD
                    
                    <a class="profile-link" href="perfil.php?user_id=<?= htmlspecialchars($post['user_id'] ?? '') ?>">
                        @<?= htmlspecialchars($post['Username'] ?? '') ?>
                    </a>
                    <p class="categoria"> <?= htmlspecialchars($post['categoria'] ?? '') ?></p>
                </div>
=======
                    <a href="perfil.php?user_id=<?= htmlspecialchars($post['user_id']) ?>">
                        <img src="../uploads/profiles/<?= htmlspecialchars($post['PicProfile'] ?: 'default.jpg') ?>" alt="Imagen de perfil">
                    </a>
                    <a class="profile-link" href="perfil.php?user_id=<?= htmlspecialchars($post['user_id']) ?>">
                        <?= htmlspecialchars($post['Username']) ?>
                    </a>
                </div>
                <p class="date">Publicado el <?= htmlspecialchars($post['created_at']) ?></p>
                <h3 class="title"><?= htmlspecialchars($post['title']) ?></h3>
                <p class="categoria"><strong>Categoría:</strong> <?= htmlspecialchars($post['categoria']) ?></p>
                <p class="content"><?= nl2br(htmlspecialchars($post['content'])) ?></p>


>>>>>>> 7a8759c (Actualizar .gitignore y limpiar archivos no deseados)
                <?php if (!empty($post['image'])): ?>
                    <img class="post-image" src="../uploads/<?= htmlspecialchars($post['image'] ?? '') ?>" alt="Imagen del post">
                <?php endif; ?>
                <!-- <p class="date">Publicado el <?= htmlspecialchars($post['created_at']) ?></p> -->
                <h3 class="title"><?= htmlspecialchars($post['title'] ?? '') ?></h3>
                
                <p class="content"><?= nl2br(htmlspecialchars($post['content'] ?? '')) ?></p>

<<<<<<< HEAD

                
                
                
=======
                <form method="POST" action="../Controller/like_controller.php">
                    <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
                    <?php $hasLiked = Post::userHasLiked($post['id'], $current_user_id); ?>
                    <button type="submit" class="like-btn<?= $hasLiked ? ' liked' : '' ?>">
                        ❤️ <?= $hasLiked ? 'Ya no me gusta' : 'Me gusta' ?>
                    </button>
                </form>
                <div class="like-count">
                    <?= htmlspecialchars($post['like_count']) ?> Me gusta
                </div>
>>>>>>> 7a8759c (Actualizar .gitignore y limpiar archivos no deseados)
            </div>
            <div class="barra_like_conectar">
                    <div class="like">
                    <form class="form_like" method="POST" action="../Controller/like_controller.php">
                        <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
                        <?php $hasLiked = Post::userHasLiked($post['id'], $current_user_id); ?>
                        <button type="submit" class="like-btn<?= $hasLiked ? ' liked' : '' ?>">
                        ⬤ <?= $hasLiked ? '✓' : '+1' ?>
                        </button>
                    </form>
                    </div>
                    <div class="conectar">
                    <a href="perfil.php?user_id=<?= htmlspecialchars($post['user_id']) ?>">
                            CONECTAR
                    </a>
                    </div>
                </div>
        <?php endforeach; ?>
    </div>
<<<<<<< HEAD
    <div id=crear_publicacion>
        <button><a class="btn-publicar" href="crear_post.php">Crear publicación</a></button>
    </div>
    <div class="bottom_nav_main">
            <div class="izquierda">
            Yo soy <br> @<?= htmlspecialchars($usuario['Username']  ?? '') ?>
                
            </div>
            <div class="derecha">
                <div class="<?= $current_page === 'posts.php' ? 'morado' : 'crema' ?>">
                    <a href="">Comunidad</a>
                </div>
                <div>
                    <a class="profile-btn" href="perfil.php?user_id=<?= $current_user_id ?>">Mi Perfil</a>
                </div>
            </div>
        </div>
    </div>
</div>
=======
>>>>>>> 7a8759c (Actualizar .gitignore y limpiar archivos no deseados)
</body>
</html>
