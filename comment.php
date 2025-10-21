<?php
        $db = mysqli_connect('localhost', 'root', '1234',  'mysitedb')or die('Fail');
        if(!$db){
                die('Error de conexión:' .mysqli_connect_error());
        }
        echo 'Conexion exitosa';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
        $libro_id = $_POST['libro_id'];
        $comentario = $_POST['new_comment'];

        $fecha_actual = date('Y-m-d');
        $query = "insert into tComentarios(comentario, usuario_id, libro_id, fecha_coment) values('$comentario' ,NULL, $libro_id, '$fecha_actual')";

        mysqli_query($db, $query) or die('Queryerror');

        echo "<p>Nuevo comentario ";
        echo mysqli_insert_id($db);
        echo "añadido</p>";

        echo "<a href='/detail.php?libro_id=".$libro_id."'>Volver</a>";
        mysqli_close($db);

        ?>
</body>
</html>