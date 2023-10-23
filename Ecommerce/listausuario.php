<?php
    #ABRE UMA CONEXÃO COM O BANCO DE DADOS
    include("conectadb.php");

    #PASSANDO UMA INSTRUÇÃO AO BANCO DE DADOS
    $sql = "SELECT * FROM usuarios WHERE usu_ativo = 's'";
    $retorno = mysqli_query($link, $sql);

    #FORÇA SEMPRE TRAZER 'S' NA VARIÁVEL PARA UTILIZARMOS NOS RADIO BUTNTON
    $ativo = "s";

    #COLETA O BOTÃO MÉTODO POST VINDO DO HTML
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $ativo = $_POST['ativo'];

        #VERIFICA SE O USUARIO ESTÁ ATIVO PARA LISTA, SE 'S' LISTA SENÃO, NÃO LISTA
        if ($ativo == 's') {
            $sql = "SELECT * FROM usuarios WHERE usu_ativo = 's'";
            $retorno = mysqli_query($link, $sql);
        } else {
            $sql = "SELECT * FROM usuarios WHERE usu_ativo = 'n'";
            $retorno = mysqli_query($link, $sql);
        }
    }
?>


<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE-edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./css/estiloadm.css">
        <title>LISTA USUARIOS</title>
    </head>
    <body>
        <div id="background ">
            <form action="listausuario.php" method="post">
                <input type="radio" name="ativo" class="radio" value="s"
                required onclick="submit()" <?= $ativo == 's' ? "checked" : "" ?>>ATIVOS
                <br>
                <input type="radio" name="ativo" class="radio" value="n"
                required onclick="submit()" <?= $ativo == 'n' ? "checked" : "" ?>>INATIVOS
            </form>
            <div class="container">
                <table border="1">
                    <tr>
                        <th>NOME</th>
                        <th>ALTERAR DADOS</th>
                        <th>ATIVO</th>
                    </tr>
                    <!-- INICIO DE PHP + HTML -->
                    <?php

                    #FAZENDO PREECHIMENTO DE TABELA USANDO WHILE (ENQUANTO TEM DADOS PARA PREENCHER)
                    while ($tbl = mysqli_fetch_array($retorno)) {

                        #MAS AQUI EU FECHO PARA TRABLHAR COM HTML SIMULTANEAMENTE
                    ?>
                        <tr>
                            <td><?=$tbl[1] ?></td> <!--TRAZ SOMENTE A COLUNA 1 [NOME] DO BANCO -->
                            <!-- AO CLICAR NO BOTÃO ELE JÁ TRARÁ O ID DO USUÁRIO PARA A PÁGINA DO ALTERUSUARIO -->
                            <td><a href="alterausuario.php?id=<?=$tbl[0] ?>"><input type="button" value="ALTERAR DADOS"></a></td>

                            <td><?= $check = ($tbl[3] == "s") ? "SIM" : "NÃO" ?></td>

                        </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>
        </div>
    </body>
</html>