<?php
        $db = mysqli_connect('localhost', 'root', '1234',  'mysitedb')or die('Fail');
        
        echo 'Conexion exitosa';

        $nombre = trim($_POST['nombre']);
        $apellido = trim($_POST['apellido']);
        $email = trim($_POST['u_email']);
        $passw = trim($_POST['u_pssw']);
        $confirm_passw = trim($_POST['u_pssw2']);

        if(empty($email) || empty($passw) || empty($nombre) || empty($apellido)){
            echo "<p>Todos los campos son obligatorios.</p>";
            exit;
        }

        if($passw != $confirm_passw){
            echo "<p>La contraseña no coincide.</p>";
            exit;
        }

        $query = "select id from tUsuarios where email = '$email'";
        $result = mysqli_query($db, $query) or die('Query error.');

        if(mysqli_num_rows($result) > 0){
            echo "<p>Ya existe un usuario con ese correo.</p>";
            exit;
        }

        $password_hash = password_hash($passw, PASSWORD_DEFAULT);
        $query_insert = "insert into tUsuarios(nombre, apellidos, email, contrasenha) values('$nombre', '$apellido', '$email', '$password_hash') ";
        $result_insert = mysqli_query($db, $query_insert);

        if($result_insert){
            header('Location: main.php');
            exit;
        }else{
            echo "<p>Error al registrar usuario.</p>";
        }
?>