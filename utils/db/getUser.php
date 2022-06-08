<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Obtener Usuario</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>

<?php
    require_once 'conexion.php';

    $apodo = clean_data($_POST['username'], $conexion);
    $password = clean_data($_POST['contraseña'], $conexion);

    if (empty($apodo) || empty($password)) {
        echo '<div class="alert alert-danger" style="margin-bottom: 0;" role="alert">
            <strong>Error!</strong> No se pudo obtener el usuario. Por favor, verifique que se envien los campos requeridos.
        </div>
        
        <div style="display: flex; flex-direction: column; justify-content: center; align-items: center; width: 100%; height: 95vh;">
            <div class="spinner-border text-danger" style="width: 8rem; height: 8rem;" role="status">
                <span class="sr-only"></span>
            </div>
            <strong class="text-danger mt-3">Redireccionando...</strong>
        </div>

        <script>
            setTimeout(function() {
                window.location.href = "/user-system/pages/login.php";
            }, 3000);
        </script>
        ';
    } else {
        // Validation
        $query = "SELECT * FROM usuario WHERE apodo='$apodo'";
        $executed_query = mysqli_query($conexion, $query);

        if (mysqli_num_rows($executed_query) > 0) { 

            while($row = $executed_query->fetch_assoc()) {
                if (password_verify($password, $row["contraseña"])) {  
                    session_start();

                    // Permissions table
                    $permission_level;
                    switch ($row["rol"]) {
                        case 'owner':
                            $permission_level = 5;
                            break;

                        case 'admin':
                            $permission_level = 2;
                            break;
                        
                        default:
                            $permission_level = 1;
                            break;
                    }

                    $_SESSION["usuario"] = array(
                        'name' => $row["nombre"], 
                        'lastname' => $row["apellido"], 
                        'nickname' => $row["apodo"], 
                        'age' => $row["edad"], 
                        'email' => $row["correo"],
                        'rol' => $row["rol"],
                        'permission_level' => $permission_level,
                    );

                    header("Location: /user-system/");
                    exit();
                } else {
                    echo '<div class="alert alert-danger" style="margin-bottom: 0;" role="alert">
                    <strong>Error!</strong> No se pudo obtener el usuario. Por favor, verifique que la contraseña sea correcta.
                    </div>

                    <div style="display: flex; flex-direction: column; justify-content: center; align-items: center; width: 100%; height: 95vh;">
                        <div class="spinner-border text-danger" style="width: 8rem; height: 8rem;" role="status">
                            <span class="sr-only"></span>
                        </div>
                        <strong class="text-danger mt-3">Redireccionando...</strong>
                    </div>

                    <script>
                        setTimeout(function() {
                            window.location.href = "/user-system/pages/login.php";
                        }, 3000);
                    </script>';
                }
            }

        } else {
            // Incorrect Username
            echo '<div class="alert alert-danger" style="margin-bottom: 0;" role="alert">
                    <strong>Error!</strong> No se pudo obtener el usuario. Por favor, verifique que el usuario sea correcto.
                </div>

                <div style="display: flex; flex-direction: column; justify-content: center; align-items: center; width: 100%; height: 95vh;">
                    <div class="spinner-border text-danger" style="width: 8rem; height: 8rem;" role="status">
                        <span class="sr-only"></span>
                    </div>
                    <strong class="text-danger mt-3">Redireccionando...</strong>
                </div>

                <script>
                    setTimeout(function() {
                        window.location.href = "/user-system/pages/login.php";
                    }, 3000);
                </script>'
            ;
        }
    }

?>
    
</body>
</html>