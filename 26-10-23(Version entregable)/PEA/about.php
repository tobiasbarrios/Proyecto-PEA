<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="autor" content="Lospibes">
  <link rel="shortcut icon" href="favicon.png">

  <meta name="description" content="" />
  <meta name="keywords" content="bootstrap, bootstrap4" />

		<!-- CSS PIOLA -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
		<link href="css/tiny-slider.css" rel="stylesheet">
		<link href="css/style.css" rel="stylesheet">
		<title>PEA</title>
	</head>

	<body>

		<!-- Header NAV -->
		<nav class="custom-navbar navbar navbar navbar-expand-md navbar-dark bg-dark" arial-label="Furni navigation bar">

			<div class="container">
				<a class="navbar-brand" href="/PEA/home.php">PEA<span>.</span></a>

				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni" aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse" id="navbarsFurni">
					<ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
						
						<li><a class="nav-link" href="/PEA/home.php">Home</a></li>
						
						<li class="nav-item active"><a class="nav-link" href="/PEA/about.php">Sobre nosotros</a></li>
					
						<li><a class="nav-link" href="contact.html">Contactanos</a></li>

						<li><a class="nav-link" href="/php-login/login.php">Iniciar sesión</a></li>
					</ul>

					<ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">
						<?php
						if (isset($_SESSION['role_id'])) {
							$role_id = $_SESSION['role_id'];
							$redirect_url = "";

							switch ($role_id) {
								case 1:
									$redirect_url = "hudalumno.php";
									break;
								case 2:
									$redirect_url = "hudvoluntario.php";
									break;
								case 3:
									$redirect_url = "hudadmin.php";
									break;
								// Agrega más casos según tus necesidades
								default:
									// Maneja otros roles aquí
									break;
							}
								
							if (!empty($redirect_url)) {
								echo '<li><a class="nav-link" href="/PEA/' . $redirect_url . '"><img src="images/user.svg"></a></li>';
							}
						}
						?>
            		</ul>
				</div>
			</div>
				
		</nav>
		<!-- End header -->

		<!-- porque elegirnos -->
		<div class="why-choose-section">
			<div class="container">
				<div class="row justify-content-between align-items-center">
					<div class="col-lg-6">
						<h2 class="section-title">¿Por qué elegirnos?</h2>
						<p>En el PEA Vida Abundante, ofrecemos razones sólidas para que elijas nuestro programa:</p>

						<div class="row my-5">
							<div class="col-6 col-md-6">
								<div class="feature">
									
									<h3>Servidores confiables </h3>
									<p>Nuestra dedicación a la educación es tan sólida como nuestros servidores. Estamos comprometidos a brindarte una experiencia educativa estable y confiable, para que puedas concentrarte en tu aprendizaje sin preocupaciones.</p>
								</div>
							</div>

							<div class="col-6 col-md-6">
								<div class="feature">
								
									<h3>Facil acceso</h3>
									<p>Entendemos la importancia de la accesibilidad. En el PEA, te proporcionamos una plataforma de fácil acceso para que puedas navegar por nuestros recursos y materiales educativos de manera sencilla, sin obstáculos.
									</p>
								</div>
							</div>

							<div class="col-6 col-md-6">
								<div class="feature">
									
									<h3>Soporte 24Hs</h3>
									<p>Sabemos que las preguntas y las necesidades pueden surgir en cualquier momento. Por eso, nuestro equipo de soporte está disponible las 24 horas del día para ayudarte en cada paso de tu viaje educativo.</p>
								</div>
							</div>

							<div class="col-6 col-md-6">
								<div class="feature">

									<h3>Opcion a bajo costo</h3>
									<p>Creemos que la educación de calidad no debería ser inaccesible. En el PEA, ofrecemos una opción a bajo costo para que puedas obtener una educación valiosa sin sacrificar tu presupuesto. Tu crecimiento no tiene por qué ser costoso.</p>
								</div>
							</div>

						</div>
					</div>

					<div class="col-lg-5">
						<div class="img-wrap">
							<img src="images/why-choose-us-img.png" alt="Image" class="img-fluid">
						</div>
					</div>

				</div>
			</div>
		</div>
		<!-- aca termina porque elegirnos -->

		<!-- Nuestro equipo -->
		<div class="untree_co-section">
			<div class="container">

				<div class="row mb-5">
					<div class="col-lg-5 mx-auto text-center">
						<h2 class="section-title">Our Team</h2>
					</div>
				</div>

				<div class="row">

					<!-- 1 -->
					<div class="col-12 col-md-6 col-lg-3 mb-5 mb-md-0">
						<img src="images/person_2.jpg" class="img-fluid mb-5">
						<h3 clas><a href="#"><span class="">Gomez Despo</span> Hugo</a></h3>
            <span class="d-block position mb-4">Puesto</span>
           
     
					</div> 
					<!-- 1 -->

					<!-- 2 -->
					<div class="col-12 col-md-6 col-lg-3 mb-5 mb-md-0">
						<img src="images/person_2.jpg" class="img-fluid mb-5">

						<h3 clas><a href="#"><span class="">Villalba</span> Santiago</a></h3>
            <span class="d-block position mb-4">Puesto</span>

       

					</div> 
					<!-- 2 -->

					<!-- 3 -->
					<div class="col-12 col-md-6 col-lg-3 mb-5 mb-md-0">
						<img src="images/person_2.jpg" class="img-fluid mb-5">

						<h3 clas><a href="#"><span class="">Barrios</span> Tobias</a></h3>
            <span class="d-block position mb-4">Puesto</span>

       

					</div> 
					<!-- 3 -->

					<!-- 4 -->
					<div class="col-12 col-md-6 col-lg-3 mb-5 mb-md-0">
						<img src="images/person_2.jpg" class="img-fluid mb-5">

						<h3 clas><a href="#"><span class="">Polo</span> Antony</a></h3>
            <span class="d-block position mb-4">Puesto</span>

          

					</div> 
					<!-- 4 -->
					
					<!--  5 -->
					<div class="col-12 col-md-6 col-lg-3 mb-5 mb-md-0">
						<img src="images/person_2.jpg" class="img-fluid mb-5">

						<h3 clas><a href="#"><span class="">Pastor</span> Ezequiel</a></h3>
            <span class="d-block position mb-4">Puesto</span>

        

					</div> 
					<!-- 5 -->
				
					<!-- 6 -->
					<div class="col-12 col-md-6 col-lg-3 mb-5 mb-md-0">
						<img src="images/person_2.jpg" class="img-fluid mb-5">

						<h3 clas><a href="#"><span class="">Cordova</span> Adriano</a></h3>
            <span class="d-block position mb-4">Puesto</span>

          

					</div> 
					<!-- 6 -->
					<!-- 7 -->
					<div class="col-12 col-md-6 col-lg-3 mb-5 mb-md-0">
						<img src="images/person_2.jpg" class="img-fluid mb-5">

						<h3 clas><a href="#"><span class="">Pazzi</span> Gonzalo</a></h3>
            <span class="d-block position mb-4">Puesto</span>

          

					</div> 
					<!-- 7 -->
					<!-- 8 -->
					<div class="col-12 col-md-6 col-lg-3 mb-5 mb-md-0">
						<img src="images/person_2.jpg" class="img-fluid mb-5">

						<h3 clas><a href="#"><span class="">Godoy</span> Mariano</a></h3>
            <span class="d-block position mb-4">Puesto</span>

           

					</div> 
					<!-- 8 -->
					

				</div>
			</div>
		</div>
		<!-- Termina nuestro equipo -->



		

		<!-- Footer empieza -->
		<footer class="footer-section">
			<div class="container relative">



				<div class="row">
					<div class="col-lg-8">
						<div class="subscription-form">
							<h3 class="d-flex align-items-center"><span class="me-1"><img src="images/envelope-outline.svg" alt="Image" class="img-fluid"></span><span>Suscribite al boletin informativo</span></h3>

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
						<p class="mb-4">Somos el equipo detrás del PEA Vida Abundante, un programa educativo sin fines de lucro para adultos. En funcionamiento durante 8 años, hemos impactado positivamente a unos 900 estudiantes y 150 voluntarios. Estamos transitando hacia un sistema de expediente electrónico para ser más eficientes y sostenibles. ¡Seguimos transformando vidas!</p>

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
							<p class="mb-2 text-center text-lg-start">Copyright &copy;<script>document.write(new Date().getFullYear());</script>. All Rights Reserved. &mdash; 
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
