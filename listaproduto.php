<?php
session_start();

$nomeusuario = $_SESSION['nomeusuario'];
include("cabecalho.php");

$sql = "SELECT pro_nome, pro_quantidade, pro_custo, pro_preco, pro_id, pro_status FROM produtos WHERE pro_status = 's'";
$retorno = mysqli_query($link,$sql);
$ativo = "s";

if($_SERVER["REQUEST_METHOD"] == 'POST'){
    $ativo = $_POST['ativo'];
    if($ativo == 's'){
        $sql = "SELECT pro_nome, pro_quantidade, pro_custo, pro_preco, pro_id, pro_status FROM produtos WHERE pro_status = 's'";
        $retorno= mysqli_query($link,$sql);
    }
    else if($ativo == "todos"){
        $sql = "SELECT pro_nome, pro_quantidade, pro_custo, pro_preco, pro_id, pro_status FROM produtos";
        $retorno= mysqli_query($link,$sql);
    }
    else{
        $sql = "SELECT pro_nome, pro_quantidade, pro_custo, pro_preco, pro_id, pro_status FROM produtos WHERE pro_status = 'n'";
        $retorno= mysqli_query($link,$sql);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilao.css">
    <title>LISTA PRODUTOS</title>
</head>
<body>
    <div class="container">
        <form action="listaproduto.php" method="">
        <input type="radio" name="ativo" value="s"
            <?= $ativo == "s" ? "checked" : "" ?>>ATIVO
            <br>
            <input type="radio" name="ativo" value="n"
            <?= $ativo == "n" ? "checked" : "" ?>>INATIVOS
            <br>
            <input type="radio" name="ativo" value="todos"
            <?= $ativo == "n" ? "checked" : "" ?>>TODOS
        </form>
        <table border="2">
            <tr>
                <th>NOME</th>
                <th>QUANTIDADE</th>
                <th>CUSTO</th>
                <th>PRECO</th>
                <th>ALTERAR</th>
                <th>STATUS</th>
            </tr>
             <!--trazendo dados da tabela-->
        <?php
            while($tbl = mysqli_fetch_array($retorno)){
        ?>
        <tr>
        <td><?=$tbl[0]?></td> <!-- coleta nome da query -->
        <td><?=$tbl[1]?></td> 
        <td><?=number_format($tbl[2], 2, ', ','.' )?></td>
        <td><?=number_format($tbl[3], 2, ', ','.' )?></td>
        <td><a href="alteraproduto.php?id=<?$tbl[4] ?><input type="button" value="ALTERAR"/td>
        <td><?= $check = ($tbl[5] == 's')? "SIM":"NÃO"?></td>
        </tr>
        <?php
            }
        ?>
        </table>
        
    </div>
</body>
</html>