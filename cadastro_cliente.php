<?php
include("cabecalho.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = mysqli_real_escape_string($link, $_POST['nome']);
    $email = mysqli_real_escape_string($link, $_POST['email']);
    $telefone = mysqli_real_escape_string($link, $_POST['telefone']);
    $cpf = mysqli_real_escape_string($link, $_POST['cpf']);
    $curso = mysqli_real_escape_string($link, $_POST['curso']);
    $sala = mysqli_real_escape_string($link, $_POST['sala']);

    $sql_check_existing = "SELECT COUNT(cli_id) FROM clientes WHERE cli_email = '$email'";
    $result_check_existing = mysqli_query($link, $sql_check_existing);
    $count_existing = mysqli_fetch_array($result_check_existing)[0];

    if ($count_existing >= 1) {
        // Verifica se o e-mail já está cadastrado
        echo "<script>window.alert('EMAIL JÁ EXISTENTE');</script>";
        echo "<script>window.location.href='logincliente.html';</script>";
    } else {
        $sql_insert_client = "INSERT INTO clientes (cli_nome, cli_email, cli_telefone, cli_cpf, cli_curso, cli_sala) 
            VALUES ('$nome', '$email', '$telefone', '$cpf', '$curso', '$sala')";
            echo $sql_insert_client;
        mysqli_query($link, $sql_insert_client);

        // Após o cadastro, exibe uma mensagem e redireciona para a página de confirmação
        echo "<script>window.alert('CLIENTE CADASTRADO COM SUCESSO');</script>";
        echo "<script>window.location.href='logincliente.html';</script>";
       
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilao2.css">
    <title>CADASTRO DE CLIENTE</title>
</head>
<body>
    <div id="cadastra">
        <form action="cadastro_cliente.php" method="post">
            <label>NOME</label>
            <input type="text" name="nome" id="nome" required/>
            <label>EMAIL</label>
            <input type="text" name="email" id="email" placeholder="email@exemplo.com" required/>
            <label>TELEFONE</label>
            <input type="text" name="telefone" id="telefone" required/>
            <label>CPF</label>
            <input type="text" name="cpf" id="cpf" required/>
            <label>CURSO</label>
            <input type="text" name="curso" id="curso" required/>
            <label>SALA</label>
            <input type="text" name="sala" id="sala" required/>
            <input type="submit" value="CADASTRAR"/>
        </form>
    </div>
</body>
</html>
