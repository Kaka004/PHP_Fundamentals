<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $id = $_POST['id'];
    $nomeproduto = $_POST['nomeproduto'];
    $descricao = $_POST['descricao'];
    $quantidade = $_POST['quantidade'];
    $quantidade = (int)$quantidade;
    $preco = $_POST['preco'];
    $preco = (float)$preco;
    $totalitem = (($preco));

    #GERAR UM RANDOM PARA DEFINIR UM CARRINHO UNICO E EXCLUSIVO
$numerocarrinho = ($idusuario .RAND());

#VALIDAÇÃO CLIENTE LOGADO
if($idusuario <= 0){

    echo "<script>window.alert('VOCÊ PRECISA FAZER LOGIN PARA
     ADICIONAR ALGUM ITEM AO CARRINHO');</script>";
    echo "<script>window.location.href='loja.php';</script>";
} else {
    #VERIFICA SE EXISTE UM CARRINHO JÁ ABERTO
    $sql = "SELECT COUNT(car_id) FROM carrinho INNER JOIN clientes
    ON fk_cli_id = cli_id WHERE cli_id = $idusuario AND car_finalizado = 'n'";

    $retorno = mysqli_query($link, $sql);
    #SE O CARRINHO NÃO EXISTE CRIA UM NOVO CARRINHO

    while($tbl = mysqli_fetch_array($retorno)){
        $cont = $tbl[0];

        if($cont == 0){
            $valor_venda = $quantidade * $preco;

            #SE O CARRINHO NÃO EXISTE, GERA UM NOVO CARRINHO
            #E INSERE NA TABELA ITENS NO CARRINHO

            $sql = "SELECT INTO carrinho(car_id , car_valorvenda, fk_cli_id, car_finalizado)
            VALUES ('$numerocarrinho', '$valor_venda', '$idusuario', 'n')";
            mysqli_query($link, $sql);

            #INSERE O ITEM NO CARRINHO
            $sql2 = "INSERT INTO `item_carinho`(`fk_car_id`, `fk_pro_id`,
            `car_item_quantidade`)
            VALUES ($numerocarrinho, $id, $quantidade)";
            mysqli_query($link, $sql2);
            $_SESSION['carrinhoid'] = $numerocarrinho;
            echo "<script>window.alert('PRODUTO CADASTRADO AO CARRINHO
            $numerocarrinhocliente');</script>";
        } else{
            #SE O CARRINHO JÁ EXISTE, CONSULTA O NUMERO DO CARRINHO PARA ADICIONAR MAIS ITENS
            $sql = "SELECT car_id FROM carrinho WHERE fk_cli_id = '$idusuario'
            AND car_finalizado = 'n'";
            mysqli_query($link, $sql);

            while($tbl = mysqli_fetch_array($retorno)){
                $numerocarrinhocliente = $tbl[0];
                $_SESSION['carrinhoid'] = $numerocarrinhocliente;
                
                #VERIFICA SE JÁ EXISTE ESSE ITEM NO CARRINHO
                #SE JA EXISTE, ATUALIZA A QUANTIDADE
                $sql2 = "SELECT car_item_quantidade FROM item_carrinho WHERE
                fk_car_id = '$numerocarrinhocliente' AND fk_pro_id = '$id'";
                $retorno2 = mysqli_query($link, $sql2);
                $qtd_atual = mysqli_fetch_array($retorno2);
                if($retorno2) {
                    if(mysqli_num_rows($retorno2) >= 1){
                        $sql = "SELECT item_carrinho SET car_item_quantidade = ($quantidade+$qtd_atual[0])
                        WHERE fk_car_id = '$numerocarrinhocliente' AND fk_pro_id = $id";
                        mysqli_query($link, $sql);
                        echo "<script>window.alert('PRODUTO ADICIONADO AO CARRINHO $numerocarrinhocliente');</script>";
                        echo "<script>window.location.href='loja.php';</script>";
                    }
                    #SE JA EXISTE, ADICIONA O NOVO ITEM
                    else{
                        $sql = "SELECT INTO `item_carrinho`(`fk_car_id`,
                         `fk_pro_id`, `car_item_quantidade`)
                        VALUES ($numerocarrinhocliente, $id, $quantidade)";
                        mysqli_query($link, $sql);
                        echo "<script>window.alert('PRODUTO ADICIONADO AO CARRINHO $numerocarrinhocliente');</script>";
                        echo "<script>window.location.href = 'loja.php';</script>";
                    }

                }

            }
        }

    }

}
        echo "<script>window.location.href='loja.php';</script>";
        exit();
}

$id = $_GET["id"];
$sql =  "SELECT * FROM produtos WHERE pro_id = '$id'";
$retorno = mysqli_query($link, $sql);
while($tbl = mysqli_fetch_array($retorno)){
    $id = $tbl[0];
    $nomeproduto = $tbl[3];
    $descricao = $tbl[2];
    $preco = $tbl[4];
    $imagem_atual = $tbl[6];
}

#CORAÇÃOZINHO DO FAVORITOS

if(isset($idusuario)) {
    $sql = "SELECT COUNT(fav_id) FROM favoritos WHERE fac_cli_id 
    = $idusuario AND fav_pro_id = $id";
    $retorno = mysqli_query($link, $sql);

    while($tbl = mysqli_fetch_array($retorno)){
        $cont = $tbl[0];
        if($cont <= 0){
            $coracao = "";
        } else {
            $coracao = "";
        }
    }
} else {
    $coracao = "";
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/estiloadm.css">
    <title>VISUALIZANDO PRODUTO</title>
</head>
<body>
    <div class="formulario">
    <form action="verproduto.php" class="visualizaproduto" method="post"
    enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $id ?>" readonly>
        <label>NOME</label>
        <input type="text" name="nomeproduto" id="nome"
        value="<? $nomeproduto ?>" readonly>
        <label>DESCRIÇÃO</label>
        <textarea name="descricao" readonly><? $descricao ?></textarea>
        <label>QUANTIDADE</label>
        <input type="number" name="quantidade" id="quantidade"
        min="1" value="1">
        <label>PREÇO</label>
        <input type="number" name="preco" id="preco"
        value="R$ <? $preco ?>" readonly>
        <input type="submit" value="ADICIONAR AO CARRINHO">

    </form>
    </div>
    <div style="position: relative;">
    <a href="favoritar.php?id=<? $id ?>"
    style="position: absolute; top: 0; left: 0;">
    <img src="<?php echo $coracao; ?>" width="50" height="50" />
    </a>
    <td> <img name="imagem_atual" class="imagem_atual" 
    src="data:image/jpeg;base64, <?= $imagem_atual ?>"></td>
    </div>
</body>
</html>