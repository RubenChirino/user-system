<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario | Project</title>
    <link rel="icon" type="image/x-icon" href="../images/branch-icon.ico">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        rel="stylesheet"
    />
    <!-- MDB -->
    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.0.0/mdb.min.css"
        rel="stylesheet"
    />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../styles/navbar.css">
    <link rel="stylesheet" href="../styles/edit.css">
</head>
<body>

    <?php
        session_start();
    ?>

    <!-- Navbar --> 
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary" >
        <div class="container-fluid">
            <a class="navbar-brand" href="/user-system">
                <svg role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><title>AIOHTTP</title><path d="M0 12C.01 5.377 5.377.01 12 0c6.623.01 11.99 5.377 12 12-.01 6.623-5.377 11.99-12 12C5.377 23.99.01 18.623 0 12zm12 11.004a10.948 10.948 0 0 0 6.81-2.367l-.303-.656a.746.746 0 0 1-.621-1.347l-.722-1.563a1.244 1.244 0 0 1-1.543-.734l-2.474.633v.012a.747.747 0 1 1-1.475-.178L8.2 15.31a1.244 1.244 0 0 1-1.278.607l-.748 2.59a.747.747 0 0 1-.17 1.388l.052 1.36A10.935 10.935 0 0 0 12 23.003zM5.75 21.05l-.044-1.142a.747.747 0 0 1 .18-1.482l.749-2.59a1.245 1.245 0 0 1-.759-1.147l-4.674-.566A11.035 11.035 0 0 0 5.75 21.05zm13.3-.608a11.083 11.083 0 0 0 2.74-3.421l-3.826-.751a1.245 1.245 0 0 1-.528.672l.732 1.588a.747.747 0 0 1 .598 1.3l.285.612zm2.878-3.698A10.934 10.934 0 0 0 23.004 12a10.95 10.95 0 0 0-2.492-6.965L19 5.551a.749.749 0 0 1-.726.922.747.747 0 0 1-.682-.442L14.449 7.1a2.492 2.492 0 0 1-1.015 2.737l2.857 4.901a1.245 1.245 0 0 1 1.732 1.236l3.904.77zm-8.846-.068l2.465-.63a1.242 1.242 0 0 1 .486-1.157l-2.856-4.9a2.478 2.478 0 0 1-2.444-.11l-2.77 3.892a1.242 1.242 0 0 1 .354 1.263l3.483 1.497a.746.746 0 0 1 1.282.143v.002zm-7.17-2.284a1.246 1.246 0 0 1 1.81-.794l2.77-3.89a2.484 2.484 0 0 1-.93-1.94c0-.603.219-1.186.617-1.64L6.476 2.487a11.013 11.013 0 0 0-5.33 11.328l4.765.578zm8.44-7.572l3.174-1.083v-.01a.747.747 0 0 1 1.345-.448l1.433-.489A10.982 10.982 0 0 0 6.745 2.333l3.64 3.581a2.49 2.49 0 0 1 3.967.904l-.002.003z"/></svg>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
            <?php
                if (isset($_SESSION["usuario"])) {
                    echo '
                        <a class="text-white nav-link text-danger" href="/user-system/pages/logout.php">
                            <i class="fa-solid fa-right-from-bracket"></i> Salir
                        </a>  
                    ';
                } else {
                    echo '
                        <a class="text-white nav-link" aria-current="page" href="/user-system/pages/register.php">
                            <i class="fa-solid fa-user-plus"></i> Crear cuenta
                        </a> 
                        <a class="text-white nav-link" href="/user-system/pages/login.php">
                            <i class="fa-solid fa-arrow-right-to-bracket"></i> Ingresar
                        </a>  
                    ';
                }
            ?>
                </div>
            </div> 
            
        </div>
    </nav>

    <main>
        <?php
            if (isset($_SESSION["usuario"])) { 

                $user_is_admin = $_SESSION["usuario"]["rol"] == "admin" || $_SESSION["usuario"]["rol"] == "owner";
                $queryNickname = $_GET["username"];

                if ($user_is_admin || $_SESSION["usuario"]["nickname"] == $queryNickname) {
                    require_once '../utils/db/conexion.php';

                    // Get User
                    $query = "SELECT * FROM usuario WHERE apodo='$queryNickname'";
                    $isNicknameOnDB = mysqli_query($conexion, $query); 
                    $isOwnUserAccount = ($queryNickname == $_SESSION["usuario"]["nickname"]);

                    if (mysqli_num_rows($isNicknameOnDB) > 0) { 

                        while($row = $isNicknameOnDB->fetch_assoc()) {
                            echo '<div class="container edit_container">';

                            echo '<button class="back_btn">';
                                echo '<i class="fa-solid fa-angle-left"></i>';
                            echo '</button>';

                                echo '<div class="main-body">';
                                    echo '<div class="row">';

                                        echo '<div class="col-lg-4">';
                                            echo '<div class="card">';
                                                echo '<div class="card-body">';
                                                    echo '<div class="d-flex flex-column align-items-center text-center">';
                                                            echo '<img src="/user-system/images/user-default-img.png" alt="Profile Image" class="user__profile-img" width="110">';
                                                            echo '<div class="mt-3">';
                                                                echo '<h3>'.$row["nombre"]." ".$row["apellido"].'</h3>';
                                                                echo '<h6>@'.$row["apodo"].'</h6>';
                                                                if ($row["profesion"]) {
                                                                    echo '<p class="text-secondary mb-1">'.$row["profesion"].'</p>';
                                                                }
                                                            echo '</div>';
                                                    echo '</div>';
                                                echo '</div>';
                                            echo '</div>';
                                        echo '</div>';

                                        echo '<div class="col-lg-8">';
                                            echo '<div class="card">';
                                                echo '<form method="post" action="../utils/db/updateUser.php" class="card-body">';

                                                    echo '<div class="form-outline mb-4">';
                                                        echo '<input value="'.$row["nombre"].'" autocomplete="name" id="inputName" name="nombre" type="text" maxlength="80" class="form-control" required />';
                                                        echo '<label class="form-label" for="inputName">Nombre</label>';
                                                    echo '</div>';

                                                    echo '<div class="form-outline mb-4">';
                                                        echo '<input value="'.$row["apellido"].'" autocomplete="username" id="inputApellido" name="apellido" type="text" maxlength="80" class="form-control" required />';
                                                        echo '<label class="form-label" for="inputApellido">Apellido</label>';
                                                    echo '</div>';

                                                    echo '<div class="row mb-4">';
                                                        echo '<div class="col-12 col-md-6 col-responsive">';
                                                            echo '<div class="form-outline">';
                                                                echo '<input disabled value="'.$row["apodo"].'" id="inputNickname" type="text" maxlength="35" class="form-control" required />';
                                                                echo '<input  value="'.$row["apodo"].'" name="apodo" type="hidden" required />';
                                                                echo '<label class="form-label" for="inputNickname">Apodo</label>';
                                                            echo '</div>';
                                                        echo '</div>';

                                                        echo '<div class="col-12 col-md-6">';
                                                            echo '<div class="form-outline">';
                                                                echo '<input value="'.$row["edad"].'" id="inputAge" min="0" max="110" name="edad" type="number" class="form-control" required />';
                                                                echo '<label class="form-label" for="inputAge">Edad</label>';
                                                            echo '</div>';
                                                        echo '</div>';
                                                    echo '</div>';

                                                    echo '<div class="form-outline mb-4">';
                                                        echo '<input value="'.$row["correo"].'" autocomplete="email" id="inputEmail" name="email" type="email" class="form-control" required />';
                                                        echo '<label class="form-label" for="inputEmail">Correo Electronico</label>';
                                                    echo '</div>';

                                                    echo '<div class="form-outline mb-4">';
                                                        echo '<input value="'.$row["profesion"].'" autocomplete="organization-title" id="inputProfession" name="profesion" type="text" maxlength="100" class="form-control" />';
                                                        echo '<label class="form-label" for="inputProfession">Profesion</label>';
                                                    echo '</div>';

                                                    echo '<div class="form-outline_custom mb-4">';
                                                        if (!$user_is_admin) {
                                                            echo '<input type="hidden" name="rol" value="'.$row["rol"].'" />';
                                                        }
                                                        echo '<label for="rolSelect" class="'.($user_is_admin ? "label_noDisabled" : "label_disabled").'">Rol</label>';
                                                        echo '<select '.($user_is_admin ? "" : "disabled").'  id="rolSelect" class="form-control" name="rol">';
                                                            echo '<option value="miembro" '.($row["rol"] == "miembro" ? "selected" : "").'>Miembro</option>';
                                                            echo '<option value="admin" '.($row["rol"] == "admin" ? "selected" : "").'>Administrador</option>';
                                                            echo '<option value="owner" '.($row["rol"] == "owner" ? "selected" : "").'>Propietario</option>';
                                                        echo '</select>';
                                                    echo '</div>';                                                    

                                                    echo '<div class="row mb-3 row-buttons">';
                                                        echo '<button id="updateBtn" type="submit" class="btn btn-primary" disabled=true>';
                                                            echo 'Guardar cambios';
                                                        echo '</button>';  
                                                        
                                                        echo '<button id="deleteBtn" type="button" class="btn btn-danger">';
                                                            echo 'Eliminar cuenta';
                                                        echo '</button>'; 
                                                    echo '</div>';

                                                        

                                                echo '</form>';
                                            echo '</div>';
                                        echo '</div>';

                                    echo '</div>';
                                echo '</div>';
                            echo '</div>';  

                            // =====  Modal =====
               
                    echo '<input type="hidden" data-mdb-toggle="modal" data-mdb-target="#deleteUserModal" id="deleteUserModalToggle" />
                    <div class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="deleteUserModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="deleteUserModalLabel">Eliminar cuenta</h5>
                                  <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                                </div>';

                                echo '<div class="modal-body">';
                                  $text = ($isOwnUserAccount) ? "tu" : "esta";                               
                                  echo '<p>¿Estás seguro de que quieres eliminar '.$text.' cuenta? No podrás recuperar la informacion.</p>';
                                echo '</div>';

                                echo '<div class="modal-footer">';
                                    echo '<form method="post" action="../utils/db/deleteUser.php">';                                      
                                        echo '<input value="'.$queryNickname.'" name="apodo" type="hidden" required />';
                                        echo '<button type="button" class="btn btn-secondary cancel_btn" data-mdb-dismiss="modal">Cancelar</button>';
                                        echo '<button type="submit" class="btn btn-danger">Eliminar</button>';
                                    echo '</form>';
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    echo'</div>';
                            
                            echo '<script>
                                const inputName = document.querySelector("#inputName");
                                const inputLastname = document.querySelector("#inputApellido");
                                const inputNickname = document.querySelector("#inputNickname");
                                const inputAge = document.querySelector("#inputAge");
                                const inputEmail = document.querySelector("#inputEmail");
                                const inputProfession = document.querySelector("#inputProfession");

                                const selectRol = document.querySelector("#rolSelect");

                                const backBtn = document.querySelector(".back_btn"); 
                                backBtn.addEventListener("click", function() {
                                    window.location.href = "/user-system";
                                });

                                // Required Data
                                const inputs = [inputName, inputLastname, inputNickname, inputAge, inputEmail];

                                const updateBtn = document.querySelector("#updateBtn");
                                updateBtn.addEventListener("click", function () {
                                    if (areInputsEmpty()) {
                                        alert
                                        updateBtn.disabled = true;  
                                        return false;
                                    }
                                });
                                updateBtn.addEventListener("submit", function () {
                                    cleanInputs(inputs);
                                });

                                const deleteBtn = document.querySelector("#deleteBtn");
                                const deleteUserModal = document.querySelector("#deleteUserModalToggle");
                                deleteBtn.addEventListener("click", function () {
                                    deleteUserModal.click();
                                });

                                setValidations(
                                    {
                                        inputs: [inputName, inputLastname, inputNickname, inputAge, inputEmail, inputProfession],
                                        selects: [selectRol],
                                    }
                                );

                                function setValidations({ inputs = [], selects = [] }) {
                                    inputs.forEach(input => {
                                        input.addEventListener("input", function () {
                                            updateBtn.disabled = ((checkThereAreChanges()) ? false : true) || areInputsEmpty();                                         
                                        });
                                    });

                                    selects.forEach(select => {
                                        select.addEventListener("change", function () {
                                            updateBtn.disabled = ((checkThereAreChanges()) ? false : true) || areInputsEmpty();
                                        });
                                    });
                                }

                                function areInputsEmpty() {
                                    return inputs.some(input => input.value.length === 0);
                                }

                                function cleanInputs(inputs) {
                                    inputs.forEach(input => {
                                        if (input) {
                                            input.value = "";
                                        }
                                    });
                                }

                                function checkThereAreChanges() {  
                                    if (inputProfession.value !== '.json_encode($row["profesion"]).') {
                                        return true;
                                    } 
                            
                                    if (selectRol.value !== '.json_encode($row["rol"]).') {
                                        return true;
                                    }
                                    
                                    if (inputName.value !== '.json_encode($row["nombre"]).') {
                                        return true;
                                    } 
                                    if (inputLastname.value !== '.json_encode($row["apellido"]).') {
                                        return true;
                                    } 
                                    if (inputNickname.value !== '.json_encode($row["apodo"]).') {
                                        return true;
                                    } 
                                    if (inputAge.value !== '.json_encode($row["edad"]).') {
                                        return true;
                                    } 
                                    if (inputEmail.value !== '.json_encode($row["correo"]).') {
                                        return true;
                                    }                              

                                    return false;
                                }
                            </script>';
                                    
                        }

                    } else {
                        echo '
                            <div class="alert alert-danger" role="alert">
                                El usuario no existe.
                            </div>
                        ';
                    }

                } else {
                    header("Location: /user-system/");
                }

            } else {
                header("Location: /user-system/pages/login.php");
            }
        ?>               
    </main>

    <!-- Bootstrap JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!-- MDB -->
    <script
        type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.0.0/mdb.min.js"
    ></script>
</body>
</html>