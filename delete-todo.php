<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    
    // Conexão com o banco de dados (ajuste conforme necessário)
    $pdo = new PDO('mysql:host=localhost;dbname=db_task_explorer', 'root', '');
    
    // Preparar e executar a query de deleção
    $stmt = $pdo->prepare('DELETE FROM tasks WHERE id = :id');
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $success = $stmt->execute();
    
    // Retornar uma resposta JSON
    echo json_encode(['success' => $success]);
}
?>
