<?php
session_start();
include("conectadb.php");

if($_SERVER['REQUEST_METHOD']=='POST'){
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT COUNT(cli_id) FROM clientes WHERE cli_email = '$email' AND cli_senha = '$senha'";
    $retorno = mysqli_query($link, $sql);

    $retorno = mysqli_fetch_array($retorno)[0];

    $sql = '"'.$sql.'"';
    $sqllog = "INSERT INTO tab_log (tab_query, tab_data) VALUES ($sql, NOW())";
    mysqli_query($link, $sqllog);

    if ($retorno == 0){
        echo "<script>window.alert('USUÁRIO OU SENHA INCORRETOS');</script>";
        echo "<script>window.location.href='logincliente.html';</script>";
    } else {
        $sql = "SELECT * FROM clientes WHERE cli_email = '$email' AND cli_senha = '$senha'";
        $retorno = mysqli_query($link, $sql);

        $sql = '"'.$sql.'"';
        $sqllog = "INSERT INTO tab_log (tab_query, tab_data) VALUES ($sql, NOW())";
        mysqli_query($link, $sqllog);

        while($tbl = mysqli_fetch_array($retorno)){
            $_SESSION['idcliente'] = $tbl[0];
            $_SESSION['nomecliente'] = $tbl[1];
        }
        echo "<script>window.location.href='backofficecliente.php';</script>";
    }
}
?>

