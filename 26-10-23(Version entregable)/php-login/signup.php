<?php
require 'database.php';
session_start();

$message = '';

if (!empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['nombre']) && !empty($_POST['apellido']) && !empty($_POST['dni']) && !empty($_POST['direccion']) && !empty($_POST['fecha_nacimiento']) && !empty($_POST['telefono'])) {
    // Definir las variables de configuración de la base de datos
    $server = 'localhost'; // Nombre del servidor de la base de datos
    $database = 'php_login_database'; // Nombre de la base de datos
    $username = 'root'; // Nombre de usuario de la base de datos
    $password = ''; // Contraseña del usuario de la base de datos

    try {
        // Crear una conexión PDO a la base de datos
        $db = new PDO("mysql:host=$server;dbname=$database", $username, $password);

        $sql = "INSERT INTO users (email, password, nombre, apellido, dni, direccion, fecha_nacimiento, telefono) VALUES (:email, :password, :nombre, :apellido, :dni, :direccion, :fecha_nacimiento, :telefono)";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':email', $_POST['email']);
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':nombre', $_POST['nombre']);
        $stmt->bindParam(':apellido', $_POST['apellido']);
        $stmt->bindParam(':dni', $_POST['dni']);
        $stmt->bindParam(':direccion', $_POST['direccion']);
        $stmt->bindParam(':fecha_nacimiento', $_POST['fecha_nacimiento']);
        $stmt->bindParam(':telefono', $_POST['telefono']);

        if ($stmt->execute()) {
            $message = 'Creaste un nuevo usuario exitosamente';
            header('Location: /PEA/hudalumno.php');

            // Establece las variables de sesión para el usuario
            $_SESSION['user_id'] = $db->lastInsertId(); // Asigna el ID del usuario recién registrado
            $_SESSION['nombre'] = $_POST['nombre'];
            $_SESSION['apellido'] = $_POST['apellido'];
        } else {
            $message = 'Hay un problema al crear tu cuenta.';
            
        }
    } catch (PDOException $e) {
        echo 'Error de conexión a la base de datos: ' . $e->getMessage();
        die();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Sigup</title>
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
	 <?php require 'partials/header.php' ?>
    <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>

    <h1>Registrarse</h1>
    <span>o <a href="login.php">Iniciar sesion</a></span>
    <form action="signup.php" method="POST">
    <br>
    <br>
      <label>Datos del Alumno/a </label>
      <input name="nombre" type="text" placeholder="Nombre completo.">
      <input name="apellido" type="text" placeholder="Apellido.">
      <input name="dni" type="text" placeholder="DNI.">
      <input name="telefono" type="text" placeholder="Ingresa un numero de telefono.">
      <br>
      <label>Fecha de Nacimiento:</label>
      <input name="fecha_nacimiento" type="date" id="fecha_nacimiento" name="fecha_nacimiento" required>
      <br>
      <br>
      <br>
      <br>
       <label>Informacion Personal:</label>
      <input name="direccion" type="text" placeholder="Ingresa tu domicilio, calle y altura.">
      <input name="email" type="text" placeholder="Email de contacto.">
      <input name="password" type="password" placeholder="Ingresa una contraseña.">
      <input type="submit" value="Enviar">
    </form>

  </body>
</html>