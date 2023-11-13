<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        include("conectadb.php");
        $email = $_POST['email'];
        $cod = $_POST['cod'];
        $senha = $_POST['senha'];

        if($cod==""){
            header("Location:redefine_senha.php?msg=Código inválido!");
            exit();
        }

        $sql = "SELECT COUNT(cli_id) FROM clientes
        WHERE cli_email='$email' AND cli_recupera = '$cod'";
        $result = mysqli_query($link, $sql);

        while($tbl = mysqli_fetch_array($result)){
            $cont = $tbl[0];
        }
        if($cont == 0){
            $sql = "SELECT clientes SET cli_recupera = '' WHERE cli_email = '$email' ";
            mysqli_query($link, $sql);
            header("Location:redefinesenha.php?msg=Código inválido! Solicite um novo código");
            exit();
        }

        else{
            $random = rand();
            $tempero = md5(rand( ). date('H:i:s'));
            $senha = md5($senha . $tempero);
            $sql = "UPDATE clientes SET cli_senha = '$senha', cli_tempero = '$tempero'
            , cli_recupera = '$random' WHERE cli_email = '$email'";
            mysqli_query($link, $sql);
            header("Location:loja.php?msg=Senha alterada com sucesso!");
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/estiloadm.css">
</head>
<body>
    <main>
        <form action="redefinesenha.php" method="post">
            <h1>Redefinir senha</h1>
            <input type="text" name="email" id="email" placeholder="Email" required>
            <p></p>
            <input type="text" name="cod" id="cod" placeholder="Codigo" required>
            <p></p>
            <input type="password" name="senha" id="senha" placeholder="Senha">
            <p></p>
            <input type="submit" name="login" value="REDEFINIR">
        </form> 
        <p id="msg">
        <?php
                if(isset($_GET['msg'])){
                    echo($_GET['msg']);
                    if($_GET['msg'] == "Usuário ou senha incorretos")
                    {
                        echo ("<br><a href='recuperesenha.php'>Esqueci minha senha</a>");
                    }
                }        
        ?>
        </p>
    </main>
</body>
</html>