<?php
session_start();
include_once("../Model/Usuario.php");
include_once("../Model/Post.php");

// Verificamos si el usuario ha iniciado sesión
if (!isset($_SESSION['UserID'])) {
    header("Location: ../View/login.php");
    exit;
}

// Obtener el ID del usuario 
$current_user_id = $_SESSION['UserID'];
$usuario = Usuario::buscarPorId($current_user_id);
$profile_user_id = $_GET['user_id'] ?? $current_user_id;
$posts = Post::getAllPorUsuario($profile_user_id);
$work_modality = $_POST['work_modality'] ?? '';


$areas_trabajo_array = $_POST['areas_trabajo'] ?? [];
$work_tools = $_POST['work_tools'] ?? [];

$work_tools_str = implode(' / ', array_filter(array_map('trim', $work_tools)));
$areas_trabajo = implode(' / ', array_map('trim', $areas_trabajo_array));



$is_own_profile = ($current_user_id == $profile_user_id);
$is_current_page_own_profile = basename($_SERVER['PHP_SELF']) === 'perfil.php' && $is_own_profile;

// Procesar el formulario de edición

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['editar_posts'])) {
    $ids = $_POST['post_ids'] ?? [];
    $titulos = $_POST['titulos'] ?? [];
    $contenidos = $_POST['contenidos'] ?? [];
    $categorias = $_POST['categorias'] ?? [];

    for ($i = 0; $i < count($ids); $i++) {
        $id = (int) $ids[$i];
        $titulo = trim($titulos[$i]);
        $contenido = trim($contenidos[$i]);
        $categoria = trim($categorias[$i]);
        

        $nuevaImagenNombre = $_FILES["nueva_imagen_$id"]['name'] ?? '';

        if ($nuevaImagenNombre && $_FILES["nueva_imagen_$id"]['error'] == 0) {
            $rutaImagen = '../uploads/' . basename($nuevaImagenNombre);
            move_uploaded_file($_FILES["nueva_imagen_$id"]['tmp_name'], $rutaImagen);
            $imagen = basename($nuevaImagenNombre);
        } else {
            $imagen = null; // Mantener la imagen existente
        }

        Post::actualizarPost($id, $titulo, $contenido, $categoria, $imagen);
    }

    header("Location: perfil.php?user_id=$current_user_id");
    exit;
}

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
    Usuario::actualizarPerfil($alias, $pronombres, $bio, $profile_image, $areas_trabajo, $work_tools_str, $work_modality, $current_user_id);

    header("Location: perfil.php?user_id=$current_user_id");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<link rel="stylesheet" href="../css/estilo.css">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>Editar Perfil</title>
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
            <li class="tab-btn crema" id="btn-posts"><a  href="#"  onclick="mostrarSeccion('posts')">PUBLICACIONES</a></li>
            <li class="tab-btn morado" id="btn-info"><a  href="#"  onclick="mostrarSeccion('info')">INFORMACIÓN</a></li>
        </ul>
    </div>


    <div class="fondo fondo_transparente fondo_edicion">
        <div class="profile-container">

            <!-- INFORMACIÓN DEL PERFIL -->
            <div id="seccion-info" class="seccion-perfil seccion-activa">
                
                <form id="form-editar" method="POST" enctype="multipart/form-data">
                    
                    <label for="profile_image">
                    <input type="file" name="profile_image" id="profile_image">
                        <div id="imagen_placeholder">
                            <img src="../uploads/profiles/<?= htmlspecialchars($usuario['PicProfile'] ?: 'default.jpg') ?>" alt="Imagen de perfil" width="150" id="imagen_editar_post">
                        </div>
                    </label>

                    <div class="barra">
                        <p>@<?= htmlspecialchars($usuario['Username']  ?? '') ?></p>
                        
                        
                        <input type="text" name="pronombres" id="pronombres" value="<?= htmlspecialchars($usuario['Pronombres'] ?? '')?>"  placeholder="pronombres">
                    </div>

                    <input type="hidden" name="work_modality" id="work_modality" value="<?= htmlspecialchars($usuario['WorkModality'] ?? '') ?>">
                    <div class="barra_modos">
                        <ul>
                            <li id="modo_virtual" class="<?= $usuario['WorkModality'] === 'Remota' ? 'modo-activo' : '' ?>">VIRTUAL</li>
                            <li id="modo_hibrido" class="<?= $usuario['WorkModality'] === 'Mixta' ? 'modo-activo' : '' ?>">HÍBRIDO</li>
                            <li id="modo_presencial" class="<?= $usuario['WorkModality'] === 'Presencial' ? 'modo-activo' : '' ?>">PRESENCIAL</li>
                        </ul>
                    </div>
                    
                    
                    <div id="informacion_personal">
                        
                        <div class="parrafo">
                            <h2>INFORMACIÓN PERSONAL</h2>
                            
                            <input type="text" name="alias" id="alias" value="<?= htmlspecialchars($usuario['Alias'] ?? 'no hay') ?>" >
                        
                            <p> <?= htmlspecialchars($usuario['Email']  ?? '') ?></p>
                            
                            
                            <?php
                            $bio = trim($usuario['Bio'] ?? '');
                            ?>

                            <textarea placeholder="biografía" name="bio" class="textarea_transparente"><?= htmlspecialchars($bio ?? 'Este usuario no tiene biografía') ?></textarea>


                        </div>
                        <div class="area_de_trabajo">
                            <h2>ÁREAS DE TRABAJO</h2>
                            
                            <div id="areas-container">
                                <?php 
                                $areas = explode(' / ', $usuario['WorkArea'] ?? '');
                                foreach ($areas as $area): ?>
                                    <div class="area-item">
                                        <input type="text" name="areas_trabajo[]" value="<?= htmlspecialchars(trim($area)) ?>">
                                        <button type="button" onclick="quitarArea(this)">X</button>
                                    </div>
                                <?php endforeach; ?>  
                            </div>
                            <div class="boton-area">
                            <button type="button" onclick="agregarArea()">+ Agregar Área</button>
                        </div>
                            
                        </div>

                        <div class="herramientas borde_abajo">
                            <h2>HERRAMIENTAS</h2>
                            <div id="herramientas-container">
                                <?php
                                $tools = explode(' / ', $usuario['WorkTools'] ?? '');
                                foreach ($tools as $tool): ?>
                                    <div class="area-item">
                                        <input class="item-input" type="text" name="work_tools[]" value="<?= trim(htmlspecialchars($tool)) ?>">
                                        <button type="button" onclick="eliminarHerramienta(this)">X</button>
                                    </div>
                                <?php endforeach; ?>
                                
                                
                            </div>
                            <div class="boton-area">
                                    <button type="button" onclick="agregarHerramienta()">+ Agregar herramienta</button>
                                </div>
                            
                        </div>

                    </div>
                </form>
            </div>
                
                
        </div>
    
        
        <!-- PUBLICACIONES -->
        <div id="seccion-posts" class=" seccion-perfil fondo_transparente " >
            <form id="form-editar-posts" method="POST" enctype="multipart/form-data">
            <?php foreach ($posts as $post): ?>
                <?php 
                        $likeCount = Post::contarLikes($post['id']);
                ?>
                <input type="hidden" name="post_ids[]" value="<?= $post['id'] ?>">

                <div class="post sin_borde fondo_transparente">
                    <div class="author">
                        @<?= htmlspecialchars($post['Username'] ?? '') ?>
                        <input type="text" id="categorias" name="categorias[]" value="<?= htmlspecialchars($post['categoria']) ?>  " placeholder="Categoría">
                    </div>

                    <!-- Nueva imagen opcional -->
                    <label for="subir_nueva_imagen" id="label_de_subir_nueva_imagen">
                    Subir foto
                        <div id="imagen_editar_post_placeholder">
                            <?php if (!empty($post['image'])): ?>
                                <img id="imagen_editar_post" class="post-image" src="../uploads/<?= htmlspecialchars($post['image']) ?>" alt="Imagen del post">
                            <?php endif; ?>
                        </div>
                    </label>
                    <input id="subir_nueva_imagen" type="file" name="nueva_imagen_<?= $post['id'] ?>">

                    <div class="parrafo">
                        
                        <input type="text" name="titulos[]" id="pronombres[]" value="<?= htmlspecialchars($post['title']) ?>" placeholder="Título">

                        <textarea class="textarea_transparente" name="contenidos[]"><?= htmlspecialchars($post['content']) ?></textarea>
                       
                    </div>
                    
                    
                </div>
                <div class="barra_like_conectar fondo_transparente borde_abajo">
                        <div class="like sin_borde">
                            <p id="likes" style=" width: 50px; margin:0px;"> ⬤ <?= $likeCount ?> <?= $likeCount != 1 ? '' : '' ?>
                            </p>                            
                        </div>
                        <div class="fecha sin_borde">
                            <p class="date" style="padding-top:5px;"><?= date('Y-m-d', strtotime($post['created_at'])) ?></p>
                        </div>
                    </div>
            <?php endforeach; ?>

            <!-- Cierre del formulario -->
            </form>
        </div>
                
        
        </div>
        
        <div class="cerrar_sesion" style="<?= $is_own_profile ? 'display: block' : 'display: none;' ?>">
            <a href="perfil.php?user_id=<?= $current_user_id ?>">Regresar</a>
        </div>        
        
        <div class="bottom_nav_main">
            <div class="izquierda">
                
                <?php if ($is_own_profile): ?>
                    <?php if ($is_own_profile): ?>
                        <button id="boton-publicar-info"  type="submit" form="form-editar" name="editar_forms">Guardar cambios</button>
                        <button id="boton-publicar-posts"  type="submit" form="form-editar-posts" name="editar_posts">Guardar cambios</button>
                    <?php endif; ?>

                        
                <?php else: ?>
                    <a style="text-decoration: none!important; color: #eef0db!important;" href="posts.php">Comunidad</a>
                <?php endif; ?>
            </div>
            <div class="derecha">
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
            document.getElementById('profile_image').addEventListener('change', function(event) {
                const input = event.target;
                const placeholder = document.getElementById('imagen_placeholder');

                if (input.files && input.files[0]) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        placeholder.innerHTML = `<img src="${e.target.result}" alt="Vista previa" style="max-width: 100%;  object-fit: contain;">`;
                    };
                    document.querySelector("#imagen_editar_post").style.width="100%!important";
                    reader.readAsDataURL(input.files[0]);
                }
            });
            document.getElementById('form-editar').addEventListener('submit', function(e) {
                const areas = document.querySelectorAll('#areas-container input[name="areas_trabajo[]"]');
                const herramientas = document.querySelectorAll('#herramientas-container input[name="work_tools[]"]');

                for (const input of [...areas, ...herramientas]) {
                    if (input.value.trim() === '') {
                        alert("No puedes dejar campos vacíos en Áreas de trabajo o Herramientas.");
                        e.preventDefault(); // Evita que se envíe el formulario
                        return;
                    }
                }
            });
            const modalidadInput = document.getElementById('work_modality');
            const items = document.querySelectorAll('.barra_modos li');

            items.forEach(item => {
                item.addEventListener('click', () => {
                    // Remover clase activa de todos
                    items.forEach(i => i.classList.remove('modo-activo'));

                    // Agregar clase al seleccionado
                    item.classList.add('modo-activo');

                    // Guardar el valor correspondiente en el input oculto
                    switch (item.id) {
                        case 'modo_virtual':
                            modalidadInput.value = 'Remota';
                            break;
                        case 'modo_hibrido':
                            modalidadInput.value = 'Mixta';
                            break;
                        case 'modo_presencial':
                            modalidadInput.value = 'Presencial';
                            break;
                    }
                });
            });

            
            function agregarArea() {
                const container = document.getElementById('areas-container');
                const div = document.createElement('div');
                div.className = 'area-item';
                div.innerHTML = `
                    <input type="text" name="areas_trabajo[]" value="">
                    <button type="button" onclick="quitarArea(this)">X</button>
                `;
                container.appendChild(div);
            }

            function quitarArea(boton) {
                const container = document.getElementById('areas-container');
                const items = container.querySelectorAll('.area-item');

                if (items.length <= 1) {
                    alert("Debes mantener al menos una área de trabajo.");
                    return;
                }

                boton.closest('.area-item').remove();
            }
            function agregarHerramienta() {
                const container = document.getElementById('herramientas-container');
                const div = document.createElement('div');
                div.className = 'area-item';
                div.innerHTML = `
                    <input type="text" name="work_tools[]" value="">
                    <button type="button" onclick="eliminarHerramienta(this)">X</button>
                `;
                container.appendChild(div);
            }

            function eliminarHerramienta(boton) {
                const container = document.getElementById('herramientas-container');
                const items = container.querySelectorAll('.area-item');

                if (items.length <= 1) {
                    alert("Debes mantener al menos una herramienta.");
                    return;
                }

                boton.closest('.area-item').remove();
            }
            function mostrarSeccion(seccion) {
                sessionStorage.setItem('pestanaPerfil', seccion);

                const infoDiv = document.getElementById("seccion-info");
                const postsDiv = document.getElementById("seccion-posts");

                const btnInfo = document.getElementById("btn-info");
                const btnPosts = document.getElementById("btn-posts");

                const boton_publicar_posts = document.getElementById("boton-publicar-posts");
                const boton_publicar_info = document.getElementById("boton-publicar-info");

                

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
                    boton_publicar_posts.style="display: none;"
                    boton_publicar_info.style="display: block;"
                } else {
                    postsDiv.classList.add("seccion-activa");
                    btnPosts.classList.add("morado");
                    btnInfo.classList.add("crema");
                    boton_publicar_posts.style="display: block;"
                    boton_publicar_info.style="display: none;"
                    
                }
            }            
            function volverAlPerfil() {
                // Redirecciona al perfil sin perder la pestaña seleccionada
                window.location.href = "perfil.php";
            }
            window.addEventListener('DOMContentLoaded', () => {
                const pestañaGuardada = sessionStorage.getItem('pestanaPerfil');
                mostrarSeccion(pestañaGuardada || 'posts');
            });

            document.getElementById('subir_nueva_imagen').addEventListener('change', function(event) {
                console.log(event.target);
                const input = event.target;
                const imagen_editar_post_placeholder = document.getElementById('imagen_editar_post_placeholder');

                if (input.files && input.files[0]) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        console.log(e);
                        imagen_editar_post_placeholder.innerHTML = `<img src="${e.target.result}" alt="Vista previa" style="max-width: 100%;  object-fit: contain;">`;
                    };
                    document.querySelector("#imagen_editar_post").style.width="100%!important";
                    reader.readAsDataURL(input.files[0]);
                }
            });

        </script>
    </body>
</html>
