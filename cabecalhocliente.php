<?php
include("conectadb.php");
if(session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
isset($_SESSION['nomeusuario'])?$nomeusuario = $_SESSION['nomeusuario']: "";
$nomeusuario = $_SESSION['nomeusuario'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🥟 Menu </title>
<body>
<div>
    <ul class="menu">
        <li><a>HOME</a></li>
        <li><a href="encomendas.php">ENCOMENDAS</a></li>
        <li><a href="produtos.php">PRODUTOS</a></li>
        <li><a href="logincliente.php">SAIR</a></li>
        <link rel="stylesheet" href="estilao1.css">
        <?php
        if($nomeusuario != null){
        ?>
          <li class="profile">OLÁ <?= strtoupper($nomeusuario) ?></li>
        <?php
        } else {
            echo"<script>window.alert('USUARIO NÃO IDENTIFICADO');
            window.location.href='logincliente.php';</script>";
        }  
        ?>    
    </ul>
</div>

        <script src="script.js"></script>
    </body>
    </html>