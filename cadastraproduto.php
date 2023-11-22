<?php
include("cabecalho.php");
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $custo = $_POST['custo'];
    $preco = $_POST['preco'];
    $quantidade = $_POST['quantidade'];
    $validade = $_POST['validade'];
    $fornecedor_id = $_POST['fornecedor'];

    $sql = "SELECT COUNT(pro_id) FROM produtos WHERE pro_nome = '$nome'";
    $retorno = mysqli_query($link,$sql);
    $cont = (mysqli_fetch_array($retorno));
    if($cont == 0){
        $sql = "INSERT INTO produtos(pro_nome,pro_descricao,pro_custo,pro_preco,pro_quantidade,pro_validade,pro_status,fk_pro_id)
        VALUES('$nome','$descricao','$custo','$preco','$quantidade','$validade', 's', '$fornecedor_id')";
        mysqli_query($link,$sql);
        echo"<script>window.alert('PRODUTO CADASTRADO COM SUCESSO');</script>";
        echo"<script>window.location.href='listaproduto.php';</script>";
    } 
    else{
        echo"<script>window.alert('PRODUTO JÁ EXISTENTE');</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilao.css">
    <title>CADASTRA PRODUTO</title>
</head>
<body>
    <div id="container">
        <form action="cadastraproduto.php" method="post">
            <label>NOME PRODUTO</label>
            <input type="text" name="nome" id="nome">
            <br>
            <label>DESCRIÇÃO</label>
            <input type="text" name="descricao" id="descricao">
            <br>
            <label>CUSTO</label>
            <input type="number" step="0.01" name="custo" id="custo">
            <br>
            <label>PREÇO</label>
            <input type="decimal" name="preco" id="preco">
            <br>
            <label>QUANTIDADE</label>
            <input type="number" name="quantidade" id="quantidade">
            <br>
            <label>VALIDADE</label>
            <input type="date" name="validade" id="validade">
            <br>
            <label>FORNECEDOR</label>
            <select name="fornecedor" id="fornecedor" required>
                <?php
                    $sql = "SELECT for_id, for_nome FROM fornecedores";
                    $retorno = mysqli_query($link,$sql);

                    while($tbl = mysqli_fetch_array($retorno)){
                ?>
                <option value="<?=$tbl[0]?>"><?=$tbl[1]?></option>
                <?php
                    }
                ?>
            </select><br>
            
            <input type="submit" name="cadastrar" value="CADASTRAR">
        </form>
    </div>
</body>
</html>