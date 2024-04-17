<?php
  session_start();
  if(isset($_SESSION['rol'])){
    switch($_SESSION['rol']){
      case 1:
          header('Location: ./menu_admin.php');
          break;
          case 2:
              header('Location: ./menu_recepcionista.php');
              break;
              case 3:
                  header('Location: ./menu_medico.php');
                break;
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesión</title>

    <!-- Fuentes de tipografia -->
    <!-- <link href="https://fonts.googleapis.com/css2?family=Spartan:wght@300;600&display=swap" rel="stylesheet"> -->
    <link href="https://fonts.googleapis.com/css2?family=Fjalla+One&family=Noto+Sans:wght@300;400&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/fec945242f.js" crossorigin="anonymous"></script>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <link rel="icon" href="resource/img/favicon.png">
    <link rel="stylesheet" href="css/style.css" />

    <!-- AOS CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  </head>
  <body class="bg-dark">
    
    <!-- Page content -->
    <section>
      <div class="row g-0">
        <!-- Carrusel -->
        <div class="col-lg-7 d-none d-lg-block">
          <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active" aria-label="Slide 1"></li>
              <li data-target="#carouselExampleCaptions" data-slide-to="1" aria-label="Slide 2"></li>
              <li data-target="#carouselExampleCaptions" data-slice-to="2" aria-label="Slide 3"></li>
            </ol>
            <div class="carousel-inner">
              <div class="carousel-item img-1 min-vh-100 active">
                <div class="carousel-caption d-none d-md-block">
                  <h4 class="font-weight-bold">El mejor sistema del mercado</h4>
                  <a class="text-muted text-decoration-none">Visita nuestro repositorio en GitHub</a>
                </div>
              </div>
              <div class="carousel-item img-2 min-vh-100">
                <div class="carousel-caption d-none d-md-block">
                  <h4 class="font-weight-bold">Descubre nuevas actualizaciones</h4>
                  <a class="text-muted text-decoration-none">Visita nuestro repositorio en GitHub</a>
                </div>
              </div>
              <div class="carousel-item img-3 min-vh-100">
                <div class="carousel-caption d-none d-md-block">
                  <h4 class="font-weight-bold">La organización que cuida mejor de ti</h4>
                  <a class="text-muted text-decoration-none">Visita nuestro repositorio en GitHub</a>
                </div>
              </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
        </div>
        <!-- Formulario -->
        <div class="col-lg-5 bg-dark d-flex flex-column align-items-end min-vh-100">
          <div class="align-self-center w-100 px-lg-5 py-lg-5 p-4">
            <h1 class="font-weight-bold mb-4 text-center">Iniciar sesión</h1>
            <form class="mb-5" action="model/consultasSesion.php" method="POST">
              <input type="text" name="tipo_operacion" value="iniciar" hidden>
              <div class="mb-4">
                <label for="Username" class="form-label font-weight-bold">Nombre usuario</label>
                <input type="text" class="form-control bg-dark-x border-0" id="Username" name="Username" placeholder="Ingresa tu usuario" aria-describedby="usuarioHelp" autocomplete="off" maxlength="18" required>
              </div>
              <div class="mb-4">
                <label for="password" class="form-label font-weight-bold">Contraseña</label>
                <input type="password" class="form-control bg-dark-x border-0 mb-2" name="Password" maxlength="15" placeholder="Ingresa tu contraseña" id="password" autocomplete="off" required>
                <a href="#" id="emailHelp" class="form-text text-muted text-decoration-none">¿Has olvidado tu contraseña?</a>
              </div>
              <button type="submit" class="btn btn-primary w-100">Iniciar sesión</button>
            </form>
            <p class="font-weight-bold text-center text-muted">O inicia sesión con</p>
            <!-- Tipos de inicio de sesión -->
            <div class="d-flex justify-content-around">
              <button type="button" class="btn btn-outline-light flex-grow-1 mr-2"><i class="fab fa-google lead mr-2"></i> Google</button>
              <button type="button" class="btn btn-outline-light flex-grow-1 ml-2"><i class="fab fa-facebook-f lead mr-2"></i> Facebook</button>
            </div>
          </div>
          <div class="text-center px-lg-5 pt-lg-1 pb-lg-4 p-4 mt-auto w-100">
            <p class="d-inline-block mb-0">¿Todavía no tienes una cuenta?</p> <a href="" class="text-light font-weight-bold text-decoration-none">Crea una ahora</a>
          </div>
        </div>
      </div>
    </section>

    <!-- Optional JavaScript -->
    <!-- Popper.js first, then Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
</body>
</html>