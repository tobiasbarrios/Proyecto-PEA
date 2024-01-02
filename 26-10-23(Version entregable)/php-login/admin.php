<?php
require 'database.php';

session_start();

// Verificar si el usuario tiene permiso para acceder a la página de administrador (debes implementar esta lógica)

// Obtener la lista de usuarios y roles de la base de datos
$sql_users = "SELECT id, email, password, nombre, apellido, dni, direccion, fecha_nacimiento, telefono, role_id  FROM users";
$stmt_users = $conn->prepare($sql_users);
$stmt_users->execute();
$users = $stmt_users->fetchAll(PDO::FETCH_ASSOC);

$sql_roles = "SELECT id, nombre FROM roles";
$stmt_roles = $conn->prepare($sql_roles);
$stmt_roles->execute();
$roles = $stmt_roles->fetchAll(PDO::FETCH_ASSOC);

// Procesar el formulario de asignación de roles
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['assign_role'])) {
        $user_id = $_POST['user_id'];
        $role_id = $_POST['role_id'];

        // Actualizar el rol del usuario en la tabla users
        $sql_update_user = "UPDATE users SET role_id = :role_id WHERE id = :user_id";
        $stmt_update_user = $conn->prepare($sql_update_user);
        $stmt_update_user->bindParam(':user_id', $user_id);
        $stmt_update_user->bindParam(':role_id', $role_id);

        // Insertar la asignación de rol en la tabla user_roles
        $sql_assign_role = "INSERT INTO user_roles (user_id, role_id) VALUES (:user_id, :role_id)";
        $stmt_assign_role = $conn->prepare($sql_assign_role);
        $stmt_assign_role->bindParam(':user_id', $user_id);
        $stmt_assign_role->bindParam(':role_id', $role_id);

        try {
            $conn->beginTransaction();

            if ($stmt_update_user->execute() && $stmt_assign_role->execute()) {
                // Rol asignado con éxito
                $conn->commit();
                header('Location: /php-login/admin.php'); // Redirecciona para evitar envíos duplicados
            } else {
                // Error al asignar el rol
                $conn->rollBack();
                $message = 'Hubo un problema al asignar el rol al usuario.';
            }
        } catch (Exception $e) {
            $conn->rollBack();
            $message = 'Hubo un error en la transacción: ' . $e->getMessage();
        }
    }

    // Agregar lógica para el CRUD aquí

    // Ejemplo de creación de un nuevo usuario
    if (isset($_POST['create_user'])) {
        // Obtener datos del formulario
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Cifra la contraseña
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $dni = $_POST['dni'];
        $direccion = $_POST['direccion'];
        $fecha_nacimiento = $_POST['fecha_nacimiento'];
        $telefono = $_POST['telefono'];
        $role_id = $_POST['role_id'];

        // Realizar la inserción en la base de datos
        $sql_create_user = "INSERT INTO users (email, password, nombre, apellido, dni, direccion, fecha_nacimiento, telefono, role_id) VALUES (:email, :password, :nombre, :apellido, :dni, :direccion, :fecha_nacimiento, :telefono, :role_id)";
        $stmt_create_user = $conn->prepare($sql_create_user);
        $stmt_create_user->bindParam(':email', $email);
        $stmt_create_user->bindParam(':password', $password);
        $stmt_create_user->bindParam(':nombre', $nombre);
        $stmt_create_user->bindParam(':apellido', $apellido);
        $stmt_create_user->bindParam(':dni', $dni);
        $stmt_create_user->bindParam(':direccion', $direccion);
        $stmt_create_user->bindParam(':fecha_nacimiento', $fecha_nacimiento);
        $stmt_create_user->bindParam(':telefono', $telefono);
        $stmt_create_user->bindParam(':role_id', $role_id);

        if ($stmt_create_user->execute($newUser)) {
            // Usuario creado con éxito
            header('Location: /php-login/admin.php');
        } else {
            // Error al crear el usuario
            $message = 'Hubo un problema al crear el usuario.';
        }
    }

    // Agregar lógica para actualizar y eliminar usuarios aquí
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Panel de Administración</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">

    <style>
        /* Import the Roboto font with a 100 weight */
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap');

        /* Apply the Roboto font to the entire body */
        body {
            font-family: 'Roboto', sans-serif;
        }

        /* Customize other CSS styles as needed */
        h1 {
            font-size: 24px;
            font-weight: 100;
            color: #333;
        }

        p {
            font-size: 16px;
            font-weight: 100;
            color: #666;
        }

        /* Add more styles as per your project requirements */

        /* Reset some default browser styles for consistency */
        body, h1, h2, h3, p, ul, li {
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f5f5f5;
            color: #333;
            line-height: 1.6;
        }

        .container {
            max-width: 960px;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            font-size: 24px;
            font-weight: 600;
            color: #333;
            margin: 20px 0;
        }

        h2 {
            font-size: 20px;
            font-weight: 500;
            color: #333;
            margin: 20px 0;
        }

        p {
            font-size: 16px;
            font-weight: 400;
            color: #666;
            margin: 10px 0;
        }

        a {
            text-decoration: none;
            color: #007BFF;
        }

        a:hover {
            color: #0056b3;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-weight: 600;
            text-align: center;
            text-decoration: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .button:hover {
            background-color: #0056b3;
        }

        /* Customize your page structure as needed */
        .header {
            background-color: #333;
            color: #fff;
            padding: 20px 0;
            text-align: center;
        }

        .main-content {
            padding: 20px 0;
        }

        .footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px 0;
        }

        /* Add more styles and structure for your specific content */
        /* Add a table with hover effect */
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        /* Change the background color of <th> elements to dark gray */
        th {
            background-color: #333;
            color: #fff;
            padding: 10px;
        }


        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #666;
            color: #fff;
            transition: background-color 0.3s;
        }
    </style>
