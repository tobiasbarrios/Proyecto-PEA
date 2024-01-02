<?php
session_start();

// Definir las variables de configuración de la base de datos
$server = 'localhost'; // Nombre del servidor de la base de datos
$database = 'php_login_database'; // Nombre de la base de datos
$username = 'root'; // Nombre de usuario de la base de datos
$password = ''; // Contraseña del usuario de la base de datos

try {
    // Crear una conexión PDO a la base de datos
    $db = new PDO("mysql:host=$server;dbname=$database", $username, $password);

    // Verifica si el usuario ha iniciado sesión
    if (isset($_SESSION['user_id'])) {
        // Obtén el ID del usuario de la sesión
        $user_id = $_SESSION['user_id'];

        // Consulta la base de datos para obtener los datos del usuario
        $stmt = $db->prepare('SELECT nombre, apellido FROM users WHERE id = :user_id');
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    }
} catch (PDOException $e) {
    echo 'Error de conexión a la base de datos: ' . $e->getMessage();
    die();
} 
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="autor" content="Lospibes">
    <link rel="shortcut icon" href="favicon.png">

    <meta name="description" content="" />
    <meta name="keywords" content="bootstrap, bootstrap4" />

    <!-- CSS Piola -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="css/tiny-slider.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <title>PEA</title>
</head>

<body>

    <!-- Empieza header Nav -->
    <nav class="custom-navbar navbar navbar-expand-md navbar-dark bg-dark" arial-label="Furni navigation bar">
        <div class="container">
            <a class="navbar-brand" href="/PEA/home.php">PEA<span>.</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni"
                aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarsFurni">
                <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
                    <li class="nav-item active">
                        <a class="nav-link" href="/PEA/home.php">Home</a>
                    </li>
                    <li><a class="nav-link" href="/PEA/about.php">Sobre nosotros</a></li>
                    <li><a class="nav-link" href="/PEA/contact.html">Contactanos</a></li>
                    <li><a class="nav-link" href="/php-login/index.php">Iniciar sesion</a></li>
                </ul>
                <ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">
                    <li><a class="nav-link" href="/PEA/"><img src="images/user.svg"></a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Termina Header Nav -->





 <!-- SECCION -->
 <div class="product-section">
    <div class="container">
        <div class="col-lg-5">
                
            <h1>Bienvenido, Administrador:<br>
            <?php
                if (isset($user) && is_array($user)) {
                    echo  "". $user['nombre'] . " " . $user['apellido'] ;
                } else {
                    header('Location: /php-login/index.php');
                    exit;
                }

                ?>
            </h1>
            <hr>

        
    </div>
        <div class="row">

             <!-- COLUMNA-->
            <div class="col-md-12 col-lg-3 mb-5 mb-lg-0">
                <h1 class="mb-4 section-title">Secciones</h1>
                <p class="mb-4">Aquí encontrarás las funcionalidades asignadas a tu rol en el sitio, si tienes problemas
                    no dudes en hablar con el soporte.
                </p>
                <p><a href="mailto:peasoporte24@gmail.com" class="btn">Soporte</a></p>
            </div>
            <!-- COLUMNA-->

            <!-- COLUMNA-->
            <div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
                <a class="product-item" href="#">
                    <img src="images/icono7.png" class="img-fluid product-thumbnail">
                    <h3 class="product-title">Buzon de Entrada</h3>
                 

                
                </a>
            </div>
            <!-- /COLUMNA -->

            <!-- COLUMNA -->
            <div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
                <a class="product-item" href="/php-login/admin.php">
                    <img src="images/icono8.png" class="img-fluid product-thumbnail">
                    <h3 class="product-title">Panel de administración</h3>
                   

                  
                </a>
            </div>
            <!-- /COLUMNA -->

            <!-- /COLUMNA -->
            <div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
                <a class="product-item" href="#">
                    <img src="images/icono9.png" class="img-fluid product-thumbnail">
                    <h3 class="product-title">Editar Bases de Datos</h3>
                    

                    
                </a>
            </div>
            <!-- /COLUMNA -->

        </div>
    </div>
</div>
<!-- Seccion -->

 





    <!-- Footer empieza -->
    <footer class="footer-section">
        
        <div class="container relative">



            <div class="row">
                <div class="col-lg-8">
                    <div class="subscription-form">
                        <h3 class="d-flex align-items-center"><span class="me-1"><img src="images/envelope-outline.svg"
                                    alt="Image" class="img-fluid"></span><span>Suscribite al boletin informativo</span>
                        </h3>

                        <form action="#" class="row g-3">
                            <div class="col-auto">
                                <input type="text" class="form-control" placeholder="Enter your name">
                            </div>
                            <div class="col-auto">
                                <input type="email" class="form-control" placeholder="Enter your email">
                            </div>
                            <div class="col-auto">
                                <button class="btn btn-primary">
                                    <span class="fa fa-paper-plane"></span>
                                </button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

            <div class="row g-5 mb-5">
                <div class="col-lg-4">
                    <div class="mb-4 footer-logo-wrap"><a href="#" class="footer-logo">PEA<span>.</span></a></div>
                    <p class="mb-4">Somos el equipo detrás del PEA Vida Abundante, un programa educativo sin fines de
                        lucro para adultos. En funcionamiento durante 8 años, hemos impactado positivamente a unos 900
                        estudiantes y 150 voluntarios. Estamos transitando hacia un sistema de expediente electrónico
                        para ser más eficientes y sostenibles. ¡Seguimos transformando vidas!</p>

                    <ul class="list-unstyled custom-social">
                        <li><a href="#"><span class="fa fa-brands fa-facebook-f"></span></a></li>

                        <li><a href="#"><span class="fa fa-brands fa-instagram"></span></a></li>

                    </ul>
                </div>

                <div class="col-lg-8">
                    <div class="row links-wrap">
                        <div class="col-6 col-sm-6 col-md-3">
                            <ul class="list-unstyled">
                                <li><a href="#">Sobre nosotros</a></li>


                                <li><a href="#">Contactanos</a></li>
                            </ul>
                        </div>


                        <div class="col-6 col-sm-6 col-md-3">
                            <ul class="list-unstyled">

                                <li><a href="#">Nuestro equipo</a></li>

                                <li><a href="#">Politica de privacidad</a></li>
                            </ul>
                        </div>


                    </div>
                </div>

            </div>

            <div class="border-top copyright">
                <div class="row pt-4">
                    <div class="col-lg-6">
                        <p class="mb-2 text-center text-lg-start">Copyright &copy;
                            <script>document.write(new Date().getFullYear());</script>. All Rights Reserved. &mdash;
                        </p>
                    </div>

                    <div class="col-lg-6 text-center text-lg-end">
                        <ul class="list-unstyled d-inline-flex ms-auto">
                            <li class="me-4"><a href="#">Terms &amp; Conditions</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                        </ul>
                    </div>

                </div>
            </div>

        </div>
    </footer>
    <!-- Footer termina -->


    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/tiny-slider.js"></script>
    <script src="js/custom.js"></script>
</body>

</html>