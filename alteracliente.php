<?php
// Inclui o arquivo "cabecalho.php" que contém configurações iniciais da página
include("cabecalho.php");

// Função para escapar e validar os dados de entrada do usuário
function cleanInput($data) {
    global $link; // Conexão com o banco de dados
    $data = mysqli_real_escape_string($link, $data); // Escapa caracteres especiais para prevenir injeção de SQL
    $data = htmlspecialchars($data); // Converte caracteres especiais em entidades HTML para prevenir XSS
    return $data;
}

// Verifica se a requisição HTTP é POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Limpa e valida os dados recebidos do formulário
    $id = cleanInput($_POST['id']);
    $nome = cleanInput($_POST['nome']);
    $email = cleanInput($_POST['email']);
    $telefone = cleanInput($_POST['telefone']);
    $cpf = cleanInput($_POST['cpf']);
    $curso = cleanInput($_POST['curso']);
    $sala = cleanInput($_POST['sala']);
    $saldo = cleanInput($_POST['saldo']);
    $status = cleanInput($_POST['status']);

    // Constrói a consulta SQL para atualizar os dados do cliente no banco de dados
    $sql = "UPDATE clientes SET cli_nome = '$nome', cli_email = '$email', cli_telefone = '$telefone', cli_cpf = '$cpf', cli_curso = '$curso', cli_sala = '$sala', cli_saldo = '$saldo', cli_status = '$status' WHERE cli_id = '$id'";

    // Executa a consulta SQL
    if (mysqli_query($link, $sql)) {
        // Exibe uma mensagem de sucesso e redireciona para a lista de clientes
        echo "<script>alert('CLIENTE ALTERADO COM SUCESSO');</script>";
        echo "<script>window.location.href='listacliente.php';</script>";
        exit();
    } else {
        // Exibe uma mensagem de erro em caso de falha na consulta SQL
        echo "Erro ao executar a consulta: " . mysqli_error($link);
    }
}

// Verifica se foi passado um parâmetro 'id' na URL
$id = isset($_GET['id']) ? $_GET['id'] : null;

// Constrói a consulta SQL para selecionar os dados do cliente com base no ID fornecido
$sql = "SELECT * FROM clientes WHERE cli_id = '$id'";
$result = mysqli_query($link, $sql);

if ($result) {
    // Recupera os dados do cliente do resultado da consulta
    $row = mysqli_fetch_assoc($result);
    
    // Atribui os dados recuperados às variáveis correspondentes
    $nome = $row['cli_nome'];
    $email = $row['cli_email'];
    $telefone = $row['cli_telefone'];
    $cpf = $row['cli_cpf'];
    $curso = $row['cli_curso'];
    $sala = $row['cli_sala'];
    $saldo = $row['cli_saldo'];
    $status = $row['cli_status'];
} else {
    // Exibe uma mensagem de erro em caso de falha na consulta SQL
    echo "Erro ao executar a consulta: " . mysqli_error($link);
    // Redireciona para uma página de erro apropriada
    header("Location: error_page.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo1.css"> <!-- Inclui o arquivo CSS -->
    <title>ALTERA CLIENTE</title>
</head>
<body>
    <div>
        <!-- Formulário para atualização dos dados do cliente -->
        <form action="alteracliente.php" method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>"> <!-- Campo oculto para enviar o ID do cliente -->
            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome" value="<?php echo $nome; ?>"> <!-- Campo para o nome do cliente -->
            <label for="email">E-mail</label>
            <input type="email" name="email" id="email" value="<?php echo $email; ?>"> <!-- Campo para o email do cliente -->
            <label for="telefone">Telefone</label>
            <input type="tel" name="telefone" id="telefone" value="<?php echo $telefone; ?>"> <!-- Campo para o telefone do cliente -->
            <label for="cpf">CPF</label>
            <input type="text" name="cpf" id="cpf" value="<?php echo $cpf; ?>"> <!-- Campo para o CPF do cliente -->
            <label for="curso">Curso</label>
            <input type="text" name="curso" id="curso" value="<?php echo $curso; ?>"> <!-- Campo para o curso do cliente -->
            <label for="sala">Sala</label>
            <input type="text" name="sala" id="sala" value="<?php echo $sala; ?>"> <!-- Campo para a sala do cliente -->
            <label for="saldo">Saldo</label>
            <input type="number" step="0.01" name="saldo" id="saldo" value="<?php echo $saldo; ?>"> <!-- Campo para o saldo do cliente -->
            <label for="status">Status</label>
            <input type="text" name="status" id="status" value="<?php echo $status; ?>"> <!-- Campo para o status do cliente -->
            <input type="submit" name="atualizar" id="atualizar" value="Atualizar"> <!-- Botão para atualizar os dados -->
        </form>
    </div>
</body>
</html>
