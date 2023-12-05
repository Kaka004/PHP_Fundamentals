<?php 
session_start();// INICIA A SESSÃO
session_destroy();// DESTROI A SESSÃO ATUAL
//rEDIRECIONA O USUÁRIO PARA A PÁGINA DE LOGIN
header("Location: login-cliente.php");
exit;
?>