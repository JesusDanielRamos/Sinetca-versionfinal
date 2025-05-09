<?php
session_start();

if (!isset($_SESSION['UserID'])) {
    header("Location: ../View/login.php");
    exit;
}

require_once '../Model/Post.php';
$post = new Post();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $contenido = $_POST['contenido'];
    $usuario_id = $_SESSION['user_id'];
    
    if ($post->create($titulo, $contenido, $usuario_id)) {
        header("Location: posts.php");
        exit();
    } else {
        echo "Error al crear la publicación.";
    }
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear nueva publicación</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; margin: 0; padding: 20px; }
        .form-container { background: white; padding: 20px; max-width: 600px; margin: auto; border-radius: 10px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        h2 { margin-bottom: 20px; }
        input[type="text"], textarea {
            width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 5px;
        }
        input[type="file"] {
            margin-bottom: 15px;
        }
        button {
            background-color: #28a745; color: white; padding: 10px 20px;
            border: none; border-radius: 5px; cursor: pointer;
        }
        button:hover {
            background-color: #218838;
        }
        a { text-decoration: none; color: #007bff; }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Crear nueva publicación</h2>

    <form action="../Controller/guardar_post.php" method="POST" enctype="multipart/form-data">
        <!-- En un sistema real usarías session para obtener el user_id -->
        <input type="hidden" name="user_id" value="1"> <!-- temporalmente fijo -->

        <label>Título:</label>
        <input type="text" name="title" required>

        <label>Contenido:</label>
        <textarea name="content" rows="5" required></textarea>

        <label>Imagen (opcional):</label>
        <input type="file" name="image" accept="image/*">

        <button type="submit">Publicar</button>
    </form>

    <br>
    <a href="posts.php">← Volver a publicaciones</a>
</div>

</body>
</html>
