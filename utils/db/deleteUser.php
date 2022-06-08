<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Usuario</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>

<?php
    require_once 'conexion.php';

    $nickname = clean_data($_POST['apodo'], $conexion);

    // Required Values
    if (empty($nickname)) {
        echo '<div class="alert alert-danger" style="margin-bottom: 0;" role="alert">
            <strong>Error!</strong> No se pudo eliminar el usuario. Por favor, verifique que se envien los campos requeridos.
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

            // Delete User
            $query = "DELETE FROM usuario WHERE apodo = '$nickname'";
            $executed_query = mysqli_query($conexion, $query);

            if ($executed_query) {

                session_start();

                if (isset($_SESSION["usuario"]) && $_SESSION["usuario"]["nickname"] == $nickname) {
                    session_destroy();
                }  

                echo '<div class="alert alert-success" style="margin-bottom: 0;" role="alert">
                    <strong>¡Éxito!</strong> El usuario se eliminó correctamente.
                </div>
                
                <div style="display: flex; flex-direction: column; justify-content: center; align-items: center; width: 100%; height: 95vh;">
                    <div class="spinner-border text-success" style="width: 8rem; height: 8rem;" role="status">
                        <span class="sr-only"></span>
                    </div>
                    <strong class="text-success mt-3">Redireccionando...</strong>
                </div>

                <script>
                    setTimeout(function() {
                        window.location.href = "/user-system/";
                    }, 3000);
                </script>
                ';
            } else {
                echo '<div class="alert alert-danger" style="margin-bottom: 0;" role="alert">
                    <strong>Error!</strong> No se pudo eliminar el usuario. Lo sentimos, al parecer ha ocurrido un error en la DB.
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
                <strong>Error!</strong> No se pudo eliminar el usuario. Verifique que los campos esten correctos.
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