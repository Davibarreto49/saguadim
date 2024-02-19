<?php
include("cabecalho.php"); 

$login = $email = $senha = $status = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($_POST['id'])) {
        $id = $_POST['id'];
        $login = $_POST['login'];
        $senha = $_POST['senha'];
        $email = $_POST['email'];
        $status = $_POST['status'];
        
        $sql = "UPDATE usuarios SET usu_login = '$login', usu_senha = '$senha', usu_email = '$email', usu_status = '$status' ";
        $sql .= "WHERE usu_id = $id"; 
        
        if(mysqli_query($link, $sql)) {
            echo "<script>alert('USUÁRIO ALTERADO COM SUCESSO');</script>";
            echo "<script>window.location.href='listausuario.php';</script>";
            exit();
        } else {
            echo "<script>alert('Erro ao atualizar usuário');</script>";
            exit();
        }
}

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM usuarios WHERE usu_id = '$id'";
    $retorno = mysqli_query($link, $sql);

    if($tbl = mysqli_fetch_array($retorno)) {
        $login = $tbl['usu_login'];
        $senha = $tbl['usu_senha'];
        $email = $tbl['usu_email'];
        $status = $tbl['usu_status'];
    } else {
        echo "<script>alert('ID de usuário inválido');</script>";
        echo "<script>window.location.href='listausuario.php';</script>";
        exit();
    }
} else {
    echo "<script>alert('ID do usuário não fornecido');</script>";
    echo "<script>window.location.href='listausuario.php';</script>";
    exit();
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo1.css">
    <title>Alterar Usuário</title>
</head>
<body>
    <div id="altera-usuario">
        <form action="alterausuario.php" method="post">
            <input type="hidden" name="id" value="<?=$id?>">
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
