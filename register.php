<?php
        $db = mysqli_connect('localhost', 'root', '1234',  'mysitedb')or die('Fail');
        if(!$db){
                die('Error de conexión:' .mysqli_connect_error());
        }
        echo 'Conexion exitosa';

        $email = ($_POST['u_email']);
        $passw = ($_POST['u_pssw']);


        if(empty($email) || empty($passw)){
            echo "<p>Todos loscampos son obligatorios.</p>";
            exit;
        }

        $query = "select id, contrasenha from tUsuarios where email = '".$email."'";
        $result = mysqli_query($db, $query) or die('Query error.');

        if(mysqli_num_rows($result) > 0){
            $only_row = mysqli_fetch_array($result);
            if($only_row[1] == $passw){
                session_start();
                $_SESSION['user_id'] = $only_row[0];
                header('Location: main.php');
            }else{
                echo "<p>contraseña incorrecta.</p>";
            }
        }else{
            echo "<p>Usuario no encontrado con ese email.</p>";
        }
?>