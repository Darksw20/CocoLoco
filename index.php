<?php
  session_start();
  error_reporting(0);

  if (isset($_SESSION['User_Name'])) {
    $user = $_SESSION['User_Name'];
  } else {
    echo "";
  }

  include('src/infoUser.php');
?>
<!DOCTYPE html>
<html lang="es" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap 4/bootstrap.css">
  <link rel="stylesheet" href="css/bootstrap 4/adicional.css">
  <link href="css/uikit.css" rel="stylesheet" type="text/css" />
  <link href="css/responsive.css" rel="stylesheet" media="only screen and (max-width: 1200px)" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  <script src="js/ajax.js" charset="utf-8"></script>
</head>

<body>

  <div class="container-fluid text-center espacioHeight">
    proyecto Desarrollado por 8B1 con coquiux
    <div class="row" id="msg">
      <div class="container-fluid">
        <?php
        $show_modal = false;
          if (!empty($_GET['msg'])) {
            $show_modal = true;
            echo "
                <div class='modal' id='modalDatos'>
                  <div class='modal-dialog modal-lg'>
                    <div class='modal-content'>
                      <div class='modal-header'>
                        <h4 class='modal-title'>¡Lo sentimos :(!</h4>
                        <button type='button' class='close' data-dismiss='modal'>&times;</button>
                      </div>
                      <div class='modal-body' id='modalAccion'>"
                        .$_GET['msg'].
                      "</div>
                      <div class='modal-footer'>
                        <button type='button' class='btn btn-danger' data-dismiss='modal' onclick=reset()>Cerrar</button>
                      </div>
                    </div>
                  </div>
                </div>

            ";
          }
        ?>
      </div>
    </div>
  </div>

  <?php if($show_modal == true):?>
  <script> $('#modalDatos').modal('show');</script>
<?php
  $show_modal = false;
endif;?>

  <!--barra inicio-->
  <div class="section-header sticky-top bg-white">
    <section style="padding: 5px;">
      <div class="container sticky-top">
        <div class="row align-items-center">
          <div class="col-lg-3 col-sm-5 col-4">
            <div class="brand-wrap">
              <img class="logo" src="">
              <h2 class="logo-text">CoCo</h2>
            </div>
            <!-- brand-wrap.// -->
          </div>
          <div class="col-lg-6 col-sm-12 order-3 order-lg-2">
            <ul class="navbar mx-auto" style="list-style: none; margin-bottom: 0;">
              <li class="nav-item">
                <a class="nav-link font-weight-bold text-dark" href="#">Inicio</a>
              </li>
              <li>
                <li class="nav-item dropdown">
                  <a class="nav-link font-weight-bold text-dark" href="departamentos.php">Departamentos</a>
                </li>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link font-weight-bold text-dark">Link</a>
              </li>
            </ul>
            <!-- search-wrap .end// -->
          </div>
          <!-- col.// -->
          <div class="col-lg-3 col-sm-7 col-8  order-2  order-lg-3">
            <div class="d-flex justify-content-end">
              <?php
                if(isset($_SESSION['User_Name'])){
                  echo"
                  <div class='widget-header'>
                    <small class='title text-muted' data-toggle='modal' data-target='#modalModificar'>Hola, ".$user."</small>
                    <div>
                      <a href='#'' class='text-dark' data-toggle='modal' data-target='#modalModificar'>Mi cuenta</a>
                    </div>
                  </div>";
                } else {
                  echo "
                    <div class='widget-header'>
                      <small class='title text-muted' >¡Hola, invitado!</small>
                      <div>
                        <a href='#'' class='text-dark' data-toggle='modal' data-target='#modalRegistro'>Iniciar sesión</a>
                      </div>
                    </div>";
                }
              ?>
              <a id="cart-popover" class="widget-header border-left pl-3 ml-3" data-container="body" data-toggle="popover" data-placement="bottom" title="Shopping Cart">
                <div class="icontext">
                  <div class="icon-wrap icon-sm round border"><i class="fa fa-shopping-cart text-dark"></i></div>
                </div>
                <span class="badge badge-pill badge-danger notify">0</span>
								<span class="total_price">$ 0.00</span>
							</a>
            </div>
            <!-- widgets-wrap.// -->
          </div>
          <!-- col.// -->
        </div>
        <!-- row.// -->
      </div>
      <!-- container.// -->
    </section>
    <!-- header-main .// -->
  </div>
  <!--barra inicio-->

  <div id="popover_content_wrapper" style="display: none">
    <span id="cart_details"></span>
      <a href="#" class="btn btn-danger" id="clear_cart">
       <i class="fas fa-trash-alt"></i> Vaciar todo
      </a>
  </div>

  <!--Carrusel-->
  <div id="demo" class="carousel slide" data-ride="carousel">
    <ul class="carousel-indicators">
      <li data-target="#demo" data-slide-to="0" class="active"></li>
      <li data-target="#demo" data-slide-to="1"></li>
      <li data-target="#demo" data-slide-to="2"></li>
    </ul>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="images/home_slider_1.jpg" alt="" width="100%" height="800">
      </div>
      <div class="carousel-item">
        <img src="images/home_slider_2.jpg" alt="" width="100%" height="800">
        <div class="carousel-caption">
          <h3>nombre</h3>
          <p>Descripcion de producto</p>
        </div>
      </div>
      <div class="carousel-item">
        <img src="images/home_slider_3.jpg" alt="" width="100%" height="800">
      </div>
    </div>
    <a class="carousel-control-prev" href="#demo" data-slide="prev">
      <span class="carousel-control-prev-icon"></span>
    </a>
    <a class="carousel-control-next" href="#demo" data-slide="next">
      <span class="carousel-control-next-icon"></span>
    </a>
  </div>
  <!--Carrusel-->

  <!--modalRegistro-->
  <div class="modal" id="modalRegistro">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Inicia sesión o registrate</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <div class="card w-100 mx-auto">
            <div class="card-header">
              <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" data-toggle="tab" href="#login">Iniciar sesión</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#signup">Registrarse</a>
                </li>
              </ul>
            </div>
            <div class="card-body">
              <div class="tab-content">
                <div id="login" class="container tab-pane active">
                  <br>
                  <form action="src/proces-lgn.php" method="post">
                    <div class="form-group">
                      <label for="email">Correo electrónico:</label>
                      <input type="email" class="form-control" name="email" required>
                    </div>
                    <div class="form-group">
                      <label for="pwd">Contraseña:</label>
                      <input type="password" class="form-control" name="password" required>
                    </div>
                    <div class="form-group form-check">
                      <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" name="checkbox"> Recordarme
                      </label>
                    </div>
                    <button type="submit" class="btn btn-primary">Iniciar sesión</button>
                  </form>
                </div>
                <div id="signup" class="container tab-pane fade">
                  <br>
                  <form action="src/registro.php" method="post">
                    <div class="form-row">
                      <div class="col-md-8 mb-3">
                        <label for="mail">Correo electrónico:</label>
                        <input type="email" class="form-control" name="emailRegistro" id="mail" required>
                      </div>
                      <div class="col-md-4 mb-2">
                        <label for="nombre">Nombre de usuario:</label>
                        <input type="text" class="form-control" name="nombreUser" id="nombreUser" pattern="[A-Za-z0-9]+" title="Solo letras y numeros sin caracteres especiales #No permitida la Ñ ni asentuaciones" required>
                      </div>
                    </div>
                    <div class="form-row" style="padding-top: 1.2rem;">
                      <div class="col">
                        <label for="nombre">Nombre(s):</label>
                        <input type="text" class="form-control" name="nombreUsuario" id="nombre" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+" title="No caracteres especiales" required>
                      </div>
                      <div class="col">
                        <label for="apellido">Apellido:</label>
                        <input type="text" class="form-control" name="apellidoUsuario" id="apellido" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+" title="No caracteres especiales" required>
                      </div>
                    </div>
                    <div class="form-row" style="padding-top: 1.2rem;">
                      <div class="col">
                        <label for="pwd">Contraseña:</label>
                        <input type="password" class="form-control" name="passwordRegistro" id="pwd" pattern="[a-zA-Z0-9-]+" minlength='6' maxlength='15' required>
                      </div>
                      <div class="col">
                        <label for="pwd2">Repertir contraseña:</label>
                        <input type="password" class="form-control" name="passwordRegistro2" id="pwd2" pattern="[a-zA-Z0-9-]+" minlength='6' maxlength='15' required>
                      </div>
                    </div>
                    <h6 class="text-primary" style="padding-top:1.22rem;">Domicilio</h6>
                    <hr>
                    <div class="form-row">
                      <div class="col-md-6 mb-4">
                        <label for="streetReg">Calle</label>
                        <input type="text" class="form-control" id="streetReg" name="calle" required>
                      </div>
                      <div class="col-md-6 mb-4">
                        <label for="formSelect0">Colonia</label>
                        <select class='form-control' id='formSelect0' name='colonia' required>
                          <?php include('src/colonias.php'); colonia($con);?>
                        </select>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary" name="button">Registrar</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
  <!--modalRegistro -->

  <!--modalModificar-->
  <div class="modal" id="modalModificar">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Modifica tus datos</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <div class="card w-100 mx-auto">
            <div class="card-header">
              <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" data-toggle="tab" href="#saldo">Agregar saldo</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#datos">Modificar mis datos</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#modPassword">Modificar contraseña</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-danger" href="src/proces-unlgn.php">Cerrar sesión</a>
                </li>
              </ul>
            </div>
            <div class="card-body">
              <div class="tab-content">
                <div id="saldo" class="container tab-pane active">
                  <h6 class="text-primary">Ingresa tu contraseña y el saldo deseado</h6>
                  <hr>
                  <form action="src/infoSaldo.php" method="post">
                    <div class="form-group">
                      <div class="row">
                        <div class="col-md-6">
                          <label for="saldoAct">Saldo actual:</label>
                          <div class="container rounded">
                            <?php echo $_SESSION['Amount']; ?>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <label for="saldoNew">Agregar saldo:</label>
                          <input type="number" class="form-control" id="saldoNew" name="saldoNuevo">
                        </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="pwd">Contraseña:</label>
                      <input type="password" class="form-control" id="pwd" name="pass" minlength='6' maxlength='15' required>
                    </div>
                    <div class="form-group form-check">
                      <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" name="checkbox" required>Autorizar
                      </label>
                    </div>
                    <button type="submit" class="btn btn-primary">Agregar saldo</button>
                  </form>
                </div>
                <div id="datos" class="container tab-pane fade">
                  <?php infoUser($con); ?>
                </div>
                <div id="modPassword" class="container tab-pane fade">
                  <?php infoPass($con); ?>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
  <!--modalModificar-->

  <!-- productos recomendados -->
  <section class="section-request bg padding-y-sm">
    <div class="container">
      <header class="section-heading heading-line">
        <h4 class="title-section bg text-uppercase">Productos recomendados</h4>
      </header>
      <div class="row">
        <?php
          include('src/fetchIndex.php');
         ?>
      </div>
    </div>
    <!-- container // -->
  </section>
  <!-- productos recomendados -->

  <footer class="section-footer bg2">
    <div class="container">
      <section class="footer-bottom row">
        <div class="col-sm-6">
          <p> Hecho con un chingo de amor, dedicación y muchas desveladas por el grupo más verga del CETI sionoraza &lt;3 <br></p>
        </div>
        <div class="col-sm-6">
          <p class="text-sm-right">
              Copyright © 2018 <br>
            <a href="https://www.facebook.com/ismaelCO2">Maestro chido de la carrera</a>
          </p>
        </div>
      </section> <!-- //footer-top -->
    </div><!-- //container -->
  </footer>

</body>

</html>
