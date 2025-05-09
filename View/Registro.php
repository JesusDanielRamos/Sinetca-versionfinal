<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="../styles/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }
        h2 {
            color: #333;
            margin-bottom: 20px;
        }
        form {
            background-color: #ffffff;
            padding: 20px 30px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
        }
        label {
            font-weight: bold;
            margin-top: 15px;
            display: block;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }
        button {
            background-color: #333;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
            margin-top: 10px;
        }
        button:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <!-- enctype es necesario para que PHP reciba los archivos -->
    <h2>Registro de Usuario</h2>
    <form action="../Controller/AuthController.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="action" value="register">

        <label for="username">Nombre de usuario:</label>
        <input type="text" name="username" id="username" required>

        <label for="email">Correo electrónico:</label>
        <input type="email" name="email" id="email" required>

        <label for="password">Contraseña:</label>
        <input type="password" name="password" id="password" required>

        <label for="PicProfile">Imagen de perfil:</label>
        <input type="file" name="PicProfile" id="PicProfile" accept="image/*">

        <button type="submit">Registrarse</button>
    </form>
</body>
</html>