</head>
<body>
<?php require 'partials/headerAdmin.php' ?>
    <?php if (!empty($message)): ?>
        <p><?= $message ?></p>
    <?php endif; ?>

    <h1>Panel de Administración</h1>
    <!-- Formulario para crear un nuevo usuario -->
    <h2>Crear Nuevo Usuario</h2>
    <form method="post" class="create-user">
        <label>Email:</label>
        <input type="email" name="email" required>
        <label>Password:</label>
        <input type="password" name="password" required>
        <label>Nombre:</label>
        <input type="text" name="nombre" required>
        <label>Apellido:</label>
        <input type="text" name="apellido" required>
        <label>DNI:</label>
        <input type="text" name="dni" required>
        <label>Domicilio:</label>
        <input type="text" name="direccion" required>
        <label>Fecha de Nacimiento:</label>
        <input type="date" name="fecha_nacimiento" required>
        <label>Teléfono:</label>
        <input type="tel" name="telefono" required>
        <label>Seleccionar rol:</label>
        <select name="role_id">
            <?php foreach ($roles as $role) : ?>
                <option value="<?= $role['id'] ?>"><?= $role['nombre'] ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit" name="create_user">Crear Usuario</button>
    </form>

    <!-- Lista de Usuarios (CRUD) -->
<h2>Lista de Usuarios</h2>
<table>
    <!-- Encabezados de la tabla aquí -->
    <tr>
        <th>ID</th>
        <th>Email</th>
        <th>Password</th>
        <th>Nombre</th>
        <th>Apellido</th>
        <th>DNI</th>
        <th>Domicilio</th>
        <th>Fecha de Nacimiento</th>
        <th>Teléfono</th>
        <th>Rol</th>
        <th>Acciones</th>
    </tr>
    <?php foreach ($users as $user) : ?>
        <tr>
            <!-- Datos de los usuarios y botones de acciones (Actualizar y Eliminar) aquí -->
            <td><?= $user['id'] ?></td>
            <td><?= $user['email'] ?></td>
            <td><?= $user['password'] ?></td>
            <td><?= $user['nombre'] ?></td>
            <td><?= $user['apellido'] ?></td>
            <td><?= $user['dni'] ?></td>
            <td><?= $user['direccion'] ?></td>
            <td><?= $user['fecha_nacimiento'] ?></td>
            <td><?= $user['telefono'] ?></td>
            <td><?= $user['role_id'] ?></td>
            <td>
                <a href="edit_user.php?id=<?= $user['id'] ?>" class="edit">Editar</a>
                <a href="delete_user.php?id=<?= $user['id'] ?>" class="delete">Eliminar</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
</body>
</html>
