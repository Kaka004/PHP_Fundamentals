<?php

include("conectadb.php");

$sucesso = $_GET['sucesso'];
$email = $_GET['email'];

if($_SERVER["REQUEST_METHOD"] == 'POST'){
    $senha = $_POST['senha'];
    $senha2 = $_POST['senha2'];

    if($senha == $senha2){
        # O tempero é uma concatenação de um número inteiro aleatório (pode ser grande ou pequeno) 
        # com a data atual no formato "HH:MM:SS" (hora, minuto, segundo). Exemplo: 47982314:42:27.
        
        # Depois, é criado um md5 a partir dessa string gerada.
        $tempero = md5(rand() . date('H:i:s'));

        # A senha é outra hash md5 criada a partir da senha criada pelo usuário  
        # concatenada com o tempero (hash md5 gerada com número aleatório + HH:MM:SS)
        # ou seja: $senha . $tempero
        $senha = md5($senha . $tempero);
        
        # É atualizada a senha e o tempero
        $sql = "UPDATE clientes SET cli_senha = '$senha', cli_tempero = '$tempero' WHERE cli_email = '$email'";
        mysqli_query($link, $sql);

        echo "<script> window.alert('Sucesso!'); </script>";
        echo "<script> window.location.href='redefinesenha.php?email=$email&sucesso=true'; </script>";

        $sucesso = true;
    }
    else{
        echo "<script> window.alert('Senhas diferentes.'); </script>";
        echo "<script> window.location.href='redefinesenha.php?email=$email&sucesso=false'; </script>";
    }
}


?>


<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width-device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./css/Visão Adm.css">
        <title>Redefinir Senha</title>
    </head>
    <body>
            <?php
            if($sucesso == "true"){
            ?>
            <form>
                <h1>Senha Redefinida!</h1><br><br>
                <a href="Login Cliente.php" style="text-decoration: none;">Voltar para Login</a>
            </form>
            <?php
            } else{
            ?>
            <form action="Redefinir Senha.php?email=<?=$email?>&sucesso=<?=$sucesso?>" method="POST">
                <h1>Redefinir Senha</h1>
                <input type="password" name="senha" id="senha" placeholder="Digite a Senha" required>
                <p></p>
                <input type="password" name="senha2" id="senha2" placeholder="Confirme a Senha" required>
                <span id="MostraSenha2" onclick="MostraSenha()" style="cursor:pointer;">👁️</span>
                <p></p>
                <input type="submit" name="login" value="Enviar">
                <p></p>
                <a href="Login Cliente.php" style="text-decoration: none;">Voltar para Login</a>
            </form>
            <?php
            }
            ?>
    </body>
</html>

<script>
    function MostraSenha(){
        var passwordInput = document.getElementById("senha");
        var passwordInput2 = document.getElementById("senha2");
        var passwordIcon = document.getElementById("MostraSenha");

        if(passwordInput.type == "password"){
            passwordInput.type = "text";
            passwordInput2.type = "text";
            passwordIcon.textContent = "🙈";
        }
        else{
            passwordInput.type = "password";
            passwordInput2.type = "password";
            passwordIcon.textContent = "👁️";
        }
    }
</script>