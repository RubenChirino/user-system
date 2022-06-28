<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse | Project</title>
    <link rel="icon" type="image/x-icon" href="../images/branch-icon.ico">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
        rel="stylesheet"
    />
    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
        rel="stylesheet"
    />
    <!-- MDB -->
    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.0.0/mdb.min.css"
        rel="stylesheet"
    />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../styles/navbar.css">
    <link rel="stylesheet" href="../styles/register.css">
</head>
<body>

    <!-- Navbar --> 
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary" >
        <div class="container-fluid">
            <a class="navbar-brand" href="/user-system">
                <svg role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><title>AIOHTTP</title><path d="M0 12C.01 5.377 5.377.01 12 0c6.623.01 11.99 5.377 12 12-.01 6.623-5.377 11.99-12 12C5.377 23.99.01 18.623 0 12zm12 11.004a10.948 10.948 0 0 0 6.81-2.367l-.303-.656a.746.746 0 0 1-.621-1.347l-.722-1.563a1.244 1.244 0 0 1-1.543-.734l-2.474.633v.012a.747.747 0 1 1-1.475-.178L8.2 15.31a1.244 1.244 0 0 1-1.278.607l-.748 2.59a.747.747 0 0 1-.17 1.388l.052 1.36A10.935 10.935 0 0 0 12 23.003zM5.75 21.05l-.044-1.142a.747.747 0 0 1 .18-1.482l.749-2.59a1.245 1.245 0 0 1-.759-1.147l-4.674-.566A11.035 11.035 0 0 0 5.75 21.05zm13.3-.608a11.083 11.083 0 0 0 2.74-3.421l-3.826-.751a1.245 1.245 0 0 1-.528.672l.732 1.588a.747.747 0 0 1 .598 1.3l.285.612zm2.878-3.698A10.934 10.934 0 0 0 23.004 12a10.95 10.95 0 0 0-2.492-6.965L19 5.551a.749.749 0 0 1-.726.922.747.747 0 0 1-.682-.442L14.449 7.1a2.492 2.492 0 0 1-1.015 2.737l2.857 4.901a1.245 1.245 0 0 1 1.732 1.236l3.904.77zm-8.846-.068l2.465-.63a1.242 1.242 0 0 1 .486-1.157l-2.856-4.9a2.478 2.478 0 0 1-2.444-.11l-2.77 3.892a1.242 1.242 0 0 1 .354 1.263l3.483 1.497a.746.746 0 0 1 1.282.143v.002zm-7.17-2.284a1.246 1.246 0 0 1 1.81-.794l2.77-3.89a2.484 2.484 0 0 1-.93-1.94c0-.603.219-1.186.617-1.64L6.476 2.487a11.013 11.013 0 0 0-5.33 11.328l4.765.578zm8.44-7.572l3.174-1.083v-.01a.747.747 0 0 1 1.345-.448l1.433-.489A10.982 10.982 0 0 0 6.745 2.333l3.64 3.581a2.49 2.49 0 0 1 3.967.904l-.002.003z"/></svg>
            </a>
        </div>
    </nav>

    <!-- Main -->
    <main>
    <?php 
        session_start();
        if (isset($_SESSION["usuario"])) {
          header("Location: /user-system/");
        }

        require_once '../utils/db/conexion.php';

        if ($conexion) {

            echo '<form method="post" action="../utils/db/addUser.php" class="register__form">
            <!-- Name and Last Name -->
            <div class="row mb-4">
              <div class="col-12 col-md-6 col-responsive">
                <div class="form-outline">
                  <input id="inputName" name="nombre" type="text" maxlength="80" class="form-control" required />
                  <label class="form-label" for="inputName">Nombre</label>
                </div>
              </div>
              <div class="col-12 col-md-6">
                <div class="form-outline">
                  <input id="inputLastname" name="apellido" type="text" maxlength="80" class="form-control" required />
                  <label class="form-label" for="inputLastname">Apellido</label>
                </div>
              </div>
            </div>

            <!-- Nickname and Country -->
            <div class="row mb-4">
              <div class="col-12 col-md-6 col-responsive">
                <div class="form-outline">
                  <input id="inputNickname" name="apodo" type="text" maxlength="35" class="form-control" required />
                  <label class="form-label" for="inputNickname">Apodo</label>
                </div>
              </div>
              <div class="col-12 col-md-6">
                <div class="form-outline">
                  <input id="inputAge" min="0" max="110" name="edad" type="number" class="form-control" required />
                  <label class="form-label" for="inputAge">Edad</label>       
                </div>
              </div>
            </div>
          
            <!-- Email input -->
            <div class="form-outline mb-4">
              <input autocomplete="email" id="inputEmail" name="email" type="email" class="form-control" required />
              <label class="form-label" for="inputEmail">Correo Electronico</label>
            </div>
          
            <!-- Password input -->
            <div class="form-outline mb-4">
              <input autocomplete="current-password" id="inputPassword" name="contraseña" type="password" class="form-control" required />
              <label class="form-label" for="inputPassword">Contraseña</label>
            </div>

            <div class="form-outline">
              <input autocomplete="current-password" id="inputPassword2" name="contraseña2" type="password" class="form-control" required />
              <label class="form-label" for="inputPassword2">Repetir contraseña</label>
            </div>
            <div id="form-info-element">
              <i class="fa-solid fa-circle-exclamation"></i>
              <span></span>
            </div>
            
          
            <!-- Checkbox -->
            <div class="form-check d-flex justify-content-center mb-4">
              <input id="inputShowPassword" class="form-check-input" type="checkbox" />
              <label class="form-check-label" for="inputShowPassword">
                Mostrar contraseña
              </label>
            </div>

            <!-- Submit button -->
            <button id="registerBtn" type="submit" class="btn btn-primary btn-block mb-4">
                Registrarme
            </button>
          
            <!-- Register buttons -->
            
            <div class="text-center">
                <p>Ya tienes cuenta? <a href="/user-system/pages/login.php">Ingresar</a></p>
              
                <!-- 
                <button type="button" class="btn btn-primary btn-floating mx-1">
                    <i class="fab fa-facebook-f"></i>
                </button>
            
                <button type="button" class="btn btn-primary btn-floating mx-1">
                    <i class="fab fa-google"></i>
                </button>
            
                <button type="button" class="btn btn-primary btn-floating mx-1">
                    <i class="fab fa-twitter"></i>
                </button>
            
                <button type="button" class="btn btn-primary btn-floating mx-1">
                    <i class="fab fa-github"></i>
                </button>
                -->
                
            </div>
            
          </form>
          
          <script>         
            // Register Validation
            const registerBtn = document.querySelector("#registerBtn");

            const inputName = document.querySelector("#inputName");
            const inputLastname = document.querySelector("#inputLastname");
            const inputNickname = document.querySelector("#inputNickname");
            const inputAge = document.querySelector("#inputAge");
            const inputEmail = document.querySelector("#inputEmail");
            const inputPassword = document.querySelector("#inputPassword");
            const inputPassword2 = document.querySelector("#inputPassword2");          
            const formInfoElement = document.querySelector("#form-info-element");   

            const inputs = [inputName, inputLastname, inputNickname, inputAge, inputEmail, inputPassword, inputPassword2];
    
            setValidations(inputs);
            registerBtn.disabled = areInputsEmpty();

            inputShowPassword.addEventListener("change", () => {
                if (inputShowPassword.checked) {
                    inputPassword.type = "text";
                    inputPassword2.type = "text";
                } else {
                    inputPassword.type = "password";
                    inputPassword2.type = "password";
                }
            });

            registerBtn.addEventListener("click", (e) => {

              const textElement = formInfoElement.querySelector("span");

              // Validate Passwords 
              if (inputPassword.value !== inputPassword2.value) {
                inputPassword2.value = "";
                
                formInfoElement.style.marginBottom = "0.5rem";
                formInfoElement.style.visibility = "visible";
                textElement.textContent = "Las contraseñas no coinciden, intenta de nuevo.";
                
                setTimeout(() => {
                  formInfoElement.style.marginBottom = "0";
                  formInfoElement.style.visibility = "hidden";
                  textElement.textContent = "";
                }, 4000);
                
                return;
              }

              if (areInputsEmpty()) {
                registerBtn.disabled = true;  
                return false;
              }  

            });
            registerBtn.addEventListener("submit", (e) => {
              cleanInputs(inputs);   
            });

            function setValidations(inputs) {
              inputs.forEach(input => {
                  input.addEventListener("input", function () {
                    registerBtn.disabled = areInputsEmpty();                                         
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

          </script>

          ';

        } else {
            die("No se pudo conectar la base de datos. \n" . "Error número: " . mysqli_connect_errno() . ".\n" . "Descripción: " . mysqli_connect_error());
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