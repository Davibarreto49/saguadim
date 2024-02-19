<?php
include("cabecalho.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = mysqli_real_escape_string($link, $_POST['email']);
    $senha = mysqli_real_escape_string($link, $_POST['senha']);
    $login = mysqli_real_escape_string($link, $_POST['login']);

    $key = rand(100000, 999999);

    $sql_check_existing = "SELECT COUNT(usu_id) FROM usuarios WHERE usu_email = '$email' OR usu_login = '$login'";
    $result_check_existing = mysqli_query($link, $sql_check_existing);
    $count_existing = mysqli_fetch_array($result_check_existing)[0];

    if ($count_existing >= 1) {
        // Verifica se o e-mail ou o login já existem
        echo "<script>window.alert('EMAIL OU LOGIN JÁ EXISTENTE');</script>";
        echo "<script>window.location.href='login.html';</script>";
    } else {
       

        $sql_insert_user = "INSERT INTO usuarios (usu_login, usu_senha, usu_status, usu_key, usu_email) 
            VALUES ('$login', '$senha', 's', '$key', '$email')";
        mysqli_query($link, $sql_insert_user);

        // Após o cadastro, exibe uma mensagem e redireciona para a página de login
        echo "<script>window.alert('USUÁRIO CADASTRADO COM SUCESSO');</script>";
        echo "<script>window.location.href='login.html';</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilao2.css">
    <title>CADASTRA USUARIO</title>
</head>
<body>
    <div id="cadastra">
        <form action="cadastra2.php" method="post">
            <label for="login">LOGIN</label>
            <input type="text" name="login" id="login" required/>
            <label for="email">EMAIL</label>
            <input type="text" name="email" id="email" placeholder="email@email.com" required/>
            <label for="senha">SENHA</label>
            <input type="password" name="senha" id="senha" placeholder="*****" required/>
            <input type="submit" value="CADASTRAR"/>
        </form>
    </div>
</body>
</html>
