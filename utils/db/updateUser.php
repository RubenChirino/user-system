<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Usuario</title>
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
    $profession = empty($_POST['profesion']) ? NULL : $_POST['profesion'];
    $profession = clean_data($profession, $conexion);

    $rol = clean_data($_POST['rol'], $conexion);

    // Required Values
    if (empty($name) || empty($lastname) || empty($nickname) || empty($age) || empty($email) || empty($rol)) {
        echo '<div class="alert alert-danger" style="margin-bottom: 0;" role="alert">
            <strong>Error!</strong> No se pudo actualizar el usuario. Por favor, verifique que se envien los campos requeridos.
        </div>
        
        <div style="display: flex; flex-direction: column; justify-content: center; align-items: center; width: 100%; height: 95vh;">
            <div class="spinner-border text-danger" style="width: 8rem; height: 8rem;" role="status">
                <span class="sr-only"></span>
            </div>
            <strong class="text-danger mt-3">Redireccionando...</strong>
        </div>

        <script>
            setTimeout(function() {
                window.location.href = "/user-system/pages/edit.php?username='.$nickname.'";
            }, 3000);
        </script>
        ';
    } else {

        // Validate User (If exist in the DB)
        if (mysqli_num_rows(mysqli_query($conexion, "SELECT * FROM usuario WHERE apodo = '$nickname'")) > 0) { // The user exist

            // Update User
            $query = "UPDATE usuario SET nombre = '$name', apellido = '$lastname', apodo = '$nickname', edad = '$age', correo = '$email', profesion = '$profession', rol = '$rol' WHERE apodo = '$nickname'";
            $executed_query = mysqli_query($conexion, $query);

            if ($executed_query) {

                echo '<div class="alert alert-success" style="margin-bottom: 0;" role="alert">
                    <strong>¡Éxito!</strong> El usuario se actualizó correctamente.
                </div>
                
                <div style="display: flex; flex-direction: column; justify-content: center; align-items: center; width: 100%; height: 95vh;">
                    <div class="spinner-border text-success" style="width: 8rem; height: 8rem;" role="status">
                        <span class="sr-only"></span>
                    </div>
                    <strong class="text-success mt-3">Redireccionando...</strong>
                </div>

                <script>
                    setTimeout(function() {
                        window.location.href = "/user-system/pages/edit.php?username='.$nickname.'";
                    }, 3000);
                </script>
                ';
            } else {
                echo '<div class="alert alert-danger" style="margin-bottom: 0;" role="alert">
                    <strong>Error!</strong> No se pudo actualizar el usuario. Por favor, verifique que se envien los campos requeridos.
                </div>
                
                <div style="display: flex; flex-direction: column; justify-content: center; align-items: center; width: 100%; height: 95vh;">
                    <div class="spinner-border text-danger" style="width: 8rem; height: 8rem;" role="status">
                        <span class="sr-only"></span>
                    </div>
                    <strong class="text-danger mt-3">Redireccionando...</strong>
                </div>

                <script>
                    setTimeout(function() {
                        window.location.href = "/user-system/pages/edit.php?username='.$nickname.'";
                    }, 3000);
                </script>
                ';
            }


        } else { // The user to updted is not fined in the DB
            echo '<div class="alert alert-danger" style="margin-bottom: 0;" role="alert">
                <strong>Error!</strong> No se pudo actualizar el usuario. Verifique que los campos esten correctos.
            </div>
            
            <div style="display: flex; flex-direction: column; justify-content: center; align-items: center; width: 100%; height: 95vh;">
                <div class="spinner-border text-danger" style="width: 8rem; height: 8rem;" role="status">
                    <span class="sr-only"></span>
                </div>
                <strong class="text-danger mt-3">Redireccionando...</strong>
            </div>

            <script>
                setTimeout(function() {
                    window.location.href = "/user-system";
                }, 3000);
            </script>
            ';

        }

    }

?>
    
</body>
</html>