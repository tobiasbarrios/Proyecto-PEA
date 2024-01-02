<?php
  session_start();

  require 'database.php';

  if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT id, email, password FROM users WHERE id = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if (count($results) > 0) {
      $user = $results;
    }
  }
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Bienvenido</title>
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="assets/css/style.css">
	</head>
	<body>
		 <?php require 'partials/header.php' ?>

    <?php if(!empty($user)): ?>

      <br>Bienvenido. <?= $user['email']; ?>
      <br>Ingresaste exitosamente.
      <a href="logout.php">
        <br>
        <br>
        Cerrar sesion
      </a>
      <br>
       <?php require 'partials/headerAlumno.php' ?>
      <br>
    <?php else: ?>
      <h1>Por favor Inicia sesion o Registrate</h1>
      <a href="login.php">Iniciar sesion</a> 
      <a href="signup.php">Registrarse</a>
    <?php endif; ?>
  </body>
</html>