<?php
    // ABRE UMA CONEXÃO COM O BANCO DE DADOS
    include("cabecalho.php");

    // PASSANDO UMA INSTRUÇÃO AO BANCO DE DADOS
    $sql = "SELECT * FROM usuarios WHERE usu_status = 's'";
    $retorno = mysqli_query($link, $sql);
    $contador = 0; // INICIALIZA UM CONTADOR PARA ACOMPANHAR AS LINHAS

    // FORÇA SEMPRE TRAZER 'S' NA VARIÁVEL PARA UTILIZARMOS NOS RADIO BUTTON
    $ativo = "s";

    // COLETA O BOTÃO MÉTODO POST VINDO DO HTML
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $ativo = $_POST['ativo'];

        // VERIFICA SE O USUARIO ESTÁ ATIVO PARA LISTA, SE 'S' LISTA SENÃO, NÃO LISTA
        if ($ativo == 's') {
            $sql = "SELECT * FROM usuarios WHERE usu_status = 's'";
            $retorno = mysqli_query($link, $sql);
        } elseif ($ativo == 'n') {
            $sql = "SELECT * FROM usuarios WHERE usu_status = 'n'";
            $retorno = mysqli_query($link, $sql);
        } else {
            $sql = "SELECT * FROM usuarios";
            $retorno = mysqli_query($link, $sql);
        }
    }
?>

<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE-edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="estilao2.css">
        <title>LISTA USUARIOS</title>
    </head>
    <body>
        <main class="listausuario-container">
            <div class="table">
                <section class="table-header">
                    <div class="form-container">
                        <form action="listausuario.php" method="post">
                            <input type="radio" name="ativo" class="radio" value="s" id="radioativo" required onclick="submit()" <?= $ativo == 's' ? "checked" : "" ?>>
                            <label class="radio-label" for="radioativo">Ativo</label>
                            <input type="radio" name="ativo" class="radio" value="n" id="radioinativo" required onclick="submit()" <?= $ativo == 'n' ? "checked" : "" ?>>
                            <label class="radio-label" for="radioinativo">Inativo</label>
                            <input type="radio" name="ativo" class="radio" value="todos" id="radiotodos" required onclick="submit()" <?= $ativo == 'todos' ? "checked" : "" ?>>
                            <label class="radio-label" for="radiotodos">Todos</label>
                        </form>
                    </div>
                </section>
                <section class="table-body">
                    <table border="2">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>USUARIO</th>
                                <th>E-MAIL</th>
                                <th>STATUS</th>
                                <th>ALTERAR</th>
                            </tr>
                        </thead>
                        <?php
                        while ($tbl = mysqli_fetch_array($retorno)) {
                            $contador++;
                            $classe = ($contador % 2 == 0) ? 'even' : 'odd';
                        ?>
                        <tbody>
                            <tr class="<?= $classe ?>">
                                <td><?=$tbl[0] ?></td>
                                <td><?=$tbl[1] ?></td> 
                                <td><?=$tbl[5] ?></td>
                                <td>
                                    <p class="status <?= $check = ($tbl[3] == "s") ? "ativo" : "inativo" ?>">
                                        <?= $check = ($tbl[3] == "s") ? "Ativo" : "Inativo" ?>
                                    </p>
                                </td>
                                <td>
                                    <a href="alterausuario.php?id=<?=$tbl[0] ?>&login=<?= $tbl[1] ?>&email=<?= $tbl[5] ?>">
                                        <button class="btn-alterar">
                                            <a href="alterausuario.php?id=ID_DO_USUARIO">Alterar</a>
                                        </button>
                                    </a>
                                </td>
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
