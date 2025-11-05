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

			li{
				text-decoration: none;
			}

			ul{
				width: 50vw;
				margin: auto;
				padding: 30px;
			}

			li{
				width: 25vw;
				margin: auto;
				transition: all 0.4s ease-in-out;
			}
			li:hover{
				transform: scale(1.03);
				background-color: gray;
			}

		</style>
	</head>
	<body>
		<?php
			$query = 'select * from tLibros';
			$result =  mysqli_query($db, $query) or die('Query error');
			echo 'Numero de filas: '.mysqli_num_rows($result).'<br>';
			echo '<ul>';
			while($row = mysqli_fetch_array($result)){
				echo '<li">';
				echo $row['id'];
				echo '<br>';
				echo $row['nombre'];
				echo '<br>';
				echo '<img src="'.$row['url_imagen'].'" alt="Imagen libro">';
				echo '<br>';
				echo $row['autor'];
				echo '<br>';
				echo $row['anho_publicacion'];
				echo '<br>';
				echo '<p><a href="/detail.php?id='.$row['id'].'">Ver detalles</a></p>';
				echo '</li>';
				echo '<hr>';

			}
			echo '</ul>';
		?>
		<a href="/logout.php">Logout</a>
		<a href="/cambio_pssw.html">Cambiar contraseña</a>
	</body>
</html>
