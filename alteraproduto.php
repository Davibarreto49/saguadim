<?php
include("cabecalho.php");

// Assuming $link is defined and a database connection is established

// Function to escape and validate user input
function cleanInput($data) {
    global $link;
    $data = mysqli_real_escape_string($link, $data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Clean and validate input data
    $id = cleanInput($_POST['id']);
    $nome = cleanInput($_POST['nome']);
    $descricao = cleanInput($_POST['descricao']);
    $quantidade = cleanInput($_POST['quantidade']);
    $preco = cleanInput($_POST['preco']);
    $custo = cleanInput($_POST['custo']);
    $status = cleanInput($_POST['status']);

    $sql = "UPDATE produtos SET pro_nome = '$nome', pro_descricao = '$descricao', pro_quantidade = '$quantidade', pro_preco = '$preco', pro_status = '$status' WHERE pro_id = '$id'";

    if (mysqli_query($link, $sql)) {
        echo "<script>alert('PRODUTO ALTERADO COM SUCESSO');</script>";
        echo "<script>window.location.href='listaproduto.php';</script>";
        exit();
    } else {
        echo "Erro ao executar a consulta: " . mysqli_error($link);
    }
}

$id = $_GET['id'];
$sql = "SELECT * FROM produtos WHERE pro_id = '$id'";
$result = mysqli_query($link, $sql);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    
    // Set all variables from the retrieved row
    $nome = $row['pro_nome'];
    $descricao = $row['pro_descricao'];
    $quantidade = $row['pro_quantidade'];
    $preco = $row['pro_preco'];
    $custo = $row['pro_custo'];
    $status = $row['pro_status'];
} else {
    echo "Erro ao executar a consulta: " . mysqli_error($link);
    // Handle the error appropriately, e.g., redirect or show an error message
    header("Location: error_page.php");
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
        <form action="alteraproduto.php" method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome" value="<?php echo $nome; ?>">
            <label for="descricao">Descrição</label>
            <input type="text" name="descricao" id="descricao" value="<?php echo $descricao; ?>">
            <label for="quantidade">Quantidade</label>
            <input type="number" name="quantidade" id="quantidade" value="<?php echo $quantidade; ?>">
            <label for="custo">Custo</label>
            <input type="number" step="0.01" name="custo" id="custo" value="<?php echo $custo; ?>">
            <input type="radio" name="status" value="s" <?php echo ($status == "s") ? "checked" : ""; ?>>ATIVO
            <input type="radio" name="status" value="n" <?php echo ($status == "n") ? "checked" : ""; ?>>INATIVO
            <input type="submit" name="atualizar" id="atualizar" value="Atualizar">
        </form>
    </div>
</body>
</html>
