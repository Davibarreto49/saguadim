<?php
include("cabecalho.php"); 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $login = $_POST['login'];
    $senha = $_POST['senha'];
    $email = $_POST['email'];
    $status = $_POST['status'];
    
    $sql = "UPDATE usuarios SET usu_login = '$login', usu_senha = '$senha', usu_email = '$email', usu_status = '$status'";
 
    $sql .= " WHERE usu_id = $id";
 
    mysqli_query($link, $sql);
 
    echo "<script>window.alert('usuario alterado com sucesso!');</script>";
    echo "<script>window.location.href='listausuario.php';</script>";
}
 
$id = $_GET['id'];
$sql = "SELECT * FROM usuarios WHERE usu_id = '$id'";
$retorno = mysqli_query($link, $sql);
 
while ($tbl = mysqli_fetch_array($retorno)) {
    $login = $tbl[1];
    $senha = $tbl[2];
    $email = $tbl[5];
    $status = $tbl[3];
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilao.css">
    <title>Alterar Usuário</title>
</head>
<body>
    <div id="altera-usuario">
        <form action="alterausuario.php" method="post">
            <label>Login</label>
            <input type="text" name="login" id="login" value="<?=$login?>" required>
            <label>E-mail</label>
            <input type="text" name="email" id="email" value="<?=$email?>" required>
            <label>Senha</label>
            <input type="password" name="senha" id="senha" value="<?=$senha?>" required>
            <p></p>
            <input type="radio" name="status" value="s" <?= $status == "s" ? "checked" : "" ?>> ATIVO
            <br>
            <input type="radio" name="status" value="n" <?= $status == "n" ? "checked" : "" ?>> INATIVO

            <input type="submit" value="Atualizar">
        </form>
    </div>
</body>
</html>
