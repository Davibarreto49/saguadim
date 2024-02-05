<?php
include("cabecalho.php");
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $id = $_POST["id"];
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];
    $cpf = $_POST["cpf"];
    $curso = $_POST["curso"]; 
    $sala = $_POST["sala"];
    $saldo = $_POST["saldo"];
    $status = $_POST["status"];

    $sql = "UPDATE clientes SET 
    nome='$nome', 
    email='$email', 
    telefone='$telefone', 
    cpf='$cpf', 
    curso='$curso', 
    sala='$sala',
    saldo='$saldo',
    status='$status' 
    WHERE id=$id";

    if($conn->query($sql) === TRUE) {
        echo "Registro alterado com sucesso!";
    } else {
        echo "Erro ao alterar o registro: " . $conn->error;
    }

    $current_status = $status; // Corrigido de "s" para "$status"
}
?>

<!DOCTYPE html>
<html lang="pt-br"> <!-- Alterado de "en" para "pt-br" para Português do Brasil -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilao.css">
    <title>ALTERA CLIENTE</title>
</head>
<body>
<form method="post"> <!-- Adicionado o método "post" ao formulário -->
    <label>NOME</label>
    <input type="text" name="nome" required>
    <br>
    <label>E-MAIL</label>
    <input type="text" name="email" required>
    <br>
    <label>TELEFONE</label>
    <input type="text" name="telefone" required>
    <br>
    <label>CPF</label>
    <input type="text" name="cpf" required>
    <br>
    <label>CURSO</label>
    <input type="text" name="curso" required>
    <br>
    <label>SALA</label>
    <input type="text" name="sala" required>
    <br>
    <label>SALDO</label>
    <input type="text" name="saldo" required>
    <br>
    <input type="radio" name="status" value="s"<?= $current_status == "s" ? "checked" : "" ?>>ATIVO
    <br>
    <input type="radio" name="status" value="n" <?= $current_status == "n" ? "checked" : "" ?>>INATIVO <!-- Corrigido de $_current_status para $current_status -->
    <p></p>
    <input type="submit" value="Alterar">
</form>
</body>
</html>
