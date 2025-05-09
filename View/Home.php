<?php

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sinetica - Home</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Header -->
    <header class="header">
        <h1 class="logo">Sinetica</h1>
        <a href="perfil.html" class="profile-btn">Perfil</a>
    </header>

    <!-- Search and Filters -->
    <section class="search-section">
        <div class="search-container">
            <input type="text" placeholder="Buscar publicaciones..." class="search-input">
            <button class="search-btn">🔍</button>
        </div>
        <select class="category-filter">
            <option value="todas">Todas</option>
            <option value="virtuales">Virtuales</option>
            <option value="mixtas">Mixtas</option>
            <option value="presencial">Presencial</option>
        </select>
    </section>

    <!-- Recent Posts -->
    <main class="posts-grid">
        <article class="post-card">
            <h2>Publicación 1</h2>
            <p>Descripción de la publicación...</p>
        </article>
        <article class="post-card">
            <h2>Publicación 2</h2>
            <p>Descripción de la publicación...</p>
        </article>
        <article class="post-card">
            <h2>Publicación 3</h2>
            <p>Descripción de la publicación...</p>
        </article>
        <article class="post-card">
            <h2>Publicación 4</h2>
            <p>Descripción de la publicación...</p>
        </article>
    </main>

    <script src="scripts.js"></script>
</body>
</html>
