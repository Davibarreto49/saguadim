<?php
include("cabecalho.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = mysqli_real_escape_string($link, $_POST['nome']);
    
    $sql_check_existing = "SELECT COUNT(for_id) FROM fornecedores WHERE for_nome = '$nome'";
    $result_check_existing = mysqli_query($link, $sql_check_existing);
    
    # SUGESTÃO ARIEL SANITIZAÇÃO
    $count_existing = mysqli_fetch_array($result_check_existing)[0];

    if ($count_existing == 0) {
        $sql_insert_fornecedor = "INSERT INTO fornecedores (for_nome) VALUES('$nome')";
        mysqli_query($link, $sql_insert_fornecedor);

        echo "<script>window.alert('FORNECEDOR CADASTRADO COM SUCESSO');</script>";
        echo "<script>window.location.href='backoffice.php';</script>";
    } else {
        echo "<script>window.alert('FORNECEDOR JÁ CADASTRADO');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilao.css">
    <title>FORNECEDORES</title>
</head>
<body>
    <div id="container">
        <form action="fornecedor.php" method="post">
            <label for="nome">NOME FORNECEDOR</label>
            <input type="text" name="nome" id="nome" placeholder="Digite o nome do fornecedor" required>
            <button type="submit">CADASTRAR</button>
        </form>
    </div>
</body>
</html>
