<?php
include("conectadb.php");
if(session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
isset($_SESSION['nomeusuario'])?$nomeusuario = $_SESSION['nomeusuario']: "";
$nomeusuario = $_SESSION['nomeusuario'];

?>
<div>
    <ul class="menu">
        <li><a href="cadastra2.php">CADASTRAR USUARIO</a></li>
        <li><a href="listausuario.php">LISTAR USUARIO</a></li>
        <li><a href="cadastraproduto.php">CADASTRAR PRODUTO</a></li>
        <li><a href="listaproduto.php">LISTAR PRODUTO</a></li>
        <li><a href="fornecedor.php">FORNECEDOR</a></li>
        <li><a href="alteracliente.php">ALTERA CLIENTE</a></li>
        <li><a href="cadastro_cliente.php">CADASTRO CLIENTE</a></li>
        <li><a href="listacliente.php">LISTA CLIENTE</a></li>
        <li class="menuloja"><a href="logout.php">SAIR</a></li>
        <link rel="stylesheet" href="estilao.css">
        <?php
        if($nomeusuario != null){
        ?>
          <li class="profile">OLÁ <?= strtoupper($nomeusuario) ?></li>
        <?php
        } else {
            echo"<script>window.alert('USUARIO NÃO IDENTIFICADO');window.location.href='login.php';</script>";
        }  
        ?>    
    </ul>
</div>