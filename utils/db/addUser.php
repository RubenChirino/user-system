<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Usuario</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>

<?php
    require_once 'conexion.php';

    $name = clean_data($_POST['nombre'], $conexion);
    $lastname = clean_data($_POST['apellido'], $conexion);
    $nickname = clean_data($_POST['apodo'], $conexion);
    $age = clean_data($_POST['edad'], $conexion);
    $email = clean_data(strtolower($_POST['email']), $conexion);
    $password = password_hash($_POST['contraseña'], PASSWORD_DEFAULT);
    $password = clean_data($password, $conexion);

    if (empty($name) || empty($lastname) || empty($nickname) || empty($age) || empty($email) || empty($password)) {
        echo '<div class="alert alert-danger" style="margin-bottom: 0;" role="alert">
            <strong>Error!</strong> No se pudo registrar el usuario. Por favor, verifique que se envien los campos requeridos.
        </div>

        <div style="display: flex; flex-direction: column; justify-content: center; align-items: center; width: 100%; height: 95vh;">
            <div class="spinner-border text-danger" style="width: 8rem; height: 8rem;" role="status">
                <span class="sr-only"></span>
            </div>
            <strong class="text-danger mt-3">Redireccionando...</strong>
        </div>

        <script>
            setTimeout(function() {
                window.location.href = "/user-system/pages/register.php";
            }, 3000);
        </script>
        ';
    } else {
        $query = "INSERT INTO usuario (nombre, apellido, apodo, edad, correo, contraseña) 
        VALUES ('$name', '$lastname', '$nickname', '$age', '$email', '$password')";

        $executed_query = mysqli_query($conexion, $query);

        if ($executed_query) {
            session_start();

            $_SESSION["usuario"] = array(
                'name' => $name, 
                'lastname' => $lastname, 
                'nickname' => $nickname, 
                'age' => $age, 
                'email' => $email,
                'rol' => "miembro",
                'permission_level' => 1,
            );

            // var_dump($_SESSION["usuario"]);

            header("Location: /user-system/");
            exit();
        } else {
            echo '<div class="alert alert-danger" style="margin-bottom: 0;" role="alert">
                <strong>Error!</strong> No se pudo registrar el usuario. Ha ocurrido un error en la DB.
            </div>
            
            <div style="display: flex; flex-direction: column; justify-content: center; align-items: center; width: 100%; height: 95vh;">
                <div class="spinner-border text-danger" style="width: 8rem; height: 8rem;" role="status">
                    <span class="sr-only"></span>
                </div>
                <strong class="text-danger mt-3">Redireccionando...</strong>
            </div>

            <script>
                setTimeout(function() {
                    window.location.href = "/user-system/pages/register.php";
                }, 3000);
            </script>';
        }
    }

?>
    
</body>
</html>