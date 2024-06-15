<?php
include ("verifica_login.php");

require __DIR__ . '/connect.php';



if (!isset($_SESSION['tasks'])) {
    $_SESSION['tasks'] = array();
}

$stmt = $conn->prepare("SELECT * FROM tasks");
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);

?>


<!DOCTYPE html>
<html lang="pt-br" class="html">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/painel.css">
    <link rel="stylesheet" href="css/sidebar.css">
    <link rel="stylesheet" href="css/styleg1.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700,800,900" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="icon" href="img/task.png">
    <title>Início</title>
</head>


<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo-details">
            <img src="img/taske2-andre-lindo.png" alt="">
            <span class="logo_name">Task Explorer</span>
        </div>
        <ul class="nav-links">
            <li>
                <div class="iocn-links">
                    <a class="link_as_button" href="precos.html">
                        <i class='bx bx-collection'></i>
                        <!--Logo do inicio-->
                        <span class="link_name">Preços</span>
                    </a>
                </div>
            </li>


            <li>
                <div class="iocn-links">
                    <a class="link_as_button" href="homepage.html">
                        <i class='bx bxs-home'></i>
                        <!--Logo do inicio-->
                        <span class="link_name">Home</span>
                    </a>
                </div>
            </li>

            <li>
                <div class="iocn-links">
                    <a class="link_as_button" href="suporte.html">
                        <i class='bx bx-help-circle'></i>
                        <!--Logo do inicio-->
                        <span class="link_name">Suporte</span>
                    </a>
                </div>
            </li>

            <li>
                <div class="profile-details">
                    <div class="nome">
                        <?php if (!isset($_SESSION['usuario'])) {
                            header("Location: login.php");
                            exit();
                        }
                        echo "Olá, " . ucfirst($_SESSION['usuario']['nome']) . "!"; ?>

                    </div>
                    <a href="logout.php"><i class='bx bx-log-out'></i></a>
                </div>
            </li>
        </ul>
    </div>

    <!-- FIM SIDEBAR -->
    <section class="home-section">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">


        </head>

        <div class="profile-details2">
            <div class="nome2">
                <?php if (!isset($_SESSION['usuario'])) {
                    header("Location: login.php");
                    exit();
                }
                echo "Bem-vindo(a) ao Task Esplorer, " . ucfirst($_SESSION['usuario']['nome']) . "!"; ?>

            </div><br>
        </div>


        <div class="container">

            <?php
            if (isset($_SESSION['success'])) {
                ?>
            <div class="alert-success">
                <?php echo $_SESSION['success']; ?>
            </div>
            <?php
                unset($_SESSION['success']);
            }
            ?>

            <?php
            if (isset($_SESSION['error'])) {
                ?>
            <div class="alert-error">
                <?php echo $_SESSION['error']; ?>
            </div>
            <?php
                unset($_SESSION['error']);
            }
            ?>

            <div class="header">
                <h1>CRIE SUAS TAREFAS</h1>
            </div>
            <div class="form">
                <form action="task.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="insert" value="insert">
                    <label for="task_name">Tarefa:</label>
                    <input type="text" name="task_name" placeholder="Nome da Tarefa" require>
                    <label for="task_description" class="description">Descrição:</label>
                    <input type="text" name="task_description" class="description" placeholder="Descrição da Tarefa">
                    <label for="task_data">Data:</label>
                    <input type="date" name="task_date" class="data">
                    <label for="task_image">Imagem:</label>
                    <input type="file" name="task_image">
                    <button type="submit">Cadastrar</button>
                </form>


                <?php
                if (isset($_SESSION['message'])) {
                    echo "<p style='color: #ef5350;'>" . $_SESSION['message'] . "</p>";
                    unset($_SESSION['message']);
                }

                ?>
            </div><br>
            <!--<div class="separator">

        </div><br>
        <div class="separator">

        </div><br>-->


        </div>
        <div class="container">
            <h2 class="tarefas">TAREFAS</h2>
            <div class="list-tasks">

                <?php

echo "<ul>";

foreach ($stmt->fetchAll() as $tasks) {
    echo "<li id='task-" . $tasks['id'] . "'>
            <a href='details.php?key=" . $tasks['id'] . "'>" . $tasks['task_name'] . "</a>
            <button type='button' class='btn-clear1' onclick='deletar(" . $tasks['id'] . ")'>Remover</button>
          </li>";
}
?>

<script>
function deletar(taskId) {
    if (confirm('Deseja remover esta tarefa?')) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "delete-todo.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                if (response.success) {
                    var taskElement = document.getElementById('task-' + taskId);
                    taskElement.parentNode.removeChild(taskElement);
                } else {
                    alert('Erro ao remover a tarefa.');
                }
            }
        };
        xhr.send("id=" + taskId);
    }
}
</script>

            </div>
            <div class="footer">
                <p>Gerenciamento Task Explore</p>
            </div>
        </div>
</body>

</html>
