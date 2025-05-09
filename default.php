<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Página por defecto</title>
        <link rel="icon" type="image/x-icon" href="https://hpanel.hostinger.com/favicons/hostinger.png">
        <meta charset="utf-8">
        <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
        <meta content="Página por defecto" name="description">
        <meta content="width=device-width, initial-scale=1" name="viewport">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link href="https://fonts.googleapis.com/css2?family=DM+Sans&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;700&display=swap" rel="stylesheet">
        <style>
            body {
                margin: 0px;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                width: 100vw;
                height: 100vh;
                min-height: 675px;
                background-color: #F4F5FF;
           
            @media screen and (max-width: 580px) and (min-width: 0px) {
                h1, p, .link-container {
                    width: 80%;
                }
            }
            @media screen and (min-width: 650px) and (min-height: 0px) and (max-height: 750px) {
                .link-container {
                    margin-top: 12px;
                }
                h1 {
                    margin-top: 0px;
                    margin-bottom: 0px;
                }
            }
        </style>
    </head>
    <body>
                
                <?php   
                
                    if($conn -> connect_error){
                    die("conexion fallida: ". $conn->connect_error);
                    }   
                     
                    if($_SERVER["REQUEST_METHOD"] == "POST"){
                        $fnombre = mysqli_real_escape_string($conn, $_POST["fnombre"]);
                        $fapellidos = mysqli_real_escape_string($conn, $_POST["fapellidos"]);
                     
                        $encryption_key = "clave secreta";
                        $sql = "INSERT INTO usuarios (nombre, apellidos) VALUES (
                            AES_ENCRYPT('nombre', 'encryption_key'),
                            AES_ENCRYPT('apellidos', 'encryption_key'))";
                        if($conn->query($sql) === TRUE){
                            echo "Los datos se guardaron correctamente";
                        }else{
                            echo "ERROR: ". $sql . "<br>" . $conn -> error;
                        }
                             
                    $conn-close();
                    }
            ?>
                
                <form action="index.php" method="POST">
                Nombre: <input type="text" name="fnombre" require><br>
                Apellidos: <input type="text" name="fapellidos" require><br>
                <input type="submit" value="Guardar datos"><br>
                </form>
 

    </body>
</html>