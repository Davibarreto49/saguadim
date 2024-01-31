<?php
include("cabecalho.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_POST['user_id'];
    $new_login = $_POST['new_login'];
    $new_email = $_POST['new_email'];
    $new_password = $_POST['new_password'];
    $new_status = $_POST['new_status']; 


    echo "<script>window.alert('Usuário alterado com sucesso');</script>";
    echo "<script>window.location.href='listausuario.php'</script>";
}


$user_id = $_GET['id']; 
$current_login = "usuario_atual"; 
$current_email = "email_atual"; 
$current_status = "s"; 
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
            <input type="hidden" name="user_id" value="<?= $user_id ?>">
            <label for="new_login">Novo Login:</label>
            <input type="text" name="new_login" id="new_login" value="<?= $current_login ?>" required>
            <label for="new_email">Novo E-mail:</label>
            <input type="text" name="new_email" id="new_email" value="<?= $current_email ?>" required>
            <label for="new_password">Nova Senha:</label>
            <input type="password" name="new_password" id="new_password" placeholder="Nova senha" required>
            <p></p>
            <input type="radio" name="new_status" value="s"<?= $current_status == "s" ? "checked" : "" ?>>ATIVO
            <br>
            <input type="radio" name="new_status" value="n" <?= $current_status == "n" ? "checked" : "" ?>>INATIVO

            <input type="submit" value="Atualizar">
        </form>
    </div>
</body>
</html>
