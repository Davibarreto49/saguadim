<?php
include('cabecalho.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Captura e valida os dados do formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $cpf = $_POST['cpf'];
    $curso = $_POST['curso'];
    $sala = $_POST['sala'];

    // Validação simples (pode ser aprimorada conforme necessário)
    if (empty($nome) || empty($email) || empty($telefone) || empty($cpf)) {
        echo "<div class='error'>Preencha todos os campos obrigatórios.</div>";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<div class='error'>E-mail inválido.</div>";
    } else {
        // Verifica se o cliente já está cadastrado
        $check_query = "SELECT COUNT(cli_id) AS total FROM clientes WHERE cli_email = ? OR cli_nome = ?";
        $stmt = mysqli_prepare($link, $check_query);
        mysqli_stmt_bind_param($stmt, "ss", $email, $nome);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $total);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);

        if ($total >= 1) {
            echo "<div class='error'>Cliente já cadastrado.</div>";
        } else {
            // Insere o novo cliente no banco de dados
            $insert_query = "INSERT INTO clientes(cli_nome, cli_email, cli_telefone, cpf, cli_curso, cli_sala) VALUES(?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($link, $insert_query);
            mysqli_stmt_bind_param($stmt, "ssssss", $nome, $email, $telefone, $cpf, $curso, $sala);

            if (mysqli_stmt_execute($stmt)) {
                echo "<div class='success'>Cliente cadastrado com sucesso.</div>";
                header("Location: listacliente.php");
                exit();
            } else {
                echo "<div class='error'>Erro ao cadastrar o cliente: " . mysqli_error($link) . "</div>";
            }
            mysqli_stmt_close($stmt);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilao.css">
    <title>Cadastro cliente</title>
</head>
<body>
    <form action="cadastro_cliente.php" method="post"> 
        <label for="nome">Nome</label>
        <input type="text" id="nome" name="nome" required>
        <br>
        <label for="email">E-mail</label>
        <input type="text" id="email" name="email" required>
        <br>
        <label for="telefone">Telefone</label>
        <input type="text" id="telefone" name="telefone" required>
        <br>
        <label for="cpf">CPF</label>
        <input type="text" id="cpf" name="cpf" required>
        <br>
        <label for="curso">Curso</label>
        <input type="text" id="curso" name="curso">
        <br>
        <label for="sala">Sala</label>
        <input type="text" id="sala" name="sala">
        <br>
        <input type="submit" value="Cadastrar">
    </form>
</body>
</html>

