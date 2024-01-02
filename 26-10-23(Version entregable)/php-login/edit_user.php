<?php
require 'database.php';

// Verificar si el usuario tiene permiso para acceder a la página de administrador (debes implementar esta lógica)

// Incluir la lógica para obtener los roles desde la base de datos
$sql_roles = "SELECT id, nombre FROM roles";
$stmt_roles = $conn->prepare($sql_roles);
$stmt_roles->execute();
$roles = $stmt_roles->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $user_id = $_GET['id'];

    // Obtener la información del usuario a editar
    $sql_user = "SELECT id, email, nombre, apellido, dni, direccion, fecha_nacimiento, telefono, role_id FROM users WHERE id = :id";
    $stmt_user = $conn->prepare($sql_user);
    $stmt_user->bindParam(':id', $user_id);
    $stmt_user->execute();
    $user = $stmt_user->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        // El usuario no existe
        // Puedes redirigir a una página de error o hacer lo que consideres necesario
        header('Location: admin.php');
    }
} else if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_user'])) {
    $user_id = $_POST['user_id'];

    // Obtener los datos del formulario de edición
    $updatedUser = [
        'email' => $_POST['email'],
        'nombre' => $_POST['nombre'],
        'apellido' => $_POST['apellido'],
        'dni' => $_POST['dni'],
        'direccion' => $_POST['direccion'],
        'fecha_nacimiento' => $_POST['fecha_nacimiento'],
        'telefono' => $_POST['telefono'],
        'role_id' => $_POST['role_id'],
        'id' => $user_id, // Asegúrate de incluir el campo 'id'
    ];

    // Actualizar los datos del usuario en la base de datos
    $sql_update_user = "UPDATE users SET email = :email, nombre = :nombre, apellido = :apellido, dni = :dni, direccion = :direccion, fecha_nacimiento = :fecha_nacimiento, telefono = :telefono, role_id = :role_id WHERE id = :id";
    $stmt_update_user = $conn->prepare($sql_update_user);
    $stmt_update_user->execute($updatedUser);

    // Redirigir de nuevo a la página de administrador
    header('Location: admin.php');
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Editar Usuario</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f3f3;
            margin: 0;
            padding: 0;
        }

        h1, h2 {
            text-align: center;
            color: #333;
        }

        form {
            background-color: #fff;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
        }

        label {
            display: block;
            margin: 10px 0;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="date"],
        input[type="tel"],
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 15px;
        }

        button {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #007BFF;
        }

        .error {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <h1>Editar Usuario</h1>

    <!-- Formulario para editar el usuario -->
    <form method="post">
        <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
        <label>Email:</label>
        <input type="email" name="email" value="<?= $user['email'] ?>" required>
        <label>Nombre:</label>
        <input type="text" name="nombre" value="<?= $user['nombre'] ?>" required>
        <label>Apellido:</label>
        <input type="text" name="apellido" value="<?= $user['apellido'] ?>" required>
        <label>DNI:</label>
        <input type="text" name="dni" value="<?= $user['dni'] ?>" required>
        <label>Domicilio:</label>
        <input type="text" name="direccion" value="<?= $user['direccion'] ?>" required>
        <label>Fecha de Nacimiento:</label>
        <input type="date" name="fecha_nacimiento" value="<?= $user['fecha_nacimiento'] ?>" required>
        <label>Teléfono:</label>
        <input type="tel" name="telefono" value="<?= $user['telefono'] ?>" required>
        <label>Seleccionar rol:</label>
        <select name="role_id">
            <?php foreach ($roles as $role) : ?>
                <option value="<?= $role['id'] ?>" <?= $role['id'] == $user['role_id'] ? 'selected' : '' ?>><?= $role['nombre'] ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit" name="update_user">Guardar Cambios</button>
    </form>
</body>
</html>

