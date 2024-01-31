<?php
include("cabecalho.php");

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $id = $_POST['id'];
    $nome = trim($_POST['nome']);
    $descricao = trim($_POST['descricao']);
    $quantidade = $_POST['quantidade'];
    $preco = $_POST['custo']; 
    $status = $_POST['status'];
    
    $nome = mysqli_real_escape_string($link, $nome);
    $descricao = mysqli_real_escape_string($link, $descricao);

    $sql = "UPDATE produtos SET pro_nome = '$nome', pro_descricao = '$descricao', pro_quantidade = '$quantidade', pro_preco = '$preco', pro_status = '$status' WHERE pro_id = '$id'";
    
    mysqli_query($link, $sql);
    echo "<script>window.alert('PRODUTO ALTERADO COM SUCESSO');</script>";
    echo "<script>window.location.href='listaproduto.php';</script>";
    exit();
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilao.css">
    <title>ALTERA PRODUTO</title>
</head>
<body>
    <div>
        <form action="alteraproduto.php" method="post" enctype="multipart/form-data">
            <label>Nome</label>
            <input type="text" name="nome" id="nome">
            <p></p>
            <label>Descrição</label>
            <input type="text" name="descricao" id="descricao">
            <p></p>
            <label>Quantidade</label>
            <input type="number" name="quantidade" id="quantidade">
            <p></p>
            <label>Custo</label>
            <input type="number" step="0.01" name="custo" id="custo"> 
            <p></p>
            <input type="submit" name="cadastrar" id="cadastrar">
        </form>
    </div>
</body>
</html>