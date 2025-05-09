<?php
session_start();
include("../conexion.php");
include_once '../Model/Usuario.php';

if (isset($_POST['action'])) {
    $action = $_POST['action'];

    // Manejo del registro de usuario
    if ($action === 'register') {
        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        $password = $_POST['password'];
        $profileImage = '';

        // Manejo de la imagen de perfil
        if (isset($_FILES['PicProfile']) && $_FILES['PicProfile']['error'] === UPLOAD_ERR_OK) {
            $imageTmp = $_FILES['PicProfile']['tmp_name'];
            $imageName = uniqid() . "_" . basename($_FILES['PicProfile']['name']);
            $imagePath = "../uploads/profiles/" . $imageName;

            // Crear directorio si no existe
            if (!is_dir("../uploads/profiles")) {
                mkdir("../uploads/profiles", 0777, true);
            }

            // Mover el archivo a la carpeta de perfiles
            if (move_uploaded_file($imageTmp, $imagePath)) {
                $profileImage = $imageName;
            }
        }

        // Registro del usuario con imagen
        if (Usuario::registrar($username, $email, $password, $profileImage)) {
            header("Location: ../View/login.php");
            exit;
        } else {
            echo "Error al registrar usuario.";
        }
    }

    // Manejo del login
    if ($action === 'login') {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $usuario = Usuario::buscarPorUsername($username);

        if ($usuario && password_verify($password, $usuario['Contrasena'])) {
            $_SESSION['UserID'] = $usuario['UserID'];
            $_SESSION['Username'] = $usuario['Username'];
            
            header("Location: ../View/posts.php");
            exit;
        } else {
            echo "Usuario o contraseña incorrectos.";

            // Mostrar todo el contenido de $_POST y $_FILES para debug
            echo "<pre>";
            print_r($_POST);
            print_r($_FILES);
            echo "</pre>";
            exit;

        }
    }
}
?>
