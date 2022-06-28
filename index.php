<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio | Project</title>
    <link rel="icon" type="image/x-icon" href="/user-system/images/branch-icon.ico">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        rel="stylesheet"
    />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="styles/navbar.css">
    <link rel="stylesheet" href="styles/index.css">
</head>
<body>

    <?php
        session_start();
    ?>

    <!-- Navbar --> 
    <?php
        if (isset($_SESSION["usuario"])) {
                echo '<nav class="navbar navbar-expand-lg navbar-dark bg-primary">';
                    echo '<div class="container-fluid">';
                        echo '<a class="navbar-brand" href="/user-system">
                            <svg role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><title>AIOHTTP</title><path d="M0 12C.01 5.377 5.377.01 12 0c6.623.01 11.99 5.377 12 12-.01 6.623-5.377 11.99-12 12C5.377 23.99.01 18.623 0 12zm12 11.004a10.948 10.948 0 0 0 6.81-2.367l-.303-.656a.746.746 0 0 1-.621-1.347l-.722-1.563a1.244 1.244 0 0 1-1.543-.734l-2.474.633v.012a.747.747 0 1 1-1.475-.178L8.2 15.31a1.244 1.244 0 0 1-1.278.607l-.748 2.59a.747.747 0 0 1-.17 1.388l.052 1.36A10.935 10.935 0 0 0 12 23.003zM5.75 21.05l-.044-1.142a.747.747 0 0 1 .18-1.482l.749-2.59a1.245 1.245 0 0 1-.759-1.147l-4.674-.566A11.035 11.035 0 0 0 5.75 21.05zm13.3-.608a11.083 11.083 0 0 0 2.74-3.421l-3.826-.751a1.245 1.245 0 0 1-.528.672l.732 1.588a.747.747 0 0 1 .598 1.3l.285.612zm2.878-3.698A10.934 10.934 0 0 0 23.004 12a10.95 10.95 0 0 0-2.492-6.965L19 5.551a.749.749 0 0 1-.726.922.747.747 0 0 1-.682-.442L14.449 7.1a2.492 2.492 0 0 1-1.015 2.737l2.857 4.901a1.245 1.245 0 0 1 1.732 1.236l3.904.77zm-8.846-.068l2.465-.63a1.242 1.242 0 0 1 .486-1.157l-2.856-4.9a2.478 2.478 0 0 1-2.444-.11l-2.77 3.892a1.242 1.242 0 0 1 .354 1.263l3.483 1.497a.746.746 0 0 1 1.282.143v.002zm-7.17-2.284a1.246 1.246 0 0 1 1.81-.794l2.77-3.89a2.484 2.484 0 0 1-.93-1.94c0-.603.219-1.186.617-1.64L6.476 2.487a11.013 11.013 0 0 0-5.33 11.328l4.765.578zm8.44-7.572l3.174-1.083v-.01a.747.747 0 0 1 1.345-.448l1.433-.489A10.982 10.982 0 0 0 6.745 2.333l3.64 3.581a2.49 2.49 0 0 1 3.967.904l-.002.003z"/></svg>
                        </a>';
                        echo '<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">';
                            echo '<span class="navbar-toggler-icon"></span>';
                        echo '</button>';
                        echo '<div class="collapse navbar-collapse" id="navbarNavAltMarkup">';
                            echo '<div class="navbar-nav">';
                                echo '<a class="text-white nav-link text-danger" href="/user-system/pages/logout.php">
                                    <i class="fa-solid fa-right-from-bracket"></i> Salir
                                </a>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                echo '</nav>';
            } 
    ?>

    <?php
        if (isset($_SESSION["usuario"])) { 
            echo '<main>';
                // $user_is_admin = $_SESSION["usuario"]["rol"] == "admin" || $_SESSION["usuario"]["rol"] == "owner";
                    
                echo '<div class="container welcome__container">
                        <div class="row">
                            <div class="col-12">
                                <h1>Hola '.$_SESSION["usuario"]["nickname"].'!</h1>
                            </div>
                        </div>
                    </div>';

                require_once './utils/db/conexion.php';

                $query = "SELECT * FROM usuario;";
                $executed_query = mysqli_query($conexion, $query);          

                echo '<div class="container list__container">';
                    echo '<div class="row">';
                        echo '<div class="col-12">';
                            echo '<div class="card">';
                                echo '<h3 class="text-center">Lista de usuarios:</h3>';
                                echo '<div class="card-body">';
                                    echo '<section class="table__container">';
                                        echo '<table class="table align-middle mb-0 bg-white">';

                                            echo '<thead class="bg-light">';
                                                echo '<tr>';
                                                    echo '<th>Nombre</th>';
                                                    echo '<th>Apodo</th>';
                                                    echo '<th>Edad</th>';    
                                                    echo '<th>Rol</th>'; 
                                                    echo '<th>Acciones</th>';             
                                                echo '</tr>';
                                            echo '</thead>';

                                            echo '<tbody> ';
                                                while ($row = mysqli_fetch_array($executed_query)) {
                                                    $isOwnUserAccount = ($row["apodo"] == $_SESSION["usuario"]["nickname"]);
                                                        
                                                    // Permissions table
                                                    $row_permission_level;
                                                    switch ($row["rol"]) {
                                                        case 'owner':
                                                            $row_permission_level = 5;
                                                        break;

                                                        case 'admin':
                                                            $row_permission_level = 2;
                                                        break;
                                                            
                                                        default:
                                                            $row_permission_level = 1;
                                                        break;
                                                    }

                                                    $styles = ($isOwnUserAccount) ? 'style="background-color: #dbf2f9;"' : ""; 
                                                    echo '<tr '.$styles.'>';
                                                        echo'<td>';
                                                            echo'<div class="d-flex align-items-center">';
                                                                echo'<img style="width: 45px; height: 45px" class="rounded-circle" src="/user-system/images/user-default-img.png" alt="User Profile image" />';
                                                                echo'<div class="ms-3">';
                                                                    $text = ($isOwnUserAccount) ? "(Tú)" : "";
                                                                    echo'<p class="fw-bold mb-1">'.$row["nombre"] . " " . $row["apellido"] .' '.$text.'</p>';
                                                                    echo'<p class="text-muted mb-0">'.$row["correo"].'</p>';
                                                                echo '</div>';
                                                            echo'</div>';
                                                        echo '</td>';

                                                        echo '<td>'.$row["apodo"].'</td>';

                                                        echo '<td>'.$row["edad"].'</td>';

                                                            
                                                        if ($row["rol"] === "owner") {
                                                            $rol_color = "badge-warning";
                                                        } else if ($row["rol"] === "admin") {
                                                            $rol_color = "badge-success";                                                         
                                                        } else { // Miembro
                                                            $rol_color = "badge-primary";
                                                        }

                                                        echo '<td>';                      
                                                            echo '<span class="badge '.$rol_color.' rounded-pill d-inline">'.$row["rol"].'</span>';
                                                        echo '</td>';

                                                        if ($_SESSION["usuario"]["permission_level"] > $row_permission_level || $isOwnUserAccount)  {
                                                            echo'<td>';
                                                                echo '<a class="text-decoration-none" href="/user-system/pages/edit.php?username='.$row["apodo"].'">';
                                                                    echo '<i class="fa-solid fa-user-pen"></i> Editar';
                                                                echo '</a>';
                                                            echo '</td>';
                                                        } else {
                                                            echo '<td></td>';
                                                        }
                                                    echo '</tr>';
                                                }            
                                            echo '</tbody>';
                                        echo '</table>';
                                    echo '</section>';
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';

            echo '</main>';
        } else {
            echo '<main class="no-user-container">';

                echo '<div class="card text-center welcome-card">';
                    echo '<div class="card-body">';
                        echo '<h2 class="card-title">Bienvenido al Sistema</h2>';

                        echo '<div class="welcome-links-grid">';
                            echo '<a class="btn btn-primary" aria-current="page" href="/user-system/pages/register.php">';
                                echo '<i class="fa-solid fa-user-plus"></i> Crear cuenta';
                            echo '</a>';

                            echo '<a class="btn btn-primary" href="/user-system/pages/login.php">';
                                echo '<i class="fa-solid fa-arrow-right-to-bracket"></i> Ingresar';
                            echo '</a>';
                        echo '</div>';

                    echo '</div>';
                echo '</div>';

            echo '</main>';
        }
     ?>               
    

    <!-- Bootstrap JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>