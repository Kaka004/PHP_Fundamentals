<?php
session_start();//INICIA A SESSÃO

include("cabecalho2.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    #busca o tempero
    $sql = "SELECT cli_tempero FROM clientes WHERE cli_email = '$email'";
    $retorno = mysqli_query($link, $sql);
    while ($tbl = mysqli_fetch_array($retorno)) {
        $tempero = $tbl[0];
    }

    $senha = md5($senha . $tempero);

    $sql = "SELECT COUNT(cli_id) FROM clientes WHERE cli_email = '$email' 
    AND cli_senha = '$senha'";
    $retorno = mysqli_query($link, $sql);
    while ($tbl = mysqli_fetch_array($retorno)) {
        $cont = $tbl[0];
    }

    if ($cont == 1) {
        $sql = "SELECT * FROM clientes WHERE cli_email = '$email' AND 
        cli_senha = '$senha' AND cli_ativo = 's'";
        $retorno = mysqli_query($link, $sql);
        while ($tbl = mysqli_fetch_array($retorno)) {
            $_SESSION['idcliente'] = $tbl[0];
            $_SESSION['emailcliente'] = $tbl[10];
        }
        #echo $_SESSION['nomeusuario'];
        echo "<script>window.location.href='listaclientes.php';</script>";
    } else {
        echo "<script>window.alert('E-MAIL OU SENHA INCORRETOS');</script>";
        echo "<script>window.location.href='cadastro-cliente.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/estiloadm.css">
    <title>LOGIN DO CLIENTE</title>
</head>

<body>


    <form action="login.php" method="POST">
        <h1>LOGIN DO CLIENTE</h1>
        <input type="text" name="email" id="email" placeholder="E-mail">
        <p></p>
        <input type="password" id="senha" name="senha" placeholder="Senha">
        <p></p>
        <input type="submit" name="login" value="LOGIN">
    </form>

</body>

</html>