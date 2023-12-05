<?php 
include("conectadb.php");
session_start();
isset($_SESSION['nomeusuario'])?$nomeusuario = $_SESSION['nomeusuario']: "";
$nomeusuario = $_SESSION['nomeusuario'];
?>

<div>
    <ul class="menu">
        <li><a href="cadastrausuario.php">CADASTRAR USUARIO</a></li>
        <li><a href="listausuario.php">LISTAR USUARIO</a></li>
        <li><a href="cadastraproduto.php">CADASTRAR PRODUTO</a></li>
        <li><a href="listaproduto.php">LISTAR PRODUTO</a></li>
        <li><a href="login-cliente.php">LOGIN CLIENTE</a></li>
        <li><a href="cadastro-cliente.php">CADASTRAR CLIENTE</a></li>
        <li><a href="perfil-usuario.php">PERFIL</a></li>
        <!--<li><a href="listacliente.php">LISTAR CLIENTES</a></li>
         <li><a href="vendas.php">VENDAS</a></li> -->
        <li class="menuloja"><a href="logout.php">SAIR</a></li>

        <?php 
        if($nomeusuario != null) {
        ?>
        <li class="profile">OLÁ <?=strtoupper($nomeusuario) ?></li>
        <?php
        } else {
            echo "<script>window.alert('USUÁRIO NÃO AUTENTICADO')
            window.location.href='login.php';</script>";
        }
        ?>
    </ul>
</div>