<?php
    include("cabecalho.php");
 
    $sql = "SELECT * FROM clientes WHERE cli_status = 'ativo'";
    $retorno = mysqli_query($link, $sql);
    $ativo = "ativo";
 
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $ativo = $_POST['ativo'];
 
        if ($ativo == 'ativo') {
            $sql = "SELECT * FROM clientes WHERE cli_status = 'ativo'";
            $retorno = mysqli_query($link, $sql);
        } elseif ($ativo == 'inativo') {
            $sql = "SELECT * FROM clientes WHERE cli_status = 'inativo'";
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
    <link rel="stylesheet" href="estilao.css">
    <title>LISTA CLIENTES</title>
</head>
<body>
    <main class="listacliente-container">
        <div class="table">
            <section class="table-header">
                <div class="form-container">
                    <form action="listacliente.php" method="post">
                        <input type="radio" name="ativo" class="radio" value="ativo" id="radioativo"
                        required onclick="submit()" <?= $ativo == 'ativo' ? "checked" : "" ?>>
                        <label class="radio-label" for="radioativo">Ativos</label>
                        <input type="radio" name="ativo" class="radio" value="inativo" id="radioinativo"
                        required onclick="submit()" <?= $ativo == 'inativo' ? "checked" : "" ?>>
                        <label class="radio-label" for="radioinativo">Inativos</label>
                        <input type="radio" name="ativo" class="radio" value="todos" id="radiotodos"
                        required onclick="submit()" <?= $ativo == 'todos' ? "checked" : "" ?>>
                        <label class="radio-label" for="radiotodos">Todos</label>
                    </form>
                </div>
            </section>
            <section class="table-body">
                <table>
                    <thead>
                        <tr>
                            <th class="id-column">ID</th>
                            <th class="nome-column">Nome</th>
                            <th class="email-column">E-mail</th>
                            <th class="status-column">Status</th>
                            <th class="alter-column">Alterar Dados</th>
                        </tr>
                    </thead>
                    <?php
                        while ($tbl = mysqli_fetch_array($retorno)) {
                    ?>
                    <tbody>
                        <tr>
                            <td><?= $tbl[0] ?></td>
                            <td><?= $tbl[1] ?></td>
                            <td><?= $tbl[4] ?></td>
                            <td>
                                <p class="status <?= $check = ($tbl[3] == "ativo") ? "ativo" : "inativo" ?>">
                                    <?= $check = ($tbl[3] == "ativo") ? "Ativo" : "Inativo" ?>
                                </p>
                            </td>
                            <td><a href="alteracliente.php?id=<?= $tbl[0] ?>"><button class="btn-alterar"><p class="text">Alterar</p></button></a></td>
                        </tr>
                    </tbody>
                    <?php
                        }
                    ?>
                </table>
            </section>
        </div>
    </main>
</body>
</html>