<?php
//*INICIA A CONEXÃO COM O BANCO DE DADOS
include("cabecalho.php");
//*COLETA DE VARIÁVEIS VIA FORMULÁRIO DE HTML
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $senha = $_POST['senha'];
    //*PASSANDO INSTRUÇÕES SQL PARA O BANCO

    if (preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^a-zA-Z\d])/', $senha)) {
        #(?=.*[a-z]): Pelo menos 1 letra minúscula.
        #(?=.*[A-Z]): Pelo menos 1 letra maiúscula.
        #(?=.*\d): Pelo menos 1 numeral.
        #(?=.*[^a-zA-Z\d]): Pelo menos 1 caractere especial 
    //*VALIDANDO SE USUARIO EXISSTE
    $sql = "SELECT COUNT(usu_id) FROM usuarios WHERE usu_nome = '$nome' AND usu_senha = '$senha' AND usu_ativo = 's'";
    $retorno = mysqli_query($link, $sql);
    while($tbl = mysqli_fetch_array($retorno)){
        $cont = $tbl[0];
    }
    //*VERIFICAÇÃO SE USUARIO EXISTE, SE EXISTE = 1 SENÃO = 0
    if($cont == 1) {
        echo "<script>window.alert('USUÁRIO JÁ CADASTRADO!');</script>";
    }
    else{

        $tempero =md5(rand() . date('H:i:s'));
        $senha =md5($senha . $tempero);

        $sql = "INSERT INTO usuarios (usu_nome, usu_senha, usu_ativo, usu_tempero)
        VALUES('$nome','$senha','n','$tempero')";

        echo($sql);
        mysqli_query($link, $sql);
        echo "<script>window.alert('USUÁRIO CADASTRADO!');</script>";
        echo "<script>window.location.href='cadastrausuario.php';</script>";
    }
}else{echo "<script>window.alert('SENHA INVALIDA!');</script>";}
}
?>
<html>
    <head>
        <link rel="stylesheet" href="./css/estiloadm.css">
        <title>CADASTRO DE USUÁRIO</title>
    </head>
    <body>
        <div>
            <form action="cadastrausuario.php" method="post">
                <input type="text" name="nome" id="nome" placeholder="Nome de Usuario">
                <p></p>
                <input type="password" name="senha" id="senha" placeholder="Senha">
                <span id="MostrarSenha" onclick="MostrarSenha()">🙉</span>
                <p></p>
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