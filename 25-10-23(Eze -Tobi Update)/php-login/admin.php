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
    <style>
        </style>
</head>
<body>
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
