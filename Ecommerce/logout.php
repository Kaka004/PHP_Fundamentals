<?php
//inicia a sessão
session_start(); 

//Destrioi a sessão atual
session_destroy(); 

//Redireciona o usuário para a págona de login
header("Location: login.php"); 
exit;
?>