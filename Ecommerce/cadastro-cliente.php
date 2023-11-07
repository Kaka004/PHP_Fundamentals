<?php
//*INICIA A CONEXÃO COM O BANCO DE DADOS
include("conectadb.php");
//*COLETA DE VARIÁVEIS VIA FORMULÁRIO DE HTML
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $senha = $_POST['senha'];
    $cpf = $_POST['cpf'];
    $datanascimento = $_POST['datanascimento'];
    $telefone = $_POST['telefone'];
    $logradouro = $_POST['logradouro'];
    $numero = $_POST['numero'];
    $cidade = $_POST['cidade'];
    $email = $_POST['email'];
    //*PASSANDO INSTRUÇÕES SQL PARA O BANCO

    if (preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^a-zA-Z\d])/', $senha)) {
        #(?=.*[a-z]): Pelo menos 1 letra minúscula.
        #(?=.*[A-Z]): Pelo menos 1 letra maiúscula.
        #(?=.*\d): Pelo menos 1 numeral.
        #(?=.*[^a-zA-Z\d]): Pelo menos 1 caractere especial 
    //*VALIDANDO SE USUARIO EXISSTE
    $sql = "SELECT COUNT(cli_id) FROM clientes WHERE cli_email = '$email' ";
    #echo $sql;
    $retorno = mysqli_query($link, $sql);
    while($tbl = mysqli_fetch_array($retorno)){
        $cont = $tbl[0];
    }
    //*VERIFICAÇÃO SE USUARIO EXISTE, SE EXISTE = 1 SENÃO = 0
    if($cont == 1) {
        echo "<script>window.alert('CLIENTE JÁ CADASTRADO!');</script>";
    }
    else{

        $tempero =md5(rand() . date('H:i:s'));
        $senha =md5($senha . $tempero);

        $sql = "INSERT INTO clientes (cli_nome, cli_senha, cli_cpf cli_ativo, cli_tempero)
        VALUES('$nome','$senha','n','$tempero')";


        $sql = "INSERT INTO clientes (cli_cpf, `cli_nome`, `cli_senha`, `cli_datanasc`, `cli_telefone`, `cli_logadouro`, `cli_numero`, `cli_ativo`, `cli_tempero`, `cli_email`) 
        VALUES ($cpf,'$nome','$senha','$datanascimento','$telefone','$logradouro','$numero','s','$tempero','$email')";

        echo($sql);
        mysqli_query($link, $sql);
        //echo "<script>window.alert('USUÁRIO CADASTRADO!');</script>";
        echo "<script>window.location.href='cadastrausuario.php';</script>";
    }
}else{echo "<script>window.alert('SENHA INVALIDA!');</script>";
    echo "<script>window.alert('Coloque letras maiúsculas e minúsculas, números e caracteres diferentes!');</script>";
}
}
?>
<html>
<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE-edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./css/estiloadm.css">
        <title>CADASTRO CLIENTE</title>
    </head>
    <body>
        <div>
            <form action="cadastro-cliente.php" method="post">
            <h1>CADASTRO CLIENTE</h1>
            <label>Nome</label>
                <input type="text" name="nome" id="nome" >
                <p></p>
                <label>Senha</label>
                <input type="password" name="senha" id="senha">
                <span id="MostrarSenha" onclick="MostrarSenha()">🙉</span>
                <p></p>
                <label>Data de Nascimento</label>
                <input type="date" name="datanasc" id="nascimento" required>
                <label>CPF</label>
                <input type="number" name="cpf" id="cpf" pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" placeholder="000.000.000-00">
                <label>Telefone</label>
                <input type="text" name="telefone" id="telefone" placeholder="(16) 12345-6789">
                <label>Logadouro</label>
                <input type="text" name="logadouro" id="logadouro" placeholder="Rua Américo Brasiliense">
                <label>Número</label>
                <input type="text" name="numero" id="numero" placeholder="123">
                <label>Cidade</label>
                <input type="text" name="cidade" id="cidade" placeholder="Brasília">
                <label>Email</label>
                <input type="text" name="email" id="email" placeholder="nome@gmail.com" required>
                <input type="submit" name="cadastrar" id="cadastrar" placeholder="Cadastrar">
            </form>
        </div>
    </body>
</html>

<script>

    function MostrarSenha(){
        var passwordInput = document.getElementById("senha")
        var PasswordIcon = document.getElementById("MostrarSenha")
        if(passwordInput.type === "password"){
            passwordInput.type = "text";
            PasswordIcon.textContent = "🙈";
        } else {
            passwordInput.type = "password";
            PasswordIcon.textContent = "🙉";
        }
    }
</script>