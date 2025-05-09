<?php
include("../conexion.php");

class Post {

  // Método para obtener todas las publicaciones
public static function getAll() {
    global $conn;

    $sql = "
    SELECT 
        posts.*, 
        Usuario.Username, 
        Usuario.PicProfile, 
        (SELECT COUNT(*) FROM Likes WHERE Likes.PostID = posts.id) AS like_count 
    FROM posts 
    JOIN Usuario ON posts.user_id = Usuario.UserID
    ORDER BY posts.created_at DESC";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return [];
    }
}


    // Método para crear una nueva publicación
    public static function create($data) {
        global $conn;

        $stmt = $conn->prepare("INSERT INTO posts (user_id, title, content, image) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $data['user_id'], $data['title'], $data['content'], $data['image']);

        return $stmt->execute();
    }

    // Método para verificar si un usuario ha dado like a una publicación
public static function userHasLiked($post_id, $user_id) {
    global $conn;

    $stmt = $conn->prepare("SELECT * FROM Likes WHERE PostID = ? AND UserID = ?");
    $stmt->bind_param("ii", $post_id, $user_id);
    $stmt->execute();

    $result = $stmt->get_result();
    return $result->num_rows > 0;
}

// Método para añadir un like
public static function addLike($post_id, $user_id) {
    global $conn;

    $stmt = $conn->prepare("INSERT INTO Likes (PostID, UserID) VALUES (?, ?)");
    $stmt->bind_param("ii", $post_id, $user_id);

    return $stmt->execute();
}

// Método para eliminar un like
public static function removeLike($post_id, $user_id) {
    global $conn;

    $stmt = $conn->prepare("DELETE FROM Likes WHERE PostID = ? AND UserID = ?");
    $stmt->bind_param("ii", $post_id, $user_id);

    return $stmt->execute();
}

}
?>
