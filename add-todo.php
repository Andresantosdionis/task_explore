<?php
include ("conn.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['list'])) {
        $list = $_POST['list'];
        
        $stmt = $conn->prepare('SELECT id as id_task FROM `tasks` WHERE 1 = 1 ORDER BY id DESC LIMIT 1');

        try {
            // Preparando a consulta SQL
            $stmt = $conn->prepare('SELECT id as id_task FROM `tasks` WHERE 1 = 1 ORDER BY id DESC LIMIT 1');
        
            // Executando a consulta
            $stmt->execute();
        
            // Definindo o modo de recuperação para array associativo
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
        
            // Obtendo o resultado da consulta
            $row = $stmt->fetch();
        
            $id_task = $row['id_task'];
        
        } catch (PDOException $e) {
            // Em caso de erro, capturamos a exceção
            echo "Erro ao executar a consulta: " . $e->getMessage();
        }

        try {
            $stmt = $conn->prepare("INSERT INTO tbl_list (list, painel, id_task) VALUES (:list, 0, :task)");

            $stmt->bindParam(":list", $list, PDO::PARAM_STR);
            $stmt->bindParam(':task', $id_task);

            $stmt->execute();

            if(isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])) {
                // Define o cabeçalho Location com a URL anterior
                header("Location: " . $_SERVER['HTTP_REFERER']);
                // Garante que o script não continue executando após o redirecionamento
                exit;
            } else {
                // Se não houver URL anterior, redireciona para uma URL padrão
                header("Location: /pagina-padrao.php");
                // Garante que o script não continue executando após o redirecionamento
                exit;
            }
            
        } catch (PDOException $e) {
            echo "Error:" . $e->getMessage();
        }

    } else {


        if (empty($_POST['campo1']) || empty($_POST['campo2'])) {

            echo "<script>alert('Por favor, preencha todos os campos!');</script>";

            $id = 1;
            if(isset($_SERVER['HTTP_REFERER'])) {
                // Redireciona para a URL anterior
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit;
            } else {
                // Se não houver URL anterior, redireciona para uma URL padrão
                header('Location: http://localhost/Task_Explorer_PCC/taske/details.php?key=');
                exit;
            }

            function redirecionar()
            {
                if(isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])) {
                    // Define o cabeçalho Location com a URL anterior
                    header("Location: " . $_SERVER['HTTP_REFERER']);
                    // Garante que o script não continue executando após o redirecionamento
                    exit;
                } else {
                    // Se não houver URL anterior, redireciona para uma URL padrão
                    header("Location: /pagina-padrao.php");
                    // Garante que o script não continue executando após o redirecionamento
                    exit;
                }
            }


        }
    }
}
?>
