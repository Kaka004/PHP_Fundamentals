<?php
    #ABRE UMA CONEXÃO COM O BANCO DE DADOS
    include("cabecalho.php");

    #PASSANDO UMA INSTRUÇÃO AO BANCO DE DADOS
    $sql = "SELECT * FROM produtos WHERE pro_ativo = 's'";
    $retorno = mysqli_query($link, $sql);

    #FORÇA SEMPRE TRAZER 'S' NA VARIÁVEL PARA UTILIZARMOS NOS RADIO BUTNTON
    $ativo = "s";

    #COLETA O BOTÃO MÉTODO POST VINDO DO HTML
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $ativo = $_POST['ativo'];
    
        if ($ativo == 's') {
            $sql = "SELECT * FROM produtos WHERE pro_ativo = 's'";
        } elseif ($ativo == 'n') {
            $sql = "SELECT * FROM produtos WHERE pro_ativo = 'n'";
        } else {
            $sql = "SELECT * FROM produtos"; // Isso seleciona todos os produtos.
        }
    
        $retorno = mysqli_query($link, $sql);
    }
    
?>


<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE-edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./css/estiloadm.css">
        <title>LISTA PRODUTOS</title>
    </head>
    <body>
        <div id="background ">
            <form action="listaproduto.php" method="post">
                <input type="radio" name="ativo" class="radio" value="s"
                required onclick="submit()" <?= $ativo == 's' ? "checked" : "" ?>>ATIVOS
                <br>
                <input type="radio" name="ativo" class="radio" value="n"
                required onclick="submit()" <?= $ativo == 'n' ? "checked" : "" ?>>INATIVOS
                <br>
                <input type="radio" name="ativo" class="radio" value="todos" 
                required onclick="submit()" <?= $ativo == 'todos' ? "checked" : "" ?>>TODOS

            </form>
            <div class="container">
                <table border="1">
                    <tr>
                        <th>PRODUTO</th>
                        <th>DESCRIÇÃO</th>
                        <th>QUANTIDADE ESTOQUE</th>
                        <th>PREÇO</th>
                        <th>IMAGEM</th>
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
                            <td><?=$tbl[2] ?></td>
                            <td><?=$tbl[3] ?></td>
                            <td>R$: <?=$tbl[4] ?></td>
                            <td><img src="data:image/jpeg;base64,<?= $tbl[6] ?>" width="100" height="100"></td>
                            <td><a href="alteraproduto.php?id=<?=$tbl[0] ?>"><input type="button" value="ALTERAR DADOS"></a></td>
                            
                            <!-- AO CLICAR NO BOTÃO ELE JÁ TRARÁ O ID DO USUÁRIO PARA A PÁGINA DO ALTERUSUARIO -->
                            <td><?= $check = ($tbl[5] == "s") ? "SIM" : "NÃO" ?></td>
                            
                            
                            

                        </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>
        </div>
    </body>
</html>


