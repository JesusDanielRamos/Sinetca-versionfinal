<?php
include("../conexion.php");

class Usuario {
    // Método para registrar un nuevo usuario en la base de datos
    public static function registrar($username, $email, $password, $PicProfile) {
        global $conn;

        // Hashear la contraseña para almacenarla de forma segura
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        // Preparar la consulta SQL para insertar un nuevo usuario con imagen de perfil
        $sql = "INSERT INTO Usuario (Username, Email, Contrasena, PicProfile) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        // Vincular los parámetros para evitar inyecciones SQL
        $stmt->bind_param("ssss", $username, $email, $passwordHash, $PicProfile);

        // Ejecutar la consulta y devolver el resultado (true si fue exitoso, false si no)
        return $stmt->execute();
    }

    // Método para buscar un usuario por su nombre de usuario (Username)
    public static function buscarPorUsername($username) {
        global $conn;

        // Preparar la consulta para buscar el usuario
        $sql = "SELECT * FROM Usuario WHERE Username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();

        // Obtener el resultado y verificar si se encontró un usuario
        $result = $stmt->get_result();
        return ($result->num_rows > 0) ? $result->fetch_assoc() : null;
    }
}
