<?php
        $db = mysqli_connect('localhost', 'root', '1234',  'mysitedb')or die('Fail');
        if(!$db){
                die('Error de conexión:' .mysqli_connect_error());
        }
        echo 'Conexion exitosa';
?>
<!DOCTYPE>
<html>
        <head>
                <style>
                        img{
                                width: 150px;
                                height: 150px;
                        }
                        a{ text-decoration: none;}
                        form{
                                width: 50vw;
                                margin: auto;
                        }
                        .cuerpo{
                                width: 50vw;
                                margin: auto;
                        }
                        input[type="submit"]{
                                display: block;
                                margin-top: 5px;
                                margin-left: auto;
                                border-radius: 5px;
                        }
                </style>
        </head>
        <body>
                <?php
                 if(!isset($_GET['libro_id'])){
                        die('No se ha especificado una canción.');
                 }
                 $libro_id = $_GET['libro_id'];
                 $query = 'select * from tLibros where id ='.$libro_id;
                 $resultado = mysqli_query($db, $query) or die('Queryerror');
                 $only_row = mysqli_fetch_array($resultado);
                 echo '<h1>'.$only_row['nombre'].'</h1>';
                 echo '<div class= "cuerpo">';
                 echo '<p>'.$only_row['autor'].'</p>';
                 echo '<p>'.$only_row['anho_publicacion'].'</p>';
                 echo '<img src="'.$only_row['url_imagen']. '"alt="Imagen libro">';
                 echo '</div>';
                 echo '<hr>';
                 ?>
                 <h2>Comentarios</h2>

                 <ul>
                        <?php
                        $query2 = 'select * from tComentarios where libro_id ='.$libro_id;
                        $resultado2 =  mysqli_query($db, $query2) or die('Query error');
                        echo '<br>';
                        while($row = mysqli_fetch_array($resultado2)){
                        echo '<li>'.$row['comentario'].$row['fecha_coment'].'</li>';

                        }
                        mysqli_close($db);
                        ?>
                 </ul>

                <p>Deja un nuevo comentario</p>
		<form action="/comment.php" method="post">
			<textarea rows= "4" cols = "30" name = "new_comment"></textarea>
			<br>
			<input type="hidden" name = "libro_id" value = "<?php echo $libro_id; ?>">
			<input type="submit" value="Comentar">
		</form>
        </body>
</html>
