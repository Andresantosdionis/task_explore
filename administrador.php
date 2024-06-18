<?php
require_once 'usuarios.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['adicionar'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha']; 
    $tipo_usuario = $_POST['tipo_usuario'];
    adicionarUsuario($nome, $email, $senha, $tipo_usuario);
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['editar'])) {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $tipo_usuario = $_POST['tipo_usuario'];
    editarUsuario($id, $nome, $email, $senha, $tipo_usuario);
}


if (isset($_POST['excluir'])) {
    $id = $_POST['excluir'];
    excluirUsuario($id);
}


$usuarios = listarUsuarios();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Usuários</title>
    <link rel="stylesheet" href="administrador.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 3px solid #fff;
            padding: 8px;
            text-align: left;
        }
        form {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <h1 class="h1">Gerenciamento de Usuários</h1>
        <br>
    <h2 class="h2">Adicionar Usuário</h2>
    <form method="POST" class="form">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required placeholder="Insira o nome">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required placeholder="Insira o email">
        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required placeholder="Insira a senha">
        <label for="tipo_usuario">Tipo de Usuário:</label>
        <select id="tipo_usuario" name="tipo_usuario" required style="background:#301e64; color:#ccc; height: 25px; border-radius: 3px;">
            <option value="Usuário" style="color:#ccc;">Usuário</option>
            <option value="Administrador" style="color:#ccc;">Administrador</option>
        </select>
        <button type="submit" name="adicionar" class="btn">Adicionar</button>
    </form>
        
    <h2 class="listagem">Listagem de Usuários</h2>
    <table class="container"> 
        <thead class="box">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Tipo de Usuário</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody class="registros">
            <?php foreach ($usuarios as $usuario): ?>
                <tr>
                    <td><?php echo $usuario['id_usuario']; ?></td>
                    <td><?php echo $usuario['nome']; ?></td>
                    <td><?php echo $usuario['email']; ?></td>
                    <td><?php echo $usuario['tipo_usuario']; ?></td>
                    <td>
                        <!-- <form method="POST" style="display: inline-block;">
                            <input type="hidden" name="excluir" value="<?php echo $usuario['id_usuario']; ?>">
                            <button type="submit" class="btn">Excluir</button>
                        </form> -->
                        <form method="POST" style="display: inline-block;">
                            <input type="hidden" name="id" value="<?php echo $usuario['id_usuario']; ?>">
                            <input type="text" name="nome" value="<?php echo $usuario['nome']; ?>" required>
                            <input type="email" name="email" value="<?php echo $usuario['email']; ?>" required>
                            <input type="password" name="senha" placeholder="Nova senha">
                            <select name="tipo_usuario" required style="background:#301e64; color:#ccc; height: 30px; border-radius: 3px;">
                                <option value="Usuário"style="color:#ccc;" <?php if ($usuario['tipo_usuario'] == 'Usuário') echo 'selected'; ?>>Usuário</option>
                                <option value="Administrador" style="color:#ccc;" <?php if ($usuario['tipo_usuario'] == 'Administrador') echo 'selected'; ?>>Administrador</option>
                            </select>
                            <button type="submit" name="editar" class="btn">Editar</button>
                        </form>
                        <form method="POST" style="display: inline-block;">
                            <input type="hidden" name="excluir" value="<?php echo $usuario['id_usuario']; ?>">
                            <button type="submit" class="btn-excluir">Excluir</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
