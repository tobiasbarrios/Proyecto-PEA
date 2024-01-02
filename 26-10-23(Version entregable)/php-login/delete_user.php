<?php
require 'database.php';

// Verificar si el usuario tiene permiso para acceder a la página de administrador (debes implementar esta lógica)

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $user_id = $_GET['id'];

    // Verificar si el usuario existe
    $sql_user = "SELECT id FROM users WHERE id = :id";
    $stmt_user = $conn->prepare($sql_user);
    $stmt_user->bindParam(':id', $user_id);
    $stmt_user->execute();
    $user = $stmt_user->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Eliminar registros relacionados en la tabla user_roles
        $sql_delete_user_roles = "DELETE FROM user_roles WHERE user_id = :user_id";
        $stmt_delete_user_roles = $conn->prepare($sql_delete_user_roles);
        $stmt_delete_user_roles->bindParam(':user_id', $user_id);
        $stmt_delete_user_roles->execute();
    
        // Ahora puedes eliminar el usuario
        $sql_delete_user = "DELETE FROM users WHERE id = :id";
        $stmt_delete_user = $conn->prepare($sql_delete_user);
        $stmt_delete_user->bindParam(':id', $user_id);
        $stmt_delete_user->execute();
    }
    
}

// Redirigir de nuevo a la página de administrador
header('Location: admin.php');
?>
