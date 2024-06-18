<?php
session_start();
require __DIR__ . '/connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $taskId = $_POST['id'];

    // Prepare and execute the query to delete the task
    $query = 'DELETE FROM tasks WHERE id_tasks = :id';
    $stmt = $conn->prepare($query);
    $stmt->bindValue(':id', $taskId, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo 'success';
    } else {
        echo 'error';
    }
} else {
    echo 'error';
}
?>
