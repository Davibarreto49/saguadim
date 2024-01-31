<?php
include('cabecalho.php');
 
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $cpf = $_POST['cpf'];
    $curso = $_POST['curso'];
    $sala = $_POST['sala'];
    
 
    //*INSERIR INSTRUÇÕES NO BANCO  
    $sql = "SELECT COUNT(cli_id) FROM clientes WHERE cli_email = '$email' OR cli_nome = '$nome'";
    $resultado = mysqli_query($link, $sql);
    $resultado = mysqli_fetch_array($resultado) [0];
    //*GRAVA LOG  
    $sql = '"'.$sql.'"';
    $sqllog = "INSERT INTO tab_log (tab_query, tab_data) VALUES ($sql, NOW())";
    mysqli_query($link, $sqllog);
    //*VERIFICA SE EXISTE
    if($resultado >= 1){
        echo"<script>window.alert('CLIENTE JÁ CADASTRADO');</script>";
        echo"<script>window.location.href='cadastracliente.php';</script>";
    }
    else{
        $sql = "INSERT INTO clientes(cli_nome, cli_email, cli_telefone, cli_cpf, cli_curso, cli_sala)
                VALUES('$nome','$email','$telefone','$cpf','$curso','$sala')";
        
 
         //*GRAVA LOG
        $sql ='"'.$sql.'"';
        $sqllog ="INSERT INTO tab_log (tab_query, tab_data) VALUES ($sql, NOW())";
        mysqli_query($link, $sqllog);
 
        echo"<script>window.alert('CLIENTE CADASTRADO');</script>";
        echo"<script>window.location.href='listacliente.php';</script>";
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
        <input type="text" id="cli_nome" name="nome" required>
        <br>
        <label for="cli_email">E-mail</label>
        <input type="text" id="email" name="email" required>
        <br>
        <label for="cli_telefone">Telefone</label>
        <input type="text" id="telefone" name="telefone" required>
        <br>
        <label for="cli_cpf">CPF</label>
        <input type="text" id="cpf" name="cpf" required>
        <br>
        <label for="cli_curso">Curso</label>
        <input type="text" id="curso" name="curso">
        <br>
        <label for="sala">Sala</label>
        <input type="text" id="sala" name="sala">
        <br>
        <input type="submit" value="Cadastrar">
    </form>
</body>
</html>