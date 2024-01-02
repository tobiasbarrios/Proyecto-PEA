<?php
session_start();
require 'database.php';

if (isset($_SESSION['user_id'])) {
    header('Location: /php-login');
}

if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $records = $conn->prepare('SELECT id, email, password FROM users WHERE email = :email');
    $records->bindParam(':email', $_POST['email']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $message = '';

    if ($results !== false && password_verify($_POST['password'], $results['password'])) {
        $_SESSION['user_id'] = $results['id'];

        // Fetch the user's role_id from the database
        $records = $conn->prepare('SELECT role_id FROM users WHERE id = :user_id');
        $records->bindParam(':user_id', $results['id']);
        $records->execute();
        $role_result = $records->fetch(PDO::FETCH_ASSOC);

        if ($role_result) {
            $_SESSION['role_id'] = $role_result['role_id'];
        }

        // Redirect the user based on their role_id
        if ($_SESSION['role_id'] == 1) {
            header("Location: /PEA/hudalumno.php");
        } elseif ($_SESSION['role_id'] == 2) {
            header("Location: /PEA/hudvoluntario.php");
        } elseif ($_SESSION['role_id'] == 3) {
            header("Location: /PEA/hudadmin.php");
        } else {
            // Handle other roles or cases if needed
            header("Location: other_page.php");
        }
    } else {
        $message = 'El usuario no existe o la contraseña es errónea.';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Iniciar sesión</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php require 'partials/header.php' ?>
    <?php if (!empty($message)): ?>
        <p><?= $message ?></p>
    <?php endif; ?>

    <h1>Iniciar sesión</h1>
    <span>o <a href="signup.php">Registrarse</a></span>

    <form action="login.php" method="POST">
        <input name="email" type="text" placeholder="Ingresa tu email">
        <input name="password" type="password" placeholder="Ingresa tu contraseña">
        <input type="submit" value="Enviar">
    </form>
</body>
</html>
