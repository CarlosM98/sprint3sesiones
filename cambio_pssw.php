<?php
        $db = mysqli_connect('localhost', 'root', '1234',  'mysitedb')or die('Fail');
        
        echo 'Conexion exitosa';

        session_start();

        if(!isset($_SESSION['user_id'])){
            header('Location: login.php');
            exit();
        }

        $id = $_SESSION['user_id'];
        $actual = $_POST['actual'];
        $nueva = $_POST['nueva'];
        $confirmar = $_POST['confirmar'];

        if(empty($actual) || empty($nueva) || empty($confirmar)){
            echo "<p>Todos loscampos son obligatorios.</p>";
            exit();
        }

        if($nueva !== $confirmar){
            echo "<p>Nueva y confirmar deben ser iguales.</p>";
            exit();
        }
        
        $query = "select contrasenha from tUsuarios where id = $id";
        $result = mysqli_query($db, $query) or die('Query error.');

        $only_row = mysqli_fetch_array($result);

        if(!password_verify($actual, $only_row['contrasenha'])){
            echo "<p>La contraseña actual no es correcta.</p>";
            exit();
        }

        $hash = password_hash($nueva, PASSWORD_DEFAULT);
        $update = "update tUsuarios set contrasenha = '$hash' where id = $id";
        mysqli_query($db, $update) or die('Error al actualizar la contraseña.');
        echo "<p>La contraseña ha sido actualizada.</p>";


        header("Location: main.php");
        exit();

?>