<?php
    
    include("cabecalho.php");
 
   
    $sql = "SELECT * FROM clientes WHERE cli_status = 's'";
    $retorno = mysqli_query($link, $sql);
    $contador = 0; 
 
   
    $ativo = "s";
 
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $ativo = $_POST['ativo'];
 
        
        if ($ativo == 's') {
            $sql = "SELECT * FROM clientes WHERE cli_status = 's'";
            $retorno = mysqli_query($link, $sql);
        } elseif ($ativo == 'n') {
            $sql = "SELECT * FROM clientes WHERE cli_status = 'n'";
            $retorno = mysqli_query($link, $sql);
        } else {
            $sql = "SELECT * FROM clientes";
            $retorno = mysqli_query($link, $sql);
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilao2.css">
    <title>LISTA CLIENTES</title>
</head>
<body>
    <main>
        <div class="table">
            <section class="table-header">
            <div class="form-container">
    <form action="listacliente.php" method="post">
        <input type="radio" name="status" class="radio" value="s" id="radioativo"
        required <?= $ativo == 's' ? "checked" : "" ?>>
        <label class="radio-label" for="radioativo">Ativos</label>
        <input type="radio" name="status" class="radio" value="n" id="radioinativo"
        required <?= $ativo == 'n' ? "checked" : "" ?>>
        <label class="radio-label" for="radioinativo">Inativos</label>
        <input type="radio" name="status" class="radio" value="todos" id="radiotodos"
        required <?= $ativo == 'todos' ? "checked" : "" ?>>
        <label class="radio-label" for="radiotodos">Todos</label>
        
    </form>
</div>
    </section>
            <section class="table-body">
                <table border="2">
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>E-mail</th>
                            <th>Status</th>
                            <th>Alterar Dados</th>
                        </tr>
                    <?php
                    while ($tbl = mysqli_fetch_array($retorno)) {
                    ?>
                        <tr>
                            <td><?= $tbl[0] ?></td>
                            <td><?= $tbl[1] ?></td>
                            <td><?= $tbl[2] ?></td> 
                            <td>
                                <p class="status <?= $check = ($tbl[3] == "ativo") ? "ativo" : "inativo" ?>">
                                    <?= $check = ($tbl[3] == "ativo") ? "Ativo" : "Inativo" ?>
                                </p>
                            </td>
                            <td><a href="alteracliente.php?id=<?= $tbl[0] ?>"><button class="btn-alterar"><p class="text">Alterar</p></button></a></td>
                        </tr>
                    <?php
                            
                        }
                    ?>
                </table>
            </section>
        </div>
    </main>
</body>
</html>
